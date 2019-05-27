$(".email_button").click(function() {
  var action = $(this).data("action");
  var email_data = [];
  var count = 0;
  var clicked = this;
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
        count++;
      }
    });
    if (count == 0) {
      alert("No candidates selected!\n\nSelect atleast one.");
      return false;
    }
  }

  $.ajax({
    url: "selected_mail.php",
    method: "POST",
    data: {
      email_data: email_data
    },
    success: function(data) {
      console.log(data);
      $(clicked).attr("disabled", "disabled");
      $(clicked).css("opacity", ".1");
    }
  });
});
