<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
       $posts = Post::all();
       return response()->json($posts);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
{
    // Validate input fields
    $fields = $request->validate([
        'title' => 'required|string',
        'content' => 'required|string',
        'path' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048' // Image validation
    ]);

    // Handle image upload
    if ($request->hasFile('path')) {
        $image = $request->file('path');
        $imagePath = $image->store('uploads', 'public');
        $fields['path'] = '/storage/' . $imagePath;     
    }

    $post = Post::create($fields);

    return response()->json([
        'message' => 'Post created successfully!',
        'post' => $post,
        'image_url' => asset($fields['path']) 
    ]);
}


public function show( $post)
{
    $post = Post::find($post);
    return response()->json($post);
}

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Post $post)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post)
    {
        //
    }
}
