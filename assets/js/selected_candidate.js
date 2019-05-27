$(".email_button").click(function() {
  $(this).attr("disabled", "disabled");
  $(this).css("opacity", ".1");
  var action = $(this).data("action");
  var email_data = [];
  if (action == "email_single") {
    email_data.push({
      email: $(this).data("email"),
      name: $(this).data("name")
    });
  } else {
    $(".checkbox-child").each(function() {
      if ($(this).is(":checked")) {
        email_data.push({
          email: $(this).data("email"),
          name: $(this).data("name")
        });
      }
    });
  }

  $.ajax({
    url: "selected_mail.php",
    method: "POST",
    data: {
      email_data: email_data
    },
    success: function(data) {
      console.log(data);
    }
  });
});
