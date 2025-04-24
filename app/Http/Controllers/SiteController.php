<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use App\Models\BlogCategory;
use App\Models\Service;
use App\Models\Project;
use App\Models\ProjectCategory;
use App\Models\ContactUs;
use App\Models\Slider;
use App\Models\Counter;
use App\Models\Partner;
use App\Models\Review;
use App\Models\Facility;
use App\Models\About;
use App\Models\Career;
use App\Models\Certificate;
use App\Models\Why;
use Illuminate\Http\Request;

class SiteController extends Controller
{
    // Home
    public function home()
    {
        try {
            $sliders = Slider::all()->map(fn($slider) => [
                'image' => $slider->img ? asset('images/' . $slider->img) : asset('images/default-slider.jpg'),
                'text' => htmlspecialchars($slider->title ?? 'بدون عنوان', ENT_QUOTES, 'UTF-8'),
                'description' => htmlspecialchars($slider->description ?? 'بدون وصف', ENT_QUOTES, 'UTF-8')
            ]);
            $blogs = Blog::where('show_at_home', true)->take(3)->get();
            $projects = Project::where('status', 'done')->take(3)->get();
            $services = Service::take(5)->get();
            $counters = Counter::all();
            $partners = Partner::all();
            $facilities = Facility::take(6)->get();
            $reviews = Review::take(5)->get()->map(fn($review) => [
                'icon' => $review->img ? asset('images/' . $review->img) : asset('images/default-user.jpg'),
                'name' => $review->name ?? 'مجهول',
                'title' => $review->title ?? 'بدون عنوان',
                'description' => $review->description ?? 'بدون وصف'
            ]);

            return view('home.home', compact('sliders', 'blogs', 'services', 'projects', 'counters', 'partners', 'reviews', 'facilities'));
        } catch (\Exception $e) {
            \Log::error('HomeController Error: ' . $e->getMessage() . ' | File: ' . $e->getFile() . ' | Line: ' . $e->getLine());
            return response('Internal Server Error', 500);
        }
    }

    // About
    public function about()
    {
        $abouts = About::orderBy('sort_id')->get();
        // dd($abouts);
        $certificates = Certificate::all();
        $whies = Why::all();

        return view('home.about', compact('abouts', 'certificates', 'whies'));
    }

    // Services
    public function services()
    {
        $services = Service::all();
        return view('home.services', compact('services'));
    }

    public function serviceShow($slug)
    {
        $service = Service::where('slug', $slug)->firstOrFail();
        $relatedServices = Service::where('slug', '!=', $slug)->take(3)->get();
        return view('home.service', compact('service', 'relatedServices'));
    }

    // Project Categories
    public function projectCategories()
    {
        $categories = ProjectCategory::all();
        return view('home.projects-categories', compact('categories'));
    }

    // Projects
    public function projects($category)
    {
        $projects = Project::where('project_category_id', $category)
            ->with('projectCategory')
            ->paginate(9);
        $categories = ProjectCategory::all();
        $category = ProjectCategory::firstOrFail('id', $category);
        return view('home.projects', compact('projects', 'categories', 'category'));
    }

    public function projectShow($slug)
    {
        $project = Project::where('slug', $slug)->with('projectCategory')->firstOrFail();
        return view('home.project', compact('project'));
    }

    // Blogs
    public function blogs($categorySlug = null)
    {
        $query = Blog::where('showed', true)->with('blogCategory');
        $category = null;
        if ($categorySlug) {
            $category = BlogCategory::where('slug', $categorySlug)->firstOrFail();
            $query->where('blog_category_id', $category->id);
        }

        $blogs = $query->paginate(9);
        $categories = BlogCategory::all();

        return view('home.blogs', compact('blogs', 'categories', 'category'));
    }

    public function blogShow($slug)
    {
        $blog = Blog::where('slug', $slug)->with('blogCategory')->firstOrFail();
        $relatedBlogs = Blog::where('blog_category_id', $blog->blog_category_id)
            ->where('id', '!=', $blog->id)
            ->where('showed', true) // Ensure only visible blogs are shown
            ->take(3)
            ->get();
        return view('home.blog', compact('blog', 'relatedBlogs'));
    }

    // Register Interest
    public function registerInterestCreate()
    {
        $projects = Project::select('id', 'name')->get();
        return view('home.register-interest', compact('projects'));
    }

    public function registerInterestStore(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'required|string|regex:/^\d{10}$/',
            'block_number' => 'nullable|integer',
            'city' => 'required|string|max:255',
            'project_id' => 'required|exists:projects,id',
            'wish' => 'required|in:استثمار,سكن,اخرى',
            'other_wish' => 'required_if:wish,اخرى|string|max:255|nullable',
            'notes' => 'nullable|string',
        ]);

        Career::create($validated);

        return redirect()->route('register-interest')->with('success', 'تم تسجيل اهتمامك بنجاح!');
    }

    // Contact Us
    public function contact()
    {
        $projects = Project::select('id', 'name')->get();
        return view('home.contact-us', compact('projects'));
    }

    public function contactStore(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'required|string|regex:/^\d{10}$/',
            'project_id' => 'required|exists:projects,id',
            'message' => 'required|string',
        ]);

        ContactUs::create($validated);

        return redirect()->route('contact')->with('success', 'تم إرسال استفسارك بنجاح!');
    }
}
