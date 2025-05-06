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
use App\Models\NewsLetter;
use App\Models\Order;
use App\Models\Privacy;
use App\Models\Step;
use App\Models\Term;
use App\Models\Why;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class SiteController extends Controller
{
    // Home
    public function home()
    {
        try {
            $sliders = Slider::all()->map(fn($slider) => [
                'image' => $slider->img ? Storage::url($slider->img) : asset('images/default-slider.jpg'),
                'text' => htmlspecialchars($slider->title ?? 'بدون عنوان', ENT_QUOTES, 'UTF-8'),
                'description' => htmlspecialchars($slider->description ?? 'بدون وصف', ENT_QUOTES, 'UTF-8')
            ]);
            $blogs = Blog::where('show_at_home', true)->take(3)->get();
            $projects = Project::where('status', 'done')->take(3)->get();
            $services = Service::take(5)->get();
            $steps = Step::get()->map(fn($step) => [
                'icon' => $step->icon ?? '',
                'name' => $step->name ?? 'مجهول',
                'description' =>  strip_tags($step->description) ?? 'بدون وصف'
            ]);
            $counters = Counter::all();
            $partners = Partner::all();
            $facilities = Facility::take(6)->get();
            $reviews = Review::take(5)->get()->map(fn($review) => [
                'icon' => $review->img ? Storage::url($review->img) : asset('images/default-user.jpg'),
                'name' => $review->name ?? 'مجهول',
                'title' => $review->title ?? 'بدون عنوان',
                'description' => $review->description ?? 'بدون وصف'
            ]);

            return view('home.home', compact('sliders', 'blogs', 'steps', 'services', 'projects', 'counters', 'partners', 'reviews', 'facilities'));
        } catch (\Exception $e) {
            \Log::error('HomeController Error: ' . $e->getMessage() . ' | File: ' . $e->getFile() . ' | Line: ' . $e->getLine());
            return response('Internal Server Error', 500);
        }
    }

    public function search(Request $request)
    {
        $query = $request->input('query');
        $scope = $request->input('scope', 'all');

        $results = [];

        if ($scope === 'all' || $scope === 'projects') {
            $results['projects'] = Project::where('name', 'like', "%{$query}%")
                ->orWhere('details', 'like', "%{$query}%")
                ->get();
        }

        if ($scope === 'all' || $scope === 'blogs') {
            $results['blogs'] = Blog::where('title', 'like', "%{$query}%")
                ->orWhere('description', 'like', "%{$query}%")
                ->get();
        }

        return view('home.search', compact('results', 'query', 'scope'));
    }
    // About
    public function about()
    {
        $abouts = About::orderBy('sort_id')->get();
        // dd($abouts);
        $certificates = Certificate::all();
        $whies = Why::all();
        $partners = Partner::all();

        return view('home.about', compact('abouts', 'certificates', 'whies', 'partners'));
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
        $category = ProjectCategory::where('id', $category)->first();

        return view('home.projects', compact('projects', 'categories', 'category'));
    }

    public function projectShow($slug)
    {
        $project = Project::where('slug', $slug)->with('projectCategory')->firstOrFail();
        $project->load('apartments', 'projectImages', 'projectPdfs');
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

    public function newsletter(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'mobile' => [
                'required',
                'regex:/^05[0-9]{8}$/', // Start with 05 and exactly 10 digits in total
            ]
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => $validator->errors()->first(),
            ]);
        }

        NewsLetter::create([
            'mobile' => $request->mobile,
        ]);

        return response()->json([
            'success' => true,
            'message' => 'تم الاشتراك في النشرة البريدية بنجاح!',
        ]);
    }


    public function serviceRequest(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'service_id' => 'required|exists:services,id',
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'required|string|max:255',
            'project_type' => 'required|string|max:255',
            'message' => 'nullable|string',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $order = Order::create($request->all());

        return response()->json(['message' => 'Order created successfully', 'order' => $order], 201);
    }

    public function terms()
    {
        $term = Term::latest()->first(); // جلب أحدث سجل
        return view('home.terms', [
            'content' => $term ? $term->content : 'لم يتم العثور على شروط وأحكام.',
            'metaDescription' => 'اطلع على شروط وأحكام بن نازح لاستخدام الموقع والخدمات.',
        ]);
    }
    public function privacy()
    {
        $privacy = Privacy::latest()->first(); // جلب أحدث سجل
        return view('home.privacy', [
            'content' => $privacy ? $privacy->content : 'لم يتم العثور على سياسة خصوصية.',
            'metaDescription' => 'تعرف على سياسة الخصوصية لبن نازح وكيفية حماية بياناتك.',
        ]);
    }
}
