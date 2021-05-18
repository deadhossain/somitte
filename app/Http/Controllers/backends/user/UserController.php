<?php

namespace App\Http\Controllers\backends\user;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUserRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::with('user')->get();
        return view('backends.pages.user.index',compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backends.pages.user.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreUserRequest $request)
    {
        try {
            $user = new User;
            $user->name = $request->input('name');
            $user->email = $request->input('email');
            $user->password = Hash::make($request->input('password'));
            $user->active_fg = 1;
            $user->created_by = 1;
            // $user->active_fg = $request->input('active_fg');
            // $user->created_by = session('user')->id;
            $is_saved = $user->save();
            if ($is_saved) {
                return redirect()->route('user.create')->with('success', 'User has been added');
            } else {
                return redirect()->route('user.create')->with('error', 'User has not been added');
            }
        } catch (\Throwable $th) {
            return redirect()->route('user.create')->with('error-dev', $th->getMessage() )->with('error','Seek system administrator help' );
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
        //
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
        //
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
            $user = User::findOrFail($id);
            $user->active_fg = 0;
            // $user->updated_by = session('user')->id;
            $user->updated_by = 1;
            $result = $user->save();
            if ($result) return response()->json(['type'=>'success', 'title'=>'Deleted!', 'msg'=>$user->name.' has been deleted']);
            return response()->json(['type'=>'error', 'title'=>'Sorry!', 'msg'=>'Failed to delete '.$user->name]);
        }
        catch (\Exception $e) {
            return response()->json(['type'=>'error', 'title'=>'System Failure!!', 'msg'=>$e->getMessage()], 400);
        }
    }
}
