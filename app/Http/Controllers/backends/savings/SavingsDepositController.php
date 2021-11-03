<?php

namespace App\Http\Controllers;

use App\Models\savings\SavingsDeposit;
use App\Models\savings\SavingsAccount;
use App\Models\savings\SavingsScheme;
use App\Models\person\Customer;
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
        return view('backends.pages.savings.account.index');
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
