<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\FinancialTransaction;
use Carbon\Carbon;

class FinancialTransactionSeeder extends Seeder
{
    public function run()
    {
        $sources = ['maintenance', 'facility_booking'];

        foreach (range(1, 100) as $index) {
            FinancialTransaction::create([
                'transaction_date' => Carbon::now()->subDays(rand(0, 1825))->toDateString(), // last 5 years
                'amount'           => rand(1000, 5000),
                'source'           => $sources[array_rand($sources)],
            ]);
        }
    }
}
