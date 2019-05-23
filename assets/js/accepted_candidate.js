$(".select").click(function(s) {
  var select_id = $(this).data("id");
  var action_by = $.cookie("userID");
  $.ajax({
    type: "POST",
    url: "select_act.php",
    data: {
      select_id: select_id,
      action_by: action_by
    },
    success: function(data) {
      location.reload();
    }
  });
});

$(".reject_button").click(function() {
  var id = $("#rejectDescription").data("id");
  var reason = $("#rejectDescription").val();
  var action_by = $.cookie("userID");
  $.ajax({
    type: "POST",
    url: "reject_act.php",
    data: {
      reject_id: id,
      reject_reason: reason,
      action_by: action_by
    },
    success: function(data) {
      console.log("Done Boy");
      location.reload();
    }
  });
});

$(".rejectButton").click(function() {
  var id = $(this).data("id");
  $("#rejectDescription").data("id", id);
});

$(document).ready(function() {
  $(".email_button").click(function() {
    if ($("#eventID").val() == "notSelected") {
      alert("Please select a valid interview slot!");
      return false;
    }
    $(this).attr("disabled", "disabled");
    $(this).css("opacity", ".1");
    var id = $(this).attr("id");
    var action = $(this).data("action");
    var email_data = [];

    if (action == "email_single") {
      email_data.push({
        email: $(this).data("email"),
        name: $(this).data("name"),
        eventID: $("#eventID").val()
      });
    } else {
      $(".checkbox-child").each(function() {
        if ($(this).is(":checked")) {
          email_data.push({
            email: $(this).data("email"),
            name: $(this).data("name"),
            eventID: $("#eventID").val()
          });
        }
      });
    }
    $.ajax({
      url: "send_mail.php",
      method: "POST",
      data: {
        email_data: email_data
      },
      success: function(data) {
        console.log(data);
      }
    });
  });
});
