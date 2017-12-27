<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
class UserController extends Controller
{
 
    public function index()
    {
        $users = User::all();
  // dd($users);
      return response()->json(['data'=>$users],200);
    }

    public function store(UsersRequest $request)
    {
       $user = new User;

       $user->name =  $request->input('name');
       $user->email =  $request->input('email');
       $user->password =  bcrypt($request->input('password'));
       $user->verified =   User::UNVERIFIED_USER;
       $user->verification_token =  User::generateVerificationCode();
       $user->admin =  User::REGULAR_USER;

       $user->save();

       return response()->json(['data'=>$user],201 );
    }

    
    public function show($id)
    {
        $user = User::findOrFail($id);

        return response()->json(['data'=>$user]);
    }

 
    public function update(Request $request, $id)
    {
         $user = User::findOrFail($id);

         
         if($request->has('name'))
         {
            $user->name = $request->name;
         }
         
         if ($request->has('email') && $user->email != $request->email)
         {
             $user->verified = User::UNVERIFIED_USER;
             $user->verification_toker =  User::generateVerificationCode();
             $user->email = $request->email;
             
         }
         if($request->has('password'))
         {
            $user->password =  bcrypt($request->password);
         }

         // proveriti zasto mi ne prikazujee pooruku za ovaj uslov:
         if($request->has('admin'))
         {
            if (!$user->isVerivied()) 
            {
                 return response()->json(['error'=>'Only verified users can modify the admin field','code' => 409],409);
            }
            $user->admin = $request->admin;
         }


         if (!$user->isDirty())
         {
             return response()->json(['error'=>'You need to specify a different value to update','code' => 422],422);
         }

         $user->save();

         return response()->json(['data'=>$user],200);


    }

 
    public function destroy($id)
    {
        $user = User::findOrFail($id);

        $user->delete();

        return response()->json(['data'=>$user],200);
    }
}
