<?php

namespace App\Http\Controllers\backends\savings;

use App\Models\savings\SavingsScheme;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Crypt;
use Yajra\DataTables\Facades\DataTables;
use App\Http\Requests\backends\savings\SavingsSchemeRequest;

class SavingsSchemeController extends Controller
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
        $savingsSchemes = SavingsScheme::all();
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
            $savingsSchemes = SavingsScheme::get();
            return Datatables::of($savingsSchemes)->addIndexColumn()
            ->addColumn('actions', function ($savingsScheme) {
                return (string) view('backends.pages.savings.scheme.actions', ['savingsScheme' => $savingsScheme]);
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
    public function store(SavingsSchemeRequest $request)
    {
        try {
            $savingsScheme = new SavingsScheme;
            $savingsScheme->name = $request->input('name');
            $savingsScheme->amount = $request->input('amount');
            $savingsScheme->late_fee = $request->input('late_fee');
            $savingsScheme->profit = $request->input('profit');
            $savingsScheme->start_date = insertDateFormat($request->input('start_date'));
            $savingsScheme->end_date = insertDateFormat($request->input('end_date'));
            $savingsScheme->remarks = $request->input('remarks');
            $savingsScheme->active_fg = 1;
            $savingsScheme->created_by = session('user')->id;
            $is_saved = $savingsScheme->save();
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
     * @param  \App\Models\savings\SavingsScheme  $savingsScheme
     * @return \Illuminate\Http\Response
     */
    public function show(SavingsScheme $savingsScheme)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\savings\SavingsScheme  $savingsScheme
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $id = Crypt::decrypt($id);
        $savingsScheme = SavingsScheme::findorFail($id);
        // dd($savingsScheme);
        return view('backends.pages.savings.scheme.edit',compact('savingsScheme'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\savings\SavingsScheme  $savingsScheme
     * @return \Illuminate\Http\Response
     */
    public function update(SavingsSchemeRequest $request, SavingsScheme $savingsScheme)
    {
        try {
            $id = Crypt::decrypt($request->scheme);
            $savingsScheme = SavingsScheme::findOrFail($id);
            $savingsScheme->name = $request->input('name');
            $savingsScheme->amount = $request->input('amount');
            $savingsScheme->late_fee = $request->input('late_fee');
            $savingsScheme->profit = $request->input('profit');
            $savingsScheme->start_date = insertDateFormat($request->input('start_date'));
            $savingsScheme->end_date = insertDateFormat($request->input('end_date'));
            $savingsScheme->remarks = $request->input('remarks');
            $savingsScheme->active_fg = $request->input('active_fg');
            $savingsScheme->updated_by = session('user')->id;
            $is_saved = $savingsScheme->save();
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
     * @param  \App\Models\savings\SavingsScheme  $savingsScheme
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try{
            $id = Crypt::decrypt($id);
            $savingsScheme = SavingsScheme::findOrFail($id);
            $savingsScheme->active_fg=0;
            $savingsScheme->updated_by = session('user')->id;
            $result = $savingsScheme->save();
            if ($result) return response()->json(['type'=>'success', 'title'=>'Deleted!', 'msg'=>$savingsScheme->name.' has been deleted']);
            return response()->json(['type'=>'error', 'title'=>'Sorry!', 'msg'=>'Failed to delete '.$savingsScheme->name]);
        }
        catch (\Exception $e) {
            return response()->json(['type'=>'error', 'title'=>'System Failure!!', 'msg'=>$e->getMessage()], 400);
        }
    }
}
