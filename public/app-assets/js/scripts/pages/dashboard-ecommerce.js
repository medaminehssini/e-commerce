/*=========================================================================================
    File Name: dashboard-ecommerce.js
    Description: dashboard ecommerce page content with Apexchart Examples
    ----------------------------------------------------------------------------------------
    Item Name: Vuexy  - Vuejs, HTML & Laravel Admin Dashboard Template
    Author: PIXINVENT
    Author URL: http://www.themeforest.net/user/pixinvent
==========================================================================================*/

$(window).on("load", function () {

  var $primary = '#7367F0';
  var $success = '#28C76F';
  var $danger = '#EA5455';
  var $warning = '#FF9F43';
  var $info = '#00cfe8';
  var $primary_light = '#A9A2F6';
  var $danger_light = '#f29292';
  var $success_light = '#55DD92';
  var $warning_light = '#ffc085';
  var $info_light = '#1fcadb';
  var $strok_color = '#b9c3cd';
  var $label_color = '#e7e7e7';
  var $white = '#fff';




  // Line Area Chart - 2
  // ----------------------------------

  


  // Line Area Chart - 3
  // ----------------------------------



  // Line Area Chart - 4
  // ----------------------------------




  // Goal Overview  Chart
  // -----------------------------

  var goalChartoptions = {
    chart: {
      height: 250,
      type: 'radialBar',
      sparkline: {
        enabled: true,
      },
      dropShadow: {
        enabled: true,
        blur: 3,
        left: 1,
        top: 1,
        opacity: 0.1
      },
    },
    colors: [$success],
    plotOptions: {
      radialBar: {
        size: 110,
        startAngle: -150,
        endAngle: 150,
        hollow: {
          size: '77%',
        },
        track: {
          background: $strok_color,
          strokeWidth: '50%',
        },
        dataLabels: {
          name: {
            show: false
          },
          value: {
            offsetY: 18,
            color: '#99a2ac',
            fontSize: '4rem'
          }
        }
      }
    },
    fill: {
      type: 'gradient',
      gradient: {
        shade: 'dark',
        type: 'horizontal',
        shadeIntensity: 0.5,
        gradientToColors: ['#00b5b5'],
        inverseColors: true,
        opacityFrom: 1,
        opacityTo: 1,
        stops: [0, 100]
      },
    },
    series: [83],
    stroke: {
      lineCap: 'round'
    },

  }

  var goalChart = new ApexCharts(
    document.querySelector("#goal-overview-chart"),
    goalChartoptions
  );

  goalChart.render();

  // Client Retention Chart
  // ----------------------------------

  

  // Session Chart
  // ----------------------------------

  var sessionChartoptions = {
    chart: {
      type: 'donut',
      height: 325,
      toolbar: {
        show: false
      }
    },
    dataLabels: {
      enabled: false
    },
    series: [58.6, 34.9, 6.5],
    legend: { show: false },
    comparedResult: [2, -3, 8],
    labels: ['Desktop', 'Mobile', 'Tablet'],
    stroke: { width: 0 },
    colors: [$primary, $warning, $danger],
    fill: {
      type: 'gradient',
      gradient: {
        gradientToColors: [$primary_light, $warning_light, $danger_light]
      }
    }
  }

  var sessionChart = new ApexCharts(
    document.querySelector("#session-chart"),
    sessionChartoptions
  );

  sessionChart.render();

  // Customer Chart
  // -----------------------------

  

});


// Chat Application
(function ($) {
  "use strict";
  // Chat area
  if ($('.chat-application .user-chats').length > 0) {
    var chat_user = new PerfectScrollbar(".user-chats", { wheelPropagation: false });
  }

})(jQuery);

