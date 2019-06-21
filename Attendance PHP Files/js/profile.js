function verify(type,input) {
  var regexes = {'email':/^([\S]+)@([\S]+)\.([\S]+)$/,'phone':/^[0-9]{10}$/,'code':/^([a-zA-Z]{3})\-([0-9]{3})$/,'roll':/^([0-9]{3})\/([a-zA-z]{2})\/([0-9]{2})$/,'name':/^[a-zA-Z \']+$/,'num':/^[0-9]+$/};
  return ((input.match(regexes[type]) == null)? false:true);
}
$(document).ready(function() {
  $('.update-profile').hide();
  $('.update-profile').click(function() {
    updateProfile($(this));
  });
  $('input[name=name],input[name=phone],input[name=email]').on('keyup',function() {
    $('.update-profile').slideDown('fast');
  });
});
function updateProfile(a) {
  var name = $('input[name=name]').val() == null?'':$('input[name=name]').val();
  var phone = $('input[name=phone]').val() == null?'':$('input[name=phone]').val();
  var email = $('input[name=email]').val() == null?'':$('input[name=email]').val();
  
  if(!verify('name',name)) {
    alert("Invalid Name!");
    return;
  }
  if(!verify('phone',phone)) {
    alert("Invalid Phone!");
    return;
  }
  if(!verify('email',email)) {
    alert("Invalid Email!");
    return;
  }
  $.ajax({
    url : 'php/update_profile.php',
    type : 'post',
    data : {name:name,phone:phone,email:email},
    dataType : 'json',
    success : function(r) {
      switch(r.error) {
        case 'phone' : alert("Invalid Phone!"); break;
        case 'email' : alert("Invalid Email!"); break;
        case 'name' : alert("Invalid Name!"); break;
        case 'exists' : alert("This email id is already in use!"); break;
        case 'none' : a.html('Saved!'); setTimeout(function() { window.location = ""; },500); break;
        case 'not_found' : case 'failure' : 
        alert("We are facing some troubles at out server side. Logging you out for security");
        window.location = "logout.php";
      }
    }  
  });
}