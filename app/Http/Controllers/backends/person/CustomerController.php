<?php
namespace App\Http\Controllers\backends\person;

use App\Http\Controllers\Controller;
use App\Models\person\Customer;
use App\Models\setups\LookupDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Yajra\DataTables\Facades\DataTables;
use App\Http\Requests\backends\person\StoreCustomerRequest;
use DB;

class CustomerController extends Controller
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
        $customers = Customer::all();
        return view('backends.pages.person.customer.index',compact('customers'));
    }

    /**
     * Display a tables data.
     *
     * @return \Illuminate\Http\Response
     */
    public function data()
    {
        try {
            $customers = Customer::get();
            return Datatables::of($customers)->addIndexColumn()
            ->addColumn('actions', function ($customer) {
                return (string) view('backends.pages.person.customer.actions', ['customer' => $customer]);
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
        $genders = LookupDetail::where('active_fg',1)->where('lookup_id',1)->get();
        return view('backends.pages.person.customer.create',compact('genders'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreCustomerRequest $request)
    {

        try {
            DB::beginTransaction();
            $customer = new Customer;
            $customer->name = $request->input('name');
            $customer->nid_no = $request->input('nid_no');
            $customer->gender_id = $request->input('gender_id');
            $customer->phone = $request->input('phone');
            $customer->start_date = insertDateFormat($request->input('start_date'));
            $customer->end_date = insertDateFormat($request->input('end_date'));
            $customer->address = $request->input('address');
            $customer->remarks = $request->input('remarks');
            $customer->active_fg = 1;
            $customer->created_by = session('user')->id;
            $is_saved = $customer->save();

            if ($is_saved){
                $id = Crypt::decrypt($customer->id);
                $customer = customer::findorFail($id);
                if($request->hasFile('nid_attachment')){

                    $customer->nid_attachment = 'nid_'.$id .'.'.$request->file('nid_attachment')->extension();
                    $request->file('nid_attachment')->storeAs('customers/nids', $customer->nid_attachment,'public');
                }
                if($request->hasFile('image')){

                    $customer->image = 'image_'.$id .'.'.$request->file('image')->extension();
                    $request->file('image')->storeAs('customers/images', $customer->image,'public');

                }
                // dd($customer,$request->all(),$request->file('nid_attachment'),$request->file('image'));
                if($customer->save()){
                    DB::commit();
                    return back()->with('message', 'Customer has been added');
                }else{
                    DB::rollBack();
                    return back()->withErrors(['error'=>'Customer Attachment has not been added']);
                }
            }
            return back()->withErrors(['error'=>'Customer has not been added']);

        } catch (\Exception $th) {
            DB::rollBack();
            return back()->withErrors([
                'error'=>'Seek system administrator help',
                'error-dev'=> $th->getMessage()
            ]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\person\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function show(Customer $customer)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\person\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $id = Crypt::decrypt($id);
        $customer = Customer::findorFail($id);
        // dd($customer);
        return view('backends.pages.person.customer.edit',compact('customer'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\person\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function update(StoreCustomerRequest $request, Customer $customer)
    {
        try {
            $id = Crypt::decrypt($request->scheme);
            $customer = Customer::findOrFail($id);
            $customer->name = $request->input('name');
            $customer->amount = $request->input('amount');
            $customer->late_fee = $request->input('late_fee');
            $customer->profit = $request->input('profit');
            $customer->start_date = insertDateFormat($request->input('start_date'));
            $customer->end_date = insertDateFormat($request->input('end_date'));
            $customer->remarks = $request->input('remarks');
            $customer->active_fg = $request->input('active_fg');
            $customer->updated_by = session('user')->id;
            $is_saved = $customer->save();
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
     * @param  \App\Models\person\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try{
            $id = Crypt::decrypt($id);
            $customer = Customer::findOrFail($id);
            $customer->active_fg=0;
            $customer->updated_by = session('user')->id;
            $result = $customer->save();
            if ($result) return response()->json(['type'=>'success', 'title'=>'Deleted!', 'msg'=>$customer->name.' has been deleted']);
            return response()->json(['type'=>'error', 'title'=>'Sorry!', 'msg'=>'Failed to delete '.$customer->name]);
        }
        catch (\Exception $e) {
            return response()->json(['type'=>'error', 'title'=>'System Failure!!', 'msg'=>$e->getMessage()], 400);
        }
    }
}
