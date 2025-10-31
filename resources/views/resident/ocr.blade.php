@include('resident.resident-nav')

<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow">
                <div class="card-header bg-primary text-white">
                    <h2 class="mb-0"><i class="bi bi-file-earmark-text me-2"></i>OCR Image Processing</h2>
                </div>
                <div class="card-body">
                    <form action="{{ route('ocr.process') }}" method="POST" enctype="multipart/form-data" class="mb-4">
                        @csrf
                        <div class="mb-3">
                            <label for="image" class="form-label">Choose an image (max 5MB)</label>
                            <input type="file" name="image" id="image" accept="image/*" required
                                class="form-control">
                            <div class="form-text">Supported formats: PNG, JPEG, JPG, GIF</div>
                        </div>

                        <div class="mb-3">
                            <label for="tags" class="form-label">
                                <i class="bi bi-tags me-2"></i>Tags to Extract
                            </label>
                            <input type="text" name="tags" id="tags" value="{{ $tags ?? '' }}"
                                class="form-control"
                                placeholder="Enter tags separated by commas (e.g., Name, Date, Amount)">
                            <div class="form-text">
                                Enter keywords to extract specific values from the text. The system will look for patterns like "Tag: Value" or "Tag = Value".
                            </div>
                        </div>

                        <button type="submit" class="btn btn-primary">
                            <i class="bi bi-image me-2"></i>Process Image
                        </button>
                    </form>

                    @if(isset($error))
                        <div class="alert alert-danger">
                            <i class="bi bi-exclamation-triangle me-2"></i>{{ $error }}
                        </div>
                    @endif

                    @if(isset($result))
                        <div class="card mt-4">
                            <div class="card-header bg-success text-white">
                                <h3 class="mb-0"><i class="bi bi-check-circle me-2"></i>OCR Results</h3>
                            </div>
                            <div class="card-body">
                                @if(!empty($result['extracted_tags']))
                                    <div class="mb-4">
                                        <h4 class="text-muted mb-3">
                                            <i class="bi bi-tags me-2"></i>Extracted Tag Values:
                                        </h4>
                                        <div class="table-responsive">
                                            <table class="table table-bordered">
                                                <thead class="table-light">
                                                    <tr>
                                                        <th>Tag</th>
                                                        <th>Extracted Value</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach($result['extracted_tags'] as $tag => $value)
                                                        <tr>
                                                            <td><strong>{{ $tag }}</strong></td>
                                                            <td>{{ $value ?? 'Not found' }}</td>
                                                        </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                @endif

                                <div class="mb-4">
                                    <h4 class="text-muted mb-3">Full Extracted Text:</h4>
                                    <pre class="bg-light p-3 rounded">{{ $result['text'] }}</pre>
                                </div>

                                <div class="mb-3">
                                    <h4 class="text-muted mb-3">Details:</h4>
                                    <ul class="list-group">
                                        <li class="list-group-item d-flex justify-content-between align-items-center">
                                            <span><i class="bi bi-percent me-2"></i>Confidence</span>
                                            <span class="badge bg-primary rounded-pill">{{ $result['confidence'] }}%</span>
                                        </li>
                                        <li class="list-group-item">
                                            <i class="bi bi-file-earmark me-2"></i>Original File: {{ $result['original_filename'] }}
                                        </li>
                                    </ul>
                                </div>
                                
                                @if(isset($json_path))
                                    <div class="mt-4">
                                        <a href="{{ route('ocr.download', ['resultId' => $result['id']]) }}"
                                           class="btn btn-success">
                                            <i class="bi bi-download me-2"></i>Download JSON Results
                                        </a>
                                        <button class="btn btn-info ms-2" type="button" data-bs-toggle="collapse" 
                                                data-bs-target="#jsonPreview" aria-expanded="false">
                                            <i class="bi bi-code-square me-2"></i>Preview JSON
                                        </button>
                                    </div>
                                    <div class="collapse mt-3" id="jsonPreview">
                                        <div class="card card-body bg-light">
                                            <pre class="mb-0" style="white-space: pre-wrap;">{{ json_encode($result, JSON_PRETTY_PRINT) }}</pre>
                                        </div>
                                    </div>
                                @endif
                            </div>
                        </div>
                    @endif

                    @if(isset($debug))
                        <div class="card mt-4">
                            <div class="card-header bg-info text-white">
                                <h3 class="mb-0"><i class="bi bi-info-circle me-2"></i>Debug Information</h3>
                            </div>
                            <div class="card-body">
                                <ul class="list-group">
                                    <li class="list-group-item">
                                        <strong><i class="bi bi-check-circle me-2"></i>File Exists:</strong> 
                                        {{ $debug['file_exists'] ? 'Yes' : 'No' }}
                                    </li>
                                    <li class="list-group-item">
                                        <strong><i class="bi bi-file-earmark me-2"></i>File Size:</strong> 
                                        {{ number_format($debug['file_size']) }} bytes
                                    </li>
                                    <li class="list-group-item">
                                        <strong><i class="bi bi-gear me-2"></i>Tesseract Installed:</strong> 
                                        {{ $debug['tesseract_exists'] ? 'Yes' : 'No' }}
                                    </li>
                                    <li class="list-group-item">
                                        <strong><i class="bi bi-folder me-2"></i>File Path:</strong> 
                                        <small>{{ $debug['file_path'] }}</small>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>