/*=========================================================================================
    File Name: fullcalendar.js
    Description: Fullcalendar
    --------------------------------------------------------------------------------------
    Item Name: Vuexy  - Vuejs, HTML & Laravel Admin Dashboard Template
    Author: PIXINVENT
    Author URL: http://www.themeforest.net/user/pixinvent
==========================================================================================*/

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
    success: "Business",
    danger: "Personal",
    warning: "Work"
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
      $(".modal-calendar #cal-description").val(info.event.extendedProps.description);
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
        "<div class='chip-body'>" +
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

  // calendar add event
  $(".cal-add-event").on("click", function () {
    $(".modal-calendar").modal("hide");
    var eventTitle = $("#cal-event-title").val(),
      startDate = $("#cal-start-date").val(),
      endDate = $("#cal-end-date").val(),
      eventDescription = $("#cal-description").val(),
      correctEndDate = new Date(endDate);
    calendar.addEvent({
      id: "newEvent",
      title: eventTitle,
      start: startDate,
      end: correctEndDate,
      description: eventDescription,
      color: evtColor,
      dataEventColor: eventColor,
      allDay: true
    });
  });

    function AddEvent () {
        calendar.addEvent({
            id: "newEvent",
            title: "eventTitle",
            start: new Date("11/04/2020"),
            end: new Date("11/15/2020"),
            description: "eventDescription",
            color:  colors.primary,
            dataEventColor: 'success',
            allDay: true
        });
    }
});
