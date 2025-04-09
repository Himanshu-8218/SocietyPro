<?php
namespace App\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\DB;

class FinancialReports extends Component
{
    public $monthly = [], $quarterly = [], $yearly = [], $bySource = [];

    public function mount()
    {
        $this->loadFinancialData();
    }

    public function loadFinancialData()
    {
        $this->monthly = DB::table('financial_transactions')
            ->selectRaw('YEAR(transaction_date) as year, MONTH(transaction_date) as month, SUM(amount) as total')
            ->groupByRaw('YEAR(transaction_date), MONTH(transaction_date)')
            ->orderByRaw('YEAR(transaction_date), MONTH(transaction_date)')
            ->get();

        $this->quarterly = DB::table('financial_transactions')
            ->selectRaw('YEAR(transaction_date) as year, QUARTER(transaction_date) as quarter, SUM(amount) as total')
            ->groupByRaw('YEAR(transaction_date), QUARTER(transaction_date)')
            ->orderByRaw('YEAR(transaction_date), QUARTER(transaction_date)')
            ->get();

        $this->yearly = DB::table('financial_transactions')
            ->selectRaw('YEAR(transaction_date) as year, SUM(amount) as total')
            ->groupBy('year')
            ->orderBy('year')
            ->get();

        $this->bySource = DB::table('financial_transactions')
            ->selectRaw('source, SUM(amount) as total')
            ->groupBy('source')
            ->get();
    }

    public function render()
    {
        return view('livewire.financial-reports');
    }
}
