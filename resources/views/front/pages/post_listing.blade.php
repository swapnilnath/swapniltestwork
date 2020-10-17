<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" href="images/favicon.ico">
    <title>Demo Laravel</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/font-awesome.min.css">
    <link rel="stylesheet" href="css/slick.css">
    <link rel="stylesheet" href="css/style.css">
</head>

<body>
<!-- header start -->
<header>
    <div class="header-top">
        <div class="container">
            <div class="ht-right">
                <div class="top-whatsapp">Test</div>

                <!-- profile end -->
            </div>
        </div>
    </div>
    <div class="header-bottom">
        <nav class="navbar navbar-expand-md">
            <div class="container">
                <a class="navbar-brand" href="index.html"><img src="images/logo.png" alt=""></a>
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
            <div class="sec-title"><span class="color-red">Posts</span> <img src="images/plane-right.png" alt=""></div>
            <div class="row">
                @if($posts->count() > 0)
                    @foreach($posts as $post)
                        <div class="col-md-4">
                            <div class="blog-box">
                                <div class="bb-img">
                                    @if($post->image)
                                        <img src=" {{ asset('storage/posts/'.'/'.$post->image) }}" alt="" style="max-width: 100px;max-height: 100px;">
                                        @else
                                        <img src=" {{ asset('uploads/settings/avatar.png') }}" alt="" style="max-width: 100px;max-height: 100px;">
                                    @endif

                                </div>
                                <div class="bb-detail">
                                    <div class="bb-title">
                                        <a href="{{ route('post_listing_details', $post->slug)  }}">
                                            {{$post->title}}
                                        </a>

                                    </div>
                                    <div class="bb-subTitle">{{ $post->created_at  }}</div>
                                    {{ strip_tags($post->description) }}
                                    <a href="designs#" class="bb-btn"><img src="images/right-arrow-white.png" alt=""></a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                @else
                @endif

            </div>

            <div class="row">
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
                    <div class="foo-logo"><img src="images/foo-logo.png" alt=""></div>
                    <div class="foo-address">

                    </div>
                    <div class="follow-us">
                        <div class="fu-title">Post Listing page</div>

                    </div>
                </div>
                <div class="col-sm-6 col-md-3">

                </div>
                <div class="col-sm-6 col-md-3">

                </div>
                <div class="col-sm-6 col-md-3">

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