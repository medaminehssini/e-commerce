@extends('boutique.index')

@section('content')
<!-- START SECTION BREADCRUMB -->
<!-- <div class="breadcrumb_section bg_gray page-title-mini">
    <div class="container">
        <div class="row align-items-center">
        	<div class="col-md-6">
                <div class="page-title">
            		<h1>Register</h1>
                </div>
            </div>
            <div class="col-md-6">
                <ol class="breadcrumb justify-content-md-end">
                    <li class="breadcrumb-item"><a href="{{ url('', []) }}">Home</a></li>
                    <li class="breadcrumb-item active">Register</li>
                </ol>
            </div>
        </div>
    </div>
</div> -->
<!-- END SECTION BREADCRUMB -->
<!-- START MAIN CONTENT -->
<div class="main_content" style="border-top: 1px solid #dee2e6 !important; border-bottom: 1px solid #dee2e6 !important;">

    <!-- START LOGIN SECTION -->
    <div class="login_register_wrap section">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-xl-6 col-md-10">
                    <div class="login_wrap">
                        <div class="padding_eight_all bg-white">

                            <div class="heading_s1">
                                <h3>S'inscrire</h3>
                            </div>

                            <form method="post">
                                @if ($errors->any())
                                <div class="alert alert-danger">
                                    <ul style="list-style-type: none">
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif
                                @csrf
                                <div class="form-group">
                                    <input type="text" required="" class="form-control" name="username" placeholder="Nom utilisateur">
                                </div>
                                <div class="form-group">
                                    <input type="text" required="" class="form-control" name="first_name" placeholder="Prénom">
                                </div>
                                <div class="form-group">
                                    <input type="text" required="" class="form-control" name="last_name" placeholder="Nom">
                                </div>
                                <div class="form-group">
                                    <input type="email" required="" class="form-control" name="email" placeholder="Adresse Email">
                                </div>
                                <div class="form-group">
                                    <input class="form-control" required="" type="password" name="password" placeholder="Mot de passe">
                                </div>
                                <div class="form-group">
                                    <input class="form-control" required="" type="password" name="confirmation_password" placeholder="Confirmer mot de passe">
                                </div>
                                <div class="login_footer form-group">
                                    <div class="chek-form">
                                        <div class="custome-checkbox">
                                            <input class="form-check-input" type="checkbox" name="checkbox" id="exampleCheckbox2" value="">
                                            <label class="form-check-label" for="exampleCheckbox2"><span>J'accepte les conditions &amp; Politique.</span></label>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <button type="submit" class="btn btn-fill-out btn-block" name="register">S'inscrire</button>
                                </div>
                            </form>
                            <div class="different_login">
                                <span> Ou</span>
                            </div>
                            <ul class="btn-login list_none text-center">
                                <li><a href="#" class="btn btn-facebook"><i class="ion-social-facebook"></i>Facebook</a></li>
                                <li><a href="#" class="btn btn-google"><i class="ion-social-googleplus"></i>Google</a></li>
                            </ul>
                            <div class="form-note text-center">Vous êtes déja inscrit? <a href="{{ url('login', []) }}">Se connecter</a></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- END LOGIN SECTION -->


    </div>
    <!-- END MAIN CONTENT -->

@endsection
