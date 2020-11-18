<!-- START HEADER -->
<header class="header_wrap">
	<div class="top-header light_skin bg_dark d-none d-md-block">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6 col-md-8">
                	<div class="header_topbar_info">
                    	<div class="header_offer" style="border: none">
                    		<span>Livraison gratuite à partir de 100 {{getSetting('currency')}} </span>
                        </div>
                        {{-- <div class="download_wrap">
                            <span class="mr-3">Télécharger l'app</span>
                            <ul class="icon_list text-center text-lg-left">
                                 <li><a href="#"><i class="fab fa-apple"></i></a></li>
                                <li><a href="#"><i class="fab fa-android"></i></a></li>
                                <li><a href="#"><i class="fab fa-windows"></i></a></li>
                            </ul>
                        </div> --}}
                    </div>
                </div>
                {{-- <div class="col-lg-6 col-md-4">
                	<div class="d-flex align-items-center justify-content-center justify-content-md-end">
                        <div class="lng_dropdown">
                            <select name="countries" class="custome_select" onchange="window.location.href='{{url('lang')}}'+ '/' + this.value">
                                <option @if (App::getLocale() == 'fr') selected  @endif value='fr' data-image="{{url('boutique')}}/assets/images/fn.png" data-title="France">France</option>
                                <option @if (App::getLocale() == 'en') selected  @endif value='en' data-image="{{url('boutique')}}/assets/images/us.png" data-title="United States">English</option>
                            </select>
                        </div>
                        <div class="ml-3">
                            <select name="countries" class="custome_select">

                                <option value='{{getSetting('currency')}}' data-title="{{getSetting('currency')}}">{{getSetting('currency')}}</option>
                            </select>
                        </div>
                    </div>
                </div> --}}
            </div>
        </div>
    </div>
    <div class="middle-header dark_skin">
    	<div class="container">
            <div class="nav_block">
                <a class="navbar-brand" href="{{ url('', []) }}">
                    <img class="logo_light" src="{{url('boutique')}}/assets/images/logo_light.png" alt="logo">
                    <img class="logo_dark" src="{{url('boutique')}}/assets/images/logo_dark.png" alt="logo">
                </a>
                <div id="searchProduct" class="product_search_form radius_input search_form_btn" style="overflow: initial">
                    <form action="{{ url('/search', []) }}">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <div class="custom_select">
                                    <select class="first_null not_chosen" id="categorieSearch" onchange ="getData(document.getElementById('inputSearch'))" name="categorie">
                                        <option value="">Tous Les Categories</option>
                                        @foreach (getCategories() as $cat)
                                             <option value="{{$cat->id}}">{{$cat->nom}}</option>
                                        @endforeach

                                    </select>
                                </div>
                            </div>
                            <input autocomplete="off" class="form-control" placeholder="Chercher un produit..." id="inputSearch" onkeyup="getData(this)"  name="libelle" type="text">

                            <button type="submit" class="search_btn3">Chercher</button>
                        </div>
                    </form>
                    <ul style="width: 100% ; float: right; position: absolute;z-index: 99;" id="ResultSearch" >

                    </ul>
                </div>
                <ul class="navbar-nav attr-nav align-items-center">
                    @if (!Auth::check())
                        <li><a href="{{ url('login', []) }}" class="nav-link"><i class="linearicons-user"></i></a></li>
                    @else
                        <li><a href="{{ url('edit/account', []) }}" class="nav-link"><i class="linearicons-user"></i></a></li>
                    @endif
                    <li><a href="{{ url('wish', []) }}" class="nav-link"><i class="linearicons-heart"></i><span class="wishlist_count">{{wishCount()}}</span></a></li>
                    <li><a href="{{ url('compare') }}"  class="nav-link"><i class="icon-shuffle"     ></i><span class="wishlist_count">{{session()->has('compare') ? count(session('compare')) : '0' }}</span></a></li>
                    <li class="dropdown cart_dropdown"><a class="nav-link cart_trigger" href="#" data-toggle="dropdown"><i class="linearicons-bag2"></i><span class="cart_count">{{Cart::count()}}</span></a>
                        <div class="cart_box cart_right dropdown-menu dropdown-menu-right">
                            <ul class="cart_list">
                                @foreach (Cart::content() as $art)
                                    <li>
                                        <a href="{{ url('panier/remove/', []) }}/{{$art->rowId}}" class="item_remove"><i class="ion-close"></i></a>
                                    <a href="#"><img src="{{url('')}}/{{$art->options->image}}" alt="">{{$art->name}}</a>
                                        <span class="cart_quantity"> {{$art->qty}} x <span class="cart_amount"> {{$art->price}} <span class="price_symbole">{{getSetting('currency')}} </span></span></span>
                                    </li>
                                @endforeach
                            </ul>
                            <div class="cart_footer">
                                <p class="cart_total"><strong>Sous Total:</strong> <span class="cart_price"> </span>{{Cart::subTotal()}} <span class="price_symbole">{{getSetting('currency')}} </span></p>
                                <p class="cart_buttons"><a href="{{ url('panier', []) }}" class="btn btn-sm btn-fill-line view-cart">Commander</a><a href="{{ url('panier/vider', []) }}" class="btn btn-sm btn-fill-out checkout">Vider panier</a></p>
                            </div>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
    </div>
    <div class="bottom_header dark_skin main_menu_uppercase border-top">
    	<div class="container">
            <div class="row align-items-center">
            	<div class="col-lg-3 col-md-4 col-sm-6 col-3">
                	<div class="categories_wrap">
                        <button type="button" data-toggle="collapse" data-target="#navCatContent" aria-expanded="false" class="categories_btn categories_menu">
                            <span>Nos Categories </span><i class="linearicons-menu"></i>
                        </button>
                        <div id="navCatContent" class="navbar collapse" style="z-index: 999;">
                            <ul>
                                @foreach (getMenuCategories() as $categorie)

                                @if (count($categorie->categorie) > 0)

                                <li class="dropdown dropdown-mega-menu">
                                <a class="dropdown-item nav-link dropdown-toggler" href="{{ url('search', []) }}?categorie={{$categorie->id}}" data-toggle="dropdown"><i class="{{$categorie->icon}}"></i> <span>{{$categorie->nom}}</span></a>
                                <div class="dropdown-menu">
                                    <ul class="mega-menu d-lg-flex">
                                        <li class="mega-menu-col col-lg-7">
                                            <ul class="d-lg-flex">
                                                <li class="mega-menu-col col-lg-6">
                                                    <ul>
                                                        <li class="dropdown-header">Sous catégories</li>
                                                        @foreach ($categorie->categorie as $key => $sousCategorie)
                                                            @if($key < 10)
                                                            <li><a class="dropdown-item nav-link nav_item" href="{{ url('search', []) }}?categorie={{$sousCategorie->id}}">{{$sousCategorie->nom}}</a></li>
                                                            @endif
                                                        @endforeach
                                                    </ul>
                                                </li>

                                                <li class="mega-menu-col col-lg-6">
                                                    <ul>
                                                        <li class="dropdown-header">Articles populaires</li>
                                                        @foreach (popularArticle($categorie->id) as $article)
                                                            <li><a class="dropdown-item nav-link nav_item" href="{{ url('product/detail') }}/{{$article->id}}">{{$article->libelle}}</a></li>
                                                        @endforeach
                                                    </ul>
                                                </li>

                                            </ul>
                                        </li>
                                        {{-- <li class="mega-menu-col col-lg-5">
                                            <div class="header-banner2">
                                                <img src="{{getImageFromCategorie($categorie->id)[0]}}" alt="menu_banner1">
                                                <div class="banne_info">
                                                    <h6>10% Off</h6>
                                                    <h4>Computers</h4>
                                                    <a href="#">Shop now</a>
                                                </div>
                                            </div>
                                            <div class="header-banner2">
                                                <img src="{{getImageFromCategorie($categorie->id)[1]}}" alt="menu_banner2">
                                                <div class="banne_info">
                                                    <h6>15% Off</h6>
                                                    <h4>Top Laptops</h4>
                                                    <a href="#">Shop now</a>
                                                </div>
                                            </div>
                                        </li> --}}
                                    </ul>
                                </div>

                                </li>
                                @else
                                <li><a class="dropdown-item nav-link nav_item" href="{{ url('search', []) }}?categorie={{$categorie->id}}"><i class="{{$categorie->icon}}"></i> <span>{{$categorie->nom}}</span></a></li>
                                @endif

                                @endforeach
                            </ul>
                            <div class="more_categories">More Categories</div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-9 col-md-8 col-sm-6 col-9">
                	<nav class="navbar navbar-expand-lg">
                    	<button class="navbar-toggler side_navbar_toggler" type="button" data-toggle="collapse" data-target="#navbarSidetoggle" aria-expanded="false">
                            <span class="ion-android-menu"></span>
                        </button>
                        <div class="pr_search_icon">
                            <a href="javascript:void(0);" class="nav-link pr_search_trigger"><i class="linearicons-magnifier"></i></a>
                        </div>
                        <div class="collapse navbar-collapse mobile_side_menu" id="navbarSidetoggle">
                            <ul class="navbar-nav">
                                <!-- <li class="dropdown">
                                    <a data-toggle="dropdown" class="nav-link dropdown-toggle active" href="#">Acceuill</a>
                                    <div class="dropdown-menu">
                                        <ul>
                                            <li><a class="dropdown-item nav-link nav_item" href="index.html">Fashion 1</a></li>
                                            <li><a class="dropdown-item nav-link nav_item" href="index-2.html">Fashion 2</a></li>
                                            <li><a class="dropdown-item nav-link nav_item" href="index-3.html">Furniture 1</a></li>
                                            <li><a class="dropdown-item nav-link nav_item" href="index-4.html">Furniture 2</a></li>
                                            <li><a class="dropdown-item nav-link nav_item" href="index-5.html">Electronics 1</a></li>
                                            <li><a class="dropdown-item nav-link nav_item active" href="index-6.html">Electronics 2</a></li>
                                        </ul>
                                    </div>
                                 </li> -->
                                <li><a class="nav-link nav_item" href="{{ url('/', []) }}">Acceuill</a></li>
                                <!-- <li class="dropdown">
                                    <a class="dropdown-toggle nav-link" href="#" data-toggle="dropdown">Pages</a>
                                    <div class="dropdown-menu">
                                        <ul>
                                            <li><a class="dropdown-item nav-link nav_item" href="about.html">About Us</a></li>
                                            <li><a class="dropdown-item nav-link nav_item" href="contact.html">Contact Us</a></li>
                                            <li><a class="dropdown-item nav-link nav_item" href="faq.html">Faq</a></li>
                                            <li><a class="dropdown-item nav-link nav_item" href="404.html">404 Error Page</a></li>
                                            <li><a class="dropdown-item nav-link nav_item" href="login.html">Login</a></li>
                                            <li><a class="dropdown-item nav-link nav_item" href="signup.html">Register</a></li>
                                            <li><a class="dropdown-item nav-link nav_item" href="term-condition.html">Terms and Conditions</a></li>
                                        </ul>
                                    </div>
                                </li> -->
                                <li >
                                    <a class="nav-link nav_item" href="{{ url('/search', []) }}" >Nos Produits</a>

                                </li>
                                <!-- <li class="dropdown">
                                    <a class="dropdown-toggle nav-link" href="#" data-toggle="dropdown">Blog</a>
                                    <div class="dropdown-menu dropdown-reverse">
                                        <ul>
                                            <li>
                                                <a class="dropdown-item menu-link dropdown-toggler" href="#">Grids</a>
                                                <div class="dropdown-menu">
                                                    <ul>
                                                        <li><a class="dropdown-item nav-link nav_item" href="blog-three-columns.html">3 columns</a></li>
                                                        <li><a class="dropdown-item nav-link nav_item" href="blog-four-columns.html">4 columns</a></li>
                                                        <li><a class="dropdown-item nav-link nav_item" href="blog-left-sidebar.html">Left Sidebar</a></li>
                                                        <li><a class="dropdown-item nav-link nav_item" href="blog-right-sidebar.html">right Sidebar</a></li>
                                                        <li><a class="dropdown-item nav-link nav_item" href="blog-standard-left-sidebar.html">Standard Left Sidebar</a></li>
                                                        <li><a class="dropdown-item nav-link nav_item" href="blog-standard-right-sidebar.html">Standard right Sidebar</a></li>
                                                    </ul>
                                                </div>
                                            </li>
                                            <li>
                                                <a class="dropdown-item menu-link dropdown-toggler" href="#">Masonry</a>
                                                <div class="dropdown-menu">
                                                    <ul>
                                                        <li><a class="dropdown-item nav-link nav_item" href="blog-masonry-three-columns.html">3 columns</a></li>
                                                        <li><a class="dropdown-item nav-link nav_item" href="blog-masonry-four-columns.html">4 columns</a></li>
                                                        <li><a class="dropdown-item nav-link nav_item" href="blog-masonry-left-sidebar.html">Left Sidebar</a></li>
                                                        <li><a class="dropdown-item nav-link nav_item" href="blog-masonry-right-sidebar.html">right Sidebar</a></li>
                                                    </ul>
                                                </div>
                                            </li>
                                            <li>
                                                <a class="dropdown-item menu-link dropdown-toggler" href="#">Single Post</a>
                                                <div class="dropdown-menu">
                                                    <ul>
                                                        <li><a class="dropdown-item nav-link nav_item" href="blog-single.html">Default</a></li>
                                                        <li><a class="dropdown-item nav-link nav_item" href="blog-single-left-sidebar.html">left sidebar</a></li>
                                                        <li><a class="dropdown-item nav-link nav_item" href="blog-single-slider.html">slider post</a></li>
                                                        <li><a class="dropdown-item nav-link nav_item" href="blog-single-video.html">video post</a></li>
                                                        <li><a class="dropdown-item nav-link nav_item" href="blog-single-audio.html">audio post</a></li>
                                                    </ul>
                                                </div>
                                            </li>
                                            <li>
                                                <a class="dropdown-item menu-link dropdown-toggler" href="#">List</a>
                                                <div class="dropdown-menu">
                                                    <ul>
                                                        <li><a class="dropdown-item nav-link nav_item" href="blog-list-left-sidebar.html">left sidebar</a></li>
                                                        <li><a class="dropdown-item nav-link nav_item" href="blog-list-right-sidebar.html">right sidebar</a></li>
                                                    </ul>
                                                </div>
                                            </li>
                                        </ul>
                                    </div>
                                </li> -->
                                 {{--   <li class="dropdown dropdown-mega-menu">
                                    <a class="dropdown-toggle nav-link" href="#" data-toggle="dropdown">Boutique</a>
                                 <div class="dropdown-menu">
                                        <ul class="mega-menu d-lg-flex">
                                            <li class="mega-menu-col col-lg-9">
                                                <ul class="d-lg-flex">
                                                    <li class="mega-menu-col col-lg-4">
                                                        <ul>
                                                            <li class="dropdown-header">Shop Page Layout</li>
                                                            <li><a class="dropdown-item nav-link nav_item" href="shop-list.html">shop List view</a></li>
                                                            <li><a class="dropdown-item nav-link nav_item" href="shop-list-left-sidebar.html">shop List Left Sidebar</a></li>
                                                            <li><a class="dropdown-item nav-link nav_item" href="shop-list-right-sidebar.html">shop List Right Sidebar</a></li>
                                                            <li><a class="dropdown-item nav-link nav_item" href="shop-left-sidebar.html">Left Sidebar</a></li>
                                                            <li><a class="dropdown-item nav-link nav_item" href="shop-right-sidebar.html">Right Sidebar</a></li>
                                                            <li><a class="dropdown-item nav-link nav_item" href="shop-load-more.html">Shop Load More</a></li>
                                                        </ul>
                                                    </li>
                                                    <li class="mega-menu-col col-lg-4">
                                                        <ul>
                                                            <li class="dropdown-header">Other Pages</li>
                                                            <li><a class="dropdown-item nav-link nav_item" href="shop-cart.html">Cart</a></li>
                                                            <li><a class="dropdown-item nav-link nav_item" href="checkout.html">Checkout</a></li>
                                                            <li><a class="dropdown-item nav-link nav_item" href="my-account.html">My Account</a></li>
                                                            <li><a class="dropdown-item nav-link nav_item" href="wishlist.html">Wishlist</a></li>
                                                            <li><a class="dropdown-item nav-link nav_item" href="compare.html">compare</a></li>
                                                            <li><a class="dropdown-item nav-link nav_item" href="order-completed.html">Order Completed</a></li>
                                                        </ul>
                                                    </li>
                                                    <li class="mega-menu-col col-lg-4">
                                                        <ul>
                                                            <li class="dropdown-header">Product Pages</li>
                                                            <li><a class="dropdown-item nav-link nav_item" href="shop-product-detail.html">Default</a></li>
                                                            <li><a class="dropdown-item nav-link nav_item" href="shop-product-detail-left-sidebar.html">Left Sidebar</a></li>
                                                            <li><a class="dropdown-item nav-link nav_item" href="shop-product-detail-right-sidebar.html">Right Sidebar</a></li>
                                                            <li><a class="dropdown-item nav-link nav_item" href="shop-product-detail-thumbnails-left.html">Thumbnails Left</a></li>
                                                        </ul>
                                                    </li>
                                                </ul>
                                            </li>
                                            <li class="mega-menu-col col-lg-3">
                                                <div class="header_banner">
                                                    <div class="header_banner_content">
                                                        <div class="shop_banner">
                                                            <div class="banner_img overlay_bg_40">
                                                                <img src="{{url('boutique')}}/assets/images/shop_banner4.jpg" alt="shop_banner2">
                                                            </div>
                                                            <div class="shop_bn_content">
                                                                <h6 class="text-uppercase shop_subtitle">New Collection</h6>
                                                                <h5 class="text-uppercase shop_title">Sale 30% Off</h5>
                                                                <a href="#" class="btn btn-white rounded-0 btn-xs text-uppercase">Shop Now</a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </li>
                                        </ul>
                                    </div>
                                </li>--}}
                                <li><a class="nav-link nav_item" href="{{ url('contact', []) }}">Contacter Nous</a></li>
                            </ul>
                        </div>
                        <div class="contact_phone contact_support">
                            <i class="linearicons-phone-wave"></i>
                            <span>{{getSetting('phone')}}</span>
                        </div>
                    </nav>
                </div>
            </div>
        </div>
    </div>
</header>
<!-- END HEADER -->
