@extends('boutique.index')
 @push('css')
     <!-- jquery-ui CSS -->
    <link rel="stylesheet" href="{{ url('boutique', []) }}/assets/css/jquery-ui.css">
 @endpush
@section('content')



<!-- START MAIN CONTENT -->
<div class="main_content">

<!-- START SECTION SHOP -->
<div class="section">
	<div class="container">
		<div class="row">
            <div class="col-lg-6 col-md-6 mb-4 mb-md-0">
              <div class="product-image">
                    <div class="product_img_box">
                    <img id="product_img" src="{{url('')}}/{{explode(",", $article->images)[0]}}" data-zoom-image="{{url('')}}/{{explode(" ", $article->images)[0]}}" alt="product_img1">
                        <a href="#" class="product_img_zoom" title="Zoom">
                            <span class="linearicons-zoom-in"></span>
                        </a>
                    </div>
                    <div id="pr_item_gallery" class="product_gallery_item slick_slider" data-slides-to-show="4" data-slides-to-scroll="1" data-infinite="false">
                        @foreach (explode(",", $article->images) as $key => $item)

                        <div class="item">
                            <a href="#" class="product_gallery_item @if ($key  == 0)
                            active
                            @endif " data-image="{{url('')}}/{{ $item}}" data-zoom-image="{{url('')}}/{{ $item}}">
                                <img src="{{url('')}}/{{ $item}}" alt="" />
                            </a>
                        </div>

                        @endforeach
                    </div>
                </div>
            </div>
            <div class="col-lg-6 col-md-6">
                <div class="pr_detail">
                    <div class="product_description">
                        <h4 class="product_title"><a href="#">{{$article->libelle}}</a></h4>
                        <div class="product_price">
                            @if ($article->prixWithPromotion != $article->prix)
                            <span class="price">{{$article->prixWithPromotion}} {{getSetting('currency')}}</span>
                            <del>{{$article->prix}} {{getSetting('currency')}}</del>
                            <div class="on_sale">
                                <span>{{$article->off}}% Off</span>
                            </div>
                           @else
                            <span class="price">{{$article->prix}} {{getSetting('currency')}}</span>

                            @endif

                        </div>
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
                        <div class="pr_desc"  style="width: 100%;">
                            <p> {{$article->description}}</p>
                                                </div>
                        <div class="product_sort_info">
                            <ul>
                                <li><i class="linearicons-shield-check"></i>QTY :  {{$article->qty}}</li>
                                <li><i class="linearicons-sync"></i>Categorie : {{$article->categorie->nom}}</li>
                                <li><i class="linearicons-bag-dollar"></i>Marque :  {{$article->marque->libelle}}</li>
                            </ul>
                        </div>
                        {{-- <div class="pr_switch_wrap">
                            <span class="switch_lable">Color</span>
                            <div class="product_color_switch">
                                <span class="active" data-color="#87554B"></span>
                                <span data-color="#333333"></span>
                                <span data-color="#DA323F"></span>
                            </div>
                        </div> --}}
                    </div>
                    <hr>
                    <form action="{{ url('panier/add/', []) }}/{{$article->id}}" method="get">
                        <div class="cart_extra">

                                <div class="cart-product-quantity" style="display: inline-block;">
                                    <div class="quantity">
                                        <input type="button" value="-" class="minus">
                                        <input type="text" name="qty" value="1" title="Qty" class="qty" size="4">
                                        <input type="button" value="+" class="plus">
                                    </div>
                                </div>
                                <input type="hidden" name="id" value="{{$article->id}}">
                                <div class="cart_btn" style="display: inline-block;">
                                    <button type="submit" class="btn btn-fill-out btn-addtocart" ><i class="icon-basket-loaded"></i> Ajouter au panier</button>
                                    <a class="add_compare" href="#"><i class="icon-shuffle"></i></a>
                                    <a class="add_wishlist" href="{{ url('wish/add/', []) }}/{{$article->id}}"><i class="icon-heart"></i></a>
                                </div>

                        </div>
                    </form>
                    <hr>


                    <div class="product_share">
                        <span>Share:</span>
                        <ul class="social_icons">
                            <li><a href="https://www.facebook.com/sharer/sharer.php?u={{URL::current()}}" target="_blank"><i class="ion-social-facebook"></i></a></li>
                            <li><a href="https://twitter.com/intent/tweet?url={{URL::current()}}" target="_blank"><i class="ion-social-twitter"></i></a></li>
                            <li><a href="https://plus.google.com/share?url={{URL::current()}}"><i class="ion-social-googleplus"></i></a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
        	<div class="col-12">
            	<div class="large_divider clearfix"></div>
            </div>
        </div>
        <div class="row">
        	<div class="col-12">
            	<div class="tab-style3">
					<ul class="nav nav-tabs" role="tablist">
						{{-- <li class="nav-item">
							<a class="nav-link active" id="Description-tab" data-toggle="tab" href="#Description" role="tab" aria-controls="Description" aria-selected="true">Description</a>
                      	</li>
                      	<li class="nav-item">
                        	<a class="nav-link" id="Additional-info-tab" data-toggle="tab" href="#Additional-info" role="tab" aria-controls="Additional-info" aria-selected="false">Additional info</a>
                      	</li> --}}
                      	<li class="nav-item">
                        	<a class="nav-link active" id="Reviews-tab" data-toggle="tab" href="#Reviews" role="tab" aria-controls="Reviews" aria-selected="false">Reviews ({{count($article->commentaire)}})</a>
                      	</li>
                    </ul>
                	<div class="tab-content shop_info_tab">
                      	{{-- <div class="tab-pane fade show active" id="Description" role="tabpanel" aria-labelledby="Description-tab">
                        	<p>
                                {{$article->description}}
                            </p>
                      	</div>
                      	<div class="tab-pane fade" id="Additional-info" role="tabpanel" aria-labelledby="Additional-info-tab">
                        	<table class="table table-bordered">
                            	<tr>
                                	<td>Capacity</td>
                                	<td>5 Kg</td>
                            	</tr>
                                <tr>
                                    <td>Color</td>
                                    <td>Black, Brown, Red,</td>
                                </tr>
                                <tr>
                                    <td>Water Resistant</td>
                                    <td>Yes</td>
                                </tr>
                                <tr>
                                    <td>Material</td>
                                    <td>Artificial Leather</td>
                                </tr>
                        	</table>
                      	</div> --}}
                      	<div class="tab-pane fade show active" id="Reviews" role="tabpanel" aria-labelledby="Reviews-tab">
                        	<div class="comments">
                                <h5 class="product_tab_title">{{count($article->commentaire)}} Review For <span>{{$article->libelle}}</span></h5>
                                <ul class="list_none comment_list mt-4">
                                    @foreach ($article->commentaire as $user)
                                        <li>
                                            <div class="comment_img">
                                                @if ($user->image)
                                                 <img src="{{ url('', []) }}/{{$user->image}}" alt="user1">
                                                @else
                                                    <img src="{{ url('', []) }}/boutique/uploads/default/avatar.png" alt="user1">
                                                @endif
                                            </div>
                                            <div class="comment_block">
                                                <div class="rating_wrap">
                                                    <div class="">

                                                        <div class="star_rating" >
                                                            @for ($i = 1 ; $i <= 5 ; $i++)
                                                                    @if ($user->pivot->rate >= $i)
                                                                     <span class="selected" ><i class="far fa-star" style="font-size: 14px"></i></span>

                                                                    @else
                                                                        <span ><i class="far fa-star" style="font-size: 14px"></i></span>

                                                                    @endif
                                                            @endfor

                                                        </div>

                                                    </div>
                                                </div>
                                                <p class="customer_meta">
                                                    <span class="review_author">{{$user->first_name}} {{$user->last_name}}</span>
                                                    <span class="comment-date">{{$user->pivot->created_at}}</span>
                                                </p>
                                                <div class="description">
                                                    <p>{{$user->pivot->description}}</p>
                                                </div>
                                            </div>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                            @if (Auth::check())
                                @if (verifCommandeArticle ($article->id))


                                <div class="review_form field_form">
                                    <h5>Add a review</h5>
                                    <form class="row mt-3" method="POST">
                                        @csrf
                                        <input type="text" id="rateinput" name="rate" hidden >
                                        <div class="form-group col-12">
                                            <div class="star_rating">
                                                <span data-value="1" onclick="setData(1)"><i class="far fa-star"></i></span>
                                                <span data-value="2" onclick="setData(2)"><i class="far fa-star"></i></span>
                                                <span data-value="3" onclick="setData(3)"><i class="far fa-star"></i></span>
                                                <span data-value="4" onclick="setData(4)"><i class="far fa-star"></i></span>
                                                <span data-value="5" onclick="setData(5)"><i class="far fa-star"></i></span>
                                            </div>
                                        </div>
                                        <div class="form-group col-12">
                                            <textarea required="required" placeholder="Your review *" class="form-control" name="description" rows="4"></textarea>
                                        </div>
                                        <div class="form-group col-12">
                                            <button type="submit"  class="btn btn-fill-out" name="submit" value="Submit">Submit Review</button>
                                        </div>
                                    </form>
                                    <script>
                                        function setData(rate) {
                                            document.getElementById('rateinput').value = rate;
                                        }
                                    </script>
                                </div>

                            @endif
                            @endif
                      	</div>
                	</div>
                </div>
            </div>
        </div>
        <div class="row">
        	<div class="col-12">
            	<div class="small_divider"></div>
            	<div class="divider"></div>
                <div class="medium_divider"></div>
            </div>
        </div>
        <div class="row">
        	<div class="col-12">
            	<div class="heading_s1">
                	<h3>Releted Products</h3>
                </div>
            	<div class="releted_product_slider carousel_slider owl-carousel owl-theme" data-margin="20" data-responsive='{"0":{"items": "1"}, "481":{"items": "2"}, "768":{"items": "3"}, "1199":{"items": "4"}}'>

                    @foreach ($article->categorie->article as $item)
                        @if ($item->id != $article->id)
                            <div class="item">
                                <div class="product">
                                    <div class="product_img">
                                        <a href="shop-product-detail.html">
                                            <img src="{{url('')}}/{{explode(",", $item->images)[0]}}" alt="product_img1">
                                        </a>
                                        <div class="product_action_box">
                                            <ul class="list_none pr_action_btn">
                                                <li class="add-to-cart"><a href="#"><i class="icon-basket-loaded"></i> Add To Cart</a></li>
                                                <li><a href="shop-compare.html"><i class="icon-shuffle"></i></a></li>
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
                                            <div >
                                                <div class="star_rating" >
                                                    @for ($i = 1 ; $i <= 5 ; $i++)
                                                            @if (getArticleRate($item->id) >= $i)
                                                             <span class="selected" ><i class="far fa-star" style="font-size: 14px"></i></span>

                                                            @else
                                                                <span ><i class="far fa-star" style="font-size: 14px"></i></span>

                                                            @endif
                                                    @endfor

                                                </div>
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
                        @endif


                    @endforeach
                </div>
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

</script>
@endpush
