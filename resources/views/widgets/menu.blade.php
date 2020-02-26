<div class="container-fluid menu-top-bg">
    <div class="container">
        <div class="row">
            <div class="col">
                <div class="menu">
                    <div>
                        <a href="{{ route('frontend.home') }}"><img src="{{ asset('images/logo3.png') }}" class="img-fluid" width="350"></a>
                    </div>
                    <div class="menu-wrap">
                        <ul class="menu-top">
                            @if(count($items) > 0)
                                @foreach($items as $item)
                                    <li class="menu-top__li"><a href="{{ $item->route == 'link' ? $item->slug : route('frontend.' . $item->route, ['path' => $item->slug]) }}" class="menu-top__li-link">{{ $item->title }}</a>
                                    @if(count($item->children) > 0)
                                        <ul class="menu-sub">
                                        @foreach($item->children as $children)
                                            <li class="menu-sub__li"><a href="{{ $item->route == 'link' ? $item->slug : route('frontend.' . $children->route, ['path' => $children->slug]) }}" class="menu-sub__li-link">{{ $children->title }}</a></li>
                                        @endforeach
                                        </ul>
                                    @endif
                                    </li>
                                @endforeach
                            @endif
                        </ul>
                    </div>
                    <div class="login-register-wrap">
                        @guest
                            <a href="{{ route('frontend.register') }}" class="btn btn-green header-btn-register">Регистрация</a>
                            <a href="{{ route('frontend.login') }}" class="btn btn-light header-btn-login">Вход</a>
                        @else
                            <ul class="navbar-nav ml-auto">
                                <li class="nav-item dropdown">
                                    <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                        {{ Auth::user()->name }} <span class="caret"></span>
                                    </a>

                                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                        <a class="dropdown-item" href="{{ route('frontend.logout') }}"
                                           onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                            Выйти
                                        </a>

                                        <form id="logout-form" action="{{ route('frontend.logout') }}" method="POST" style="display: none;">
                                            @csrf
                                        </form>
                                    </div>
                                </li>
                            </ul>
                        @endguest
                    </div>
                    <div class="menu-mobile-icon"><img src="/images/menu-icon-mobile.png"></div>
                </div>
            </div>
        </div>
    </div>
</div>
