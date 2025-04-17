<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\Blog;

class BlogController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth']);
    }

    public function index()
    {
        $blogs = \App\Models\Blog::all();
        return view('dashboard.blogs.index', compact('blogs'));
    }

    public function create()
    {
                $blogCategories = \App\Models\BlogCategory::all();

        return view('dashboard.blogs.create', compact([],'blogCategories'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'slug' => 'required|string|max:255',
            'blog_category_id' => 'required|exists:blog_categories,id',
            'image' => 'required|image|max:2048',
            'image_alt' => 'required|string|max:255',
            'index_image' => 'nullable|image|max:2048',
            'index_image_alt' => 'nullable|string|max:255',
            'showed' => 'sometimes|boolean',
            'show_at_home' => 'sometimes|boolean',
            'title' => 'required|string|max:255',
            'introduction' => 'required|string',
            'content_table' => 'required|string',
            'first_paragraph' => 'required|string',
            'description' => 'required|string',
            'author_name' => 'required|string|max:255',
            'author_title' => 'required|string|max:255',
            'author_image' => 'required|image|max:2048'
        ]);
                if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')->store('public/images');
        }
        if ($request->hasFile('index_image')) {
            $validated['index_image'] = $request->file('index_image')->store('public/index_images');
        }
        if ($request->hasFile('author_image')) {
            $validated['author_image'] = $request->file('author_image')->store('public/author_images');
        }

        $blog = \App\Models\Blog::create($validated);
        
        return redirect()->route('dashboard.blogs.index')->with('success', 'Blog created successfully.');
    }

    public function show($id)
    {
        $blog = \App\Models\Blog::findOrFail($id);
                $blogCategories = \App\Models\BlogCategory::all();

        return view('dashboard.blogs.show', compact('blog'));
    }

    public function edit($id)
    {
        $blog = \App\Models\Blog::findOrFail($id);
                $blogCategories = \App\Models\BlogCategory::all();

        return view('dashboard.blogs.edit', compact('blog', 'blogCategories'));
    }

    public function update(Request $request, $id)
    {
        $blog = \App\Models\Blog::findOrFail($id);
        $validated = $request->validate([
            'slug' => 'required|string|max:255',
            'blog_category_id' => 'required|exists:blog_categories,id',
            'image' => 'required|image|max:2048',
            'image_alt' => 'required|string|max:255',
            'index_image' => 'nullable|image|max:2048',
            'index_image_alt' => 'nullable|string|max:255',
            'showed' => 'sometimes|boolean',
            'show_at_home' => 'sometimes|boolean',
            'title' => 'required|string|max:255',
            'introduction' => 'required|string',
            'content_table' => 'required|string',
            'first_paragraph' => 'required|string',
            'description' => 'required|string',
            'author_name' => 'required|string|max:255',
            'author_title' => 'required|string|max:255',
            'author_image' => 'required|image|max:2048'
        ]);
                if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')->store('public/images');
            if ($blog->image) Storage::delete($blog->image);
        }
        if ($request->hasFile('index_image')) {
            $validated['index_image'] = $request->file('index_image')->store('public/index_images');
            if ($blog->index_image) Storage::delete($blog->index_image);
        }
        if ($request->hasFile('author_image')) {
            $validated['author_image'] = $request->file('author_image')->store('public/author_images');
            if ($blog->author_image) Storage::delete($blog->author_image);
        }

        $blog->update($validated);
        
        return redirect()->route('dashboard.blogs.index')->with('success', 'Blog updated successfully.');
    }

        public function destroy($id)
    {
        $blog = \App\Models\Blog::findOrFail($id);
        $blog->delete();
        return redirect()->route('dashboard.blogs.index')->with('success', 'Blog deleted successfully.');
    }
    public function restore($id)
    {
        $blog = \App\Models\Blog::withTrashed()->findOrFail($id);
        $blog->restore();
        return redirect()->route('dashboard.blogs.index')->with('success', 'Blog restored successfully.');
    }
}