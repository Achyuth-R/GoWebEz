<?php
require_once 'init.php';
require_once 'includes/header-inc.php';
?>

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
    $.ajax({
      url: "insert.php",
      type: "POST",
      data: {
        title: title,
        start: start,
        end: end,
      },
      success: function() {
        $("#scheduleModal").modal("hide");
        $("#calendar").fullCalendar('refetchEvents');
        toastr.error("Event created!");
      }
    })
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
        $("#scheduleModal").modal("show");
        var start = $.fullCalendar.formatDate(start, "Y-MM-DD HH:mm:ss");
        $('#comment').data('dataStart', start);
      },
      editable: true,
      eventResize: function(event) {
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
            id: id
          },
          success: function() {}
        })
      },

      eventDrop: function(event) {
        var start = $.fullCalendar.formatDate(event.start, "Y-MM-DD HH:mm:ss");
        var title = event.title;
        var id = event.id;
        $.ajax({
          url: "update.php",
          type: "POST",
          data: {
            title: title,
            start: start,
            end: end,
            id: id
          },
          success: function() {
            calendar.fullCalendar('refetchEvents');
          }
        });
      },

      eventClick: function(event) {
        $("#scheduleModal").modal("show");
        var start = $.fullCalendar.formatDate(event.start, "Y-MM-DD HH:mm:ss");
        var id = event.id;
        $('#comment').data('dataID', id);
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
        $("#scheduleModal").modal("hide");
      }
    })
  });
</script>