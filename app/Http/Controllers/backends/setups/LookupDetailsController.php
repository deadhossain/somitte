<?php

namespace App\Http\Controllers\backends\setups;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Crypt;
use App\Http\Requests\backends\setups\StoreLookupDetailRequest;
use Illuminate\Http\Request;
use App\models\setups\LookupDetails;
use Yajra\DataTables\Facades\DataTables;

class LookupDetailsController extends Controller
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
    public function index($lookupId)
    {
        // dd($request->all());
        $lookupId = Crypt::decrypt($lookupId);
        $key['lookup_id'] = $lookupId;
        $lookupDetails = LookupDetails::where($key);
        return Datatables::of($lookupDetails)->addIndexColumn()
        ->editColumn('name', function ($lookupDetails) {
            return $lookupDetails->name. ' - '. $lookupDetails->id;
        })
        ->addColumn('status', function ($lookupDetails) {
            if ($lookupDetails->active_fg == 1) return '<label class="label label-success label-white middle">ACTIVE</label>';
            return '<label class="label label-danger label-white middle">INACTIVE</label>';
        })
        ->addColumn('actions', function ($lookupDetails) {
            return (string) view('backends.pages.setups.lookup_detail.actions', ['lookupDetails' => $lookupDetails]);
            // return '<a href="#" data-modal-url="'.route('lookup_details.edit',$lookupDetails->id).'" data-modal-title="Update Lookup Detail Form" class="btn btn-xs btn-primary showModal"><i class="glyphicon glyphicon-edit"></i> Edit</a>
            // <a href="#" data-modal-url="'.route('lookup_details.destroy',$lookupDetails->id).'"   class="btn btn-xs btn-danger deleteDTRow"><i class="glyphicon glyphicon-trash"></i> Delete</a>';
        })->rawColumns(['actions','status'])->make();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id)
    {
        return view('backends.pages.setups.lookup_detail.create',compact('id'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreLookupDetailRequest $request,LookupDetails $lookupDetail)
    {
        try {
            $lookupDetail = new LookupDetails;
            $lookupDetail->lookup_id = $lookupDetail->id;
            $lookupDetail->name = $request->input('name');
            $lookupDetail->value = $request->input('value');
            $lookupDetail->remarks = $request->input('remarks');
            $lookupDetail->active_fg = 1;
            $lookupDetail->created_by = session('user')->id;
            $is_saved = $lookupDetail->save();
            if ($is_saved) {
                return back()->with('message', 'Lookup has been updated');
            } else {
                return back()->withErrors(['error'=>'Lookup has not been updated']);
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
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $lookupDetail = LookupDetails::findorFail($id);
        return view('backends.pages.setups.lookup_detail.edit',compact('lookupDetail','id'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(StoreLookupDetailRequest $request, LookupDetails $lookupDetail)
    {
        try {
            $lookupDetail = LookupDetails::findOrFail($lookupDetail->id);
            $lookupDetail->name = $request->input('name');
            $lookupDetail->value = $request->input('value');
            $lookupDetail->remarks = $request->input('remarks');
            $lookupDetail->active_fg = $request->input('active_fg');
            $lookupDetail->updated_by = session('user')->id;
            $is_saved = $lookupDetail->save();
            if ($is_saved) {
                return back()->with('message', 'Lookup Detail has been updated');
            } else {
                return back()->withErrors(['error'=>'Lookup Detail has not been updated']);
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
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try{
            $lookupDetail = LookupDetails::findOrFail($id);
            $lookupDetail->active_fg=0;
            $lookupDetail->updated_by = session('user')->id;
            $result = $lookupDetail->save();
            if ($result) return response()->json(['type'=>'success', 'title'=>'Deleted!', 'msg'=>$lookupDetail->name.' has been deleted']);
            return response()->json(['type'=>'error', 'title'=>'Sorry!', 'msg'=>'Failed to delete '.$lookupDetail->name]);
        }
        catch (\Exception $e) {
            return response()->json(['type'=>'error', 'title'=>'System Failure!!', 'msg'=>$e->getMessage()], 400);
        }
    }
}
