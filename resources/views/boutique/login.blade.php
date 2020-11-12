@extends('boutique.index')

@section('content')
<!-- START SECTION BREADCRUMB -->
<!-- <div class="breadcrumb_section bg_gray page-title-mini">
    <div class="container">

        <div class="row align-items-center">
        	<div class="col-md-6">
                <div class="page-title">
            		<h1>Se Connecter</h1>
                </div>
            </div>
            <div class="col-md-6">
                <ol class="breadcrumb justify-content-md-end">
                    <li class="breadcrumb-item"><a href="{{ url('', []) }}">Accueil</a></li>
                    <li class="breadcrumb-item active">Se Connecter</li>
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
                            <h3>Se Connecter</h3>
                        </div>
                        <form method="post">
                            @csrf
                            <div class="form-group">
                                <input type="text" required="" class="form-control" name="email" placeholder="Votre Email">
                            </div>
                            <div class="form-group">
                                <input class="form-control" required="" type="password" name="password" placeholder="Mot de passe">
                            </div>
                            <div class="login_footer form-group">
                                <!-- <div class="chek-form">
                                    <div class="custome-checkbox">
                                        <input class="form-check-input" type="checkbox"  name="remember" id="exampleCheckbox1" value="">
                                        <label class="form-check-label" for="exampleCheckbox1"><span>Remember me</span></label>
                                    </div>
                                </div> -->
                                <a href="#">Mot de passe oublié?</a>
                            </div>
                            <div class="form-group">
                                <button type="submit" class="btn btn-fill-out btn-block" name="login">Se Connecter</button>
                            </div>
                        </form>
                        <div class="different_login">
                            <span> Ou</span>
                        </div>
                        <ul class="btn-login list_none text-center">
                            <li><a href="{{ url('login/facebook', []) }}" class="btn btn-facebook"><i class="ion-social-facebook"></i>Facebook</a></li>
                            <li><a href="{{ url('login/google', []) }}" class="btn btn-google"><i class="ion-social-googleplus"></i>Google</a></li>
                        </ul>
                        <div class="form-note text-center">Vous n'avez pas un compte? <a href="{{ url('signup', []) }}">S'inscrire</a></div>
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
