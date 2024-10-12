<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Council;
use App\Models\Documentation;
use App\Models\Employer;
use App\Models\Graduated;
use App\Models\Partner;
use App\Models\Profession;
use App\Models\Program;
use App\Models\Staff;
use App\Models\Task;
use App\Models\Teacher;
use App\Models\Vote;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class AdminController extends Controller
{
    public object $user;

    public function __construct()
    {
        $this-> user = (object) [
            'email' => 'profgldani@admin.panel',
            'password' => '$2y$10$PlR/Juu2rW/s8yfMMNs29OcEpn6zL2HxcCSCBrSTKiVS07FeotMZO' //$AdminPanel2024#
        ];
    }
    public function  dashboard()
    {
        return view('admin.desk', [
            'articles' => (object) [
                'title' => 'სიახლეები',
                'count' => Article::count()
            ],
            'teachers' => (object) [
                'title' => 'პედაგოგები',
                'count' => Teacher::count()
            ],
            'partners' => (object) [
                'title' => 'პარტნიორები',
                'count' => Partner::count()
            ],
            'staff' => (object) [
                'title' => 'ადმინისტრაცია',
                'count' => Staff::count()
            ],
            'councils' => (object) [
                'title' => 'საბჭო',
                'count' => Council::count()
            ],
            'employers' => (object) [
                'title' => 'დამსაქმებლები',
                'count' => Employer::count()
            ],
            'graduates' => (object) [
                'title' => 'კურსდამთავრებულები',
                'count' => Graduated::count()
            ],
            'documents' => (object) [
                'title' => 'დოკუმენტაცია',
                'count' => Documentation::count()
            ],
            'programs' => (object) [
                'title' => 'პროგრამები',
                'count' => Program::count()
            ],
            'professions' => (object) [
                'title' => 'პროფესიები',
                'count' => Profession::count()
            ],
            'tasks' => (object) [
                'title' => 'ტასკები',
                'count' => Task::count()
            ],
            'vote' => Vote::all() -> first()
        ]);
    }


    public function login()
    {
        if(Session::has('admin')) return redirect() -> route('admin.dashboard.page', ['language' => app() -> getLocale()]);
        return view('admin.login', ['language' => app() -> getLocale()]);
    }

    public function auth(Request $request)
    {
        if($this -> user -> email == $request -> email){
            if(password_verify($request -> password, $this -> user -> password)){
                Session::put('admin', $this -> user);
                return redirect() -> route('admin.dashboard.page', ['language' => app() -> getLocale()]);
            }  else return redirect() -> back() -> with('password', 'პაროლი არასწორია');
        } else return redirect() -> back() -> with('email', 'ელ.ფოსტა არასწორია');

    }

    public function logout()
    {
        Session::forget('admin');
        return redirect() -> route('admin.login.page');
    }
}
