<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

//custom namespaces
use Illuminate\Support\Facades\Auth;
use App\Models\Group;
use App\Models\UserGroup;
use Hash;
use DB;

class GroupsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //getting public groups
        return Group::where('is_private', 0)->get();
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
        
        $this->validate($request,Group::$rules);
        $group = new Group();
        $group->title = $request->get('title');

        $group->is_private = $request->get('is_private');

        if($request->get('img_url') != "")
            $group->img_url = $request->get('img_url');
        //defaut img
        else{
            $group->img_url = '/img/group-banners/gb20.jpg';
        }

        if($request->get('password') == $request->get('confirmPassword'))
            $group->password = Hash::make($request->get('password')) ;
        else{
            return "Passoword combination do not match";
        }
        $group->description = $request->get('description');  
        $group->save();


        //creating the fields on the pivot table 
        //making sure the new group created is part of the private groups
        //and making user owner
        $userGroup = new UserGroup();
        $userGroup->user_id = Auth::user()->id;
        $userGroup->group_id = $group->id;
        $userGroup->is_owner = 1;//group creator is only owner
        $userGroup->save();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //return the specific group with its posts and events
        return Group::with('post')->with('users')->with('event')->findOrFail($id);
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
        $group = Group::findOrFail($id);

        $group->delete();
    }

    public function getPrivateGroups(Request $request){

        return Auth::user()->privateGroups()->get();
    }

    //adds user to the private group using the pivot table
    public function addUserToGroup(Request $request){
        $this->validate($request,Group::$rulesJoinKnot);

        $id = DB::table('groups')->where('title', $request->name)->value('id');
        $password = DB::table('groups')->where('title', $request->name)->value('password');
        if($password == null){
            return "Group name/password combination not found";
        }
        else if(Hash::check($request->password, $password)){
            //create the row in the pivot table
            $userGroup = new UserGroup();
            $userGroup->user_id = Auth::user()->id;
            $userGroup->group_id = $id;

            $userGroup->save();
            // return "User Added";
        }
        else{
            return "Password does not match the group password";
        }
        
    }
}
