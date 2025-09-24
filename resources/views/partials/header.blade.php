<div class="container-fluid bg-dark-red">
    <h1 class="page-slogan p-2 d-md-none" data-language="{{ $language }}">{{ __('static.pages.title') }}</h1>
    <div class="container-xxl navigation-container" data-content="{{ __('static.pages.title') }}" data-language="{{ $language }}">
        <nav class="navbar navbar-expand-xl">
            <a class="navbar-brand" href="{{ route('home', ['language' => app() -> getLocale()]) }}">
                <img class="logo-icon" src="{{ asset('images/themes/college_logo.png') }}" alt="College Logo" />
            </a>
            <div class="language-bar">
                <ul class="language-switcher m-0 p-0">
                    <li class="language-choose">
                        <a class="language-link @if(app()->getLocale() == "en") language-link-active @endif"
                            href="{{ Str::replaceFirst(app()->getLocale(), 'en', request()->url()) }}"
                            data-language="{{ $language }}">EN</a>
                    </li>
                    <li class="language-choose">
                        <a class="language-link @if(app()->getLocale() == "ka") language-link-active @endif"
                            href="{{ Str::replaceFirst(app()->getLocale(), 'ka', request()->url()) }}"
                            data-language="{{ $language }}">KA</a>
                    </li>
                </ul>
            </div>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <i class="bi bi-list text-white"></i>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav w-100 justify-content-end">
                    @foreach($main_menus as $item)
                        @if($item->sub_menus->isNotEmpty())
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle text-white position-relative animated-line"
                                    href="#"
                                    role="button"
                                    data-bs-toggle="dropdown"
                                    aria-expanded="false"
                                    data-language="{{ $language }}">
                                    {{ $item->title->$language }}
                                </a>
                                <ul class="dropdown-menu dropdown-menu-category">
                                    @foreach($item->sub_menus as $sub_menu)
                                        @if($sub_menu->type == "url")
                                            <li class="list-group-item sub-menu-item">
                                                <a class="sub-menu-link dropdown-item"
                                                    href="{{ $sub_menu->href }}"
                                                    target="_blank"
                                                    data-language="{{ $language }}">
                                                    {{ $sub_menu->title->$language }}
                                                </a>
                                            </li>
                                        @else
                                            <li class="list-group-item sub-menu-item">
                                                <a class="sub-menu-link dropdown-item"
                                                    href="{{ route($sub_menu->name, ['language' => app()->getLocale()]) }}"
                                                    data-language="{{ $language }}">
                                                    {{ $sub_menu->title->$language }}
                                                </a>
                                            </li>
                                        @endif
                                    @endforeach
                                </ul>
                            </li>
                        @else
                            <li class="nav-item">
                                <a class="nav-link text-white position-relative animated-line"
                                    aria-current="page"
                                    href="{{ route($item->name, ['language' => app()->getLocale()])}}"
                                    data-language="{{ $language }}">
                                    {{ $item->title->$language }}
                                </a>
                            </li>
                        @endif
                    @endforeach
                    <li class="nav-item">
                        <button class="nav-link text-white position-relative animated-line" aria-current="page" aria-label="Search" onclick="showModal('search')">
                            <i class="bi bi-search"></i>
                        </button>
                    </li>
                </ul>
            </div>
        </nav>
    </div>
</div>
