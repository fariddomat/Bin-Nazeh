<x-app-layout>
    <section class="dashboard-section">
        <div class="container">
            <h2 class="dashboard-title">لوحة التحكم</h2>
            <div class="stats-grid">
                <!-- Blog -->
                <a href="{{ route('dashboard.blogs.index') }}" class="stats-card" wire:navigate>
                    <i class="fas fa-blog dashboard-icon"></i>
                    <h3 class="card-title">المدونات</h3>
                    <p class="card-value">{{ \App\Models\Blog::count() }}</p>
                    <p class="card-label">إجمالي المدونات</p>
                </a>

                <!-- Service -->
                <a href="{{ route('dashboard.services.index') }}" class="stats-card" wire:navigate>
                    <i class="fas fa-concierge-bell dashboard-icon"></i>
                    <h3 class="card-title">الخدمات</h3>
                    <p class="card-value">{{ \App\Models\Service::count() }}</p>
                    <p class="card-label">إجمالي الخدمات</p>
                </a>

                <!-- Project -->
                <a href="{{ route('dashboard.projects.index') }}" class="stats-card" wire:navigate>
                    <i class="fas fa-project-diagram dashboard-icon"></i>
                    <h3 class="card-title">المشاريع</h3>
                    <p class="card-value">{{ \App\Models\Project::count() }}</p>
                    <p class="card-label">إجمالي المشاريع</p>
                </a>

                <!-- NewsLetter -->
                <a href="{{ route('dashboard.news_letters.index') }}" class="stats-card" wire:navigate>
                    <i class="fas fa-envelope dashboard-icon"></i>
                    <h3 class="card-title">النشرة الإخبارية</h3>
                    <p class="card-value">{{ \App\Models\NewsLetter::count() }}</p>
                    <p class="card-label">إجمالي المشتركين</p>
                </a>

                <!-- Career -->
                <a href="{{ route('dashboard.careers.index') }}" class="stats-card" wire:navigate>
                    <i class="fas fa-briefcase dashboard-icon"></i>
                    <h3 class="card-title">الاهتمامات</h3>
                    <p class="card-value">{{ \App\Models\Career::count() }}</p>
                    <p class="card-label">إجمالي الاهتمامات</p>
                </a>

                <!-- Contact Us -->
                <a href="{{ route('dashboard.contact_uses.index') }}" class="stats-card" wire:navigate>
                    <i class="fas fa-headset dashboard-icon"></i>
                    <h3 class="card-title">تواصل معنا</h3>
                    <p class="card-value">{{ \App\Models\ContactUs::count() }}</p>
                    <p class="card-label">إجمالي الرسائل</p>
                </a>
            </div>
        </div>
    </section>

    <style>
        /* Dashboard Section */
        .dashboard-section {
            padding: 3rem 0;
            background-color: #f9fafb; /* Light gray */
        }

        .dashboard-title {
            font-size: 2.5rem;
            font-weight: 700;
            color: #1f2937; /* Dark gray */
            text-align: center;
            margin-bottom: 2rem;
        }

        .stats-grid {
            display: grid;
            grid-template-columns: 1fr; /* 1 column on mobile */
            gap: 1.5rem;
        }

        .stats-card {
            background-color: #ffffff;
            padding: 1.5rem;
            border-radius: 8px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            text-align: center;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            text-decoration: none; /* Remove underline from <a> */
            color: inherit; /* Inherit text color */
        }

        .stats-card:hover {
            transform: translateY(-4px);
            box-shadow: 0 6px 12px rgba(0, 0, 0, 0.15);
            cursor: pointer; /* Indicate clickability */
        }

        .dashboard-icon {
            font-size: 2rem;
            color: #f97316; /* Theme orange */
            margin-bottom: 0.5rem;
        }

        .card-title {
            font-size: 1.25rem;
            font-weight: 600;
            color: #1f2937;
            margin-bottom: 0.5rem;
        }

        .card-value {
            font-size: 2rem;
            font-weight: 700;
            color: #f97316;
            margin: 0.5rem 0;
        }

        .card-label {
            font-size: 1rem;
            color: #6b7280; /* Gray */
        }

        /* RTL Support */
        html[dir="rtl"] .stats-card {
            text-align: center;
        }

        /* Responsive Design */
        @media (min-width: 640px) {
            .stats-grid {
                grid-template-columns: repeat(2, 1fr); /* 2 columns on small screens */
            }
        }

        @media (min-width: 1024px) {
            .stats-grid {
                grid-template-columns: repeat(3, 1fr); /* 3 columns on desktop */
            }

            .dashboard-title {
                font-size: 3rem;
            }
        }
    </style>
</x-app-layout>
