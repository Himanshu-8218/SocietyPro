<?php

namespace App\Http\Controllers;

use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use thiagoalessio\TesseractOCR\TesseractOCR;

class OcrController extends Controller
{
    public function showForm()
    {
        return view('resident.ocr');
    }

    private function extractValueForTag($text, $tag)
    {
        // Common patterns for tag-value pairs
        $patterns = [
            // Pattern 1: "Tag: Value" or "Tag : Value"
            "/\b" . preg_quote($tag, '/') . "\s*:\s*([^\n]+)/i",
            
            // Pattern 2: "Tag = Value"
            "/\b" . preg_quote($tag, '/') . "\s*=\s*([^\n]+)/i",
            // Pattern 3: "Tag . Value"
            "/\b" . preg_quote($tag, '/') . "\s*.\s*([^\n]+)/i",
            
            // Pattern 4: "Tag Value" (when tag is immediately followed by value)
            "/\b" . preg_quote($tag, '/') . "\s+([^\n]+)/i"
        ];

        foreach ($patterns as $pattern) {
            if (preg_match($pattern, $text, $matches)) {
                return trim($matches[1]);
            }
        }

        return null; // Return null if no match found
    }

    public function process(Request $request)
    {
        try {
            $request->validate([
                'image' => 'required|image|max:5120', // 5MB max
                'tags' => 'nullable|string'
            ]);

            $image = $request->file('image');
            $path = $image->store('ocr_uploads', 'public');
            $fullPath = storage_path('app/public/' . $path);

            // Debug information
            $debug = [
                'file_exists' => file_exists($fullPath),
                'file_size' => filesize($fullPath),
                'file_path' => $fullPath,
                'tesseract_exists' => file_exists('C:\Program Files\Tesseract-OCR\tesseract.exe')
            ];

            // Perform OCR using Tesseract directly
            $tesseract = new TesseractOCR($fullPath);
            $tesseract->executable('C:\Program Files\Tesseract-OCR\tesseract.exe');
            
            $text = $tesseract->run();
            
            if (empty($text)) {
                throw new Exception('No text was extracted from the image');
            }

            // Process tags if provided
            $tagValues = [];
            if ($request->has('tags') && !empty($request->tags)) {
                $tags = array_map('trim', explode(',', $request->tags));
                foreach ($tags as $tag) {
                    $value = $this->extractValueForTag($text, $tag);
                    $tagValues[$tag] = $value;
                }
            }

            // Generate a unique identifier for this OCR result
            $resultId = Str::random(20);

            // Format the result with metadata
            $result = [
                'id' => $resultId,
                'timestamp' => now()->toIso8601String(),
                'text' => $text,
                'confidence' => 100,
                'file_path' => $path,
                'original_filename' => $image->getClientOriginalName(),
                'mime_type' => $image->getMimeType(),
                'file_size' => $image->getSize(),
                'extracted_tags' => $tagValues,
                'metadata' => [
                    'ocr_engine' => 'Tesseract',
                    'language' => 'eng',
                    'processing_time' => microtime(true) - LARAVEL_START
                ]
            ];

            // Save the result as JSON file
            $jsonPath = 'ocr_results/' . $resultId . '.json';
            Storage::put('public/' . $jsonPath, json_encode($result, JSON_PRETTY_PRINT));

            return view('resident.ocr', [
                'result' => $result,
                'debug' => $debug,
                'json_path' => $jsonPath,
                'tags' => $request->tags
            ]);

        } catch (Exception $e) {
            return view('resident.ocr', [
                'error' => 'OCR Error: ' . $e->getMessage(),
                'debug' => $debug ?? null,
                'tags' => $request->tags
            ]);
        }
    }

    public function downloadJson($resultId)
    {
        $jsonPath = 'public/ocr_results/' . $resultId . '.json';
        
        if (!Storage::exists($jsonPath)) {
            abort(404, 'OCR result file not found');
        }

        return Storage::download($jsonPath, 'ocr_result_' . $resultId . '.json');
    }
}
