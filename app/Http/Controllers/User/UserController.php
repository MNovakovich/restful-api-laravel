<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

// we create abstarct class ApiController
use App\Http\Controllers\ApiController;

use App\User;

class UserController extends ApiController
{
 
    public function index()
    {

        $users = User::all();
       
       
  // dd($users);
       return response()->json(['data'=>$users],200);
      //return $this->showAll($users, 200)
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

       //first way how we can do it
       return response()->json(['data'=>$user],201 );

       //second way

      // return $this->showOne($user, 201);
    }

    
    public function show(User $user)
    {
       // $user = User::findOrFail($id);   // ako dodajemo parametar User , umesto $id, ne treba nam ovaj deo koda
       
         return response()->json(['data'=>$user]);
       // return $this->showOne($user);
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
             $user->verification_token =  User::generateVerificationCode();
             $user->email = $request->email;
             
         }
         if($request->has('password'))
         {
            $user->password =  bcrypt($request->password);
         }

         // proveriti zasto mi ne prikazujee pooruku za ovaj uslov:
         if($request->has('admin'))
         {
            if (!$user->isVerified()) 
            {
                 //return response()->json(['error'=>'Only verified users can modify the admin field','code' => 409],409);
                 return $this->errorResponse('Only verified users can modify the admin field',409);
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

    public function verify($token)
    {
      $user = User::where('verification_token', $token)->firstOrFail();

      $user->verified = User::VERIFIED_USER;
      $user->verification_token = null;
      $user->save();

    return $this->showMessage('The account has been verified succeafuly');

    }
}
