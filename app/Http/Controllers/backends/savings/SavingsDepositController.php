<?php

namespace App\Http\Controllers\backends\savings;

use App\Models\savings\SavingsDeposit;
use App\Models\savings\SavingsAccount;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Crypt;
use Yajra\DataTables\Facades\DataTables;
use App\Http\Requests\backends\savings\StoreSavingsDepositRequest;
use App\Models\setups\LookupDetail;
use Auth;
use DateTime;

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
    public function data($date="")
    {
        $date = $date?:date('F-Y');
        $depositDate = array(
            'start_date' => date('Y-m-1',strtotime($date)),
            'end_date' => date('Y-m-t',strtotime($date))
        );

        $accounts = SavingsAccount::with(['activeCustomer','activeSavingsScheme',
                    'currentSavingsDeposit' => function ( $query ) use ($depositDate)
                    {
                        $query->whereBetween('deposit_date',$depositDate)->latest();
                    }])
                    ->where('savings_accounts.start_date','<',$depositDate['end_date'])
                    ->where(function ($query) use($depositDate) {
                        $query->whereNull('end_date')->orWhere('end_date','>=',$depositDate['end_date']);
                    })->get();

        return Datatables::of($accounts)->addIndexColumn()
        ->setRowClass(function ($account) {
            return empty($account->currentSavingsDeposit) ? 'alert-danger' : '';
        })
        ->addColumn('actions', function ($account) use ($date){
            return (string) view('backends.pages.savings.deposit.actions',['account' => $account,'date' => $date]);
        })->rawColumns(['actions','status'])->make();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($savingsAccountId,$date)
    {
        $savingsAccountId = Crypt::decrypt($savingsAccountId);
        $account = SavingsAccount::with(['activeCustomer','activeSavingsScheme'])->find($savingsAccountId);
        $date1 = new DateTime($date);
        $date2 = new DateTime();
        $days = $date1->diff($date2)->d; // check if customer paying late
        $lateDays = LookupDetail::where(['udid' => 'LS'])->firstOrFail();
        // dd($days,$lateDays->value);
        return view('backends.pages.savings.deposit.create',compact('account','date','lateDays','days'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreSavingsDepositRequest $request,$savingsAccountId)
    {
        try {
            $savingsAccountDeposit = SavingsDeposit::firstOrNew([
                'savings_accounts_id' => Crypt::decrypt($savingsAccountId),
                'schedule_date' => insertDateFormat($request->input('schedule_date'))
            ]);

            $savingsAccountDeposit->deposit_amount = trim($request->input('deposit_amount'))?:0;
            $savingsAccountDeposit->late_fee = trim($request->input('late_fee'))?:0;
            $savingsAccountDeposit->deposit_date = insertDateFormat($request->input('deposit_date'));
            $savingsAccountDeposit->remarks = $request->input('remarks');
            $savingsAccountDeposit->active_fg = 1;
            $savingsAccountDeposit->created_by = Auth::user()->id;
            $is_saved = $savingsAccountDeposit->save();
            if ($is_saved) {
                return back()->with('message', 'Deposit has been Succesful');
            } else {
                return back()->withErrors(['error'=>'Deposit has not been Succesful']);
            }
        } catch (\Exception $th) {
            return back()->withErrors([
                'error'=>'Seek system administrator help',
                'error-dev'=> $th->getMessage()
            ]);
        }
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
