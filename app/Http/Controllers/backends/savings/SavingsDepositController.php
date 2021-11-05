<?php

namespace App\Http\Controllers\backends\savings;

use App\Models\savings\SavingsDeposit;
use App\Models\savings\SavingsAccount;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Crypt;
use Yajra\DataTables\Facades\DataTables;
use App\Http\Requests\backends\savings\StoreSavingsAccountRequest;
use Auth;

class SavingsDepositController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('backends.pages.savings.deposit.index');
    }

    /**
     * Display a listing of the employee.
     *
     * @return \Illuminate\Http\Response
     */
    public function data(Request $request,$date,$paymentMethodId=0)
    {
        $date = $date?:date('F-Y');
        $depositDate = array(
            'start_date' => date('Y-m-1',strtotime($date)),
            'end_date' => date('Y-m-t',strtotime($date))
        );

        $accounts = SavingsAccount::with([
                    'activeCustomer','activeSavingsScheme',
                    'activeSavingsDeposits' => function ( $query ) use ($depositDate)
                    {
                        $query->whereBetween('deposit_date',$depositDate)->latest();
                    }])
                    ->where('savings_accounts.start_date','<',$depositDate['end_date'])
                    ->where(function ($query) use($depositDate) {
                        $query->whereNull('end_date')
                              ->orWhere('end_date','>=',$depositDate['end_date']);
                    })->get();

        return Datatables::of($accounts)->addIndexColumn()
        // ->setRowClass(function ($employee) {
        //     return $employee->ld_id == 13 ? 'alert-danger' : '';
        // })
        ->addColumn('actions', function ($account) use ($depositDate){
            return (string) view('backends.pages.savings.deposit.actions',['account' => $account,'date' => $depositDate]);
        })->rawColumns(['actions','status'])->make();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\savings\SavingsDeposit  $savingsDeposit
     * @return \Illuminate\Http\Response
     */
    public function show(SavingsDeposit $savingsDeposit)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\savings\SavingsDeposit  $savingsDeposit
     * @return \Illuminate\Http\Response
     */
    public function edit(SavingsDeposit $savingsDeposit)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\savings\SavingsDeposit  $savingsDeposit
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, SavingsDeposit $savingsDeposit)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\savings\SavingsDeposit  $savingsDeposit
     * @return \Illuminate\Http\Response
     */
    public function destroy(SavingsDeposit $savingsDeposit)
    {
        //
    }
}
