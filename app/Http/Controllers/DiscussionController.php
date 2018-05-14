<?php

namespace App\Http\Controllers;

use App\Discussion;
use Illuminate\Http\Request;
use Auth;
use App\AdventureComment;
use DB;

class DiscussionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        
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
    public function store(Request $request, $id)
    {

        $new_discussion = new Discussion;
        $new_discussion->user_id = Auth::user()->id;
        $new_discussion->adventure_id = $id;
        $new_discussion->topic = $request->topic;
        $new_discussion->save();

        return redirect(route('adventure.show', $id));

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Discussion  $discussion
     * @return \Illuminate\Http\Response
     */
    public function show(Discussion $discussion)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Discussion  $discussion
     * @return \Illuminate\Http\Response
     */
    public function edit(Discussion $discussion)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Discussion  $discussion
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Discussion $discussion)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Discussion  $discussion
     * @return \Illuminate\Http\Response
     */
    public function destroy(Discussion $discussion)
    {
        //
    }

    public function send_comment(Request $request){
        
        $new_comment = new AdventureComment;
        $new_comment->user_id = $request->user_id;
        $new_comment->discussion_id = $request->id;
        $new_comment->comment = $request->message;
        $new_comment->save();

        return 'sukses';

    }

    public function load_comment($id, $disc_id){
        $comments = AdventureComment::where('discussion_id', $disc_id)
            ->with('user')
            ->get();
        return view('ajax.comment.load', compact('comments'));
    }
}
