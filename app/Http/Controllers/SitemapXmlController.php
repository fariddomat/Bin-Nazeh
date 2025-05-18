<?php

namespace App\Http\Controllers;

use anlutro\LaravelSettings\Facades\Setting;
// use anlutro\LaravelSettings\Facade as Setting;
use App\Http\Controllers\Controller;
use App\Models\About;
use App\Models\Blog;
use App\Models\BlogCategory;
use App\Models\Category;
use App\Models\Contact;
use App\Models\Project;
use Illuminate\Http\Request;

class SitemapXmlController extends Controller
{
    public function index()
    {

        $blogs = Blog::select('id', 'slug', 'updated_at')->get();
        $projects = Project::select('id', 'slug', 'updated_at')->get();
        $about = About::first();
        $categories = BlogCategory::select('id', 'slug', 'updated_at')->get();

        return response()->view('home.sitemap', [
            'categories' => $categories,
            'blogs' => $blogs,
            'projects' => $projects,
            'about' => $about,
        ])->header('Content-Type', 'text/xml')
            ->header('charset', 'utf-8');
    }
}
