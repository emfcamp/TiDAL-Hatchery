<!DOCTYPE html>
<html lang="{{ config('app.locale') }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="manifest" href="/manifest.json">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="csrfToken" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Hatchery') }}</title>
    <meta name="description" content="A platform to publish and develop software for several electronic badges.">

    <meta name="theme-color" content="#F2DAC7">
    <link rel="icon" type="image/x-icon" sizes="16x16" href="{{ asset('favicon.ico') }}">
    <link rel="icon" type="image/png" sizes="640x640" href="{{ asset('img/bs.png') }}">
    <link rel="apple-touch-icon" sizes="640x640" href="{{ asset('img/bs.png') }}">
    <link rel="canonical" href="{{ url()->current() }}" />

    <!-- Styles -->
    <link href="{{ mix('css/app.css') }}" rel="stylesheet">

    <!-- Scripts -->
    <script>
        window.Laravel = {!! json_encode([
            'csrfToken' => csrf_token(),
        ]) !!};
        @auth
        window.UserId = {{ Auth::user()->id }};
        @endauth
    </script>

</head>
<body>
    <div id="app">
        <nav class="navbar navbar-default navbar-static-top">
            <div class="container">
                <div class="navbar-header">

                    <!-- Collapsed Hamburger -->
                    <button type="button" class="navbar-toggle collapsed" data-bs-toggle="collapse" data-bs-target="#app-navbar-collapse">
                        <span class="sr-only">Toggle Navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>

                    <!-- Branding Image -->
                    <a class="navbar-brand" href="{{ url('/') }}">
                        {{ config('app.name', 'Laravel') }}
                    </a>
                </div>

                <div class="collapse navbar-collapse" id="app-navbar-collapse">
                    <!-- Left Side Of Navbar -->
                    <ul class="nav navbar-nav">
                        @if(isset($file))
                            <li><a href="{{ route('projects.index') }}">Eggs</a></li>
                            @if(Auth::check())
                                @can('update', $file->version->project)
                                    <li><a href="{{ route('projects.edit', ['project' => $file->version->project->slug]) }}">{{ $file->version->project->name }}</a></li>
                                @else
                                    <li><a href="{{ route('projects.show', ['project' => $file->version->project->slug]) }}">{{ $file->version->project->name }}</a></li>
                                @endcan
                            @else
                            <li><a href="{{ route('projects.show', ['project' => $file->version->project->slug]) }}">{{ $file->version->project->name }}</a></li>
                            @endif
                            <li><a>{{ $file->name }}</a></li>
                        @elseif(isset($project) && !isset($projects))
                            <li><a href="{{ route('projects.index') }}">Eggs</a></li>
                            <li><a>{{ $project->name }}</a></li>
                        @else
                            <li>
                                <a href="{{ route('projects.index') }}">Eggs</a>
                            </li>
                        @endif
                            <li><a href="{{ route('users.index') }}">Users</a></li>
                            <li><a href="{{ route('badges.index') }}">Badges</a></li>
                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="nav navbar-nav navbar-right">
                        <!-- Authentication Links -->
                        @if (Auth::guest())
                            <li><a href="{{ route('login') }}">Login</a></li>
                            <li><a href="{{ route('register') }}">Register</a></li>
                        @else
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-bs-toggle="dropdown" role="button" aria-expanded="false">
                                    {{ Auth::user()->name }} <span class="caret"></span>
                                </a>
                                <ul class="dropdown-menu" role="menu">
                                    <li>
                                        <a href="{{ route('users.edit', Auth::user()->id) }}">Profile</a>
                                    </li>
                                    <li>
                                        <a href="{{ route('logout') }}"
                                            onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                            Logout
                                        </a>
                                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                            {{ csrf_field() }}
                                        </form>
                                    </li>
                                </ul>
                            </li>
                        @endif
                    </ul>
                </div>
            </div>
        </nav>

        @include('partials.messages')

        @yield('content')
    </div>
    <script type="application/ld+json">
{
  "@context": "https://schema.org",
  "@type": "Organization",
  "url": "https://badge.team",
  "name": "Badge.Team",
  "logo": "https://badge.team/img/bs.png",
  "foundingDate": "2017",
  "contactPoint": {
    "@type": "ContactPoint",
    "contactType": "support",
    "email": "help@badge.team"
  }
}
    </script>
    <!-- Scripts -->
    <script src="{{ mix('/js/manifest.js') }}"></script>
    <script src="{{ mix('/js/vendor.js') }}"></script>
    <script src="{{ mix('/js/app.js') }}"></script>

    @yield('script')
</body>
</html>
