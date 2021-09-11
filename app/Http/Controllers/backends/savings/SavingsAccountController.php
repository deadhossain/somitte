<?php

namespace App\Http\Controllers\backends\savings;

use App\Models\savings\SavingsAccount;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Crypt;
use Yajra\DataTables\Facades\DataTables;
use App\Http\Requests\backends\savings\StoreSavingsAccountRequest;

class SavingsAccountController extends Controller
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
        $savingsAccounts = SavingsAccount::all();
        return view('backends.pages.savings.scheme.index',compact('savingsSchemes'));
    }

    /**
     * Display a tables data.
     *
     * @return \Illuminate\Http\Response
     */
    public function data()
    {
        try {
            $savingsAccounts = SavingsAccount::get();
            return Datatables::of($savingsAccounts)->addIndexColumn()
            ->addColumn('actions', function ($savingsAccount) {
                return (string) view('backends.pages.savings.scheme.actions', ['savingsScheme' => $savingsAccount]);
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
        return view('backends.pages.savings.scheme.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreSavingsAccountRequest $request)
    {
        try {
            $savingsAccount = new SavingsAccount;
            $savingsAccount->name = $request->input('name');
            $savingsAccount->amount = $request->input('amount');
            $savingsAccount->late_fee = $request->input('late_fee');
            $savingsAccount->profit = $request->input('profit');
            $savingsAccount->start_date = insertDateFormat($request->input('start_date'));
            $savingsAccount->end_date = insertDateFormat($request->input('end_date'));
            $savingsAccount->remarks = $request->input('remarks');
            $savingsAccount->active_fg = 1;
            $savingsAccount->created_by = session('user')->id;
            $is_saved = $savingsAccount->save();
            if ($is_saved) {
                return back()->with('message', 'Savings Scheme has been added');
            } else {
                return back()->withErrors(['error'=>'Savings Scheme has not been added']);
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
     * @param  \App\Models\savings\SavingsAccount  $savingsAccount
     * @return \Illuminate\Http\Response
     */
    public function show(SavingsAccount $savingsAccount)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\savings\SavingsAccount  $savingsAccount
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $id = Crypt::decrypt($id);
        $savingsAccount = SavingsAccount::findorFail($id);
        return view('backends.pages.savings.scheme.edit',compact('savingsScheme'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\savings\SavingsAccount  $savingsAccount
     * @return \Illuminate\Http\Response
     */
    public function update(StoreSavingsAccountRequest $request, SavingsAccount $savingsAccount)
    {
        try {
            $id = Crypt::decrypt($request->scheme);
            $savingsAccount = SavingsAccount::findOrFail($id);
            $savingsAccount->name = $request->input('name');
            $savingsAccount->amount = $request->input('amount');
            $savingsAccount->late_fee = $request->input('late_fee');
            $savingsAccount->profit = $request->input('profit');
            $savingsAccount->start_date = insertDateFormat($request->input('start_date'));
            $savingsAccount->end_date = insertDateFormat($request->input('end_date'));
            $savingsAccount->remarks = $request->input('remarks');
            $savingsAccount->active_fg = $request->input('active_fg');
            $savingsAccount->updated_by = session('user')->id;
            $is_saved = $savingsAccount->save();
            if ($is_saved) {
                return back()->with('message', 'Savings Scheme has been updated');
            } else {
                return back()->withErrors(['error'=>'Savings Scheme has not been updated']);
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
     * @param  \App\Models\savings\SavingsAccount  $savingsAccount
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try{
            $id = Crypt::decrypt($id);
            $savingsAccount = SavingsAccount::findOrFail($id);
            $savingsAccount->active_fg=0;
            $savingsAccount->updated_by = session('user')->id;
            $result = $savingsAccount->save();
            if ($result) return response()->json(['type'=>'success', 'title'=>'Deleted!', 'msg'=>$savingsAccount->name.' has been deleted']);
            return response()->json(['type'=>'error', 'title'=>'Sorry!', 'msg'=>'Failed to delete '.$savingsAccount->name]);
        }
        catch (\Exception $e) {
            return response()->json(['type'=>'error', 'title'=>'System Failure!!', 'msg'=>$e->getMessage()], 400);
        }
    }
}
