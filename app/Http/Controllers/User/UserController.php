<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::all();
  // dd($users);
      return response()->json(['data'=>$users],200);
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

    public function store(Request $request)
    {
       $user = new User;

       $user->name =  $request->input('name');
       $user->email =  $request->input('email');
       $user->password =  bcrypt($request->input('password'));
       $user->verified =   User::UNVERIFIED_USER;
       $user->verification_token =  User::generateVerificationCode();
       $user->admin =  User::REGULAR_USER;

       $user->save();

       return response()->json(['data'=>$user],201);
    }

    
    public function show($id)
    {
        $user = User::findOrFail($id);

        return response()->json(['data'=>$user]);
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
        //
    }
}
