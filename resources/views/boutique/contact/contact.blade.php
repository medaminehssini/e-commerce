
@extends('boutique.index')

@section('content')
<!-- START MAIN CONTENT -->
<div class="main_content">

    <!-- START SECTION CONTACT -->
    <div class="section pb_70">
        <div class="container">
            <div class="row">
                <div class="col-xl-4 col-md-6">
                    <div class="contact_wrap contact_style3">
                        <div class="contact_icon">
                            <i class="linearicons-map2"></i>
                        </div>
                        <div class="contact_text">
                            <span>Address</span>
                            <p>123 Street, Old Trafford, London, UK</p>
                        </div>
                    </div>
                </div>
                <div class="col-xl-4 col-md-6">
                    <div class="contact_wrap contact_style3">
                        <div class="contact_icon">
                            <i class="linearicons-envelope-open"></i>
                        </div>
                        <div class="contact_text">
                            <span>Email Address</span>
                            <a href="mailto:info@sitename.com">info@yourmail.com </a>
                        </div>
                    </div>
                </div>
                <div class="col-xl-4 col-md-6">
                    <div class="contact_wrap contact_style3">
                        <div class="contact_icon">
                            <i class="linearicons-tablet2"></i>
                        </div>
                        <div class="contact_text">
                            <span>Phone</span>
                            <p>+ 457 789 789 65</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- END SECTION CONTACT -->

    <!-- START SECTION CONTACT -->
    <div class="section pt-0">
        <div class="container">
            <div class="row">
                <div class="col-lg-6">
                    <div class="heading_s1">
                        <h2>Get In touch</h2>
                    </div>
                    <p class="leads">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Phasellus blandit massa enim. Nullam id varius nunc id varius nunc.</p>
                    <div class="field_form">
                        <form method="post" >
                            @csrf
                            <div class="row">
                                <div class="form-group col-md-12">
                                    <input required="" placeholder="Enter Name *" class="form-control" name="nom" type="text">
                                 </div>
                                <div class="form-group col-md-12">
                                    <input required="" placeholder="Enter Email *"  class="form-control" name="email" type="email">
                                </div>

                                <div class="form-group col-md-12">
                                    <textarea required="" placeholder="Message *"  class="form-control" name="message" rows="4"></textarea>
                                </div>
                                <div class="col-md-12">
                                    <button type="submit" title="Submit Your Message!" class="btn btn-fill-out"   value="Submit">Send Message</button>
                                </div>
                                <div class="col-md-12">
                                    <div id="alert-msg" class="alert-msg text-center"></div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="col-lg-6 pt-2 pt-lg-0 mt-4 mt-lg-0">
                    <div id="map" class="contact_map2" data-zoom="12" data-latitude="40.680" data-longitude="-73.945" data-icon="{{ url('/boutique', []) }}/assets/images/marker.png"></div>
                </div>
            </div>
        </div>
    </div>
    <!-- END SECTION CONTACT -->


    </div>
    <!-- END MAIN CONTENT -->
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyD7TypZFTl4Z3gVtikNOdGSfNTpnmq-ahQ&amp;callback=initMap"></script>

@endsection


@push('scripts')

@endpush
