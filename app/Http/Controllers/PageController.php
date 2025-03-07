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
use App\Models\Cataloge;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;

class PageController extends Controller
{
    public function home(Request $request)
    {
        $articles = Article::where('visibility', '1') -> orderBy('created_at', 'DESC')->paginate(8);
        if($request -> filled('search')){
            $articles = Article::where('title', 'like', '%'.$request -> search.'%')->
            orWhere('description', 'like', '%'.$request -> search.'%')
                ->where('visibility', '1')
                ->paginate(8);
        }
        return view('pages.home',[
            'articles' =>  $articles,

        ]);
    }

    public function staff()
    {
        return view('pages.staff', [
            'staff' => Staff::where('visibility', '1') -> orderby('sortable', 'ASC') ->get(),
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
           'catalogues' =>  $catalogues
        ]);
    }

    public function teachers()
    {
        return view('pages.teachers', [
            'teachers' => Teacher::orderBy('id', 'DESC')->paginate(8),
        ]);
    }
//    public function documents()
//    {
//        $docs = Documentation::where('visibility', '1')->get();
//
//        $activate_docs = $docs->filter(function($doc){ return $doc-> category == 'activates';});
//        $authorization_docs = $docs->filter(function($doc){ return $doc-> category == 'authorizations';});
//        $act_docs = $docs->filter(function($doc){ return $doc-> category == 'acts';});
//        $education_docs = $docs->filter(function($doc){ return $doc-> category == 'educations';});
//        $rate_docs = $docs->filter(function($doc){ return $doc-> category == 'rates';});
//        $strategy_docs = $docs->filter(function($doc){ return $doc-> category == 'strategies';});
//
//        return view('pages.documents', [
//            'activate_docs' => $activate_docs,
//            'authorization_docs' => $authorization_docs,
//            'act_docs' => $act_docs,
//            'education_docs' => $education_docs,
//            'rate_docs' => $rate_docs,
//            'strategy_docs' => $strategy_docs,
//        ]);
//    }

    public function contact()
    {
        return view('pages.contact');
    }

    public function gallery()
    {
        $photoGallery = PhotoGallery::where('visibility', '1')->with('gallery_images')-> orderBy('id', 'DESC') -> paginate(6);

        return view('pages.gallery',[
            'photoGallery' => $photoGallery
        ]);
    }

    public function videos()
    {
        return view('pages.videos',[
           'videos' => Video::where('visibility', '1')->orderBy('id', 'DESC')->paginate(9),
        ]);
    }

    public  function employers()
    {
        return view('pages.employers',[
            'employers' => Employer::where('visibility', '1')->orderBy('id', 'DESC')->paginate(15),
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
        return view('pages.councils',[
            'councils' => Council::where('visibility', '1')->get()
        ]);
    }

    public function graduates()
    {
        return view('pages.graduates',[
            'graduates' => Graduated::where('visibility', '1')->orderBy('sortable', 'ASC')->paginate(5)
        ]);
    }

    public function visitors()
    {
        $slides = SubSlider::where('visibility', '1')->get();
        return view('layouts.visitors',[
            'slides' => $slides
        ]);
    }

    public function studyingProcess()
    {
        $docs = Documentation::where('visibility', '1')->get();
        $docs = $docs->filter(function($doc){ return $doc-> category == 'educations';});
        return view('pages.studying-process',[
            'docs' => $docs
        ]);
    }

    public function legislativeActs()
    {
        $docs = Documentation::where('visibility', '1')->get();
        $legislative_docs = $docs->filter(function($doc){ return  $doc -> category == 'activates';});
        return view('pages.activates',[
            'docs' => $legislative_docs
        ]);
    }

    public function acts()
    {
        $docs = Documentation::where('visibility', '1')->get();
        $act_docs = $docs->filter(function($doc){ return $doc-> category == 'acts';});
        $legislative_docs = $docs->filter(function($doc){ return $doc-> category == 'legislative';});
        $subordinate_docs = $docs->filter(function($doc){ return $doc-> category == 'subordinate';});
        return view('pages.acts',[
            'docs' => $act_docs,
            'legislative_docs' => $legislative_docs,
            'subordinate_docs' => $subordinate_docs
        ]);
    }
    public function vacancies()
    {
        return view('pages.vacancies',[
            'vacancies' => Vacancy::orderBy('sortable', 'DESC') -> where('visibility', '1')->paginate(12)
        ]);
    }

    public function mission()
    {
        $docs = Documentation::where('visibility', '1')->get();
        $mission_docs = $docs->filter(function($doc){ return $doc-> category == 'structure';});
        return view('pages.mission',[
            'docs' => $mission_docs
        ]);
    }
}
