@extends('boutique.index')

@section('content')


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
                            <h3>Reset Password</h3>
                        </div>
                        <form method="post">
                            @csrf
                            <div class="form-group">
                                <input type="text" required="" class="form-control"  name="email" placeholder="Votre Email">
                            </div>
                            <div class="form-group">
                                <button type="submit" class="btn btn-fill-out btn-block" name="login">  Reset Password</button>
                            </div>
                        </form>

                    <div class="form-note text-center">Vous n'avez pas un compte? <a href="{{ url('signup', []) }}">    S'inscrire</a></div>
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
