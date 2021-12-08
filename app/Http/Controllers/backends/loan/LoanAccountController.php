<?php

namespace App\Http\Controllers\backends\loan;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\loan\LoanAccount;
use App\Models\loan\LoanScheme;
use App\Models\person\Customer;
use Illuminate\Support\Facades\Crypt;
use Yajra\DataTables\Facades\DataTables;
use App\Http\Requests\backends\loan\StoreLoanAccountRequest;
use Auth;

class LoanAccountController extends Controller
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
        return view('backends.pages.loan.account.index');
    }

    /**
     * Display a tables data.
     *
     * @return \Illuminate\Http\Response
     */
    public function data()
    {
        try {
            $loanAccounts = LoanAccount::with(['customer','loanScheme','nominee'])->get();

            // dd($loanAccounts);
            return Datatables::of($loanAccounts)->addIndexColumn()
            ->addColumn('actions', function ($loanAccount) {
                return (string) view('backends.pages.loan.account.actions', ['loanAccount' => $loanAccount]);
            })->rawColumns(['actions','status'])->make();
        } catch (\Exception $th) {
            return back()->withErrors([
                'error'=>'Seek system administrator help',
                'error-dev'=> $th->getMessage()
            ]);
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $customers = Customer::where('active_fg',1)->get();
        $loanSchemes = LoanScheme::where('active_fg',1)->get();
        return view('backends.pages.loan.account.create',compact('customers','loanSchemes'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreLoanAccountRequest $request)
    {
        try {
            $loanAccount = new LoanAccount;
            $loanAccount->account_no = $request->input('account_no');
            $loanAccount->first_deposit_amount = trim($request->input('first_deposit_amount'))?:0;
            $loanAccount->customer_id = Crypt::decrypt($request->input('customer_id'));
            $loanAccount->loan_scheme_id = Crypt::decrypt($request->input('loan_scheme_id'));
            $loanAccount->start_date = insertDateFormat($request->input('start_date'));
            $loanAccount->end_date = insertDateFormat($request->input('end_date'));
            $loanAccount->remarks = $request->input('remarks');
            $loanAccount->active_fg = 1;
            $loanAccount->created_by = Auth::user()->id;
            $is_saved = $loanAccount->save();
            if ($is_saved) {
                return back()->with('message', 'Loan Account has been added');
            } else {
                return back()->withErrors(['error'=>'Loan Account has not been added']);
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
     * @param  \App\Models\loan\LoanAccount  $loanAccount
     * @return \Illuminate\Http\Response
     */
    public function show(LoanAccount $loanAccount)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\loan\LoanAccount  $loanAccount
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $id = Crypt::decrypt($id);
        $loanAccount = LoanAccount::findorFail($id);
        $customers = Customer::where('active_fg',1)->get();
        $loanSchemes = LoanScheme::where('active_fg',1)->get();
        return view('backends.pages.loan.account.edit',compact('loanAccount','customers','loanSchemes'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\loan\LoanAccount  $loanAccount
     * @return \Illuminate\Http\Response
     */
    public function update(StoreLoanAccountRequest $request, LoanAccount  $loanAccount)
    {
        try {
            $id = Crypt::decrypt($request->account);
            $loanAccount = LoanAccount::findOrFail($id);
            $loanAccount->account_no = $request->input('account_no');
            $loanAccount->first_deposit_amount = trim($request->input('first_deposit_amount'))?:0;
            $loanAccount->customer_id = Crypt::decrypt($request->input('customer_id'));
            $loanAccount->loan_scheme_id = Crypt::decrypt($request->input('loan_scheme_id'));
            $loanAccount->start_date = insertDateFormat($request->input('start_date'));
            $loanAccount->end_date = insertDateFormat($request->input('end_date'));
            $loanAccount->remarks = $request->input('remarks');
            $loanAccount->active_fg = $request->input('active_fg');
            $loanAccount->updated_by = Auth::user()->id;
            $is_saved = $loanAccount->save();
            if ($is_saved) {
                return back()->with('message', 'Loan Account has been updated');
            } else {
                return back()->withErrors(['error'=>'Loan Account has not been updated']);
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
     * @param  \App\Models\loan\LoanAccount  $loanAccount
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try{
            $id = Crypt::decrypt($id);
            $loanAccount = LoanAccount::findOrFail($id);
            $loanAccount->active_fg=0;
            $loanAccount->updated_by = Auth::user()->id;
            $result = $loanAccount->save();
            if ($result) return response()->json(['type'=>'success', 'title'=>'Deleted!', 'msg'=>'Loan Account has been deleted']);
            return response()->json(['type'=>'error', 'title'=>'Sorry!', 'msg'=>'Failed to delete Loan Account']);
        }
        catch (\Exception $e) {
            return response()->json(['type'=>'error', 'title'=>'System Failure!!', 'msg'=>$e->getMessage()], 400);
        }
    }
}
