<?php

namespace App\Http\Controllers\backends\loan;

use App\Models\loan\LoanScheme;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Crypt;
use Yajra\DataTables\Facades\DataTables;
use App\Http\Requests\backends\loan\StoreLoanSchemeRequest;
use Auth;

class LoanSchemeController extends Controller
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
        $loanSchemes = LoanScheme::all();
        return view('backends.pages.loan.scheme.index',compact('loanSchemes'));
    }

    /**
     * Display a tables data.
     *
     * @return \Illuminate\Http\Response
     */
    public function data()
    {
        try {
            $loanSchemes = LoanScheme::get();
            return Datatables::of($loanSchemes)->addIndexColumn()
            ->addColumn('actions', function ($loanScheme) {
                return (string) view('backends.pages.loan.scheme.actions', ['loanScheme' => $loanScheme]);
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
        return view('backends.pages.loan.scheme.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreLoanSchemeRequest $request)
    {
        try {
            $loanScheme = new LoanScheme;
            $loanScheme->name = $request->input('name');
            $loanScheme->min_amount = $request->input('min_amount');
            $loanScheme->max_amount = $request->input('max_amount');
            $loanScheme->late_fee = $request->input('late_fee');
            $loanScheme->rate = $request->input('rate');
            $loanScheme->max_installment = $request->input('max_installment');
            $loanScheme->remarks = $request->input('remarks');
            $loanScheme->active_fg = 1;
            $loanScheme->created_by = Auth::user()->id;
            $is_saved = $loanScheme->save();
            if ($is_saved) {
                return back()->with('message', 'Loan Scheme has been added');
            } else {
                return back()->withErrors(['error'=>'Loan Scheme has not been added']);
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
     * @param  \App\Models\loan\LoanScheme  $loanScheme
     * @return \Illuminate\Http\Response
     */
    public function show(LoanScheme $loanScheme)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\loan\LoanScheme  $loanScheme
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $id = Crypt::decrypt($id);
        $loanScheme = LoanScheme::findorFail($id);
        return view('backends.pages.loan.scheme.edit',compact('loanScheme'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\loan\LoanScheme  $loanScheme
     * @return \Illuminate\Http\Response
     */
    public function update(StoreLoanSchemeRequest $request, LoanScheme $loanScheme)
    {
        try {
            $id = Crypt::decrypt($request->scheme);
            $loanScheme = LoanScheme::findOrFail($id);
            $loanScheme->name = $request->input('name');
            $loanScheme->min_amount = $request->input('min_amount');
            $loanScheme->max_amount = $request->input('max_amount');
            $loanScheme->late_fee = $request->input('late_fee');
            $loanScheme->rate = $request->input('rate');
            $loanScheme->max_installment = $request->input('max_installment');
            $loanScheme->remarks = $request->input('remarks');
            $loanScheme->active_fg = $request->input('active_fg');
            $loanScheme->updated_by = Auth::user()->id;
            $is_saved = $loanScheme->save();
            if ($is_saved) {
                return back()->with('message', 'Loan Scheme has been updated');
            } else {
                return back()->withErrors(['error'=>'Loan Scheme has not been updated']);
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
     * @param  \App\Models\loan\LoanScheme  $loanScheme
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try{
            $id = Crypt::decrypt($id);
            $loanScheme = LoanScheme::findOrFail($id);
            $loanScheme->active_fg=0;
            $loanScheme->updated_by = Auth::user()->id;
            $result = $loanScheme->save();
            if ($result) return response()->json(['type'=>'success', 'title'=>'Deleted!', 'msg'=>$loanScheme->name.' has been deleted']);
            return response()->json(['type'=>'error', 'title'=>'Sorry!', 'msg'=>'Failed to delete '.$loanScheme->name]);
        }
        catch (\Exception $e) {
            return response()->json(['type'=>'error', 'title'=>'System Failure!!', 'msg'=>$e->getMessage()], 400);
        }
    }
}
