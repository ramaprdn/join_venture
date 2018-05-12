<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;
use Auth;
use App\User;
use App\Postimage;
use App\Like;
use DB;

class PostController extends Controller
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

        $this->validate($request, [
            'description' => 'required',
        ]);

        $post = new Post();
        $post->user_id = Auth::user()->id;
        $post->description = $request->description;
        $post->save();

        $last_user_post = Post::where('user_id',Auth::user()->id)->orderBy('created_at', 'desc')->first();

        $images = $request->file('image_post');

        if ($images) {
            foreach ($images as $key => $image) {
                $imageName = $last_user_post->id . "_" . "$key" . "_" . $last_user_post->user_id . "." . $image->getClientOriginalExtension();
                $postImage = new Postimage();
                $postImage->post_id = $last_user_post->id;
                $postImage->img_name = $imageName;
                $image->move(public_path('img/post'), $imageName);
                $postImage->save();
            }   
        }

        return redirect(route('home'));

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
        $post = Post::find($id);

        if(auth()->user()->id != $post->user_id) {
            return redirect(route('home'));
        }
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
        $this->validate($request, [
            'description' => 'required'
        ]);

        // Update Post
        $post = Post::find($id);
        $post->description = $request->input('description');
        $post->save();

        return redirect(route('home'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $post = Post::find($id);
        if ($post->status == 1) {
            $post->status = 0;
            $post->save();
        }

        return redirect(route('home'));    
    }


    public function getImagePost($post_id){
        $images = Postimage::where('post_id', $post_id)->get();
        if (sizeof($images) > 0) {
            return view('ajax.post.image', compact('images'));
        }
        return null;
        
    }

    public function like($post_id){
        $liked = Like::where('post_id', $post_id)->where('user_id', Auth::user()->id)->first();
        if (!empty($liked)) {
            if ($liked->status == 1) {
                $liked->status = 0;
                $liked->save();
            }else if($liked->status == 0){
                $liked->status = 1;
                $liked->save();
            }
        }else{
            $like = new Like;
            $like->post_id = $post_id;
            $like->user_id = Auth::user()->id;
            $like->save();
        }
    }


    public function whoLikeThisPost($post_id){
        $like = [];

        $like_count = DB::table('likes')
            ->where('post_id', $post_id)
            ->where('user_id','<>' , Auth::user()->id)
            ->where('status', 1)
            ->count();

        $user_like = DB::table('likes')
            ->where('post_id', $post_id)
            ->where('user_id', Auth::user()->id)
            ->where('status', 1)
            ->count();

        $like = [
            'like_count' => $like_count,
            'user_like' => $user_like
        ];

        return $like;
    }

}
