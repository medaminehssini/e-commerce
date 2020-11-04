
@extends('admin.index')
@push('css')
<link rel="stylesheet" type="text/css" href="{{url('')}}/app-assets/vendors/css/calendars/fullcalendar.min.css">
<link rel="stylesheet" type="text/css" href="{{url('')}}/app-assets/vendors/css/calendars/extensions/daygrid.min.css">
<link rel="stylesheet" type="text/css" href="{{url('')}}/app-assets/vendors/css/calendars/extensions/timegrid.min.css">
<link rel="stylesheet" type="text/css" href="{{url('')}}/app-assets/vendors/css/pickers/pickadate/pickadate.css">
    <!-- BEGIN: Page CSS-->
    <link rel="stylesheet" type="text/css" href="{{url('')}}/app-assets/css/core/menu/menu-types/vertical-menu.css">
    <link rel="stylesheet" type="text/css" href="{{url('')}}/app-assets/css/core/colors/palette-gradient.css">
    <link rel="stylesheet" type="text/css" href="{{url('')}}/app-assets/css/plugins/calendars/fullcalendar.css">
    <!-- END: Page CSS-->
@endpush
@section('content')




<div class="content-header row">
</div>
<div class="content-body">
    <!-- Full calendar start -->
    <section id="basic-examples">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-content">
                        <div class="card-body">
                            <div class="cal-category-bullets d-none">
                                <div class="bullets-group-1 mt-2">
                                    <div class="category-business mr-1">
                                        <span class="bullet bullet-success bullet-sm mr-25"></span>
                                        Coupon
                                    </div>
                                    <div class="category-work mr-1">
                                        <span class="bullet bullet-warning bullet-sm mr-25"></span>
                                        Coupon
                                    </div>
                                    {{-- <div class="category-personal mr-1">
                                        <span class="bullet bullet-danger bullet-sm mr-25"></span>
                                        Personal
                                    </div>
                                    <div class="category-others">
                                        <span class="bullet bullet-primary bullet-sm mr-25"></span>
                                        Others
                                    </div> --}}
                                </div>
                            </div>
                            <div id='fc-default'></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- calendar Modal starts-->
        <div class="modal fade text-left modal-calendar" tabindex="-1" role="dialog" aria-labelledby="cal-modal" aria-modal="true">
            <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-sm" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title text-text-bold-600" id="cal-modal">Event info</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                    <form action="#">
                        <div class="modal-body">
                            <div class="d-flex justify-content-between align-items-center add-category">
                                <div class="chip-wrapper" style="margin-bottom: 15px"></div>
                                <div class="label-icon pt-1 pb-2 dropdown calendar-dropdown">

                                </div>
                            </div>
                            <fieldset class="form-label-group">
                                <input type="text" class="form-control" disabled id="cal-event-title" placeholder="Event Title">
                                <label for="cal-event-title">Event Title</label>
                            </fieldset>
                            <fieldset class="form-label-group">
                                <input type="text" class="form-control pickadate" disabled id="cal-start-date" placeholder="Start Date">
                                <label for="cal-start-date">Start Date</label>
                            </fieldset>
                            <fieldset class="form-label-group">
                                <input type="text" class="form-control pickadate" disabled id="cal-end-date" placeholder="End Date">
                                <label for="cal-end-date">End Date</label>
                            </fieldset>

                        </div>

                    </form>
                </div>
            </div>
        </div>
        <!-- calendar Modal ends-->
    </section>
    <!-- // Full calendar end -->

</div>



@endsection




@push('scripts')
    <!-- BEGIN: Page Vendor JS-->
    <script src="{{url('')}}/app-assets/vendors/js/extensions/moment.min.js"></script>
    <script src="{{url('')}}/app-assets/vendors/js/calendar/fullcalendar.min.js"></script>
    <script src="{{url('')}}/app-assets/vendors/js/calendar/extensions/daygrid.min.js"></script>
    <script src="{{url('')}}/app-assets/vendors/js/calendar/extensions/timegrid.min.js"></script>
    <script src="{{url('')}}/app-assets/vendors/js/calendar/extensions/interactions.min.js"></script>
    <script src="{{url('')}}/app-assets/vendors/js/pickers/pickadate/picker.js"></script>
    <script src="{{url('')}}/app-assets/vendors/js/pickers/pickadate/picker.date.js"></script>
    <!-- END: Page Vendor JS-->
    <!-- BEGIN: Page JS-->
    <!-- END: Page JS-->
<script>

document.addEventListener('DOMContentLoaded', function () {

// color object for different event types
var colors = {
  primary: "#7367f0",
  success: "#28c76f",
  danger: "#ea5455",
  warning: "#ff9f43"
};

// chip text object for different event types
var categoryText = {
  primary: "Others",
  success: "Promotion",
  danger: "Personal",
  warning: "Coupon"
};
var categoryBullets = $(".cal-category-bullets").html(),
  evtColor = "",
  eventColor = "";

// calendar init
var calendarEl = document.getElementById('fc-default');

var calendar = new FullCalendar.Calendar(calendarEl, {
  plugins: ["dayGrid", "timeGrid", "interaction"],
  header: {
    left: "addNew",
    center: "dayGridMonth,timeGridWeek,timeGridDay",
    right: "prev,title,next"
  },
  displayEventTime: false,
  navLinks: true,
  editable: true,
  allDay: true,

  // displays saved event values on click
  eventClick: function (info) {
    $(".modal-calendar").modal("show");
    $(".modal-calendar #cal-event-title").val(info.event.title);
    $(".modal-calendar #cal-start-date").val(moment(info.event.start).format('YYYY-MM-DD'));
    $(".modal-calendar #cal-end-date").val(moment(info.event.end).format('YYYY-MM-DD'));
    $(".modal-calendar .cal-submit-event").removeClass("d-none");
    $(".modal-calendar .remove-event").removeClass("d-none");
    $(".modal-calendar .cal-add-event").addClass("d-none");
    $(".modal-calendar .cancel-event").addClass("d-none");
    $(".calendar-dropdown .dropdown-menu").find(".selected").removeClass("selected");
    var eventCategory = info.event.extendedProps.dataEventColor;
    console.log(eventCategory);
    var eventText = categoryText[eventCategory]
    $(".modal-calendar .chip-wrapper .chip").remove();
    $(".modal-calendar .chip-wrapper").append($("<div class='chip chip-" + eventCategory + "'>" +
      "<div class='chip-body' >" +
      "<span class='chip-text'> " + eventText + " </span>" +
      "</div>" +
      "</div>"));
  },
});

// render calendar
calendar.render();

// appends bullets to left class of header
$("#basic-examples .fc-right").append(categoryBullets);

// Close modal on submit button
$(".modal-calendar .cal-submit-event").on("click", function () {
  $(".modal-calendar").modal("hide");
});




// reset input element's value for new event
if ($("td:not(.fc-event-container)").length > 0) {
  $(".modal-calendar").on('hidden.bs.modal', function (e) {
    $('.modal-calendar .form-control').val('');
  })
}

// remove disabled attr from button after entering info
$(".modal-calendar .form-control").on("keyup", function () {
  if ($(".modal-calendar #cal-event-title").val().length >= 1) {
    $(".modal-calendar .modal-footer .btn").removeAttr("disabled");
  }
  else {
    $(".modal-calendar .modal-footer .btn").attr("disabled", true);
  }
});


// change chip's and event's color according to event type
$(".calendar-dropdown .dropdown-menu .dropdown-item").on("click", function () {
  var selectedColor = $(this).data("color");
  evtColor = colors[selectedColor];
  eventTag = categoryText[selectedColor];
  eventColor = selectedColor;

  // changes event color after selecting category
  $(".cal-add-event").on("click", function () {
    calendar.addEvent({
      color: evtColor,
      dataEventColor: eventColor,
      className: eventColor
    });
  })

  $(".calendar-dropdown .dropdown-menu").find(".selected").removeClass("selected");
  $(this).addClass("selected");

  // add chip according to category
  $(".modal-calendar .chip-wrapper .chip").remove();
  $(".modal-calendar .chip-wrapper").append($("<div class='chip chip-" + selectedColor + "'>" +
    "<div class='chip-body'>" +
    "<span class='chip-text'> " + eventTag + " </span>" +
    "</div>" +
    "</div>"));
});




    var promotion = {!! json_encode($promotion->toArray(), JSON_HEX_TAG) !!}
    promotion.forEach(element => {
        calendar.addEvent({
          id: element.id,
          title: element.libelle,
          start: new Date(element.date_debut),
          end: new Date(element.date_fin),
          color:  colors.success,
          dataEventColor: 'success',
          allDay: true
      });
    });
    var coupon = {!! json_encode($coupon->toArray(), JSON_HEX_TAG) !!}
    coupon.forEach(element => {
        calendar.addEvent({
          id: element.id,
          title: element.code,
          start: new Date(element.created_at),
          end: new Date(element.date_fin),
          color:  colors.warning,
          dataEventColor: 'warning',
          allDay: true
      });
    });

});

</script>
@endpush
