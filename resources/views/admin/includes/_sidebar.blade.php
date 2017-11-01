<nav class="navbar-default navbar-static-side" role="navigation">
    <div class="sidebar-collapse">
        <ul class="nav metismenu" id="side-menu">
            <li class="nav-header">
                <div class="dropdown profile-element"> <span>
                            <img alt="image" class="img-circle" src="/images/profile_small.jpg"/>
                             </span>
                    <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                            <span class="clear"> <span class="block m-t-xs"> <strong
                                            class="font-bold">{{ Auth::user()->full_name }}</strong>
                             </span> <span class="text-muted text-xs block">Editor <b
                                            class="caret"></b></span> </span> </a>
                    <ul class="dropdown-menu animated fadeInRight m-t-xs">
                        <li><a href="{{ route('logout') }}"
                               onclick="event.preventDefault();
                                document.getElementById('logout-form').submit();">Logout</a>

                            <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                  style="display: none;">
                                {{ csrf_field() }}
                            </form>
                        </li>
                    </ul>
                </div>
                <div class="logo-element">
                    {{config('app.short_name')}}+
                </div>
            </li>

            <li>
                <a href="{{ route('dashboard') }}"><i class="fa fa-home"></i> <span
                            class="nav-label">Dashboard</span> </a>
            </li>
            <li>
                <a href="{{ route('tags') }}"><i class="fa fa-tags"></i> <span
                            class="nav-label">Tags</span> </a>
            </li>
            <li>
                <a href="{{ route('sections') }}"><i class="fa fa-columns"></i> <span
                            class="nav-label">Sections</span> </a>
            </li>
            <li>
                <a href="{{ route('news') }}"><i class="fa fa-newspaper-o"></i> <span
                            class="nav-label">News</span> </a>
            </li>
            <li>
                <a href="{{ route('faqs') }}"><i class="fa fa-question"></i> <span
                            class="nav-label">FAQs</span> </a>
            </li>
            {{--<li>
                <a href="{{ route('reviews.index') }}"><i class="fa fa-star"></i> <span
                            class="nav-label">Reviews</span> </a>
            </li>
            <li>
                <a href="#"><i class="fa fa-file-text-o"></i> <span class="nav-label">Pages</span><span
                            class="fa arrow"></span></a>
                <ul class="nav nav-second-level collapse">
                </ul>
            </li>--}}
        </ul>

    </div>
</nav>