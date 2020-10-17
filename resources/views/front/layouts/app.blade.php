<!doctype html>
<!--[if IE 9]><html class="ie9" lang="en"><![endif]-->
<!--[if (gt IE 9)|!(IE)]><!-->
<html lang="en">
<!--<![endif]-->
@include('front.includes.head')
<body>
    <script type="text/javascript">{{App\Script::get('body_script')}}</script> 
    @include('front.includes.topNavigation')
    <div class="header-bottom">
        <nav class="navbar navbar-expand-md">
            <div class="container">
                <a class="navbar-brand" href="{{route('front.index')}}"><img src="{{ url(\Settings::get('slider_logo')) }}" alt=""></a>
                <button class="navbar-toggler navbar-toggler-right collapsed" type="button" data-toggle="collapse" data-target="#collapsingNavbar">
                    <span> </span>
                    <span> </span>
                    <span> </span>
                </button>
                <div class="collapse navbar-collapse" id="collapsingNavbar">

                </div>
            </div>
        </nav>
    </div>
</header>
    <div class="mid-start">
    @yield('mainContent')
    </div>
    @include('front.includes.footer')
    @include('front.includes.scripts')
 </body>
</html>
