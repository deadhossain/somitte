<?php

namespace App\Http\Controllers\backends\loan;

use Illuminate\Http\Request;
use App\Models\loan\LoanDeposit;
use App\Models\loan\LoanAccount;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Crypt;
use Yajra\DataTables\Facades\DataTables;
use App\Http\Requests\backends\loan\StoreLoanDepositRequest;
use App\Models\setups\LookupDetail;
use App\Models\person\Customer;
use App\Models\loan\LoanScheme;
use Auth;
use DateTime;

class LoanDepositController extends Controller
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
        return view('backends.pages.loan.deposit.index',compact('month'));
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

        $accounts = LoanAccount::with(['customer','loanScheme',
                    'currentLoanDeposit' => function ( $query ) use ($depositDate)
                    {
                        $query->whereBetween('schedule_date',$depositDate)->latest();
                    }])
                    ->where('loan_accounts.start_installment_date','<',$depositDate['end_date'])
                    ->where('loan_accounts.active_fg',1)
                    ->where(function ($query) use($depositDate) {
                        $query->whereNull('end_installment_date')->orWhere('end_installment_date','>=',$depositDate['end_date']);
                    })->get();

        return Datatables::of($accounts)->addIndexColumn()
        ->setRowClass(function ($account) {
            return empty($account->currentLoanDeposit) ? 'alert-danger' : '';
        })
        ->addColumn('paymentStatus', function ($account) {
            if (empty($account->currentLoanDeposit)) return '<label class="label label-danger">Unpaid</label>';
                return '<label class="label label-success">Paid</label>';
        })
        ->addColumn('actions', function ($account) use ($month){
            return (string) view('backends.pages.loan.deposit.actions',['account' => $account,'date' => $month]);
        })->rawColumns(['actions','paymentStatus'])->make();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($loanAccountId,$date)
    {
        $loanAccountId = Crypt::decrypt($loanAccountId);
        $account = LoanAccount::with(['customer','loanScheme'])->find($loanAccountId);
        $date1 = new DateTime($date);
        $date2 = new DateTime();
        $days = $date1->diff($date2)->days; // check if customer paying late
        $lateDays = LookupDetail::where(['udid' => 'LLF'])->firstOrFail();
        return view('backends.pages.loan.deposit.create',compact('account','date','lateDays','days'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreLoanDepositRequest $request,$loanAccountId)
    {
        try {
            $loanAccountDeposit = LoanDeposit::firstOrNew([
                'loan_accounts_id' => Crypt::decrypt($loanAccountId),
                'schedule_date' => insertDateFormat($request->input('schedule_date'))
            ]);

            $loanAccountDeposit->deposit_amount = trim($request->input('deposit_amount'))?:0;
            $loanAccountDeposit->late_fee = trim($request->input('late_fee'))?:0;
            $loanAccountDeposit->deposit_date = insertDateFormat($request->input('deposit_date'));
            $loanAccountDeposit->remarks = $request->input('remarks');
            $loanAccountDeposit->active_fg = 1;
            $loanAccountDeposit->created_by = Auth::user()->id;
            $is_saved = $loanAccountDeposit->save();
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
     * @param  \App\Models\loan\LoanDeposit  $loanDeposit
     * @return \Illuminate\Http\Response
     */
    public function show(LoanDeposit $loanDeposit)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\loan\LoanDeposit  $loanDeposit
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $id = Crypt::decrypt($id);
        $deposit = LoanDeposit::with(['loanAccount','loanAccount.customer','loanAccount.loanScheme'])->findorFail($id);
        return view('backends.pages.loan.deposit.edit',compact('deposit'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\loan\LoanDeposit  $loanDeposit
     * @return \Illuminate\Http\Response
     */
    public function update(StoreLoanDepositRequest $request, LoanDeposit $loanAccountDeposit)
    {
        try {
            $id = Crypt::decrypt($request->loan_deposit);
            $loanAccountDeposit = LoanDeposit::findOrFail($id);
            // $loanAccountDeposit->schedule_date = insertDateFormat($request->input('schedule_date'));
            $loanAccountDeposit->deposit_amount = trim($request->input('deposit_amount'))?:0;
            $loanAccountDeposit->late_fee = trim($request->input('late_fee'))?:0;
            $loanAccountDeposit->deposit_date = insertDateFormat($request->input('deposit_date'));
            $loanAccountDeposit->remarks = $request->input('remarks');
            $loanAccountDeposit->active_fg = 1;
            $loanAccountDeposit->created_by = Auth::user()->id;
            $is_saved = $loanAccountDeposit->save();
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
     * @param  \App\Models\loan\LoanDeposit  $loanDeposit
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try{
            $id = Crypt::decrypt($id);
            $loanAccountDeposit = LoanDeposit::findOrFail($id);
            $loanAccountDeposit->active_fg=0;
            $loanAccountDeposit->updated_by = Auth::user()->id;
            $result = $loanAccountDeposit->save();
            if ($result) return response()->json(['type'=>'success', 'title'=>'Deleted!', 'msg'=>'Deposit has been removed']);
            return response()->json(['type'=>'error', 'title'=>'Sorry!', 'msg'=>'Failed to remove Deposit']);
        }
        catch (\Exception $e) {
            return response()->json(['type'=>'error', 'title'=>'System Failure!!', 'msg'=>$e->getMessage()], 400);
        }
    }

    public function monthWiseDepositReport(Request $request)
    {
        // dd($request->all());
        $currentYear = date('01/01/Y').' - ' .date('31/12/Y');
        $customerId = $request->input('customer_id')?:0;
        $accountId = $request->input('account_id')?:0;
        $loanSchemeId = $request->input('loan_scheme_id')?:0;

        $daterange = $request->input('datefilter')?:$currentYear;
        // dd($request->all(),$request->input('customer_id'),$customerId,$request->input('loan_scheme_id'),$loanSchemeId,$loanSchemeId!=0);

        $daterangeArray = explode("-",$daterange);
        $daterangeArray[0] = date('Y-m-d',strtotime(str_replace('/', '-', trim($daterangeArray[0]))));
        $daterangeArray[1] = date('Y-m-d',strtotime(str_replace('/', '-', trim($daterangeArray[1]))));
        $startTime = strtotime($daterangeArray[0]);
        $endTime = strtotime($daterangeArray[1]);

        $accounts = LoanAccount::with(['customer','loanScheme','activeLoanDeposits'])
                    ->where('loan_accounts.start_installment_date','<',$daterangeArray[1])
                    ->where('loan_accounts.active_fg',1)

                    ->where(function ($query) use($daterangeArray) {
                        $query->whereNull('end_installment_date')->orWhere('end_installment_date','>=',$daterangeArray[1]);
                    });

        if ($customerId!==0){
            $customerId = Crypt::decrypt($customerId);
            $accounts = $accounts->whereHas('customer', function($q) use ($customerId){ $q->where('id','=', $customerId);});
        }
        if ($accountId!==0){
            $accountId = Crypt::decrypt($accountId);
            $accounts = $accounts->where('id', $accountId);
        }

        if ($loanSchemeId!==0){
            $loanSchemeId = Crypt::decrypt($loanSchemeId);
            $accounts = $accounts->whereHas('loanScheme', function($q) use ($loanSchemeId){ $q->where('id','=', $loanSchemeId);});
        }

        $accounts = $accounts->get();
        $customers = Customer::where('active_fg',1)->get();
        $loanSchemes = LoanScheme::where('active_fg',1)->get();
        return view('backends.pages.loan.deposit.reports.month_wise_report',
                compact('daterange','daterangeArray','startTime','endTime','accounts','accountId','endTime','accounts','customers','customerId','loanSchemes','loanSchemeId'));
    }
}
