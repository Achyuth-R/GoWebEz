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
        <div class="container">
          <div class="row">
            <div class="col-sm">
              <select class="custom-select custom-select-lg mb-3" id="startTime">
                <option selected>Start time</option>
                <option value="1">1</option>
                <option value="2">2</option>
                <option value="3">3</option>
                <option value="4">4</option>
                <option value="5">5</option>
                <option value="6">6</option>
                <option value="7">7</option>
                <option value="8">8</option>
                <option value="9">9</option>
                <option value="10">10</option>
                <option value="11">11</option>
                <option value="12">12</option>
                <option value="13">13</option>
                <option value="14">14</option>
                <option value="15">15</option>
                <option value="16">16</option>
                <option value="17">17</option>
                <option value="18">18</option>
                <option value="19">19</option>
                <option value="20">20</option>
                <option value="21">21</option>
                <option value="22">22</option>
                <option value="23">23</option>
                <option value="24">24</option>
              </select>
            </div>
            <div class="col-sm">
              <select class="custom-select custom-select-lg mb-3" id="endTime">
                <option selected>Start time</option>
                <option value="1">1</option>
                <option value="2">2</option>
                <option value="3">3</option>
                <option value="4">4</option>
                <option value="5">5</option>
                <option value="6">6</option>
                <option value="7">7</option>
                <option value="8">8</option>
                <option value="9">9</option>
                <option value="10">10</option>
                <option value="11">11</option>
                <option value="12">12</option>
                <option value="13">13</option>
                <option value="14">14</option>
                <option value="15">15</option>
                <option value="16">16</option>
                <option value="17">17</option>
                <option value="18">18</option>
                <option value="19">19</option>
                <option value="20">20</option>
                <option value="21">21</option>
                <option value="22">22</option>
                <option value="23">23</option>
                <option value="24">24</option>
              </select>
            </div>
          </div>
        </div>

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" id="schedule-trigger" class="btn btn-primary">Save changes</button>
      </div>
    </div>
  </div>
</div>


<script>
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
      select: function(start, end, allDay) {
        $("#scheduleModal").modal("show");


        var title = $("#comment").val();
        var startTime = $("#startTime").val();
        var endTime = $("#endTime").val();

        var start = $.fullCalendar.formatDate(start, "Y-MM-DD HH:mm:ss");
        var end = $.fullCalendar.formatDate(end, "Y-MM-DD HH:mm:ss");

        $.ajax({
          url: "insert.php",
          type: "POST",
          data: {
            title: title,
            start: start,
            end: end,
            startTime: startTime,
            endTime: endTime
          },
          success: function(data) {
            calendar.fullCalendar('refetchEvents');
            $("#schedule-trigger").toggleClass("clickeds");
            $("#scheduleModal").modal("hide");
            alert("Added Successfully");
          }
        })
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
          success: function() {
            calendar.fullCalendar('refetchEvents');
            alert('Event Update');
          }
        })
      },

      eventDrop: function(event) {
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
          success: function() {
            calendar.fullCalendar('refetchEvents');
            alert("Event Updated");
          }
        });
      },

      eventClick: function(event) {
        if (confirm("Are you sure you want to remove it?")) {
          var id = event.id;
          $.ajax({
            url: "delete.php",
            type: "POST",
            data: {
              id: id
            },
            success: function() {
              calendar.fullCalendar('refetchEvents');
              alert("Event Removed");
            }
          })
        }
      },

    });
  });
</script>