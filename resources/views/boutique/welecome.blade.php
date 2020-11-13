
@extends('boutique.index')

@section('content')

<!-- START SECTION BANNER -->
<div class="banner_section slide_medium shop_banner_slider staggered-animation-wrap">
    <div id="carouselExampleControls" class="carousel slide carousel-fade light_arrow" data-ride="carousel">
        <div class="carousel-inner">
            @foreach ($sliders as $key => $slider)

                <div class="carousel-item background_bg @if ($key == 0)
                active
                @endif" data-img-src="{{url('')}}/{{$slider->image}}">
                    <div class="banner_slide_content banner_content_inner">
                        <div class="container">
                            <div class="row">
                                <div class="col-lg-7 col-10">
                                    <div class="banner_content overflow-hidden">
                                        <h2 class="staggered-animation" data-animation="slideInLeft" data-animation-delay="0.5s">{{$slider->title}}</h2>
                                        <h5 class="mb-3 mb-sm-4 staggered-animation font-weight-light" data-animation="slideInLeft" data-animation-delay="1s">{{$slider->description}}</h5>
                                        <a class="btn btn-fill-out staggered-animation text-uppercase" href="{{$slider->url}}" data-animation="slideInLeft" data-animation-delay="1.5s">{{$slider->buttom_name}}</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
        <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev"><i class="ion-chevron-left"></i></a>
        <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next"><i class="ion-chevron-right"></i></a>
    </div>
</div>
<!-- END SECTION BANNER -->
    <!-- END MAIN CONTENT -->
<div class="main_content">

    <!-- START SECTION BANNER -->
    <div class="section pb_20 small_pt">
        <div class="container">
            <div class="row">
                <div class="col-md-4">
                    <div class="sale-banner mb-3 mb-md-4">
                        <a class="hover_effect1" href="#">
                            <img src="{{url('boutique')}}/assets/images/shop_banner_img7.jpg" alt="shop_banner_img7">
                        </a>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="sale-banner mb-3 mb-md-4">
                        <a class="hover_effect1" href="#">
                            <img src="{{url('boutique')}}/assets/images/shop_banner_img8.jpg" alt="shop_banner_img8">
                        </a>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="sale-banner mb-3 mb-md-4">
                        <a class="hover_effect1" href="#">
                            <img src="{{url('boutique')}}/assets/images/shop_banner_img9.jpg" alt="shop_banner_img9">
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- END SECTION BANNER -->

    <!-- START SECTION CATEGORIES -->
    <div class="section small_pb small_pt">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-6">
                    <div class="heading_s4 text-center">
                        <h2>Top Categories</h2>
                    </div>
                    <p class="text-center leads">Voilà la liste de nos meilleures categories.</p>
                </div>
            </div>
            <div class="row align-items-center">
                <div class="col-12">
                    <div class="cat_slider cat_style1 mt-4 mt-md-0 carousel_slider owl-carousel owl-theme nav_style5" data-loop="true" data-dots="false" data-nav="true" data-margin="30" data-responsive='{"0":{"items": "2"}, "480":{"items": "3"}, "576":{"items": "4"}, "768":{"items": "5"}, "991":{"items": "6"}, "1199":{"items": "7"}}'>

                        @foreach ($categories as $categorie)
                            <div class="item">
                                <div class="categories_box">
                                    <a href="{{ url('search', []) }}?categorie={{$categorie->id}}">
                                        <img style="width: 132px;
                                        height: 120px;" src="{{url('')}}/{{$categorie->image}}" alt="{{$categorie->nom}}">
                                        <span>{{$categorie->nom}}</span>
                                    </a>
                                </div>
                            </div>
                        @endforeach


                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- END SECTION CATEGORIES -->

    <!-- START SECTION SHOP -->
    <div class="section small_pb small_pt">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-6">
                    <div class="heading_s1 text-center">
                        <h2>Les promos du jour à saisir</h2>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="tab-style1">
                        <ul class="nav nav-tabs justify-content-center" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active" id="arrival-tab" data-toggle="tab" href="#arrival" role="tab" aria-controls="arrival" aria-selected="true">New Arrival</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="sellers-tab" data-toggle="tab" href="#sellers" role="tab" aria-controls="sellers" aria-selected="false">Best Sellers</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="special-tab" data-toggle="tab" href="#special" role="tab" aria-controls="special" aria-selected="false">Special Offer
                                </a>
                            </li>
                        </ul>
                    </div>
                    <div class="tab_slider tab-content">
                        <div class="tab-pane fade show active" id="arrival" role="tabpanel" aria-labelledby="arrival-tab">
                            <div class="product_slider carousel_slider owl-carousel owl-theme dot_style1" data-loop="true" data-margin="20" data-responsive='{"0":{"items": "1"}, "481":{"items": "2"}, "768":{"items": "3"}, "991":{"items": "4"}}'>
                              @foreach ($newArticles as $article)
                                <div class="item">
                                    <div class="product_wrap">
                                        <div class="product_img">
                                            <a href="{{ url('product/detail/', []) }}/{{$article->id}}">
                                                <img src="{{url('')}}/{{explode(",", $article->images)[0]}}" alt="{{$article->libelle}}">
                                                @if (count(explode(",", $article->images))>1)
                                                    <img class="product_hover_img" src="{{url('')}}/{{explode(",", $article->images)[1]}}" alt="{{$article->libelle}}">
                                                @else
                                                    <img class="product_hover_img" src="{{url('')}}/{{explode(",", $article->images)[0]}}" alt="{{$article->libelle}}">
                                                @endif
                                            </a>
                                            <div class="product_action_box">
                                                <ul class="list_none pr_action_btn">
                                                    <li class="add-to-cart"><a href="{{ url('panier/add/', []) }}/{{$article->id}}"><i class="icon-basket-loaded"></i> Add To Cart</a></li>
                                                    <li><a href="{{ url('compare/add/', []) }}/{{$article->id}}"><i class="icon-shuffle"></i></a></li>
                                                    <li><a href="{{url('')}}/quick/product/detail/{{$article->id}}" class="popup-ajax"><i class="icon-magnifier-add"></i></a></li>
                                                    <li><a href="{{ url('wish/add/', []) }}/{{$article->id}}"><i class="icon-heart"></i></a></li>
                                                </ul>
                                            </div>
                                        </div>
                                        <div class="product_info">
                                            <h6 class="product_title"><a href="{{ url('product/detail/', []) }}/{{$article->id}}">{{$article->libelle}}</a></h6>
                                            @php
                                                $prom = FindPromArticle($article->id);
                                            @endphp
                                            @if ($prom != 0)
                                                <span class="price">{{getPrixWithProm ($article->prix , $prom)}} {{getSetting('currency')}}</span>
                                                <del>{{$article->prix}} {{getSetting('currency')}}</del>
                                                <div class="on_sale">
                                                    <span>{{ $prom }}% Off</span>
                                                </div>
                                           @else
                                                <span class="price">{{$article->prix}} {{getSetting('currency')}}</span>

                                            @endif
                                            <div class="rating_wrap">

                                                    <div class="star_rating" style="display: inline-block;" >
                                                        @for ($i = 1 ; $i <= 5 ; $i++)
                                                                @if (getArticleRate($article->id) >= $i)
                                                                 <span class="selected" ><i class="far fa-star" style="font-size: 14px"></i></span>

                                                                @else
                                                                    <span ><i class="far fa-star" style="font-size: 14px"></i></span>

                                                                @endif
                                                        @endfor

                                                    </div>

                                                <span class="rating_num">({{count($article->commentaire)}})</span>
                                            </div>

                                            <div class="pr_switch_wrap">
                                                <div class="product_color_switch">

                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                              @endforeach


                            </div>
                        </div>
                        <div class="tab-pane fade" id="sellers" role="tabpanel" aria-labelledby="sellers-tab">
                            <div class="product_slider carousel_slider owl-carousel owl-theme dot_style1" data-loop="true" data-margin="20" data-responsive='{"0":{"items": "1"}, "481":{"items": "2"}, "768":{"items": "3"}, "991":{"items": "4"}}'>
                                @foreach ($bestpromSellers as $article)
                                <div class="item">
                                    <div class="product_wrap">
                                        <div class="product_img">
                                            <a href="{{ url('product/detail/', []) }}/{{$article->id}}">
                                                <img src="{{url('')}}/{{explode(",", $article->images)[0]}}" alt="{{$article->libelle}}">
                                                @if (count(explode(",", $article->images))>1)
                                                    <img class="product_hover_img" src="{{url('')}}/{{explode(",", $article->images)[1]}}" alt="{{$article->libelle}}">
                                                @else
                                                    <img class="product_hover_img" src="{{url('')}}/{{explode(",", $article->images)[0]}}" alt="{{$article->libelle}}">
                                                @endif
                                            </a>
                                            <div class="product_action_box">
                                                <ul class="list_none pr_action_btn">
                                                    <li class="add-to-cart"><a href="{{ url('panier/add/', []) }}/{{$article->id}}"><i class="icon-basket-loaded"></i> Add To Cart</a></li>
                                                    <li><a href="{{ url('compare/add/', []) }}/{{$article->id}}"><i class="icon-shuffle"></i></a></li>
                                                    <li><a href="{{url('')}}/quick/product/detail/{{$article->id}}" class="popup-ajax"><i class="icon-magnifier-add"></i></a></li>
                                                    <li><a href="{{ url('wish/add/', []) }}/{{$article->id}}"><i class="icon-heart"></i></a></li>
                                                </ul>
                                            </div>
                                        </div>
                                        <div class="product_info">
                                            <h6 class="product_title"><a href="{{ url('product/detail/', []) }}/{{$article->id}}">{{$article->libelle}}</a></h6>
                                            @php
                                                $prom = FindPromArticle($article->id);
                                            @endphp
                                            @if ($prom != 0)
                                                <span class="price">{{getPrixWithProm ($article->prix , $prom)}} {{getSetting('currency')}}</span>
                                                <del>{{$article->prix}} {{getSetting('currency')}}</del>
                                                <div class="on_sale">
                                                    <span>{{ $prom }}% Off</span>
                                                </div>
                                        @else
                                                <span class="price">{{$article->prix}} {{getSetting('currency')}}</span>

                                            @endif
                                            <div class="rating_wrap">

                                                    <div class="star_rating" style="display: inline-block;" >
                                                        @for ($i = 1 ; $i <= 5 ; $i++)
                                                                @if (getArticleRate($article->id) >= $i)
                                                                <span class="selected" ><i class="far fa-star" style="font-size: 14px"></i></span>

                                                                @else
                                                                    <span ><i class="far fa-star" style="font-size: 14px"></i></span>

                                                                @endif
                                                        @endfor

                                                    </div>

                                                <span class="rating_num">({{count($article->commentaire)}})</span>
                                            </div>

                                            <div class="pr_switch_wrap">
                                                <div class="product_color_switch">

                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                            </div>
                        </div>

                        <div class="tab-pane fade" id="special" role="tabpanel" aria-labelledby="special-tab">
                            <div class="product_slider carousel_slider owl-carousel owl-theme dot_style1" data-loop="true" data-margin="20" data-responsive='{"0":{"items": "1"}, "481":{"items": "2"}, "768":{"items": "3"}, "991":{"items": "4"}}'>

                                @foreach ($specialOffres as $article)
                                    <div class="item">
                                        <div class="product_wrap">
                                            <div class="product_img">
                                                <a href="{{ url('product/detail/', []) }}/{{$article->id}}">
                                                    <img src="{{url('')}}/{{explode(",", $article->images)[0]}}" alt="{{$article->libelle}}">
                                                    @if (count(explode(",", $article->images))>1)
                                                        <img class="product_hover_img" src="{{url('')}}/{{explode(",", $article->images)[1]}}" alt="{{$article->libelle}}">
                                                    @else
                                                        <img class="product_hover_img" src="{{url('')}}/{{explode(",", $article->images)[0]}}" alt="{{$article->libelle}}">
                                                    @endif
                                                </a>
                                                <div class="product_action_box">
                                                    <ul class="list_none pr_action_btn">
                                                        <li class="add-to-cart"><a href="{{ url('panier/add/', []) }}/{{$article->id}}"><i class="icon-basket-loaded"></i> Add To Cart</a></li>
                                                        <li><a href="{{ url('compare/add/', []) }}/{{$article->id}}"><i class="icon-shuffle"></i></a></li>
                                                        <li><a href="{{url('')}}/quick/product/detail/{{$article->id}}" class="popup-ajax"><i class="icon-magnifier-add"></i></a></li>
                                                        <li><a href="{{ url('wish/add/', []) }}/{{$article->id}}"><i class="icon-heart"></i></a></li>
                                                    </ul>
                                                </div>
                                            </div>
                                            <div class="product_info">
                                                <h6 class="product_title"><a href="{{ url('product/detail/', []) }}/{{$article->id}}">{{$article->libelle}}</a></h6>
                                                @php
                                                    $prom = FindPromArticle($article->id);
                                                @endphp
                                                @if ($prom != 0)
                                                    <span class="price">{{getPrixWithProm ($article->prix , $prom)}} {{getSetting('currency')}}</span>
                                                    <del>{{$article->prix}} {{getSetting('currency')}}</del>
                                                    <div class="on_sale">
                                                        <span>{{ $prom }}% Off</span>
                                                    </div>
                                            @else
                                                    <span class="price">{{$article->prix}} {{getSetting('currency')}}</span>

                                                @endif
                                                <div class="rating_wrap">

                                                        <div class="star_rating" style="display: inline-block;" >
                                                            @for ($i = 1 ; $i <= 5 ; $i++)
                                                                    @if (getArticleRate($article->id) >= $i)
                                                                    <span class="selected" ><i class="far fa-star" style="font-size: 14px"></i></span>

                                                                    @else
                                                                        <span ><i class="far fa-star" style="font-size: 14px"></i></span>

                                                                    @endif
                                                            @endfor

                                                        </div>

                                                    <span class="rating_num">({{count($article->commentaire)}})</span>
                                                </div>

                                                <div class="pr_switch_wrap">
                                                    <div class="product_color_switch">

                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- END SECTION SHOP -->

    <!-- START SECTION BANNER -->
    <!-- <div class="section pb_20 small_pt">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="sale-banner mb-3 mb-md-4">
                        <a class="hover_effect1" href="#">
                            <img src="{{url('boutique')}}/assets/images/shop_banner_img11.png" alt="shop_banner_img11">
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div> -->
    <!-- END SECTION BANNER -->

    <!-- START SECTION SHOP -->
    <div class="section small_pt">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-6">
                    <div class="heading_s1 text-center">
                        <h2>les produits les plus consultés</h2>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="product_slider carousel_slider owl-carousel owl-theme dot_style1" data-loop="true" data-margin="20" data-responsive='{"0":{"items": "1"}, "481":{"items": "2"}, "768":{"items": "3"}, "991":{"items": "4"}}'>
                        @foreach ($bestSellers as $article)
                        <div class="item">
                            <div class="product_wrap">
                                <div class="product_img">
                                    <a href="{{ url('product/detail/', []) }}/{{$article->id}}">
                                        <img src="{{url('')}}/{{explode(",", $article->images)[0]}}" alt="{{$article->libelle}}">
                                        @if (count(explode(",", $article->images))>1)
                                            <img class="product_hover_img" src="{{url('')}}/{{explode(",", $article->images)[1]}}" alt="{{$article->libelle}}">
                                        @else
                                            <img class="product_hover_img" src="{{url('')}}/{{explode(",", $article->images)[0]}}" alt="{{$article->libelle}}">
                                        @endif
                                    </a>
                                    <div class="product_action_box">
                                        <ul class="list_none pr_action_btn">
                                            <li class="add-to-cart"><a href="{{ url('panier/add/', []) }}/{{$article->id}}"><i class="icon-basket-loaded"></i> Add To Cart</a></li>
                                            <li><a href="{{ url('compare/add/', []) }}/{{$article->id}}"><i class="icon-shuffle"></i></a></li>
                                            <li><a href="{{url('')}}/quick/product/detail/{{$article->id}}" class="popup-ajax"><i class="icon-magnifier-add"></i></a></li>
                                            <li><a href="{{ url('wish/add/', []) }}/{{$article->id}}"><i class="icon-heart"></i></a></li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="product_info">
                                    <h6 class="product_title"><a href="{{ url('product/detail/', []) }}/{{$article->id}}">{{$article->libelle}}</a></h6>
                                    @php
                                        $prom = FindPromArticle($article->id);
                                    @endphp
                                    @if ($prom != 0)
                                        <span class="price">{{getPrixWithProm ($article->prix , $prom)}} {{getSetting('currency')}}</span>
                                        <del>{{$article->prix}} {{getSetting('currency')}}</del>
                                        <div class="on_sale">
                                            <span>{{ $prom }}% Off</span>
                                        </div>
                                @else
                                        <span class="price">{{$article->prix}} {{getSetting('currency')}}</span>

                                    @endif
                                    <div class="rating_wrap">

                                            <div class="star_rating" style="display: inline-block;" >
                                                @for ($i = 1 ; $i <= 5 ; $i++)
                                                        @if (getArticleRate($article->id) >= $i)
                                                        <span class="selected" ><i class="far fa-star" style="font-size: 14px"></i></span>

                                                        @else
                                                            <span ><i class="far fa-star" style="font-size: 14px"></i></span>

                                                        @endif
                                                @endfor

                                            </div>

                                        <span class="rating_num">({{count($article->commentaire)}})</span>
                                    </div>

                                    <div class="pr_switch_wrap">
                                        <div class="product_color_switch">

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- END SECTION SHOP -->

    <!-- START SECTION TESTIMONIAL -->
    <div class="section bg_redon">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-6">
                    <div class="heading_s1 text-center">
                        <h2>Nos Client dit!</h2>
                    </div>
                </div>
            </div>
            <div class="row justify-content-center">
                <div class="col-lg-9">
                    <div class="testimonial_wrap testimonial_style1 carousel_slider owl-carousel owl-theme nav_style2" data-nav="true" data-dots="false" data-center="true" data-loop="true" data-autoplay="true" data-items='1'>
                       @foreach ($contacts as $contact)
                       <div class="testimonial_box">
                        <div class="testimonial_desc">
                            <p>{{$contact->message}}</p>
                        </div>
                        <div class="author_wrap">
                            <div class="author_img">
                            </div>
                            <div class="author_name">
                                <h6>{{$contact->nom}}</h6>
                            </div>
                        </div>
                    </div>
                       @endforeach


                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- END SECTION TESTIMONIAL -->

    <!-- START SECTION BLOG -->
    <!-- <div class="section pb_20">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-6 col-md-8">
                    <div class="heading_s1 text-center">
                        <h2>Latest News</h2>
                    </div>
                    <p class="leads text-center">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore.</p>
                </div>
            </div>
            <div class="row justify-content-center">
                <div class="col-lg-4 col-md-6">
                    <div class="blog_post blog_style2 box_shadow1">
                        <div class="blog_img">
                            <a href="blog-single.html">
                                <img src="{{url('boutique')}}/assets/images/el_blog_img1.jpg" alt="el_blog_img1">
                            </a>
                        </div>
                        <div class="blog_content bg-white">
                            <div class="blog_text">
                                <h5 class="blog_title"><a href="blog-single.html">But I must explain to you how all this mistaken idea</a></h5>
                                <ul class="list_none blog_meta">
                                    <li><a href="#"><i class="ti-calendar"></i> April 14, 2018</a></li>
                                    <li><a href="#"><i class="ti-comments"></i> 2 Comment</a></li>
                                </ul>
                                <p>If you are going to use a passage of Lorem Ipsum, you need to be sure there isn't anything hidden in the text</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6">
                    <div class="blog_post blog_style2 box_shadow1">
                        <div class="blog_img">
                            <a href="blog-single.html">
                                <img src="{{url('boutique')}}/assets/images/el_blog_img2.jpg" alt="el_blog_img2">
                            </a>
                        </div>
                        <div class="blog_content bg-white">
                            <div class="blog_text">
                                <h5 class="blog_title"><a href="blog-single.html">On the other hand we provide denounce with righteous</a></h5>
                                <ul class="list_none blog_meta">
                                    <li><a href="#"><i class="ti-calendar"></i> April 14, 2018</a></li>
                                    <li><a href="#"><i class="ti-comments"></i> 2 Comment</a></li>
                                </ul>
                                <p>If you are going to use a passage of Lorem Ipsum, you need to be sure there isn't anything hidden in the text</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6">
                    <div class="blog_post blog_style2 box_shadow1">
                        <div class="blog_img">
                            <a href="blog-single.html">
                                <img src="{{url('boutique')}}/assets/images/el_blog_img3.jpg" alt="el_blog_img2">
                            </a>
                        </div>
                        <div class="blog_content bg-white">
                            <div class="blog_text">
                                <h5 class="blog_title"><a href="blog-single.html">Why is a ticket to Lagos so expensive?</a></h5>
                                <ul class="list_none blog_meta">
                                    <li><a href="#"><i class="ti-calendar"></i> April 14, 2018</a></li>
                                    <li><a href="#"><i class="ti-comments"></i> 2 Comment</a></li>
                                </ul>
                                <p>If you are going to use a passage of Lorem Ipsum, you need to be sure there isn't anything hidden in the text</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div> -->
    <!-- END SECTION BLOG -->

    <!-- START SECTION CLIENT LOGO -->
    <div class="section small_pt">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="client_logo carousel_slider owl-carousel owl-theme" data-dots="false" data-margin="30" data-loop="true" data-autoplay="true" data-responsive='{"0":{"items": "2"}, "480":{"items": "3"}, "767":{"items": "4"}, "991":{"items": "5"}}'>

                       @foreach ($marques as $marque)
                        <div class="item">
                            <div class="cl_logo">
                                <img style="height: 60px"  src="{{url('')}}/{{$marque->logo}}" alt="{{$marque->libelle}}">
                            </div>
                        </div>
                       @endforeach


                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- END SECTION CLIENT LOGO -->

    </div>
    <!-- END MAIN CONTENT -->

@endsection
