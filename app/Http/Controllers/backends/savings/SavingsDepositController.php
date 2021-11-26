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
    public function index(Request $request)
    {
        $month = $request->input('month-picker')?date('F-Y',strtotime($request->input('month-picker'))):date('F-Y');
        return view('backends.pages.savings.deposit.index',compact('month'));
    }

    /**
     * Display a listing of the employee.
     *
     * @return \Illuminate\Http\Response
     */
    public function data($month="")
    {
        $month = $month?:date('F-Y');
        $depositDate = array(
            'start_date' => date('Y-m-1',strtotime($month)),
            'end_date' => date('Y-m-t',strtotime($month))
        );

        $accounts = SavingsAccount::with(['customer','savingsScheme',
                    'currentSavingsDeposit' => function ( $query ) use ($depositDate)
                    {
                        $query->whereBetween('schedule_date',$depositDate)->latest();
                    }])
                    ->where('savings_accounts.start_date','<',$depositDate['end_date'])
                    ->where('savings_accounts.active_fg',1)
                    ->where(function ($query) use($depositDate) {
                        $query->whereNull('end_date')->orWhere('end_date','>=',$depositDate['end_date']);
                    })->get();

        return Datatables::of($accounts)->addIndexColumn()
        ->setRowClass(function ($account) {
            return empty($account->currentSavingsDeposit) ? 'alert-danger' : '';
        })
        ->addColumn('paymentStatus', function ($account) {
            if (empty($account->currentSavingsDeposit)) return '<label class="label label-danger">Unpaid</label>';
                return '<label class="label label-success">Paid</label>';
        })
        ->addColumn('actions', function ($account) use ($month){
            return (string) view('backends.pages.savings.deposit.actions',['account' => $account,'date' => $month]);
        })->rawColumns(['actions','paymentStatus'])->make();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($savingsAccountId,$date)
    {
        $savingsAccountId = Crypt::decrypt($savingsAccountId);
        $account = SavingsAccount::with(['customer','savingsScheme'])->find($savingsAccountId);
        $date1 = new DateTime($date);
        $date2 = new DateTime();
        $days = $date1->diff($date2)->days; // check if customer paying late
        $lateDays = LookupDetail::where(['udid' => 'LS'])->firstOrFail();
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
    public function edit($id)
    {
        $id = Crypt::decrypt($id);
        $deposit = SavingsDeposit::with(['savingsAccount','savingsAccount.customer','savingsAccount.savingsScheme'])->findorFail($id);
        return view('backends.pages.savings.deposit.edit',compact('deposit'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\savings\SavingsDeposit  $savingsDeposit
     * @return \Illuminate\Http\Response
     */
    public function update(StoreSavingsDepositRequest $request, SavingsDeposit $savingsDeposit)
    {
        try {
            $id = Crypt::decrypt($request->deposit);
            $savingsAccountDeposit = SavingsDeposit::findOrFail($id);
            // $savingsAccountDeposit->schedule_date = insertDateFormat($request->input('schedule_date'));
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
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\savings\SavingsDeposit  $savingsDeposit
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try{
            $id = Crypt::decrypt($id);
            $savingsAccountDeposit = SavingsDeposit::findOrFail($id);
            $savingsAccountDeposit->active_fg=0;
            $savingsAccountDeposit->updated_by = Auth::user()->id;
            $result = $savingsAccountDeposit->save();
            if ($result) return response()->json(['type'=>'success', 'title'=>'Deleted!', 'msg'=>'Deposit has been removed']);
            return response()->json(['type'=>'error', 'title'=>'Sorry!', 'msg'=>'Failed to remove Deposit']);
        }
        catch (\Exception $e) {
            return response()->json(['type'=>'error', 'title'=>'System Failure!!', 'msg'=>$e->getMessage()], 400);
        }
    }

    public function monthWiseDepositReport(Request $request)
    {
        $currentYear = date('01/01/Y').' - ' .date('31/12/Y');
        $daterange = $request->input('datefilter')?:$currentYear;
        $daterangeArray = explode("-",$daterange);
        $daterangeArray[0] = date('Y-m-d',strtotime(str_replace('/', '-', trim($daterangeArray[0]))));
        $daterangeArray[1] = date('Y-m-d',strtotime(str_replace('/', '-', trim($daterangeArray[1]))));
        $startTime = strtotime($daterangeArray[0]);
        $endTime = strtotime($daterangeArray[1]);

        $accounts = SavingsAccount::with(['customer','savingsScheme','activeSavingsDeposits'])
                    ->where('savings_accounts.start_date','<',$daterangeArray[1])
                    ->where('savings_accounts.active_fg',1)
                    ->where(function ($query) use($daterangeArray) {
                        $query->whereNull('end_date')->orWhere('end_date','>=',$daterangeArray[1]);
                    })->get();
        return view('backends.pages.savings.deposit.reports.month_wise_report',compact('daterange','daterangeArray','startTime','endTime','accounts'));
    }
}
