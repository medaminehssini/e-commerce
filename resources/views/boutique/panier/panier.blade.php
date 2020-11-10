
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
                                @php
                                    $sommeTax = 0;
                                @endphp
                                @foreach (Cart::content() as $art)
                                    <tr>
                                        <td class="product-thumbnail"><a href="#"><img src="{{url('')}}/{{$art->options->image}}" alt="product1"></a></td>
                                        <td class="product-name" data-title="Product"><a href="#">{{$art->name}}</a></td>
                                        <td class="product-price" data-title="Price">{{$art->price}}</td>
                                        <td class="product-quantity" data-title="Quantity"><div class="quantity">
                                        <input type="text" class="productId"  hidden value="{{$art->id}}">
                                        <input type="button" value="-" class="minus">
                                        <input type="text" name="quantity" class="qty articlesQty" value="{{$art->qty}}" title="Qty" size="4">
                                        <input type="button" value="+" class="plus">
                                    </div></td>
                                    @php
                                        $sommeTax += $art->total * $art->model->taux_tva/100;
                                    @endphp
                                        <td class="product-subtotal" data-title="Total">{{$art->total+($art->total * $art->model->taux_tva/100)}} ({{$art->model->taux_tva}}%)</td>
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
                                                <form action="{{ url('panier/recalculer', []) }}" method="post" name="recalculerCommande">
                                                    @csrf
                                                    <textarea name="json" id="jsonValue" cols="30" rows="10" hidden></textarea>
                                                    <button class="btn btn-line-fill btn-sm" type="submit" onclick="Recalculer()">Re-calculer</button>
                                                </form>
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
                    <form class="field_form shipping_calculator" action="">
                        <div class="form-row">
                            <div class="form-group col-lg-12">
                                <div class="custom_select">
                                    <select class="form-control" id="ville" onchange="changeUrl('ville' , this.value)">
                                            <option value="">Choisir ville</option>
                                            <option value="grand_tunis">Grand tunis</option>
                                            <option value="rest">Reste</option>
                                    </select>
                                </div>
                            </div>
                            @if (request()->ville == 'grand_tunis' ||  request()->ville == 'rest'  )


                            <div class="form-group col-lg-12">
                                <div class="custom_select">
                                    <select class="form-control" id="livreur" onchange="changeUrl('livreur' , this.value)">
                                            <option value="">Choisir livreur</option>
                                            @if (request()->ville == 'grand_tunis' )
                                            <option value="0">Societe gratuite</option>
                                            @endif
                                        @foreach ($livreur as $liv)
                                            <option value="{{$liv->id}}">{{ $liv->nom." Frais =".$liv->frais.getSetting('currency')." Delais =".$liv->delai."heures" }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            @endif
                        </div>
                        <div class="form-row">
                            <div class="form-group col-lg-12">
                                <input required="required" placeholder="Adresse de livraison" class="form-control" name="adrressliv" type="text" disabled value="{{Auth::user()->adresse.' '.Auth::user()->code_postale.' '.Auth::user()->ville}}">
                            </div>
                            <div class="form-group col-lg-12">
                                <input placeholder="Adresse de facturation" class="form-control" name="adressfac" type="text">
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
                                    <td class="cart_total_amount">{{Cart::subTotal().' '.getSetting('currency')}}</td>
                                    </tr>
                                    <tr>
                                    <td class="cart_total_label">Frais de livraison</td>
                                        <td class="cart_total_amount">{{ $fraislivreur == 0 ? 'Gratuit' : $fraislivreur .' '.getSetting('currency')}}</td>
                                    </tr>
                                    <tr>
                                        <td class="cart_total_label">Tax</td>
                                            <td class="cart_total_amount">{{ $sommeTax .' '.getSetting('currency')}}</td>
                                        </tr>
                                    <tr>
                                        <td class="cart_total_label">Total TTC</td>
                                        <td class="cart_total_amount"><strong>{{Cart::total()+ $sommeTax + $fraislivreur.' '.getSetting('currency')}}</strong></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <form action="{{ url('add/commande', []) }}" method="post">
                            @csrf
                            <input type="hidden" value="{{request()->ville}}" name="ville">
                            <input type="hidden" value="{{request()->livreur}}" name="livreur">

                            <button type="submit" class="btn btn-fill-out">Confirmer</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- END SECTION SHOP -->


    </div>
@endsection

@push('scripts')
        <script>
            function Recalculer() {
                articlesId  = document.getElementsByClassName('productId');
                articlesQty  = document.getElementsByClassName('articlesQty');
                console.log(articlesId);  console.log(articlesQty);
                listart = [];
                for (let index = 0; index < articlesId.length; index++) {
                     listart[index] = {'id' : articlesId[index].value , 'qty' : articlesQty[index].value };

                }
                document.recalculerCommande.jsonValue.value = JSON.stringify(listart) ;
                document.recalculerCommande.submit();
            }
            function changeUrl( key, value) {
                if(key == 'ville') {
                    uri = removeParam('livreur' , window.location.href)
                }else
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
            function removeParam(key, sourceURL) {
                var rtn = sourceURL.split("?")[0],
                    param,
                    params_arr = [],
                    queryString = (sourceURL.indexOf("?") !== -1) ? sourceURL.split("?")[1] : "";
                if (queryString !== "") {
                    params_arr = queryString.split("&");
                    for (var i = params_arr.length - 1; i >= 0; i -= 1) {
                        param = params_arr[i].split("=")[0];
                        if (param === key) {
                            params_arr.splice(i, 1);
                        }
                    }
                    rtn = rtn + "?" + params_arr.join("&");
                }
                return rtn;
            }
            $( document ).ready(function() {
                document.getElementById('livreur').value = "{{request()->livreur}}" ;
                document.getElementById('ville').value = "{{request()->ville}}" ;

            })
        </script>
@endpush
