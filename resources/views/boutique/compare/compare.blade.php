
@extends('boutique.index')

@section('content')
<!-- START MAIN CONTENT -->
<div class="main_content">

    <!-- START SECTION SHOP -->
    <div class="section">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="compare_box">
                        <div class="table-responsive">
                            <table class="table table-bordered text-center">
                            <tbody>
                                <tr class="pr_image">
                                    <td class="row_title">Product Image</td>
                                    <td class="row_img">@if (count($compares)>0)
                                        <img src="{{url('')}}/{{explode(",", $compares[0]->images)[0]}}" alt="{{$compares[0]->libelle}}">
                                    @endif</td>
                                    <td class="row_img">@if (count($compares)>1)
                                        <img src="{{url('')}}/{{explode(",", $compares[1]->images)[0]}}" alt="{{$compares[1]->libelle}}">
                                    @endif</td>
                                    <td class="row_img">@if (count($compares)>2)
                                        <img src="{{url('')}}/{{explode(",", $compares[2]->images)[0]}}" alt="{{$compares[2]->libelle}}">
                                    @endif</td>
                                </tr>
                                <tr class="pr_title">
                                    <td class="row_title">Product Name</td>
                                    <td class="product_name">
                                        @if (count($compares)>0)
                                        <a href="{{ url('product/detail/', []) }}/{{$compares[0]->id}}">{{$compares[0]->libelle}}</a>
                                        @endif
                                    </td>
                                    <td class="product_name">
                                        @if (count($compares)>1)
                                        <a href="{{ url('product/detail/', []) }}/{{$compares[1]->id}}">{{$compares[1]->libelle}}</a>
                                        @endif
                                    </td>
                                    <td class="product_name">
                                        @if (count($compares)>2)
                                        <a href="{{ url('product/detail/', []) }}/{{$compares[2]->id}}">{{$compares[2]->libelle}}</a>
                                        @endif
                                    </td>
                                </tr>
                                <tr class="pr_price">
                                    <td class="row_title">Price</td>
                                    <td class="product_price">
                                        @if (count($compares)>0)
                                            <span class="price">{{ getPrixWithProm($compares[0]->prix , FindPromArticle($compares[0]->id)) }} TND</span>
                                        @endif
                                    </td>
                                    <td class="product_price">
                                        @if (count($compares)>1)
                                            <span class="price">{{ getPrixWithProm($compares[1]->prix , FindPromArticle($compares[1]->id)) }} TND</span>
                                        @endif
                                    </td>
                                    <td class="product_price">
                                        @if (count($compares)>2)
                                            <span class="price">{{ getPrixWithProm($compares[2]->prix , FindPromArticle($compares[2]->id)) }} TND</span>
                                        @endif
                                    </td>
                                </tr>
                                <tr class="pr_rating">
                                    <td class="row_title">Rating</td>
                                    <td>
                                        @if (count($compares)>0)
                                            <div class="star_rating" style="display: inline-block;" >
                                                @for ($i = 1 ; $i <= 5 ; $i++)
                                                        @if (getArticleRate($compares[0]->id) >= $i)
                                                        <span class="selected" ><i class="far fa-star" style="font-size: 14px"></i></span>

                                                        @else
                                                            <span ><i class="far fa-star" style="font-size: 14px"></i></span>

                                                        @endif
                                                @endfor

                                            </div>
                                                <span class="rating_num">({{count($compares[0]->commentaire)}})</span>
                                            </div>
                                        @endif
                                    </td>
                                    <td>
                                        @if (count($compares)>1)
                                            <div class="star_rating" style="display: inline-block;" >
                                                @for ($i = 1 ; $i <= 5 ; $i++)
                                                        @if (getArticleRate($compares[1]->id) >= $i)
                                                        <span class="selected" ><i class="far fa-star" style="font-size: 14px"></i></span>

                                                        @else
                                                            <span ><i class="far fa-star" style="font-size: 14px"></i></span>

                                                        @endif
                                                @endfor

                                            </div>
                                                <span class="rating_num">({{count($compares[1]->commentaire)}})</span>
                                            </div>
                                        @endif
                                    </td>
                                    <td>
                                        @if (count($compares)>2)
                                            <div class="star_rating" style="display: inline-block;" >
                                                @for ($i = 1 ; $i <= 5 ; $i++)
                                                        @if (getArticleRate($compares[2]->id) >= $i)
                                                        <span class="selected" ><i class="far fa-star" style="font-size: 14px"></i></span>

                                                        @else
                                                            <span ><i class="far fa-star" style="font-size: 14px"></i></span>

                                                        @endif
                                                @endfor

                                            </div>
                                                <span class="rating_num">({{count($compares[2]->commentaire)}})</span>
                                            </div>
                                        @endif
                                    </td>
                                </tr>
                                <tr class="pr_add_to_cart">
                                    <td class="row_title">Add To Cart</td>
                                    <td class="row_btn">
                                        @if (count($compares)>0)
                                            <a href="#" class="btn btn-fill-out"><i class="icon-basket-loaded"></i> Add To Cart</a>
                                        @endif
                                    </td>
                                    <td class="row_btn">
                                        @if (count($compares)>1)
                                            <a href="#" class="btn btn-fill-out"><i class="icon-basket-loaded"></i> Add To Cart</a>
                                        @endif
                                    </td>
                                    <td class="row_btn">
                                        @if (count($compares)>2)
                                            <a href="#" class="btn btn-fill-out"><i class="icon-basket-loaded"></i> Add To Cart</a>
                                        @endif
                                    </td>
                                </tr>
                                <tr class="description">
                                    <td class="row_title">Description</td>
                                    <td class="row_text">
                                        @if (count($compares)>0)
                                            <p>{{$compares[0]->description}}</p>
                                        @endif
                                    </td>
                                    <td class="row_text">
                                        @if (count($compares)>1)
                                            <p>{{$compares[1]->description}}</p>
                                        @endif
                                    </td>
                                    <td class="row_text">
                                        @if (count($compares)>2)
                                            <p>{{$compares[2]->description}}</p>
                                        @endif
                                    </td>
                                </tr>
                                <tr class="pr_color">
                                    <td class="row_title">Categorie</td>
                                    <td class="row_text">
                                        @if (count($compares)>0)
                                            <p>{{$compares[0]->categorie->nom}}</p>
                                        @endif
                                    </td>
                                    <td class="row_text">
                                        @if (count($compares)>1)
                                            <p>{{$compares[1]->categorie->nom}}</p>
                                        @endif
                                    </td>
                                    <td class="row_text">
                                        @if (count($compares)>2)
                                            <p>{{$compares[2]->categorie->nom}}</p>
                                        @endif
                                    </td>
                                </tr>
                                <tr class="pr_color">
                                    <td class="row_title">Marque</td>
                                    <td class="row_text">
                                        @if (count($compares)>0)
                                            <p>{{$compares[0]->marque->libelle}}</p>
                                        @endif
                                    </td>
                                    <td class="row_text">
                                        @if (count($compares)>1)
                                            <p>{{$compares[1]->marque->libelle}}</p>
                                        @endif
                                    </td>
                                    <td class="row_text">
                                        @if (count($compares)>2)
                                            <p>{{$compares[2]->marque->libelle}}</p>
                                        @endif
                                    </td>
                                </tr>
                                <tr class="pr_stock">
                                    <td class="row_title">Item Availability</td>
                                    <td class="row_stock">
                                        @if (count($compares)>0)
                                        {!!$compares[0]->qty > 0 ?'<span class="in-stock">In Stock': '<span class="out-stock">Out Of Stock' !!} </span>
                                        @endif
                                    </td>
                                    <td class="row_stock">
                                        @if (count($compares)>1)
                                        {!!$compares[1]->qty > 0 ?'<span class="in-stock">In Stock': '<span class="out-stock">Out Of Stock' !!} </span>
                                        @endif
                                    </td>
                                    <td class="row_stock">
                                        @if (count($compares)>2)
                                        {!!$compares[2]->qty > 0 ?'<span class="in-stock">In Stock': '<span class="out-stock">Out Of Stock' !!} </span>
                                        @endif
                                    </td>
                                </tr>
                                <tr class="pr_remove">
                                    <td class="row_title"></td>
                                    <td class="row_remove">
                                        @if (count($compares)>0)

                                            <a href="{{ url('compare/remove', []) }}/{{$compares[0]->id}}"><span>Remove</span> <i class="fa fa-times"></i></a>
                                        @else
                                            <a style="color: green"  href="{{ url('search', []) }}"><span>Add</span> <i class="fa fa-plus"></i></a>

                                        @endif
                                    </td>
                                    <td class="row_remove">
                                        @if (count($compares)>1)

                                            <a  href="{{ url('compare/remove', []) }}/{{$compares[1]->id}}"><span>Remove</span> <i class="fa fa-times"></i></a>
                                        @else
                                            <a style="color: green"  href="{{ url('search', []) }}"><span>Add</span> <i class="fa fa-plus"></i></a>

                                        @endif
                                    </td>
                                    <td class="row_remove">
                                        @if (count($compares)>2)

                                            <a href="{{ url('compare/remove', []) }}/{{$compares[2]->id}}"><span>Remove</span> <i class="fa fa-times"></i></a>
                                        @else
                                            <a style="color: green" href="{{ url('search', []) }}"><span>Add</span> <i class="fa fa-plus"></i></a>

                                        @endif
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        </div>
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

@endpush
