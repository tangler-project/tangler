<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

//custom namespaces
use App\Models\Event;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\SoftDeletes;



class EventsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Event::with('user')->get();
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
        $this->validate($request,Event::$rules);
        $event = new Event();

        $event->owner_id = $request->user()->id;
        $event->group_id = $request->group_id;


        if($request->get('img_url') != "")
            $event->img_url = $request->get('img_url');
        //defaut img
        else{
            $event->img_url = 'http://www.eng.umd.edu/sites/default/files/images/resources/events-icons/event-promotion.png';
        }


        $event->title = $request->get('title');
        $event->content = $request->get('content');

        $event->start_date = $request->get('start_date');
        $event->end_date = $request->get('end_date');


        $event->save();
        return $event;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $now = date('Y-m-d H:i:s');
        return Event::with('user')->with('group')->orderBy('start_date')->where('group_id', $id)->having('end_date','>',$now)->get();
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
        $this->validate($request,Event::$rules);

        $event = Event::findOrFail($id);

        //cant and no need to update these values
        // $event->owner_id = $request->user()->id;
        // $event->group_id = $request->group_id;


        $event->title = $request->get('title');
        $event->img_url= $request->get('img_url');
        $event->content = $request->get('content');
        $event->start_date = $request->get('start_date');
        $event->end_date = $request->get('end_date');

        $event->save();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $event = Event::findOrFail($id);

        $event->delete();
        // $event->softDeletes();


    }

    


}
