
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
                                <input type="password" required="" class="form-control" value="" name="password" placeholder="new Password">
                            </div>
                            <div class="form-group">
                                <input type="password" required="" class="form-control" value="" name="password_confirmation" placeholder="password confirmation ">
                            </div>
                            <div class="form-group">
                                <button type="submit" class="btn btn-fill-out btn-block" name="login">  Changer Password</button>
                            </div>
                        </form>

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
