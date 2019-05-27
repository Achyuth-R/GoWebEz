<?php
require_once 'init.php';
require_once 'includes/header-inc.php';
?>
<style>
.fc-today {
    background: #fb6b5b !important;
    opacity: 0.4;
}
</style>
<h2 align="center"><a href="#"></a></h2>
<br />
<div class="container" style="overflow:scroll;width:80%;
  height:500px;">
  <div id="calendar"></div>
</div>

<div class="modal fade" id="scheduleModal" tabindex="-1" role="dialog" aria-labelledby="scheduleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Schedule Timings</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="input-group mb-3">
          <div class="input-group-prepend">
            <span class="input-group-text" id="basic-addon3">Comment</span>
          </div>
          <input type="text" id="comment" class="form-control" aria-label="Comment" aria-describedby="basic-addon1">
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" id="delete-trigger" data-dismiss="modal">Delete</button>
        <button type="button" id="schedule-trigger" class="btn btn-primary">Save changes</button>
      </div>
    </div>
  </div>
</div>

<script>
  $("#schedule-trigger").click(function() {
    var title = $("#comment").val();
    var start = $('#comment').data('dataStart');
    var end = $('#comment').data('dataEnd');
    var id = $('#comment').data('dataID');
    var uID = $.cookie("userID").toString();
    if (id) {
      $.ajax({
        url: "update.php",
        type: "POST",
        data: {
          title: title,
          start: start,
          end: end,
          id: id,
          uID: uID
        },
        success: function() {
          $("#scheduleModal").modal("hide");
          $("#calendar").fullCalendar('refetchEvents');
          toastr.info("Event updated!");
        }
      });
    } else {
      var uID = $.cookie("userID").toString();
      $.ajax({
        url: "insert.php",
        type: "POST",
        data: {
          title: title,
          start: start,
          end: end,
          uID: uID
        },
        success: function() {
          $("#scheduleModal").modal("hide");
          $("#calendar").fullCalendar('refetchEvents');
          toastr.success("Event created!");
        }
      });
    }
  });

  $(document).ready(function() {
    var calendar = $('#calendar').fullCalendar({
      editable: true,
      header: {
        left: 'prev,next today',
        center: 'title',
        right: 'month,agendaWeek,agendaDay'
      },
      events: 'load.php',
      selectable: true,
      selectHelper: true,
      duration: {
        default: '01.00'
      },
      select: function(start) {

        if (start.isBefore(moment().startOf('day'))) {
              $('#calendar').fullCalendar('unselect');
              return false;
            }
            else {
              $('#comment').val('');
              $("#scheduleModal").modal("show");
              var start = $.fullCalendar.formatDate(start, "Y-MM-DD HH:mm:ss");
              $('#comment').data('dataStart', start);
              $('#comment').removeData('dataID');
              $('#comment').removeData('dataEnd');
            } 
      },
      editable: true,
      eventResize: function(event) {
        var uID = $.cookie("userID").toString();
        var start = $.fullCalendar.formatDate(event.start, "Y-MM-DD HH:mm:ss");
        var end = $.fullCalendar.formatDate(event.end, "Y-MM-DD HH:mm:ss");
        var title = event.title;
        var id = event.id;
        $.ajax({
          url: "update.php",
          type: "POST",
          data: {
            title: title,
            start: start,
            end: end,
            id: id,
            uID: uID
          },
          success: function() {
            calendar.fullCalendar('refetchEvents');
            toastr.info("Event upadted!");
          }
        })
      },
      eventDrop: function(event) {
        var uID = $.cookie("userID").toString();
        var start = $.fullCalendar.formatDate(event.start, "Y-MM-DD HH:mm:ss");
        var title = event.title;
        var id = event.id;
        if (event.end) {
          var end = $.fullCalendar.formatDate(event.end, "Y-MM-DD HH:mm:ss");
        } else {
          var end = $.fullCalendar.formatDate(event.start, "Y-MM-DD HH:mm:ss");
        }
        $.ajax({
          url: "update.php",
          type: "POST",
          data: {
            title: title,
            start: start,
            end: end,
            id: id,
            uID: uID
          },
          success: function(data) {
            console.log(data);
            calendar.fullCalendar('refetchEvents');
            toastr.info("Event upadted!");
          }
        });
      },

      eventClick: function(event) {
        $("#scheduleModal").modal("show");
        var start = $.fullCalendar.formatDate(event.start, "Y-MM-DD HH:mm:ss");
        if (event.end) {
          var end = $.fullCalendar.formatDate(event.end, "Y-MM-DD HH:mm:ss");
        } else {
          var end = start;
        }
        var id = event.id;
        $('#comment').data('dataID', id);
        $('#comment').data('dataEnd', end);
        $('#comment').data('dataStart', start);
        $('#comment').val(event.title);
      },
    });
  });

  $("#delete-trigger").click(function() {
    var id = $("#comment").data("dataID");
    $.ajax({
      url: "delete.php",
      type: "POST",
      data: {
        id: id
      },
      success: function() {
        $("#calendar").fullCalendar('refetchEvents');
        toastr.error("Event deleted!");
        $("#scheduleModal").modal("hide");
      }
    })
  });
</script>