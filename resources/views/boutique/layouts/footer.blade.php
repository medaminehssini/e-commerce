<!-- START FOOTER -->
<footer class="bg_gray">
    <div class="middle_footer">
    	<div class="container">
        	<div class="row">
            	<div class="col-12">
                	<div class="shopping_info" style="border-bottom:none; border-top: none; ">
                        <div class="row justify-content-center">
                            <div class="col-md-4">
                                <div class="icon_box icon_box_style2">
                                    <div class="icon">
                                        <i class="flaticon-shipped"></i>
                                    </div>
                                    <div class="icon_box_content">
                                    	<h5>Livraison gratuite</h5>
                                        <p>Livraison gratuite à partir de 100TND d'achats.</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="icon_box icon_box_style2">
                                    <div class="icon">
                                        <i class="flaticon-money-back"></i>
                                    </div>
                                    <div class="icon_box_content">
                                    	<h5>Guarantie de 10 jours de retour.</h5>
                                        <p>Possibilité de retour sous quelques conditions.</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="icon_box icon_box_style2">
                                    <div class="icon">
                                        <i class="flaticon-support"></i>
                                    </div>
                                    <div class="icon_box_content">
                                    	<h5>Support En ligne</h5>
                                        <p>Service client en ligne .</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
	<div class="footer_top small_pt pb_20">
        <div class="container">
            <div class="row" style="    border-bottom: 1px solid #ddd; border-top: 1px solid #ddd; padding-top: 40px">
                <div class="col-lg-3 col-md-12 col-sm-12">
                	<div class="widget">
                        <div class="footer_logo">
                            <a href="#"><img src="{{url('boutique')}}/assets/images/logo_dark.png" alt="logo"></a>
                        </div>
                        <!-- <p class="mb-3">If you are going to use of Lorem Ipsum need to be sure there isn't anything hidden of text</p> -->

                    </div>
        		</div>
                <div class="col-lg-5 col-md-4 col-sm-6">
                	<div class="widget">
                        <ul class="contact_info">
                            <li>
                                <i class="ti-location-pin"></i>
                                <p>{{getSetting('adresse')}}</p>
                            </li>
                            <li>
                                <i class="ti-email"></i>
                                <a href="mailto:{{getSetting('mail')}}">{{getSetting('mail')}}</a>
                            </li>
                            <li>
                                <i class="ti-mobile"></i>
                                <p>{{getSetting('phone')}}</p>
                            </li>
                        </ul>
                    </div>
                </div>

                <div class="col-lg-4 col-md-4 col-sm-12">
                	<div class="widget">
                    	<h6 class="widget_title">Social</h6>
                        <ul class="social_icons">
                            @if (getSetting('facebook'))
                                <li><a href="{{getSetting('facebook')}}" class="sc_facebook"><i class="ion-social-facebook"></i></a></li>
                            @endif
                            @if (getSetting('twitter'))
                                <li><a href="{{getSetting('twitter')}}" class="sc_twitter"><i class="ion-social-twitter"></i></a></li>
                            @endif
                            @if (getSetting('googleplus'))
                                <li><a href="{{getSetting('googleplus')}}" class="sc_google"><i class="ion-social-googleplus"></i></a></li>
                            @endif
                            @if (getSetting('youtube'))
                                <li><a href="{{getSetting('youtube')}}" class="sc_youtube"><i class="ion-social-youtube-outline"></i></a></li>
                            @endif
                            @if (getSetting('instagrame'))
                                <li><a href="{{getSetting('instagram')}}" class="sc_instagram"><i class="ion-social-instagram-outline"></i></a></li>
                            @endif
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="bottom_footer border-top-tran">
        <div class="container">
            <div class="row">
                <div class="col-md-12" >
                    <p class="text-center text-md-left mb-md-0" style="text-align: center !important;">© 2020 All Rights Reserved by {{getSetting('name')}}</p>
                </div>

            </div>
        </div>
    </div>
</footer>
<!-- END FOOTER -->

<a href="#" class="scrollup" style="display: none;"><i class="ion-ios-arrow-up"></i></a>

</body>
</html>
