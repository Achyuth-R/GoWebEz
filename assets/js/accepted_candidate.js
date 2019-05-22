$(".select").click(function(s) {
  var select_id = $(this).data("id");
  $.ajax({
    type: "POST",
    url: "select_act.php",
    data: {
      select_id: select_id
    },
    success: function(data) {
      location.reload();
    }
  });
});

$(".reject_button").click(function() {
  var id = $("#rejectDescription").data("id");
  var reason = $("#rejectDescription").val();

  $.ajax({
    type: "POST",
    url: "reject_act.php",
    data: {
      reject_id: id,
      reject_reason: reason
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
