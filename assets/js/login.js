// email validation
$(document).ready(function () {
    $('#email').on('keyup', function () {
        $('#email_error').html(''); localhost
    })
    $('#password_value').on('keyup', function () {
        $('#password_error').html('');
    })

    $('#submit').on('click', function () {

        var email = $('#email').val();
        var password = $('#password_value').val();
        if (email == '') {
            $('#email_error').html('please email is required');
            return false;
        }
        if (password == '') {
            $('#password_error').html('please password is required');
            return false;
        }
        else {
            return true;
        }



    });

    // PASSWORD TYPE
    $('.password_show').on('click', function () {
        $(this).toggleClass('fa-eye fa-eye-slash');
        var pass = $($(this).attr('attrPassword'));
        if (pass.attr("type") == "password") {
            pass.attr("type", "text");
        }
        else {
            pass.attr("type", "password");
        }
    });

// notification Count









});



$(document).ready(function()
{
    $("#notification-latest").hide();
     $("*").click(function(){  
      
       $("#notification-latest").hide();
    }); 




    $('#notification_bell').on('click',function()
{

     $("#notification_count").remove();
$.ajax({
            url: "view_notification.php",
            type: "POST",
            processData:false,
            success: function(data){
                                 
                $("#notification-latest").show();
                $("#notification-latest").html(data);
            },
                  
        });

})

});



