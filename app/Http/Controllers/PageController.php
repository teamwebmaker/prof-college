<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Council;
use App\Models\Documentation;
use App\Models\Employer;
use App\Models\Graduated;
use App\Models\MainMenu;
use App\Models\Partner;
use App\Models\PhotoGallery;
use App\Models\Profession;
use App\Models\Program;
use App\Models\Slide;
use App\Models\Staff;
use App\Models\SubSlider;
use App\Models\Task;
use App\Models\Teacher;
use App\Models\Vacancy;
use App\Models\Video;
use App\Models\CollegePrinciple;
use App\Models\Cataloge;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;

class PageController extends Controller
{
    public function home(Request $request)
    {
        $articles = Article::where('visibility', '1')->orderBy('created_at', 'DESC')->paginate(6);
        if ($request->filled('search')) {
            // Search across all articles (not limited to category)
            $articles = Article::where(function ($query) use ($request) {
                $query->where('title', 'like', '%' . $request->search . '%')
                    ->orWhere('description', 'like', '%' . $request->search . '%');
            })
                ->where('visibility', '1')
                ->orderBy('created_at', 'DESC')
                ->paginate(8);
        }
        return view('pages.home', [
            'articles' => $articles,

        ]);
    }

    public function staff()
    {
        $staff = Staff::where('visibility', '1')
            ->orderBy('sortable', 'ASC')
            ->whereIn('category', ['administration', 'management'])
            ->get()
            ->groupBy('category');

        return view('pages.staff', [
            'administrations' => $staff->get('administration', collect()),
            'managements' => $staff->get('management', collect()),
        ]);
    }

    public function structure(Request $request)
    {
        $fileName = implode(".", [$request->route()->getName(), "pdf"]);
        return view('pages.pdf-view', [
            'fileName' => $fileName
        ]);
    }

    public function programs()
    {
        $professions = Profession::where('visibility', '1')->get();
        $catalogues = Cataloge::where('visibility', '1')->get();
        //        $modular = $programs->filter(function($program){ return $program -> category == 'modular';});
        //        $dual = $programs->filter(fn($program) => $program -> category == 'dual');
        //        $integrated = $programs->filter(fn($program) => $program -> category == 'integrated');
        //        $short_term = $programs->filter(fn($program) => $program -> category == 'short_term');
        //
        //        'modular' => $modular,
        //        'dual' => $dual,
        //        'integrated' => $integrated,
        //        'short_term' => $short_term,

        return view('pages.programs', [
            'professions' => $professions,
            'catalogues' => $catalogues
        ]);
    }

    public function teachers()
    {
        return view('pages.teachers', [
            'teachers' => Teacher::orderBy('id', 'DESC')->paginate(8),
        ]);
    }

    public function contact()
    {
        return view('pages.contact');
    }

    public function gallery()
    {
        $photoGallery = PhotoGallery::where('visibility', '1')->with('gallery_images')->orderBy('id', 'DESC')->paginate(4);

        return view('pages.gallery', [
            'photoGallery' => $photoGallery
        ]);
    }

    public function videos()
    {
        return view('pages.videos', [
            'videos' => Video::where('visibility', '1')->orderBy('sortable', 'ASC')->paginate(12),
        ]);
    }

    public function employers()
    {
        return view('pages.employers', [
            'employers' => Employer::where('visibility', '1')->orderBy('id', 'DESC')->paginate(24),
        ]);
    }

    public function tables()
    {
        return view('pages.tables', [
            'professions' => Profession::where('visibility', '1')
                ->where('type->en', 'modular') // Querying the JSON column
                ->with('groups')
                ->get(),
        ]);
    }

    public function councils()
    {
        return view('pages.councils', [
            'councils' => Council::where('visibility', '1')->get()
        ]);
    }

    public function graduates()
    {
        return view('pages.graduates', [
            'graduates' => Graduated::where('visibility', '1')->orderBy('sortable', 'ASC')->paginate(5)
        ]);
    }

    public function visitors()
    {
        $slides = SubSlider::where('visibility', '1')->get();
        return view('layouts.visitors', [
            'slides' => $slides
        ]);
    }

    public function developmentStrategy()
    {
        $docs = Documentation::where('visibility', '1')->get();
        $docs = $docs->filter(function ($doc) {
            return $doc->category == 'development-strategy';
        });
        return view('pages.development-strategy', [
            'docs' => $docs
        ]);
    }

    public function reportsActivities()
    {
        $docs = Documentation::where('visibility', '1')->get();
        $legislative_docs = $docs->filter(function ($doc) {
            return $doc->category == 'reports-activities';
        });
        return view('pages.reports-activities', [
            'docs' => $legislative_docs
        ]);
    }

    public function acts()
    {
        $docs = Documentation::where('visibility', '1')->get();

        $legislative_docs = $docs->filter(function ($doc) {
            return $doc->category == 'legislative-acts';
        });
        $subordinate_docs = $docs->filter(function ($doc) {
            return $doc->category == 'subordinate-legislation-acts';
        });
        return view('pages.acts', [
            'legislative_docs' => $legislative_docs,
            'subordinate_docs' => $subordinate_docs
        ]);
    }
    public function vacancies()
    {
        return view('pages.vacancies', [
            'vacancies' => Vacancy::orderBy('sortable', 'DESC')->where('visibility', '1')->paginate(12)
        ]);
    }

    public function mission()
    {
        return view('pages.mission', [
            'college' => CollegePrinciple::latest()->first()
        ]);
    }

    public function sitemap()
    {
        $language = app()->getLocale();

        $sitemapData = [
            'main_pages' => [
                'title' => __('sitemap.main_pages'),
                'routes' => [
                    ['name' => __('sitemap.home'), 'route' => 'home', 'icon' => 'fas fa-home'],
                    ['name' => __('sitemap.contact'), 'route' => 'contact', 'icon' => 'fas fa-envelope'],
                    ['name' => __('sitemap.mission'), 'route' => 'mission', 'icon' => 'fas fa-bullseye'],
                ]
            ],
            'institutional' => [
                'title' => __('sitemap.institutional'),
                'routes' => [
                    ['name' => __('sitemap.staff'), 'route' => 'staff', 'icon' => 'fas fa-users'],
                    ['name' => __('sitemap.structure'), 'route' => 'structure', 'icon' => 'fas fa-sitemap'],
                    ['name' => __('sitemap.councils'), 'route' => 'councils', 'icon' => 'fas fa-user-tie'],
                    ['name' => __('sitemap.teachers'), 'route' => 'teachers', 'icon' => 'fas fa-chalkboard-teacher'],
                ]
            ],
            'academic' => [
                'title' => __('sitemap.academic'),
                'routes' => [
                    ['name' => __('sitemap.programs'), 'route' => 'programs', 'icon' => 'fas fa-graduation-cap'],
                    ['name' => __('sitemap.tables'), 'route' => 'tables', 'icon' => 'fas fa-table'],
                    ['name' => __('sitemap.graduates'), 'route' => 'graduates', 'icon' => 'fas fa-user-graduate'],
                ]
            ],
            'resources' => [
                'title' => __('sitemap.resources'),
                'routes' => [
                    ['name' => __('sitemap.library'), 'route' => 'library', 'icon' => 'fas fa-book'],
                    ['name' => __('sitemap.reports_activities'), 'route' => 'reportsActivities', 'icon' => 'fas fa-chart-line'],
                    ['name' => __('sitemap.development_strategy'), 'route' => 'developmentStrategy', 'icon' => 'fas fa-road'],
                    ['name' => __('sitemap.acts'), 'route' => 'acts', 'icon' => 'fas fa-gavel'],
                ]
            ],
            'community' => [
                'title' => __('sitemap.community'),
                'routes' => [
                    ['name' => __('sitemap.employers'), 'route' => 'employers', 'icon' => 'fas fa-briefcase'],
                    ['name' => __('sitemap.vacancies'), 'route' => 'vacancies', 'icon' => 'fas fa-search'],
                    ['name' => __('sitemap.visitors'), 'route' => 'visitors', 'icon' => 'fas fa-eye'],
                ]
            ],
            'media' => [
                'title' => __('sitemap.media'),
                'routes' => [
                    ['name' => __('sitemap.gallery'), 'route' => 'gallery', 'icon' => 'fas fa-images'],
                    ['name' => __('sitemap.videos'), 'route' => 'videos', 'icon' => 'fas fa-video'],
                ]
            ]
        ];

        return view('pages.sitemap', compact('sitemapData'));
    }
}
