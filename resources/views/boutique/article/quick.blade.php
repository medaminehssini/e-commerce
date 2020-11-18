
<div class="ajax_quick_view">
	<div class="row">
        <div class="col-lg-6 col-md-6 mb-4 mb-md-0">
          <div class="product-image">
                <div class="product_img_box">
                    <img id="product_img" src="{{url('')}}/{{explode(",", $article->images)[0]}}" data-zoom-image="{{url('')}}/{{explode(",", $article->images)[0]}}" alt="product_img1" />
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
                    <div class="pr_desc" style="width: 100%;" >
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
                            <div class="cart-product-quantity">
                                <div class="quantity">
                                    <input type="button" value="-" class="minus">
                                    <input type="text" name="qty" value="1" title="Qty" class="qty" size="4">
                                    <input type="button" value="+" class="plus">
                                </div>
                            </div>
                            <div class="cart_btn">
                                <button class="btn btn-fill-out btn-addtocart" type="submit"><i class="icon-basket-loaded"></i> Add to cart</button>
                                <a class="add_compare" href="{{ url('compare/add/', []) }}/{{$article->id}}"><i class="icon-shuffle"></i></a>
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
</div>


<script src="{{url('boutique')}}/assets/js/scripts.js"></script>
