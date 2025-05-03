<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user_id = Auth::user()->id;
        $categories = Category::all();
        $posts = Post::where('user_id', $user_id)->get();
        return view('admin.posts.index', compact('posts', 'categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
    $categories = Category::where('user_id', Auth::id())->get();
    return view('admin.posts.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|max:255|unique:posts,title',
            'content' => 'required|string',
            'category_id' => 'required|exists:categories,id',
            'user_id' => 'required',
            'featured_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // Handel Image Upload
        $imagePath = null;
        if ($request->hasFile('featured_image')){
            $image = $request->file('featured_image');
            $imageName = time().'.'.$image->getClientOriginalExtension();
            $imagePath = 'uploads/' . $imageName;
            $image->move('uploads', $imageName);
        }

        // Create Post
        Post::create([
            'title' => $request->title,
            'content' => $request->content,
            'category_id' => $request->category_id,
            'user_id' => $request->user_id,
            'featured_image' => $imagePath,
        ]);

        return redirect()->route('posts.index')->with('success', 'Post created successfully.');

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $post = Post::findOrFail($id);
        $categories = Category::all();
        return view('admin.posts.edit', compact('post', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $post = Post::findOrFail($id);

        $request->validate([
            'title' => 'required|max:255|unique:posts,title,' . $post->id, // Corrected unique validation rule
            'content' => 'required|string',
            'category_id' => 'required|exists:categories,id',
            'user_id' => 'required',
            'featured_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // Handle Image Upload
        $imagePath = $post->featured_image; // Keep the old image path by default
        if ($request->hasFile('featured_image')) {
            $image = $request->file('featured_image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $imagePath = 'uploads/' . $imageName;
            $image->move('uploads', $imageName);

            // Delete Old Image
            if ($post->featured_image && file_exists($post->featured_image)) {
                unlink($post->featured_image);
            }
        }

        // Update Post
        $post->update([
            'title' => $request->title,
            'content' => $request->content,
            'category_id' => $request->category_id,
            'user_id' => $request->user_id,
            'featured_image' => $imagePath,
        ]);

        return redirect()->route('posts.index')->with('success', 'Post updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $post = Post::findOrFail($id);

        // Delete Image
        if ($post->featured_image && file_exists($post->featured_image)) {
            unlink($post->featured_image);
        }

        $post->delete();
        return redirect()->route('posts.index')->with('success', 'Post deleted successfully.');
    }
}
