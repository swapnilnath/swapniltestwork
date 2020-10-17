<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" href="images/favicon.ico">
    <title>Demo larvel</title>
    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{ asset('css/font-awesome.min.css')}}">
    <link rel="stylesheet" href="{{ asset('css/slick.css')}}">
    <link rel="stylesheet" href="{{ asset('css/style.css')}}">
    <link rel="stylesheet" href="{{ asset('css/bootstrap-datetimepicker.min.css')}}">
    <link rel="stylesheet" href="{{ asset('css/select2.min.css')}}">
    <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
</head>

<body>
<!-- header start -->
<header>
    <div class="header-top">
        <div class="container">
            <div class="ht-right">

                <!-- profile end -->
            </div>
        </div>
    </div>
    <div class="header-bottom">
        <nav class="navbar navbar-expand-md">
            <div class="container">
                <a class="navbar-brand" href="index.html"><img src="images/logo.png" alt=""></a>
                <button class="navbar-toggler navbar-toggler-right collapsed" type="button" data-toggle="collapse" data-target="#collapsingNavbar">
                    <span> </span>
                    <span> </span>
                    <span> </span>
                </button>
                <div class="collapse navbar-collapse" id="collapsingNavbar">
                    <ul class="navbar-nav ml-auto">
                        <li class="nav-item active"><a class="nav-link" href="#">Test</a></li>

                    </ul>
                </div>
            </div>
        </nav>
    </div>
</header>
<!-- header end -->
<!-- mid part start -->
<div class="mid-start">
    <!-- about us start -->
    <div class="container">
        <div class="about-us">
            <div class="sec-title">Post <span class="color-red">Detail</span> <img src="images/plane-right.png" alt=""></div>
            <div class="row">
                <div class="col-sm-12">
                    <div class="blog-box blogDetail-box">
                        <div class="bb-img">
                            @if($post->image)
                                <img src=" {{ asset('storage/posts/'.'/'.$post->image) }}" alt="" style="max-width: 100px;max-height: 100px;">
                            @else
                                <img src=" {{ asset('uploads/settings/avatar.png') }}" alt="" style="max-width: 100px;max-height: 100px;">
                            @endif
                        </div>
                        <div class="bb-detail">
                            <div class="bb-title">{{$post->title}}</div>
                            <div class="bb-subTitle">{{ $post->created_at  }}</div>
                            <p>{{ strip_tags($post->description) }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- about us start -->
</div>
<footer>
    <div class="footer-top">
        <div class="container">
            <div class="row">
                <div class="col-sm-6 col-md-3">

                </div>
                <div class="col-sm-6 col-md-3">

                </div>
                <div class="col-sm-6 col-md-3">

                </div>
                <div class="col-sm-6 col-md-3">
                    <div class="foo-title"></div>
                    <div class="we-accpet"><img src="images/we-accpet.png" alt=""></div>
                </div>
            </div>
        </div>
    </div>
    <div class="foo-botom">
        <div class="container">
            All rights reserved.
        </div>
    </div>
</footer>



<script type="text/javascript" src="js/jquery.min.js"></script>
<script type="text/javascript" src="js/popper.min.js"></script>
<script type="text/javascript" src="js/bootstrap.min.js"></script>
<script type="text/javascript" src="js/moment.js"></script>
<script type="text/javascript" src="js/slick.min.js"></script>
<script type="text/javascript" src="js/jquery.slimscroll.js"></script>

</body>

</html>