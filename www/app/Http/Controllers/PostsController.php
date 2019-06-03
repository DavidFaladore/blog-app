<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Post;
use App\CoverImage;

class PostsController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth', ['except' => ['index', 'show']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $cover_images = CoverImage::all();
        $posts = Post::orderBy('created_at', 'desc')->paginate(10);
        // return view('posts.index')->with('posts', $posts)->with('cover-images', $cover_images);
        return view('posts.index', compact('posts', 'cover_images'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('posts.create');
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
            'title' => 'required',
            'body' => 'required',
            'cover_image' => 'image|nullable|max:1999'
        ]);

        // Handle file upload
        if($request->hasFile('cover_image')){
            // Get file with the extension
            $fileNameWithExt = $request->file('cover_image')->getClientOriginalName();
            // Get just file name
            $fileName = pathinfo($fileNameWithExt, PATHINFO_FILENAME);
            // Get just ext
            $fileExtension = $request->file('cover_image')->getClientOriginalExtension();
            // File name to store
            $fileNameToStore = $fileName.'_'.time().'.'.$fileExtension;
            // Upload the image
            $path = $request->file('cover_image')->storeAs('public/cover_images', $fileNameToStore);

            // Create cover image
            $coverImage = new CoverImage;
            $coverImage->path = $fileNameToStore;
            $coverImage->save();
        } else {
            $fileNameToStore = 'noimage.jpg';
        }

        // Create cover image
        $coverImage = new CoverImage;
        $coverImage->path = $fileNameToStore;
        $coverImage->save();

        // Create post
        $post = new Post;
        $post->title = $request->input('title');
        $post->body = $request->input('body');
        $post->user_id = auth()->user()->id;
        $post->cover_image_id = CoverImage::where('path', $fileNameToStore)->value('id');
        $post->save();
        
        return redirect('/posts')->with('success', 'Post Created');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        // $post = Post::find($id);
        // return view('posts.show')->with('post', $post)
        $post = Post::find($id);
        $cover_image = CoverImage::find($post->cover_image_id);
        return view('posts.show', compact('post', 'cover_image'));
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
        
        // Check for correct user
        if(auth()->user()->id != $post->user_id){
            return redirect('/posts')->with('error', 'Unathorized user to access this page');
        }

        return view('posts.edit')->with('post', $post);
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
            'title' => 'required',
            'body' => 'required'
        ]);

         // Handle file upload
        if($request->hasFile('cover_image')){
            // Get file with the extension
            $fileNameWithExt = $request->file('cover_image')->getClientOriginalName();
            // Get just file name
            $fileName = pathinfo($fileNameWithExt, PATHINFO_FILENAME);
            // Get just ext
            $fileExtension = $request->file('cover_image')->getClientOriginalExtension();
            // File name to store
            $fileNameToStore = $fileName.'_'.time().'.'.$fileExtension;
            // Upload the image
            $path = $request->file('cover_image')->storeAs('public/cover_images', $fileNameToStore);
        }

        // Create post
        $post = Post::find($id);
        $post->title = $request->input('title');
        $post->body = $request->input('body');
        if($request->hasFile('cover_image')){
            $post->cover_image_id = $fileNameToStore;
        }
        $post->save();
        
        return redirect('/posts')->with('success', 'Post Updated');
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

        // Check for correct user
        if(auth()->user()->id != $post->user_id){
            return redirect('/posts')->with('error', 'Unathorized user to access this page');
        }

        $post->delete();

        return redirect('/posts')->with('success', 'Post Removed');
    }
}
