@extends('layouts.dashboard')
@section('title', 'Admin Dashboard')
@section('main')
    <div class="row">
        <div class="col-md-4 mb-3">
            <div class="card">
                <div class="card-header">
                    <h4 class="text-red d-flex justify-content-between">
                        <span>სტატისტიკა</span>
                        <span>{{ $vote -> high + $vote->middle + $vote -> low }}</span>
                    </h4>
                </div>
                <div class="card-body p-0">
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item border-bottom border-success vote-item" data-percent="{{ floor(($vote -> high/($vote -> high + $vote->middle + $vote -> low)) * 100)}}" style="--bg-color:  #337357; --width: {{ floor(($vote -> high/($vote -> high + $vote->middle + $vote -> low)) * 100)}}%"></li>
                        <li class="list-group-item border-bottom border-warning vote-item" data-percent="{{ floor(($vote -> middle/($vote -> high + $vote->middle + $vote -> low)) * 100)}}" style="--bg-color: #FFD23F; --width: {{ floor(($vote -> middle/($vote -> high + $vote->middle + $vote -> low)) * 100)}}%"></li>
                        <li class="list-group-item border-bottom border-danger vote-item" data-percent="{{ floor(($vote -> low/($vote -> high + $vote->middle + $vote -> low)) * 100)}}" style="--bg-color: #EE4266; --width: {{ floor(($vote -> low/($vote -> high + $vote->middle + $vote -> low)) * 100)}}%"></li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="col-md-4 mb-3">
            <div class="card bg-dark-red">
                <div class="card-header  d-flex justify-content-between">
                    <button class="btn bg-gold px-2 text-white py-1">
                        <i class="bi bi-folder-plus"></i>
                    </button>
                    <button class="btn bg-gold text-white px-2 py-1">
                        <span class="btn-label">{{ $articles -> title }}</span>
                    </button>
                </div>
                <div class="card-body d-flex justify-content-between">
                    <button class="btn bg-gold text-white  px-2 py-1">
                        <span class="btn-label">რაოდენობა</span>
                    </button>
                    <button class="btn bg-gold text-white px-2 py-1">{{ $articles -> count }}</button>
                </div>
            </div>
        </div>
        <div class="col-md-4 mb-3">
            <div class="card bg-dark-red">
                <div class="card-header  d-flex justify-content-between">
                    <button class="btn bg-gold px-2 text-white py-1">
                        <i class="bi bi-people"></i>
                    </button>
                    <button class="btn bg-gold  px-2 text-white py-1">
                        <span class="btn-label">{{ $teachers -> title }}</span>
                    </button>
                </div>
                <div class="card-body d-flex justify-content-between">
                    <button class="btn bg-gold text-white px-2 py-1">
                        <span class="btn-label">რაოდენობა</span>
                    </button>
                    <button class="btn bg-gold text-white px-2 py-1">{{ $teachers -> count }}</button>
                </div>
            </div>
        </div>
        <div class="col-md-4 mb-3">
            <div class="card bg-dark-red">
                <div class="card-header  d-flex justify-content-between">
                    <button class="btn bg-gold text-white px-2 py-1">
                        <i class="bi bi-briefcase"></i>
                    </button>
                    <button class="btn bg-gold text-white px-2 py-1">
                        <span class="btn-label">{{ $partners -> title }}</span>
                    </button>
                </div>
                <div class="card-body d-flex justify-content-between">
                    <button class="btn bg-gold text-white px-2 py-1">
                        <span class="btn-label">რაოდენობა</span>
                    </button>
                    <button class="btn bg-gold text-white px-2 py-1">{{ $partners -> count }}</button>
                </div>
            </div>
        </div>
        <div class="col-md-4 mb-3">
            <div class="card bg-dark-red">
                <div class="card-header  d-flex justify-content-between">
                    <button class="btn bg-gold text-white px-2 py-1">
                        <i class="bi bi-book"></i>
                    </button>
                    <button class="btn bg-gold text-white px-2 py-1">
                        <span class="btn-label">{{ $staff -> title }}</span>
                    </button>
                </div>
                <div class="card-body d-flex justify-content-between">
                    <button class="btn bg-gold text-white px-2 py-1">
                        <span class="btn-label">რაოდენობა</span>
                    </button>
                    <button class="btn bg-gold text-white px-2 py-1">{{ $staff -> count }}</button>
                </div>
            </div>
        </div>
        <div class="col-md-4 mb-3">
            <div class="card bg-dark-red">
                <div class="card-header  d-flex justify-content-between">
                    <button class="btn bg-gold text-white px-2 py-1">
                        <i class="bi bi-book"></i>
                    </button>
                    <button class="btn bg-gold text-white px-2 py-1">
                        <span class="btn-label">{{ $councils -> title }}</span>
                    </button>
                </div>
                <div class="card-body d-flex justify-content-between">
                    <button class="btn bg-gold text-white px-2 py-1">
                        <span class="btn-label">რაოდენობა</span>
                    </button>
                    <button class="btn bg-gold text-white px-2 py-1">{{ $councils-> count }}</button>
                </div>
            </div>
        </div>
        <div class="col-md-4 mb-3">
            <div class="card bg-dark-red">
                <div class="card-header  d-flex justify-content-between">
                    <button class="btn bg-gold text-white px-2 py-1">
                        <i class="bi bi-book"></i>
                    </button>
                    <button class="btn bg-gold text-white px-2 py-1">
                        <span class="btn-label">{{ $employers -> title }}</span>
                    </button>
                </div>
                <div class="card-body d-flex justify-content-between">
                    <button class="btn bg-gold text-white px-2 py-1">
                        <span class="btn-label">რაოდენობა</span>
                    </button>
                    <button class="btn bg-gold text-white px-2 py-1">{{ $employers-> count }}</button>
                </div>
            </div>
        </div>
        <div class="col-md-4 mb-3">
            <div class="card bg-dark-red">
                <div class="card-header  d-flex justify-content-between">
                    <button class="btn bg-gold text-white px-2 py-1">
                        <i class="bi bi-book"></i>
                    </button>
                    <button class="btn bg-gold text-white px-2 py-1">
                        <span class="btn-label">{{ $graduates -> title }}</span>
                    </button>
                </div>
                <div class="card-body d-flex justify-content-between">
                    <button class="btn bg-gold text-white px-2 py-1">
                        <span class="btn-label">რაოდენობა</span>
                    </button>
                    <button class="btn bg-gold text-white px-2 py-1">{{ $graduates-> count }}</button>
                </div>
            </div>
        </div>
        <div class="col-md-4 mb-3">
            <div class="card bg-dark-red">
                <div class="card-header  d-flex justify-content-between">
                    <button class="btn bg-gold text-white px-2 py-1">
                        <i class="bi bi-book"></i>
                    </button>
                    <button class="btn bg-gold text-white px-2 py-1">
                        <span class="btn-label">{{ $documents -> title }}</span>
                    </button>
                </div>
                <div class="card-body d-flex justify-content-between">
                    <button class="btn bg-gold text-white px-2 py-1">
                        <span class="btn-label">რაოდენობა</span>
                    </button>
                    <button class="btn bg-gold text-white px-2 py-1">{{ $documents-> count }}</button>
                </div>
            </div>
        </div>
        <div class="col-md-4 mb-3">
            <div class="card bg-dark-red">
                <div class="card-header  d-flex justify-content-between">
                    <button class="btn bg-gold text-white px-2 py-1">
                        <i class="bi bi-book"></i>
                    </button>
                    <button class="btn bg-gold text-white px-2 py-1">
                        <span class="btn-label">{{ $programs -> title }}</span>
                    </button>
                </div>
                <div class="card-body d-flex justify-content-between">
                    <button class="btn bg-gold text-white px-2 py-1">
                        <span class="btn-label">რაოდენობა</span>
                    </button>
                    <button class="btn bg-gold text-white px-2 py-1">{{ $programs -> count }}</button>
                </div>
            </div>
        </div>
        <div class="col-md-4 mb-3">
            <div class="card bg-dark-red">
                <div class="card-header  d-flex justify-content-between">
                    <button class="btn bg-gold text-white px-2 py-1">
                        <i class="bi bi-book"></i>
                    </button>
                    <button class="btn bg-gold text-white px-2 py-1">
                        <span class="btn-label">{{ $professions -> title }}</span>
                    </button>
                </div>
                <div class="card-body d-flex justify-content-between">
                    <button class="btn bg-gold text-white px-2 py-1">
                        <span class="btn-label">რაოდენობა</span>
                    </button>
                    <button class="btn bg-gold text-white px-2 py-1">{{ $professions -> count }}</button>
                </div>
            </div>
        </div>
        <div class="col-md-4 mb-3">
            <div class="card bg-dark-red">
                <div class="card-header  d-flex justify-content-between">
                    <button class="btn bg-gold text-white px-2 py-1">
                        <i class="bi bi-book"></i>
                    </button>
                    <button class="btn bg-gold text-white px-2 py-1">
                        <span class="btn-label">{{ $tasks -> title }}</span>
                    </button>
                </div>
                <div class="card-body d-flex justify-content-between">
                    <button class="btn bg-gold text-white px-2 py-1">
                        <span class="btn-label">რაოდენობა</span>
                    </button>
                    <button class="btn bg-gold text-white px-2 py-1">{{ $tasks -> count }}</button>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
    <script></script>
@endsection
