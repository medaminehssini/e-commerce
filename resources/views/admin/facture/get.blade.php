
@extends('admin.index')
@push('css')

<link rel="stylesheet" type="text/css" href="{{url('')}}/app-assets/css/pages/invoice.css">
@endpush




@section('content')

<div class="content-header row">
    <div class="content-header-left col-md-9 col-12 mb-2">
        <div class="row breadcrumbs-top">
            <div class="col-12">
                <h2 class="content-header-title float-left mb-0">Invoice</h2>
                <div class="breadcrumb-wrapper col-12">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="index.html">Home</a>
                        </li>
                        <li class="breadcrumb-item"><a href="#">Pages</a>
                        </li>
                        <li class="breadcrumb-item active">Invoice
                        </li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    <div class="content-header-right text-md-right col-md-3 col-12 d-md-block d-none">

    </div>
</div>
<div class="content-body">
    <!-- invoice functionality start -->
    <section class="invoice-print mb-1">
        <div class="row">

            <fieldset class="col-12 col-md-5 mb-1 mb-md-0">

            </fieldset>
            <div class="col-12 col-md-7 d-flex flex-column flex-md-row justify-content-end">
                <button class="btn btn-primary btn-print mb-1 mb-md-0"> <i class="feather icon-file-text"></i> Print</button>
            </div>
        </div>
    </section>
    <!-- invoice functionality end -->
    <!-- invoice page -->
    <section class="card invoice-page">
        <div id="invoice-template" class="card-body">
            <!-- Invoice Company Details -->
            <div id="invoice-company-details" class="row">
                <div class="col-sm-6 col-12 text-left pt-1">
                    <div class="media pt-1">
                        <img src="{{ url('', []) }}/boutique/assets/images/logo_dark.png" alt="company logo" />
                    </div>
                </div>
                <div class="col-sm-6 col-12 text-right">
                    <h1>Facture d'achat </h1>
                    <div class="invoice-details mt-2">
                        <h6>Facture NO.</h6>
                        <p>{{$commande->id}}/{{ date("Y")}}</p>
                        <h6 class="mt-2">Date Facture </h6>
                        <p>{{$commande->created_at}}</p>
                    </div>
                </div>
            </div>
            <!--/ Invoice Company Details -->

            <!-- Invoice Recipient Details -->
            <div id="invoice-customer-details" class="row pt-2">
                <div class="col-sm-6 col-12 text-left">
                    <h5>Bénéficiaire : </h5>
                    <div class="recipient-info my-2">
                        <p>{{$commande->client->first_name}} {{$commande->client->last_name}}</p>
                        <p>{{$commande->adresseliv ? $commande->adresseliv : $commande->client->adresse}}</p>
                        <p>{{$commande->adresseliv ? $commande->villeliv : $commande->client->ville}}</p>

                    </div>
                    @if ($commande->adressefact && $commande->adressefact)
                        <h5>Adresse de facturation : </h5>
                        <div class="recipient-info my-2">
                            <p>{{ $commande->adressefact}}</p>
                            <p>{{$commande->villefact}}</p>

                        </div>
                    @endif
                    @if ($commande->client->is_societe)
                        <h5>Matricule Fiscale : </h5>
                        <div class="recipient-info my-2">
                            <p>{{ $commande->client->matricule_fiscale}}</p>

                        </div>
                        <h5>Code TVA : </h5>
                        <div class="recipient-info my-2">
                            <p>{{ $commande->client->code_tva}}</p>

                        </div>
                    @endif
                    <div class="recipient-contact pb-2">
                        <p>
                            <i class="feather icon-mail"></i>
                            {{$commande->client->email}}
                        </p>
                        <p>
                            <i class="feather icon-phone"></i>
                            {{$commande->client->tele}}

                        </p>
                    </div>
                </div>
                <div class="col-sm-6 col-12 text-right">
                    <h5>{{getSetting('name')}}</h5>
                    <div class="company-info my-2">
                        <p>{{getSetting('adresse')}}</p>
                        <p>Tunisie</p>

                    </div>
                    <div class="company-contact">
                        <p>
                            {{getSetting('mail')}}
                            <i class="feather icon-mail"></i>

                        </p>
                        <p>
                            {{getSetting('phone')}}
                            <i class="feather icon-phone"></i>

                        </p>
                    </div>
                </div>
            </div>
            <!--/ Invoice Recipient Details -->

            <!-- Invoice Items Details -->
            <div id="invoice-items-details" class="pt-1 invoice-items-table">
                <div class="row">
                    <div class="table-responsive col-12">
                        <table class="table table-borderless">
                            <thead>
                                <tr>
                                    <th>Image</th>
                                    <th>Article</th>
                                    <th>Qty</th>
                                    <th>Prix</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $subtotal = 0 ;
                                    $tva = 0 ;
                                @endphp
                                @foreach ($commande->article as $item)
                                    @php

                                        $subtotal += $item->prix *  $item->pivot->qty;

                                        $tva += ($item->prix *  $item->pivot->qty *$item->taux_tva)/100 ;
                                    @endphp
                                    <tr>
                                        <td><img src="{{url('')}}/{{explode(",", $item->images)[0]}}" style="width: 100px;height: 100px;" alt=""></td>
                                        <td>{{$item->libelle}}</td>
                                        <td>{{$item->pivot->qty}}</td>
                                        <td>{{$item->prix * $item->pivot->qty + ($item->prix * $item->pivot->qty *$item->taux_tva /100 ) }}({{$item->taux_tva}}%)</td>
                                    </tr>
                                @endforeach


                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div id="invoice-total-details" class="invoice-total-table">
                <div class="row">
                    <div class="col-7 offset-5">
                        <div class="table-responsive">
                            <table class="table table-borderless">
                                <tbody>
                                    <tr>
                                        <th>SUBTOTAL</th>
                                        <td>{{$subtotal}} {{getSetting('currency')}}</td>
                                    </tr>
                                    <tr>
                                        <th>TVA</th>
                                        <td>{{$tva}} {{getSetting('currency')}}</td>
                                    </tr>
                                    <tr>
                                        <th>Livraison</th>
                                        <td>{{$commande->id_livreur != 0 ? $commande->livreur->frais .' ' . getSetting('currency').' ' .'('.$commande->livreur->nom .')' : 'Gratuit'}}</td>
                                    </tr>
                                    @if ($commande->id_coupon)
                                        <tr>
                                            <th>DISCOUNT ({{$commande->coupon->taux}}}%)</th>
                                            <td> {{$subtotal*$commande->coupon->taux/100}} {{getSetting('currency')}}</td>
                                        </tr>
                                    @endif
                                    <tr>
                                        <th>TOTAL</th>
                                        <td>{{$commande->total}} {{getSetting('currency')}}</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>



        </div>
    </section>
    <!-- invoice page end -->

</div>





@endsection






@push('scripts')





    <script src="{{url('')}}/app-assets/js/scripts/pages/invoice.js"></script>

@endpush
