$(document).ready(function(){

   $('#profile_close').on('click',function()
   {
        // alert('hiii');
      $(".profile").hide();
      $('#candidate_list tr').parent().parent().show();
      location.reload();
   });

   // ============================= accept tic start ============================
      $("#acceptButton").click(function(){
         $(this).removeClass("btn-outline-success");
         $(this).addClass("btn-success");
         $("#rejectButton").addClass("disabled");
      });
   // ============================= accept tic end ============================

   // =====================================================================================
   //============================= Page View in next buttons start =========================
   $(".pageOneNextBtn").click(function(){
      $("#profileApplicationAnswerFirst").hide();
      $("#profileApplicationAnswerTwo").slideToggle("slow");
   });
   $(".pageTwoNextBtn").click(function(){
      $("#profileApplicationAnswerTwo").hide();
      $("#profileApplicationAnswerThree").slideToggle("slow");
   });
   $(".pageTwoPreBtn").click(function(){
      $("#profileApplicationAnswerTwo").hide();
      $("#profileApplicationAnswerFirst").slideToggle("slow");
   });
   $(".pageThreePreBtn").click(function(){
      $("#profileApplicationAnswerThree").hide();
      $("#profileApplicationAnswerTwo").slideToggle("slow");
   });
   //============================= Page View in next buttons end=========================
   // ================================================================================



// candidate-resume
// ===============================
$('.pdfajax').click(function() {
    var resumeURL = $(this).attr("data-resume");
    window.open(resumeURL);
});
});



  $(document).ready(function()
   {
      if($("#statusFlags").attr("data-status") == "Rejected"){
         $("#rejectButton").removeClass("btn-outline-danger");
         $("#rejectButton").addClass("btn-danger");
         $("#acceptButton").attr("disabled",true);
      }

      if($("#statusFlags").attr("data-status") == "Accepted"){
         $("#acceptButton").removeClass("btn-outline-success");
         $("#acceptButton").addClass("btn-success");
         $("#rejectButton").attr("disabled",true);
      }

      $('#acceptButton').on('click',function()
      {
         var accept_id = $(this).attr('data-id');

         $.ajax({
            url: 'accept_act.php',
           type: 'POST',
           data:{accept_id:accept_id},
         
           success: function(response) {
               $('#result').html(response);
               
           }
         });
       

      });

      $('#reject-btn').on('click',function()
      {
        // alert('hiii');
         
         // Validation
         if( $("#rejectDescription").val() == "" ){
            alert("Please provide a valid reason!");
            return false;
         }

         // Reject AJAX
         var reject_id = $(this).attr('data-id');
         var reason = $("#rejectDescription").val();
         $.ajax({
            url: 'reject_act.php',
            type: 'POST',
            data:{reject_id:reject_id, reject_reason : reason},   
            success: function(response) {
               $('#result').html(response);              
            } 
         });

         // Button css change
         $("#rejectButton").removeClass("btn-outline-danger");
         $("#rejectButton").addClass("btn-danger");
         $("#acceptButton").attr("disabled",true);
      });

   });




