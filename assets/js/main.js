

$(document).ready(function()
{


  $('#search_button').on('click',function(){
  $('.search_filter').addClass('search_filter_show');
  })







var navPath=window.location.pathname.split("/").pop();

var pathTarget=$('.side-nav-items a[href="'+navPath+'"]');

if (pathTarget.attr('href')=='dashboard.php') {
     $('#border1').css({'background':'#4cc0c1'})
}
else if (pathTarget.attr('href')=='interview-schedule.php') {
     $('#border2').css({'background':'#ffc333'})
}
else if (pathTarget.attr('href')=='accepted_candidate.php') {
     $('#border3').css({'background':'#8ec165'})
}
else if (pathTarget.attr('href')=='rejected_candidate.php') {
     $('#border4').css({'background':'#fb6b5b'})
}
else if (pathTarget.attr('href')=='selected_candidate.php') {
     $('#border5').css({'background':'#65bd77'})
}

$('*').on('click', function (e) {
    $('[data-toggle="popover"]').each(function () {
        if (!$(this).is(e.target) && $(this).has(e.target).length === 0) {
            $(this).popover('hide');
        }
    });
});

// sidebar-toggle-effect function
// ========================================

  $('.hamburger').on( 'click', function() {

  $( this ).toggleClass( 'hamburger-active' );
  $("#sidebar").toggleClass('sidebar_move');
  $('#sidebar span').toggleClass('span_none');
  $('.show_img').toggleClass('show_img_bg');
  $('.hide_img').toggleClass('hide_img_bg');
  $('.logo').toggleClass('logo_move');
  $("#page-content").toggleClass('fullpage-content');

});

//End sidebar-toggle-effect function
// ========================================


// checkbox-function
// ====================================

 $('.checkall').on('click',function() {

    $('.checkbox-child').prop('checked',this.checked);

 var ischecked= $(this).is(':checked');
if ( $(this).is(':checked')) {
      $('tbody tr').css('background','rgb(200, 217, 244)');
}
else if(!ischecked)  
{ 
  $('tbody tr').css('background','');
}


   
});

 $('.checkbox-child').change(function()
 {
    var ischecked= $(this).is(':checked');
if ( $(this).is(':checked')) {
      $(this).parent().parent().css('background','rgb(200, 217, 244)');
}
else if(!ischecked)  
{ 
    $(this).parent().parent().css('background','');
}


    

  var x =($('.checkbox-child').filter(':checked').length == $('.checkbox-child').length);
  $('#checkall').prop('checked',x)
 });

 // End checkbox-function
 // ==================================


// Pass Candidate id
//=======================================
 


});







    var ops = {
      html: true,
      content: function () {
        return $("#content").html();
      }
    };

    $(function () {
      $("#notification-bell").popover(ops);
       
    });

    function notifications() {
      $.ajax(
        {
          url: "getNotification.php",
          cache: "false",
          success: function (json) {
            var count = json.unreadcount;
            document.getElementById("count").innerHTML = count;
            var ap = document.getElementById("applicants");
            $('#applicants').empty();
            if(count==0){
              ap.innerHTML = "No new applicants";
            }
            for (var i = 0; i < count; i++) {
              var applicantName = document.createElement("div");
              var applicantQualification = document.createElement("div");
              var divider = document.createElement("div");
              var applicantDiv = document.createElement("div");
              applicantName.className = "text-primary";
              applicantDiv.setAttribute('data-id', json.notification[i].id);
              applicantQualification.className = "text-secondary";
              divider.className = "dropdown-divider";
              applicantName.innerHTML = json.notification[i].name;
              applicantQualification.innerHTML = json.notification[i].qualification;
              applicantDiv.appendChild(applicantName);
              applicantDiv.appendChild(applicantQualification);
              applicantDiv.appendChild(divider);
              ap.appendChild(applicantDiv);
            };
          }
        });
    };
    setInterval(notifications, 1000);
    



    $("#notification-bell").click(function () {
      // var obj = [];
      var obj = "";
       var childNum = document.getElementById('applicants').children.length;
       var children = document.getElementById('applicants').children;
       for(var i = 0; i < childNum; i++){
         if(i==0){
          obj += children[i].getAttribute('data-id').toString();  
         }
         else{
         obj += ',' + children[i].getAttribute('data-id').toString();
        }
      };
      $.ajax({
        url: 'setNotification.php',
          type : 'POST',
          data : {id: obj},
          success : function (data){
            console.log(data);
          }
      });
    })

// logout popup
var op = {
      html: true,
      content: function () {
        return $("#profile-content").html();
      }
    };

    $(function () {
      $("#profile").popover(op);

}); 




// SEARCH BOX

$(document).ready(function()
{
  $(".search_filter").keyup(function()
  {
     searchValue($(this).val());
  });

function searchValue(value)
{
  $("table tbody tr").each(function()
  {
   var found='false';

   $(this).each(function()
   {
    if($(this).text().toLowerCase().indexOf(value.toLowerCase())>=0)
    {
      found='true';
    }
    });
   if (found=='true') {
    $(this).show();
   }
   else
   {

    $(this).hide();

   }
  })
}
});

// SEARCH BOX END
   




  // Accepted candiadate 

 $(document).ready(function(){
 $('.email_button').click(function(){
  $(this).attr('disabled', 'disabled');
  var id = $(this).attr("id");
  // alert(id);
  var action = $(this).data("action");
  // alert(action);
   var  email=$(this).data("email");
   // alert(email);
  // var email_data = [];
   //    email_data.push({
   //      email: $(this).data("email")
   // });
  $.ajax({
   url:"send_mail.php",
   method:"POST",
   data:{
    email:email
  },

   beforeSend:function(){
    $('#'+id).html('Sending...');
    $('#'+id).addClass('btn-danger');
   },
   success:function(data){
    if(data = 'ok')
    {
     $('#'+id).text('Success');
     $('#'+id).removeClass('btn-danger');
     $('#'+id).removeClass('btn-info');
     $('#'+id).addClass('btn-success');
    }
    else
    {
     $('#'+id).text(data);
    }
    $('#'+id).attr('disabled', false);
   }
   
  });
 });
});




   
   






