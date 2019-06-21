$(document).ready(function() {
  if(gup('roll') && gup('code') && gup('year') && gup('section')) {
    $("#getAttendance select[name=year]").val(gup('year'));
    $("#getAttendance select[name=section]").val(gup('section'));
    $("#getAttendance input[name=code]").val(gup('code'));
    $("#getAttendance input[name=roll]").val(gup('roll').replace(/-/g,"/"));
    getAttendance();
  }
  $('#getAttendance').submit(function() {
    getAttendance();
    return false;
  });
});
function getAttendance() {
  var data = getFormElements('#getAttendance');
  var check = 0;
  jQuery.each(data,function(k,v) {
    if(v == '') {
      check++;
    }
  });
  if(check) {
    $('#output').html("<h2> Fill all details! </h2>");
    return;
  }
  $.ajax({
    url : 'php/get_attendance.php',
    type : 'post',
    data : data,
    dataType : 'json',
    success : function(r) {
      console.log(r);
      if(r.error == 'NO_RECORD') {
        $('#output').html('<h2> No records found for this class!</h2>');
        return;
      } else if(r.error == 'NOT_IN_RECORDS') {
        $('#output').html('<h2> This roll number doesn\'t belong to this class! </h2>');
        return;
      } else if(r.error == 'DB_ERROR') {
        $('#output').html('<h2> We are facing issues at backend! </h2>');
        return;
      } else { 
        $('#output').html("<h1> Teacher : "+r.teacher+"</h1><h4>Subject : "+$('input[name="code"]').val()+"</h4><h4>Total Classes : "+r.count+"</h4><div id='chart'></div><div id='pie'></div>");
        generateGraph(r.timeline);
        $('#pie').html('<h2>Percent : </h2> <input class="knob" value="'+(Math.floor(r.percent))+'" data-readonly="true" data-thickness=".4" readonly="readonly" data-width="150" data-height="150" data-angleOffset=180 data-fgColor="#87AB66" data-bgColor="#E1EAD9">');
        loadKnob();
        return;
      }
    },
    error : function(r) {
      console.log(r);
    }
  });
}
function getFormElements(formID) {
  var data = {};
  $(formID+' input,'+formID+' select,'+formID+' textarea').each(function(k,v) {
    data[$(this).attr('name')] = $(this).val();
  });
  return data;
}
function generateGraph(data) {
 $('#chart').highcharts({ 
  chart : { type: 'column'},
  title: { text: 'Attendance Tracker', x: -20}, 
  subtitle: { text: '', x: -20 }, 
  xAxis: {  gridLineWidth :0, title : 'Dates' , categories: $.map(data, function(v,k) {return new Date(1000*k).toDateString();})},
  yAxis: {
  gridLineWidth :0,
  title: { text: 'Presence' }
  }, 
  legend: { layout: 'vertical',align: 'middle',verticalAlign: 'middle',borderWidth: 0 },
  series: [{ name: 'Presence', data: $.map(data, function(v,k) {return v;}) ,color: '#D10057'}] 
  }); 
}
function gup( name ){
  name = name.replace(/[\[]/,"\\\[").replace(/[\]]/,"\\\]");
  var regexS = "[\\?&]"+name+"=([^&#]*)";
  var regex = new RegExp( regexS );
  var results = regex.exec( window.location.href );
  if( results == null )
    return "";
  else
    return results[1];
}