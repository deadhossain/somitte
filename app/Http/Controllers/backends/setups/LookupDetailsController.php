<?php

namespace App\Http\Controllers\backends\setups;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\models\setups\LookupDetails;
use Yajra\DataTables\Facades\DataTables;

class LookupDetailsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($lookupId)
    {
        // dd($request->all());
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
            return '<a href="#" data-modal-url="'.route('lookupDetails.edit',$lookupDetails->id).'" data-modal-title="Update Lookup Detail Form" class="btn btn-xs btn-primary showModal"><i class="glyphicon glyphicon-edit"></i> Edit</a>
            <a href="#" data-modal-url="'.route('lookupDetails.destroy',$lookupDetails->id).'"   class="btn btn-xs btn-danger deleteDTRow"><i class="glyphicon glyphicon-trash"></i> Delete</a>';
        })->rawColumns(['actions','status'])->make();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id)
    {
        return view('backends.layouts.setups.lookup_detail.create',compact('id'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request,$id)
    {
        try {
            $rules = [
                'name' => ['required',
                    Rule::unique('lookup_details')->where(function ($query) use ($id) {
                        return $query->where('active_fg', 1)->where('lookup_id', $id);
                    }),
                ],
            ];

            $customAttributes = [ 'name' =>'Name' ];
            $message = array();
            $validator = Validator::make($request->all(),$rules,$message,$customAttributes);
            if ($validator->fails()) return response()->json(['error'=>$validator->errors()]);

            $lookupDetail = new LookupDetail;
            $lookupDetail->lookup_id = $id;
            $lookupDetail->name = $request->input('name');
            $lookupDetail->value = $request->input('value');
            $lookupDetail->remarks = $request->input('remarks');
            $lookupDetail->active_fg = $request->input('status');
            $lookupDetail->created_by = session('user')->id;
            $result = $lookupDetail->save();
            if ($result) return response()->json(['success'=>$lookupDetail->name.' is saved']);
            return response()->json(['error'=>'Fail to save '.$lookupDetail->name]);
        } catch (Exception $e) {
            return response()->json([
                'success' => 'false',
                'errors'  => $e->getMessage(),
            ], 400);
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
        $lookupDetail = LookupDetail::findorFail($id);
        return view('backends.layouts.setups.lookup_detail.edit',compact('lookupDetail','id'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        try {
            $rules = [ 'name' => 'required|unique:lookup_details,name,'.$id];
            $customAttributes = [ 'name' =>'Name' ];
            $message = array();
            $validator = Validator::make($request->all(),$rules,$message,$customAttributes);
            if ($validator->fails()) return response()->json(['error'=>$validator->errors()]);

            $lookupDetail = LookupDetail::findOrFail($id);
            $lookupDetail->name = $request->input('name');
            $lookupDetail->value = $request->input('value');
            $lookupDetail->remarks = $request->input('remarks');
            $lookupDetail->active_fg = $request->input('status');
            $lookupDetail->updated_by = session('user')->id;
            $result = $lookupDetail->save();
            if ($result) return response()->json(['success'=>$lookupDetail->name.' is saved']);
            return response()->json(['error'=>'Fail to save '.$lookupDetail->name]);
        } catch (Exception $e) {
            return response()->json([
                'success' => 'false',
                'errors'  => $e->getMessage(),
            ], 400);
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
            $lookupDetail = LookupDetail::findOrFail($id);
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
