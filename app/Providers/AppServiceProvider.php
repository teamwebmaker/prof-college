<?php

namespace App\Providers;

use App\Models\Category;
use App\Models\Profession;
use App\Models\Program;
use Illuminate\Routing\UrlGenerator;
use App\Models\MainMenu;
use App\Models\Partner;
use App\Models\Slide;
use App\Models\Task;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(UrlGenerator $url): void
    {
        if (env('REDIRECT_HTTPS')) {
            $url->forceScheme('https');
        }

        $MainMenu = MainMenu::where('visibility', '1')
            ->orderBy('sortable', 'asc') // Order main menu
            ->with([
                'sub_menus' => function ($query) {
                    $query->where('visibility', '1')
                        ->orderBy('sortable', 'asc'); // Order submenus
                }
            ])
            ->get();

        $slides = Slide::all();
        $tasks = Task::where('visibility', '1')->get();
        $partners = Partner::orderBy('sortable', 'asc')->get();
        $language = App::getLocale();
        $professions = Profession::all();
        $categories = Category::where('visibility', '1')->get();

        $data = [
            'main_menus' => $MainMenu,
            'slides' => $slides,
            'tasks' => $tasks,
            'partners' => $partners,
            'professions' => $professions,
            'language' => $language,
            'routeName' => Route::currentRouteName(),
            'categories' => $categories
        ];
        View::share($data);
    }
}
