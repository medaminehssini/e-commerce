
@extends('boutique.index')

@section('content')
    <!-- START MAIN CONTENT -->
<div class="main_content">

    <!-- START SECTION SHOP -->
    <div class="section">
        <div class="container">
            <div class="row">
                <div class="col-lg-9">
                    <div class="row align-items-center mb-4 pb-1">
                        <div class="col-12">
                            <div class="product_header">
                                <div class="product_header_left">
                                    <div class="custom_select">
                                        <select class="form-control form-control-sm" onchange="changeUrl('orderBy' , this.value)" id="orderBy">
                                            <option value="created_at,asc">Sort by newness</option>
                                            <option value="prix,asc">Sort by price: low to high</option>
                                            <option value="prix,desc">Sort by price: high to low</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="product_header_right">
                                    <div class="products_view">
                                        <a href="javascript:Void(0);" class="shorting_icon grid active"><i class="ti-view-grid"></i></a>
                                        <a href="javascript:Void(0);" class="shorting_icon list "><i class="ti-layout-list-thumb"></i></a>
                                    </div>
                                    <div class="custom_select">
                                        <select class="form-control form-control-sm" onchange="changeUrl('show' , this.value)" id="shwing">
                                            <option value="">Showing</option>
                                            <option value="9">9</option>
                                            <option value="12">12</option>
                                            <option value="18">18</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row shop_container grid">
                        @foreach ($articles as $item)
                        <div class="col-md-4 col-6">
                            <div class="product">
                                <div class="product_img">
                                    <a href="shop-product-detail.html">
                                        <img src="{{url('')}}/{{explode(",", $item->images)[0]}}" alt="product_img1">
                                    </a>
                                    <div class="product_action_box">
                                        <ul class="list_none pr_action_btn">
                                            <li class="add-to-cart"><a href="{{ url('panier/add/', []) }}/{{$item->id}}"><i class="icon-basket-loaded"></i> Add To Cart</a></li>
                                            <li><a href="{{ url('compare/add/', []) }}/{{$item->id}}"><i class="icon-shuffle"></i></a></li>
                                            <li><a href="{{url('')}}/quick/product/detail/{{$item->id}}" class="popup-ajax"><i class="icon-magnifier-add"></i></a></li>
                                            <li><a href="{{ url('wish/add/', []) }}/{{$item->id}}"><i class="icon-heart"></i></a></li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="product_info">
                                    <h6 class="product_title"><a href="{{ url('product/detail/', []) }}/{{$item->id}}">{{$item->libelle}}</a></h6>
                                    @php
                                        $prom = FindPromArticle($item->id);
                                    @endphp
                                    @if ($prom != 0)
                                        <span class="price">{{getPrixWithProm ($item->prix , $prom)}} {{getSetting('currency')}}</span>
                                        <del>{{$item->prix}} {{getSetting('currency')}}</del>
                                        <div class="on_sale">
                                            <span>{{ $prom }}% Off</span>
                                        </div>
                                   @else
                                        <span class="price">{{$item->prix}} {{getSetting('currency')}}</span>

                                    @endif
                                    <div class="rating_wrap">

                                            <div class="star_rating"  style="display: inline-block;width: 70%;">
                                                @for ($i = 1 ; $i <= 5 ; $i++)
                                                        @if (getArticleRate($item->id) >= $i)
                                                         <span class="selected" ><i class="far fa-star" style="font-size: 14px"></i></span>

                                                        @else
                                                            <span ><i class="far fa-star" style="font-size: 14px"></i></span>

                                                        @endif
                                                @endfor

                                            </div>

                                        <span class="rating_num">({{count($item->commentaire)}})</span>
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
                    <div class="row">
                        <div class="col-12">
                            <ul class="pagination mt-3 justify-content-center pagination_style1">
                                @if ($articles->lastPage() >1)
                                @if ($articles->previousPageUrl())
                                <li class="page-item"><a class="page-link" href="{{$articles->previousPageUrl()}}"><i class="linearicons-arrow-left"></i></a></li>

                                @endif

                                @for ($i = 0; $i < $articles->lastPage(); $i++)
                                @if ( $i ==0 && request()->page  == '')
                                 <li class="page-item active"><a class="page-link" href="{{$articles->url($i+1)}}">{{$i+1}}</a></li>
                                @else
                                  <li class="page-item {{request()->page == $i+1 ? 'active':''}}"><a class="page-link" href="{{$articles->url($i+1)}}">{{$i+1}}</a></li>
                                @endif
                                @endfor

                                @if ($articles->nextPageUrl())
                                <li class="page-item"><a class="page-link" href="{{$articles->nextPageUrl()}}"><i class="linearicons-arrow-right"></i></a></li>

                                @endif
                                @endif
                            </ul>

                        </div>
                    </div>
                </div>
                <div class="col-lg-3 order-lg-first mt-4 pt-2 mt-lg-0 pt-lg-0">
                    <form action="" method="get">

                        <div class="sidebar">

                            <div class="widget">
                                <h5 class="widget_title">Categories</h5>
                               <div  class="widget_categories">
                                    <div class="form-group">
                                            <select class="form-control" name="categorie" >
                                                <option value="">Choisie Categorie</option>
                                                @foreach ($categories as $categorie)
                                                <option {{ $categorie->id == request()->categorie ? 'selected'  : ''}} value="{{$categorie->id}}">{{$categorie->nom}}</option>
                                                @endforeach
                                            </select>
                                    </div>
                               </div>
                            </div>

                            <div class="widget">
                                <h5 class="widget_title">Brand</h5>
                                <div  class="list_brand">
                                    <div class="form-group">
                                            <select class="form-control" name="marque" >
                                                <option value="">Choisie Marque</option>
                                                @foreach ($marques as $marque)
                                                <option {{ $marque->id == request()->marque ? 'selected'  : ''}} value="{{$marque->id}}">{{$marque->libelle}}</option>
                                                @endforeach
                                            </select>
                                    </div>
                               </div>
                            </div>
                            <div class="widget">
                                <h5 class="widget_title">Filter</h5>
                                <div class="filter_price">
                                    <div id="price_filter" data-min="0" data-max="500" data-min-value="{{request()->prix_min}}" data-max-value="{{request()->prix_max}}" data-price-sign="{{getSetting('currency')}}"></div>
                                    <div class="price_range">
                                        <span>Price: <span id="flt_price"></span></span>
                                        <input type="hidden" value="{{request()->prix_min}}" name="prix_min" id="price_first">
                                        <input type="hidden" value="{{request()->prix_max}}" name="prix_max" id="price_second">
                                    </div>
                                </div>
                            </div>

                            <div class="widget" >
                                <div class="form-group ">
                                    <button type="submit" class="btn btn-fill-out btn-block" >Search</button>
                                </div>
                            </div>
                        </div>


                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- END SECTION SHOP -->



    </div>
    <!-- END MAIN CONTENT -->
@endsection
@push('scripts')
    <script>
        function changeUrl( key, value) {
            uri = window.location.href;
            var re = new RegExp("([?&])" + key + "=.*?(&|$)", "i");
            var separator = uri.indexOf('?') !== -1 ? "&" : "?";
            if (uri.match(re)) {
                uri = uri.replace(re, '$1' + key + "=" + value + '$2');
            }
            else {
                uri =  uri + separator + key + "=" + value;
            }
            window.location.href = uri ;
        }
        $( document ).ready(function() {
            document.getElementById('shwing').value = "{{request()->show}}" ;

            document.getElementById('orderBy').value = "{{request()->orderBy ? request()->orderBy : 'created_at,asc' }}" ;

        })

    </script>
@endpush
