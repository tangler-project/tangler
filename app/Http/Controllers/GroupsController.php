<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

//custom namespaces
use App\Models\Group;
use Hash;

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


        $group = new Group();
        $group->title = $request->get('title');
        $group->is_private = 1;//$request->get('is_private');

        // $group->img_url = $request->get('img_url');

        if($request->get('password') == $request->get('confirmPassword'))
            $group->password = Hash::make($request->get('password')) ;
        else{
            return "fail";
        }
        $group->description = "Default value";//$request->get('description');  

        $this->validate($request,Group::$rules);
        $group->save();
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
        return Group::with('post')->with('event')->findOrFail($id);
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

    public function getPrivateGroups(Request $request, $id){

        // return Group::with('post')->with('event')->where($request->user()->id, $id)->get();
        return Group::where('is_private', 1)->get();
    }
}
