@extends('boutique.index')

@section('content')



<!-- START MAIN CONTENT -->
<div class="main_content">

<!-- START SECTION SHOP -->
<div class="section">
	<div class="container">
        <div class="row">
            <div class="col-12">
                <div class="table-responsive wishlist_table">
                	<table class="table">
                    	<thead>
                        	<tr>
                            	<th class="product-thumbnail">&nbsp;</th>
                                <th class="product-name">Product</th>
                                <th class="product-price">Price</th>
                                <th class="product-stock-status">Stock Status</th>
                                <th class="product-add-to-cart"></th>
                                <th class="product-remove">Remove</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($wishs as $art)
                            <tr>
                            <td class="product-thumbnail"><a href="{{ url('product/detail/', []) }}/{{$art->id}}"><img src="{{url('')}}/{{explode(",", $art->images)[0]}}" alt="{{$art->libelle}}"></a></td>
                                <td class="product-name" data-title="Product"><a href="{{ url('product/detail/', []) }}/{{$art->id}}">{{$art->libelle}}</a></td>
                                <td class="product-price" data-title="Price">{{ getPrixWithProm($art->prix , FindPromArticle($art->id)) }} {{getSetting('currency')}}</td>
                              	<td class="product-stock-status" data-title="Stock Status">{!!$art->qty > 0 ?'<span class="badge badge-pill badge-success">Disponible': '<span class="badge badge-pill badge-danger">Non disponible' !!}</span></td>
                                <td class="product-add-to-cart"><a href="{{ url('panier/add/', []) }}/{{$art->id}}" class="btn btn-fill-out"><i class="icon-basket-loaded"></i> Ajouter au panier</a></td>
                            <td class="product-remove" data-title="Remove"><a href="{{ url('wish/remove', []) }}/{{$art->id}}"><i class="ti-close"></i></a></td>
                            </tr>
                            @endforeach


                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- END SECTION SHOP -->



</div>
<!-- END MAIN CONTENT -->
@endsection
