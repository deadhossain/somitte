<?php

namespace App\Exports\backends\loan;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class LoanDepositsExportView implements FromView
{
    public $startTime,$endTime,$accounts;

    public function __construct($startTime, $endTime, $accounts)
    {
        $this->startTime = $startTime;
        $this->endTime = $endTime;
        $this->accounts = $accounts;
    }
    public function view(): View
    {
        return view('backends.pages.loan.deposit.reports.month_wise_report_table_excel', [
            'startTime' => $this->startTime,
            'endTime' => $this->endTime,
            'accounts' => $this->accounts
        ]);
    }
}
