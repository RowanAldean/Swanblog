<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Models\Post;
use App\Models\User;
use App\Models\Comment;
use Illuminate\Http\Request;

class CommentController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $comments = Comment::all();
        // $ids = User::where('id', $comments->user_id);
        return $comments;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //we never create comments, we only store them and delete them.
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $post = Post::findOrFail($request->post_id);

        Comment::create([
            'body' => $request->body,
            'user_id' => Auth::user()->id,
            'post_id' => $post->id
        ]);

        //Go to the post page
        if ($request->redirect) {
            return redirect()->route('post.show', compact('post'));
        }

        // Go back to feed
        return redirect()->route('feed');
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
        $comment = Comment::findOrFail($id);
        if (Auth::user()->can('update', $comment)) {
            $comment->body = $request->body;
            $comment->edited = true;
            $comment->save();
        }
        // dd("missed the change");
        //Go to the post page
        if ($request->redirect) {
            return redirect()->route('post.show', compact('post'));
        }

        // Go back to feed
        return true;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $comment = Comment::findOrFail($id);
        $this->authorize('delete', $comment);

        $comment->delete();
        return true;
    }
}
