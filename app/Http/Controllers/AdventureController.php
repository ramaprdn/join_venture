<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Adventure;

class AdventureController extends Controller
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
        return view('user.createAdventure');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // return $request;
        $adventure = new Adventure;
        $adventure->user_id = Auth::user()->id;
        $adventure->name = $request->adventure_name;
        $adventure->start_date = $request->starting_date;
        $adventure->start_time = $request->starting_time;
        $adventure->end_date = $request->ending_date;
        $adventure->end_time = $request->ending_time;
        $adventure->descriptoin = $request->descriptoin;

        $image = $request->file('image');

        if ($image) {
            $image_name = 'cover_' . Auth::user()->id . '_' . Str::quickRandom(10) .'.' .$image->getClientOriginalExtension();
            $adventure->image = $image_name;
            $image->move(public_path('img/adventure'), $image_name);
        }

        $adventure->save();

        foreach ($request->location as $key => $loc) {
            $destination = new Destination;
            $destination->adventure_id = $adventure->id;
            $destination->destination = $loc;
            $destination->full_location = $request->full_location[$key];
            $destination->lat = $request->lat[$key];
            $destination->long = $request->lng[$key];
            $destination->save();
        }

        return 'sukses';
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
        //
    }
}
