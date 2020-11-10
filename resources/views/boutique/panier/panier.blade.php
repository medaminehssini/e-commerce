
@extends('boutique.index')

@section('content')
<div class="main_content">

    <!-- START SECTION SHOP -->
    <div class="section">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="table-responsive shop_cart_table">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th class="product-thumbnail">&nbsp;</th>
                                    <th class="product-name">Article</th>
                                    <th class="product-price">Prix</th>
                                    <th class="product-quantity">Quantité</th>
                                    <th class="product-subtotal">Total</th>
                                    <th class="product-remove">Retirer</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach (Cart::content() as $art)
                                    <tr>
                                        <td class="product-thumbnail"><a href="#"><img src="{{url('')}}/{{explode(",", $articles->find($art->id)->images)[0]}}" alt="product1"></a></td>
                                        <td class="product-name" data-title="Product"><a href="#">{{$art->name}}</a></td>
                                        <td class="product-price" data-title="Price">{{$art->price}}</td>
                                        <td class="product-quantity" data-title="Quantity"><div class="quantity">
                                        <input type="button" value="-" class="minus">
                                        <input type="text" name="quantity" value="1" title="Qty" class="qty" size="4">
                                        <input type="button" value="+" class="plus">
                                    </div></td>
                                        <td class="product-subtotal" data-title="Total">{{Cart::subTotal()}}</td>
                                        <td class="product-remove" data-title="Remove"><a href="{{ url('panier/remove/', []) }}/{{$art->rowId}}"><i class="ti-close"></i></a></td>
                                    </tr>
                                @endforeach
                            </tbody>
                            <tfoot>
                                <tr>
                                    <td colspan="6" class="px-0">
                                        <div class="row no-gutters align-items-center">

                                            <div class="col-lg-4 col-md-6 mb-3 mb-md-0">
                                                <div class="coupon field_form input-group">
                                                    <input type="text" value="" class="form-control form-control-sm" placeholder="Enter Coupon Code..">
                                                    <div class="input-group-append">
                                                        <button class="btn btn-fill-out btn-sm" type="submit">Appliquez un coupon</button>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-8 col-md-6 text-left text-md-right">
                                                <button class="btn btn-line-fill btn-sm" type="submit">Re-calculer</button>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="medium_divider"></div>
                    <div class="divider center_icon"><i class="ti-shopping-cart-full"></i></div>
                    <div class="medium_divider"></div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="heading_s1 mb-3">
                        <h6>Options de livraison</h6>
                    </div>
                    <form class="field_form shipping_calculator">
                        <div class="form-row">
                            <div class="form-group col-lg-12">
                                <div class="custom_select">
                                    <select class="form-control">
                                    @foreach ($livreur as $liv)
                                    <option value="{{$liv->id}}">{{ $liv->nom." Frais =".$liv->frais."TND Delais =".$liv->delai."heures" }}</option>
                                    @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-lg-12">
                                <input required="required" placeholder="Adresse de livraison" class="form-control" name="adrressliv" type="text" disabled value="{{Auth::user()->adresse.' '.Auth::user()->code_postale.' '.Auth::user()->ville}}">
                            </div>
                            <div class="form-group col-lg-12">
                                <input placeholder="Adresse de facturation" class="form-control" name="adressfac" type="text">
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-lg-12">
                                <button class="btn btn-fill-line" type="submit">Recalculer les totaux</button>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="col-md-6">
                    <div class="border p-3 p-md-4">
                        <div class="heading_s1 mb-3">
                            <h6>Totaux</h6>
                        </div>
                        <div class="table-responsive">
                            <table class="table">
                                <tbody>
                                    <tr>
                                        <td class="cart_total_label">Sous total</td>
                                    <td class="cart_total_amount">{{Cart::subTotal()." TND"}}</td>
                                    </tr>
                                    <tr>
                                    <td class="cart_total_label">Frais de livraison</td>
                                        <td class="cart_total_amount">Gratuit</td>
                                    </tr>
                                    <tr>
                                        <td class="cart_total_label">Tax</td>
                                            <td class="cart_total_amount">{{Cart::tax()." TND"}}</td>
                                        </tr>
                                    <tr>
                                        <td class="cart_total_label">Total TTC</td>
                                        <td class="cart_total_amount"><strong>{{Cart::total()." TND"}}</strong></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <form action="" method="get">
                            <a href="{{ url('commande', []) }}" class="btn btn-fill-out">Confirmer</a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- END SECTION SHOP -->

    <!-- START SECTION SUBSCRIBE NEWSLETTER -->
    <div class="section bg_default small_pt small_pb">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-md-6">
                    <div class="heading_s1 mb-md-0 heading_light">
                        <h3>Subscribe Our Newsletter</h3>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="newsletter_form">
                        <form>
                            <input type="text" required="" class="form-control rounded-0" placeholder="Enter Email Address">
                            <button type="submit" class="btn btn-dark rounded-0" name="submit" value="Submit">Subscribe</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- START SECTION SUBSCRIBE NEWSLETTER -->

    </div>
@endsection

