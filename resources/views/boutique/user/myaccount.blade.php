@extends('boutique.index')

@section('content')
<!-- START SECTION BREADCRUMB -->
<!-- <div class="breadcrumb_section bg_gray page-title-mini">
    <div class="container">
        <div class="row align-items-center">
        	<div class="col-md-6">
                <div class="page-title">
            		<h1>Mon compte</h1>
                </div>
            </div>
            <div class="col-md-6">
                <ol class="breadcrumb justify-content-md-end">
                    <li class="breadcrumb-item"><a href="{{ url('', []) }}">Acceuill</a></li>
                    <li class="breadcrumb-item active">Mon compte</li>
                </ol>
            </div>
        </div>
    </div>
</div> -->
<!-- END SECTION BREADCRUMB -->

<!-- START MAIN CONTENT -->
<div class="main_content">

<!-- START SECTION SHOP -->
<div class="section" style="border-top: 1px solid #dee2e6 !important; border-bottom: 1px solid #dee2e6 !important;">
	<div class="container">
        <div class="row">
            @if ($errors->any())
            <div class="alert alert-danger col-lg-12 col-md-12">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
            <div class="col-lg-3 col-md-4">
                <div class="dashboard_menu">
                    <ul class="nav nav-tabs flex-column" role="tablist">
                      <li class="nav-item">
                        <a class="nav-link active" id="dashboard-tab" data-toggle="tab" href="#dashboard" role="tab" aria-controls="dashboard" aria-selected="false"><i class="ti-layout-grid2"></i>Tableau de bord</a>
                      </li>
                      <li class="nav-item">
                        <a class="nav-link" id="orders-tab" data-toggle="tab" href="#orders" role="tab" aria-controls="orders" aria-selected="false"><i class="ti-shopping-cart-full"></i>Commandes</a>
                      </li>
                      <li class="nav-item">
                        <a class="nav-link" id="address-tab" data-toggle="tab" href="#address" role="tab" aria-controls="address" aria-selected="true"><i class="ti-location-pin"></i>Adresse</a>
                      </li>
                      <li class="nav-item">
                        <a class="nav-link" id="account-detail-tab" data-toggle="tab" href="#account-detail" role="tab" aria-controls="account-detail" aria-selected="true"><i class="ti-id-badge"></i>Detailles du compte</a>
                      </li>
                      <li class="nav-item">
                        <a class="nav-link" href="{{ url('logout', []) }}"><i class="ti-lock"></i>Deconnecter</a>
                      </li>
                    </ul>
                </div>
            </div>
            <div class="col-lg-9 col-md-8">
                <div class="tab-content dashboard_content">
                  	<div class="tab-pane fade active show" id="dashboard" role="tabpanel" aria-labelledby="dashboard-tab">
                    	<div class="card">
                        	<div class="card-header">
                                <h3>Tableau de bord</h3>
                            </div>
                            <div class="card-body">
                    			<p>D'ici vous pouvez voir vos <a href="javascript:void(0);" onclick="$('#orders-tab').trigger('click')"> commandes recent </a>, gérer votre <a href="javascript:void(0);" onclick="$('#address-tab').trigger('click')"> addresse de livraison</a> et <a href="javascript:void(0);" onclick="$('#account-detail-tab').trigger('click')">editer votre mot de passe et les detailles du compte.</a></p>
                            </div>
                        </div>
                  	</div>
                  	<div class="tab-pane fade" id="orders" role="tabpanel" aria-labelledby="orders-tab">
                    	<div class="card">
                        	<div class="card-header">
                                <h3>Commandes</h3>
                            </div>
                            <div class="card-body">
                    			<div class="table-responsive">
                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <th>Numero Commande</th>
                                                <th>Date</th>
                                                <th>Status</th>
                                                <th>Total</th>
                                                <th>Actions</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($commandes as $commande)
                                                <tr>
                                                    <td>#{{$commande->id}}</td>
                                                    <td>{{$commande->created_at}}</td>
                                                    <td>{{$commande->status}}</td>
                                                    <td>{{$commande->total}} TND for {{count($commande->article)}} item</td>
                                                    <td><a href="#" class="btn btn-fill-out btn-sm">View</a></td>
                                                </tr>
                                            @endforeach


                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                  	</div>
					<div class="tab-pane fade" id="address" role="tabpanel" aria-labelledby="address-tab">
                        <div class="card">
                        	<div class="card-header">
                                <h3>Detailles du compte</h3>
                            </div>
                            <div class="card-body">
                                <form method="post" action="{{ url('edit/adresse', []) }}" enctype="multipart/form-data" name="enq">
                                    @csrf
                                    <div class="row">



                                        <div class="form-group col-md-12">
                                        	<label>Adresse <span class="required">*</span></label>
                                            <input required="" class="form-control" value="{{auth()->user()->adresse}}"  name="adresse" type="text">
                                         </div>
                                         <div class="form-group col-md-6">
                                        	<label>Ville <span class="required">*</span></label>
                                            <input required="" class="form-control" name="ville" value="{{auth()->user()->ville}}"  type="text">
                                        </div>
                                         <div class="form-group col-md-6">
                                        	<label> Code postale <span class="required">*</span></label>
                                            <input required="" type="text" class="form-control" value="{{auth()->user()->code_postale}}" name="code_postale">
                                        </div>

                                        <div class="col-md-12">
                                            <button type="submit" class="btn btn-fill-out" name="submit" value="Submit">Enregistrer</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
					</div>
                    <div class="tab-pane fade" id="account-detail" role="tabpanel" aria-labelledby="account-detail-tab">
						<div class="card">
                        	<div class="card-header">
                                <h3>Detailles du compte</h3>
                            </div>
                            <div class="card-body">
                                <form method="post" action="{{ url('edit/account', []) }}" enctype="multipart/form-data" name="enq">
                                    @csrf
                                    <div class="row">
                                        <div class="form-group col-md-3">
                                            @if (auth()->user()->image)
                                             <img style="width: 100px; height: 100px; margin: 10px; border-radius: 50%" src="{{ url('', []) }}/{{auth()->user()->image}}" alt="">
                                            @else
                                                <img style="width: 100px; height: 100px; margin: 10px; border-radius: 50%" src="{{ url('', []) }}/boutique/uploads/default/avatar.png" alt="">
                                            @endif
                                        </div>
                                         <div class="form-group col-md-9">
                                        	<label> Image </label>
                                            <input  type="file" class="form-control"  name="image">
                                        </div>
                                        <div class="form-group col-md-12">
                                        	<label>Nom utilisateur <span class="required">*</span></label>
                                            <input required="" class="form-control" value="{{auth()->user()->username}}" disabled type="text">
                                        </div>
                                        <div class="form-group col-md-6">
                                        	<label>Prénom <span class="required">*</span></label>
                                            <input required="" class="form-control" value="{{auth()->user()->first_name}}"  name="first_name" type="text">
                                         </div>
                                         <div class="form-group col-md-6">
                                        	<label>Nom <span class="required">*</span></label>
                                            <input required="" class="form-control" value="{{auth()->user()->last_name}}" name="last_name">
                                        </div>
                                        <div class="form-group col-md-12">
                                        	<label>Addresse Email<span class="required">*</span></label>
                                            <input required="" class="form-control" name="email" value="{{auth()->user()->email}}"  type="email">
                                        </div>
                                        <div class="form-group col-md-12">
                                            <label>Sexe <span class="required">*</span></label>
                                            <select name="sexe" class="form-control"  >
                                                <option value="Homme" @if (auth()->user()->sexe == 'Homme')
                                                    selected
                                                @endif>Homme</option>
                                                <option value="Famme" @if (auth()->user()->sexe == 'Famme')
                                                    selected
                                                @endif>Femme</option>
                                            </select>
                                        </div>
                                        <div class="form-group col-md-12">
                                        	<label>Mot de passe actuelle <span class="required">*</span></label>
                                            <input  class="form-control" name="current_password" type="password">
                                        </div>
                                        <div class="form-group col-md-12">
                                        	<label>Nouvelle mot de passe <span class="required">*</span></label>
                                            <input  class="form-control" name="password" type="password">
                                        </div>
                                        <div class="form-group col-md-12">
                                        	<label>Confirmer mot de passe <span class="required">*</span></label>
                                            <input class="form-control" name="confirmation_password" type="password">
                                        </div>
                                        <div class="col-md-12">
                                            <button type="submit" class="btn btn-fill-out" name="submit" value="Submit">Enregistrer</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
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
