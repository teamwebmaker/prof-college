<div class="accordion" id="dashboard">
    <!-- articles -->
    <div class="accordion-item">
        <h2 class="accordion-header">
            <button class="accordion-button collapsed d-flex gap-2" type="button" data-bs-toggle="collapse" data-bs-target="#articles" aria-expanded="false" aria-controls="articles">
                <i class="bi bi-newspaper"></i>
                <span class="btn-label">სიახლეები {{ $routeName }}</span>
            </button>
        </h2>
        <div id="articles" class="accordion-collapse collapse @if($routeName == 'articles.index' || $routeName == 'articles.create' || $routeName == 'articles.edit') show @endif" data-bs-parent="#dashboard">
            <div class="accordion-body">
                <ul class="list-group">
                    <li class="list-group-item  @if($routeName == 'articles.index')  bg-secondary text-white @endif">
                        <a class="nav-link" href="{{ route('articles.index', ['language' => app() -> getLocale()]) }}">სიახლეების სია</a>
                    </li>
                    <li class="list-group-item  @if($routeName == 'articles.create')  bg-secondary text-white   @endif">
                        <a class="nav-link" href="{{ route('articles.create',['language' => app() -> getLocale()]) }}">სიახლის დამატება</a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
    <!-- staff -->
    <div class="accordion-item">
        <h2 class="accordion-header">
            <button class="accordion-button collapsed d-flex gap-2" type="button" data-bs-toggle="collapse" data-bs-target="#staff" aria-expanded="false" aria-controls="staff">
                <i class="bi bi-person-bounding-box"></i>
                <span class="btn-label">ადმინისტრაცია</span>
            </button>
        </h2>
        <div id="staff" class="accordion-collapse collapse @if($routeName == 'staff.index' || $routeName == 'staff.create' || $routeName == 'staff.edit') show @endif" data-bs-parent="#dashboard">
            <div class="accordion-body">
                <ul class="list-group">
                    <li class="list-group-item  @if($routeName == 'staff.index')  bg-secondary text-white @endif">
                        <a class="nav-link" href="{{ route('staff.index', ['language' => app() -> getLocale()]) }}">ადმინისტრაციის სია</a>
                    </li>
                    <li class="list-group-item  @if($routeName == 'staff.create')  bg-secondary text-white   @endif">
                        <a class="nav-link" href="{{ route('staff.create', ['language' => app() -> getLocale()]) }}">თანამშრომლის დამატება</a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
    <!-- councils -->
    <div class="accordion-item">
        <h2 class="accordion-header">
            <button class="accordion-button collapsed d-flex gap-2" type="button" data-bs-toggle="collapse" data-bs-target="#councils" aria-expanded="false" aria-controls="councils">
                <i class="bi bi-bank"></i>
                <span class="btn-label">სამეთვალყურეო საბჭო</span>
            </button>
        </h2>
        <div id="councils" class="accordion-collapse collapse @if($routeName == 'councils.index' || $routeName == 'councils.create' || $routeName == 'councils.edit') show @endif" data-bs-parent="#dashboard">
            <div class="accordion-body">
                <ul class="list-group">
                    <li class="list-group-item  @if($routeName == 'councils.index')  bg-secondary text-white @endif">
                        <a class="nav-link" href="{{ route('councils.index',['language' => app() -> getLocale()]) }}">საბჭოს წევრების სია</a>
                    </li>
                    <li class="list-group-item  @if($routeName == 'councils.create')  bg-secondary text-white   @endif">
                        <a class="nav-link" href="{{ route('councils.create',['language' => app() -> getLocale()]) }}">საბჭოს წევრის დამატება</a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
    <!-- employers -->
    <div class="accordion-item">
        <h2 class="accordion-header">
            <button class="accordion-button collapsed d-flex gap-2" type="button" data-bs-toggle="collapse" data-bs-target="#employers" aria-expanded="false" aria-controls="employers">
                <i class="bi bi-person-workspace"></i>
                <span class="btn-label">დამსაქმებლები</span>
            </button>
        </h2>
        <div id="employers" class="accordion-collapse collapse @if($routeName == 'employers.index' || $routeName == ' employers.create' || $routeName == 'employers.edit') show @endif" data-bs-parent="#dashboard">
            <div class="accordion-body">
                <ul class="list-group">
                    <li class="list-group-item  @if($routeName == 'employers.index')  bg-secondary text-white @endif">
                        <a class="nav-link" href="{{ route('employers.index',['language' => app() -> getLocale()]) }}">დამსაქმებლების სია</a>
                    </li>
                    <li class="list-group-item  @if($routeName == 'employers.create')  bg-secondary text-white   @endif">
                        <a class="nav-link" href="{{ route('employers.create',['language' => app() -> getLocale()]) }}">დამსაქმებლის დამატება</a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
    <!-- graduates -->
    <div class="accordion-item">
        <h2 class="accordion-header">
            <button class="accordion-button collapsed d-flex gap-2" type="button" data-bs-toggle="collapse" data-bs-target="#graduates" aria-expanded="false" aria-controls="graduates">
                <i class="bi bi-mortarboard"></i>
                <span class="btn-label">კურსდამთავრებულები</span>
            </button>
        </h2>
        <div id="graduates" class="accordion-collapse collapse @if($routeName == 'graduates.index' || $routeName == 'graduates.create' || $routeName == 'graduates.edit') show @endif" data-bs-parent="#dashboard">
            <div class="accordion-body">
                <ul class="list-group">
                    <li class="list-group-item  @if($routeName == 'graduates.index')  bg-secondary text-white @endif">
                        <a class="nav-link" href="{{ route('graduates.index',['language' => app() -> getLocale()]) }}">კურსდამთავრებულების სია</a>
                    </li>
                    <li class="list-group-item  @if($routeName == 'graduates.create')  bg-secondary text-white   @endif">
                        <a class="nav-link" href="{{ route('graduates.create',['language' => app() -> getLocale()]) }}">კურსდამთავრებულის დამატება</a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
    <!-- partners -->
    <div class="accordion-item">
        <h2 class="accordion-header">
            <button class="accordion-button collapsed d-flex gap-2" type="button" data-bs-toggle="collapse" data-bs-target="#partners" aria-expanded="false" aria-controls="partners">
                <i class="bi bi-people"></i>
                <span class="btn-label">პარტნიორები</span>
            </button>
        </h2>
        <div id="partners" class="accordion-collapse collapse @if($routeName == 'partners.index' || $routeName == 'partners.create' || $routeName == 'partners.edit') show @endif" data-bs-parent="#dashboard">
            <div class="accordion-body">
                <ul class="list-group">
                    <li class="list-group-item @if($routeName == 'partners.index')  bg-secondary text-white @endif">
                        <a class="nav-link" href="{{ route('partners.index',['language' => app() -> getLocale()]) }}">პარტნიორების სია</a>
                    </li>
                    <li class="list-group-item  @if($routeName == 'partners.create')  bg-secondary text-white @endif">
                        <a class="nav-link" href="{{ route('partners.create',['language' => app() -> getLocale()]) }}">პარტნიორის დამატება</a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
    <!-- programs -->
    <div class="accordion-item">
        <h2 class="accordion-header">
            <button class="accordion-button collapsed d-flex gap-2" type="button" data-bs-toggle="collapse" data-bs-target="#programs" aria-expanded="false" aria-controls="programs">
                <i class="bi bi-card-list"></i>
                <span class="btn-label">პროგრამები</span>
            </button>
        </h2>
        <div id="programs" class="accordion-collapse collapse @if($routeName == 'programs.index' || $routeName == 'programs.create' || $routeName == 'programs.edit') show @endif" data-bs-parent="#dashboard">
            <div class="accordion-body">
                <ul class="list-group">
                    <li class="list-group-item @if($routeName == 'programs.index')  bg-secondary text-white @endif">
                        <a class="nav-link" href="{{ route('programs.index',['language' => app() -> getLocale()]) }}">პროგრამების სია</a>
                    </li>
                    <li class="list-group-item  @if($routeName == 'programs.create')  bg-secondary text-white @endif">
                        <a class="nav-link" href="{{ route('programs.create',['language' => app() -> getLocale()]) }}">პროგრამის დამატება</a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
    <!-- professions -->
    <div class="accordion-item">
        <h2 class="accordion-header">
            <button class="accordion-button collapsed d-flex gap-2" type="button" data-bs-toggle="collapse" data-bs-target="#professions" aria-expanded="false" aria-controls="professions">
                <i class="bi bi-briefcase"></i>
                <span class="btn-label">პროფესიები</span>
            </button>
        </h2>
        <div id="professions" class="accordion-collapse collapse @if($routeName == 'professions.index' || $routeName == 'professions.create' || $routeName == 'professions.edit') show @endif" data-bs-parent="#dashboard">
            <div class="accordion-body">
                <ul class="list-group">
                    <li class="list-group-item @if($routeName == 'professions.index')  bg-secondary text-white @endif">
                        <a class="nav-link" href="{{ route('professions.index',['language' => app() -> getLocale()]) }}">პროფესიების სია</a>
                    </li>
                    <li class="list-group-item  @if($routeName == 'professions.create')  bg-secondary text-white @endif">
                        <a class="nav-link" href="{{ route('professions.create',['language' => app() -> getLocale()]) }}">პროფესიის დამატება</a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
    <!-- galleries -->
    <div class="accordion-item">
        <h2 class="accordion-header">
            <button class="accordion-button collapsed d-flex gap-2" type="button" data-bs-toggle="collapse" data-bs-target="#photo_galleries" aria-expanded="false" aria-controls="photo_galleries">
                <i class="bi bi-file-image"></i>
                <span class="btn-label">ფოტო გალერია</span>
            </button>
        </h2>
        <div id="photo_galleries" class="accordion-collapse collapse @if($routeName == 'galleries.index' || $routeName == 'galleries.create' || $routeName == 'galleries.edit') show @endif" data-bs-parent="#dashboard">
            <div class="accordion-body">
                <ul class="list-group">
                    <li class="list-group-item @if($routeName == 'galleries.index')  bg-secondary text-white @endif">
                        <a class="nav-link" href="{{ route('galleries.index',['language' => app() -> getLocale()]) }}">გალერიების სია</a>
                    </li>
                    <li class="list-group-item  @if($routeName == 'galleries.create')  bg-secondary text-white @endif">
                        <a class="nav-link" href="{{ route('galleries.create',['language' => app() -> getLocale()])}}">გალერიის დამატება</a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
    <!-- videos -->
    <div class="accordion-item">
        <h2 class="accordion-header">
            <button class="accordion-button collapsed d-flex gap-2" type="button" data-bs-toggle="collapse" data-bs-target="#videos" aria-expanded="false" aria-controls="videos">
                <i class="bi bi-camera-reels"></i>
                <span class="btn-label">ვიდეო გალერია</span>
            </button>
        </h2>
        <div id="videos" class="accordion-collapse collapse @if($routeName == 'videos.index' || $routeName == 'videos.create' || $routeName == 'videos.edit') show @endif" data-bs-parent="#dashboard">
            <div class="accordion-body">
                <ul class="list-group">
                    <li class="list-group-item @if($routeName == 'videos.index')  bg-secondary text-white @endif">
                        <a class="nav-link" href="{{ route('videos.index',['language' => app() -> getLocale()]) }}">ვიდეოების სია</a>
                    </li>
                    <li class="list-group-item  @if($routeName == 'videos.create')  bg-secondary text-white @endif">
                        <a class="nav-link" href="{{ route('videos.create',['language' => app() -> getLocale()])}}">ვიდეოს დამატება</a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
    <!-- slides -->
    <div class="accordion-item">
        <h2 class="accordion-header">
            <button class="accordion-button collapsed d-flex gap-2" type="button" data-bs-toggle="collapse" data-bs-target="#slides" aria-expanded="false" aria-controls="slides">
                <i class="bi bi-file-earmark-easel"></i>
                <span class="btn-label">სლაიდები</span>
            </button>
        </h2>
        <div id="slides" class="accordion-collapse collapse @if($routeName == 'slides.index' || $routeName == 'slides.create') show @endif" data-bs-parent="#dashboard">
            <div class="accordion-body">
                <ul class="list-group">
                    <li class="list-group-item @if($routeName == 'slides.index')  bg-secondary text-white @endif">
                        <a class="nav-link" href="{{ route('slides.index',['language' => app() -> getLocale()]) }}">სლაიდების სია</a>
                    </li>
                    <li class="list-group-item  @if($routeName == 'slides.create')  bg-secondary text-white @endif">
                        <a class="nav-link" href="{{ route('slides.create',['language' => app() -> getLocale()] )}}">სლაიდის დამატება</a>
                    </li>
                </ul>
            </div>
        </div>
    </div>

    <!-- groups -->
    <div class="accordion-item">
        <h2 class="accordion-header">
            <button class="accordion-button collapsed d-flex gap-2" type="button" data-bs-toggle="collapse" data-bs-target="#groups" aria-expanded="false" aria-controls="groups">
                <i class="bi bi-people"></i>
                <span class="btn-label">ჯგუფები</span>
            </button>
        </h2>
        <div id="groups" class="accordion-collapse collapse @if($routeName == 'groups.index' || $routeName == 'groups.create' || $routeName == 'groups.edit') show @endif" data-bs-parent="#dashboard">
            <div class="accordion-body">
                <ul class="list-group">
                    <li class="list-group-item @if($routeName == 'groups.index')  bg-secondary text-white @endif">
                        <a class="nav-link" href="{{ route('groups.index',['language' => app() -> getLocale()]) }}">ჯგუფების სია</a>
                    </li>
                    <li class="list-group-item  @if($routeName == 'groups.create')  bg-secondary text-white @endif">
                        <a class="nav-link" href="{{ route('groups.create',['language' => app() -> getLocale()]) }}">ჯგუფის დამატება</a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
    <!-- contacts -->
    <div class="accordion-item">
        <h2 class="accordion-header">
            <button class="accordion-button collapsed d-flex gap-2" type="button" data-bs-toggle="collapse" data-bs-target="#contacts" aria-expanded="false" aria-controls="contacts">
                <i class="bi bi-envelope"></i>
                <span class="btn-label">კონტაქტები</span>
            </button>
        </h2>
        <div id="contacts" class="accordion-collapse collapse @if($routeName == 'contacts.index' || $routeName == 'contacts.show') show @endif" data-bs-parent="#dashboard">
            <div class="accordion-body">
                <ul class="list-group">
                    <li class="list-group-item @if($routeName == 'contacts.index')  bg-secondary text-white @endif">
                        <a class="nav-link" href="{{ route('contacts.index',['language' => app() -> getLocale()]) }}">კონტაქტების სია</a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
    <!-- admin users -->
    @if(isset($authAdmin) && $authAdmin->canManageUsers())
    <div class="accordion-item">
        <h2 class="accordion-header">
            <button class="accordion-button collapsed d-flex gap-2" type="button" data-bs-toggle="collapse" data-bs-target="#admin_users" aria-expanded="false" aria-controls="admin_users">
                <i class="bi bi-person-gear"></i>
                <span class="btn-label">ადმინისტრატორები</span>
            </button>
        </h2>
        <div id="admin_users" class="accordion-collapse collapse @if($routeName == 'admin-users.index' || $routeName == 'admin-users.create' || $routeName == 'admin-users.edit' || $routeName == 'admin-users.show') show @endif" data-bs-parent="#dashboard">
            <div class="accordion-body">
                <ul class="list-group">
                    <li class="list-group-item @if($routeName == 'admin-users.index')  bg-secondary text-white @endif">
                        <a class="nav-link" href="{{ route('admin-users.index',['language' => app() -> getLocale()]) }}">ადმინისტრატორების სია</a>
                    </li>
                    <li class="list-group-item @if($routeName == 'admin-users.create')  bg-secondary text-white @endif">
                        <a class="nav-link" href="{{ route('admin-users.create',['language' => app() -> getLocale()]) }}">ახალი ადმინისტრატორი</a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
    @endif
    <!-- vacancies -->
    <div class="accordion-item">
        <h2 class="accordion-header">
            <button class="accordion-button collapsed d-flex gap-2" type="button" data-bs-toggle="collapse" data-bs-target="#vacancies" aria-expanded="false" aria-controls="vacancies">
                <i class="bi bi-binoculars"></i>
                <span class="btn-label">ვაკანსიები</span>
            </button>
        </h2>
        <div id="vacancies" class="accordion-collapse collapse @if($routeName == 'vacancies.index' || $routeName == 'vacancies.create') show @endif" data-bs-parent="#dashboard">
            <div class="accordion-body">
                <ul class="list-group">
                    <li class="list-group-item @if($routeName == 'vacancies.index')  bg-secondary text-white @endif">
                        <a class="nav-link" href="{{ route('vacancies.index',['language' => app() -> getLocale()]) }}">ვაკანსიების სია</a>
                    </li>
                    <li class="list-group-item @if($routeName == 'vacancies.create')  bg-secondary text-white @endif">
                        <a class="nav-link" href="{{ route('vacancies.create',['language' => app() -> getLocale()]) }}">ვაკანსიის შექმნა</a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>
