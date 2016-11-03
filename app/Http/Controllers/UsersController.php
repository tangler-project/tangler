<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

//custom namespaces
use App\User;
use Hash;
use Illuminate\Support\Facades\Auth;


class UsersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
    public function update(Request $request)
    {

        //makes sure name email and password are not left empty
        $this->validate($request,User::$rulesEdit);

        $user = User::findOrFail(Auth::user()->id);
        $user->name= $request->get('name');
        $user->email= $request->get('email');
        
        $user->img_url = $request->get('img_url');

        //make sure password is valid
        if(Hash::check($request->get('password'), $user->password)){
            //make sure new passwords match
            if($request->get('confirmNewPassword') == $request->get('newPassword')){
                //if matched save the hashed new password
                $user->password = Hash::make($request->get('newPassword'));
            }
            else{
                return "New password combination does not match";
            }
        }
        else{
            return "Password record does not match";
        }

        $user->save();
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();
        return "User's account deactivated";
    }
}
