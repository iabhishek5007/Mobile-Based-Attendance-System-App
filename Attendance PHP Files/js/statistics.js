$(document).ready(function() {
  loadGraph();
  $('.list').hide();
  $('#detained').hide();
  $('.classes').click(function() {
    $('.classes').css('font-weight','');
    if($(this).find('.list').css('display') == 'block') {
      $('.list').slideUp('fast');
    } else {
      $(this).css('font-weight','bold');
      $('.list').slideUp('fast');
      $(this).find('.list').slideDown('fast');
    }      
  });
  $('a[href=#detained]').click(function() {
    $('.wrapper .active').removeClass('active');
    $(this).parent().addClass('active');
    $('#graph').slideUp('fast',function() {
     $('#detained').show('fast');
     $('html,body').animate({ scrollTop: $('#detained').offset().top}, 500);
    });
  });
  $('a[href=#graph]').click(function() {
    $('.wrapper .active').removeClass('active');
    $(this).parent().addClass('active');
    $('#detained').slideUp('fast',function() {
     $('#graph').show('fast');
     $('html,body').animate({ scrollTop: $('#graph').offset().top}, 500);
    });
  });
});
function loadGraph() {
  totals = new Array();
  averages = new Array();
  keys = new Array();
  for(var a in data) {
    keys.push(a);
    totals.push(data[a].total);
    averages.push(data[a].average);
  }
  $('.content #graph').highcharts({
    chart: {
        type: 'column'
    },
    title: {
        text: 'Average Attendance'
    },
    xAxis: {
        categories: keys
    },
    yAxis: {
        min: 0,
        title: {
            text: 'Count of Days'
        }
    },
    plotOptions: {
        column: {
            pointPadding: 0.2,
            borderWidth: 0
        }
    },
    series: [{
        name: 'Total Days',
        data: totals

    }, {
        name: 'Average Attendance',
        data: averages

    }]
  });
}