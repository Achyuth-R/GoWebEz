$(document).ready(function() {
  $("#search_button").on("click", function() {
    $(".search_filter").addClass("search_filter_show");
  });

  var navPath = window.location.pathname.split("/").pop();

  var pathTarget = $('.side-nav-items a[href="' + navPath + '"]');

  if (pathTarget.attr("href") == "dashboard.php") {
    $("#border1").css({ background: "#4cc0c1" });
  } else if (pathTarget.attr("href") == "interview-schedule.php") {
    $("#border2").css({ background: "#ffc333" });
  } else if (pathTarget.attr("href") == "accepted_candidate.php") {
    $("#border3").css({ background: "#8ec165" });
  } else if (pathTarget.attr("href") == "rejected_candidate.php") {
    $("#border4").css({ background: "#fb6b5b" });
  } else if (pathTarget.attr("href") == "selected_candidate.php") {
    $("#border5").css({ background: "#65bd77" });
  }

  $(".tablelSectionTdUl").click(function(e) {
    e.stopPropagation();
  });

  $("#candidate_list tr").on("click", function() {
    $(this)
      .parent()
      .parent()
      .hide();

    var id = $(this).attr("data-id");
    $.ajax({
      url: "candidate_profile.php",
      type: "POST",
      data: {
        id: id
      },

      success: function(response) {
        $("#result").html(response);
        alert(data);
      }
    });
  });

  $("*").on("click", function(e) {
    $('[data-toggle="popover"]').each(function() {
      if (!$(this).is(e.target) && $(this).has(e.target).length === 0) {
        $(this).popover("hide");
      }
    });
  });

  // sidebar-toggle-effect function
  // ========================================

  $(".hamburger").on("click", function() {
    $(this).toggleClass("hamburger-active");
    $("#sidebar").toggleClass("sidebar_move");
    $("#sidebar span").toggleClass("span_none");
    $(".show_img").toggleClass("show_img_bg");
    $(".hide_img").toggleClass("hide_img_bg");
    $(".logo").toggleClass("logo_move");
    $("#page-content").toggleClass("fullpage-content");
  });

  //End sidebar-toggle-effect function
  // ========================================

  // checkbox-function
  // ====================================

  $(".checkall").on("click", function() {
    $(".checkbox-child").prop("checked", this.checked);

    var ischecked = $(this).is(":checked");
    if ($(this).is(":checked")) {
      $("tbody tr").css("background", "rgb(200, 217, 244)");
    } else if (!ischecked) {
      $("tbody tr").css("background", "");
    }
  });

  $(".checkbox-child").change(function() {
    var ischecked = $(this).is(":checked");
    if ($(this).is(":checked")) {
      $(this)
        .parent()
        .parent()
        .css("background", "rgb(200, 217, 244)");
    } else if (!ischecked) {
      $(this)
        .parent()
        .parent()
        .css("background", "");
    }

    var x =
      $(".checkbox-child").filter(":checked").length ==
      $(".checkbox-child").length;
    $("#checkall").prop("checked", x);
  });

  // End checkbox-function
  // ==================================

  // Pass Candidate id
  //=======================================
});
//===================================================================================
var notification_ops = {
  html: true,
  content: function() {
    return $("#notification-content").html();
  }
};

$(function() {
  $("#notification-bell").popover(notification_ops);
});

function notifications() {
  $.ajax({
    url: "getNotification.php",
    cache: "false",
    success: function(json) {
      var count = json.unreadcount;
      document.getElementById("notificationCount").innerHTML = count;
      var ap = document.getElementById("applicants");
      $("#applicants").empty();
      if (count == 0) {
        ap.innerHTML = "No new applicants";
      }
      for (var i = 0; i < count; i++) {
        var applicantName = document.createElement("div");
        var applicantQualification = document.createElement("div");
        var divider = document.createElement("div");
        var applicantDiv = document.createElement("div");
        applicantName.className = "text-primary";
        applicantDiv.setAttribute("data-id", json.notification[i].id);
        applicantQualification.className = "text-secondary";
        divider.className = "dropdown-divider";
        applicantName.innerHTML = json.notification[i].name;
        applicantQualification.innerHTML = json.notification[i].qualification;
        applicantDiv.appendChild(applicantName);
        applicantDiv.appendChild(applicantQualification);
        applicantDiv.appendChild(divider);
        ap.appendChild(applicantDiv);
      }
    }
  });
}
setInterval(notifications, 1000);

$("#notification-bell").click(function() {
  // var obj = [];
  var obj = "";
  var childNum = document.getElementById("applicants").children.length;
  var children = document.getElementById("applicants").children;
  for (var i = 0; i < childNum; i++) {
    if (i == 0) {
      obj += children[i].getAttribute("data-id").toString();
    } else {
      obj += "," + children[i].getAttribute("data-id").toString();
    }
  }
  $.ajax({
    url: "setNotification.php",
    type: "POST",
    data: { id: obj },
    success: function(data) {
      console.log(data);
    }
  });
});
//===================================================================================

// Logout AJAX and Popover
var profile_ops = {
  html: true,
  content: function() {
    return $("#profile-content").html();
  }
};

$(function() {
  $("#profile").popover(profile_ops);
});
//===================================================================================

// Chat AJAX and popover
var chat_ops = {
  html: true,
  content: function() {
    return $("#chat-content").html();
  }
};

$(function() {
  $("#chat").popover(chat_ops);
});

function chatsFetch() {
  var ck = $.cookie("userID");
  var uID = ck.toString();
  $.ajax({
    url: "getChats.php",
    type: "POST",
    data: { uID: uID },
    cache: "false",
    success: function(json) {
      var unreadCount = json.unreadCount;
      var chatCount = json.chatCount;
      document.getElementById("chatCount").innerHTML = unreadCount;
      var ch = document.getElementById("chats");
      $("#chats").empty();
      if (chatCount == 0) {
        ch.innerHTML = "No new interview sessions";
      } else {
        for (var i = 0; i < chatCount; i++) {
          if (json.chats[i].created_by != uID) {
            chatCreator(json.chats[i], ch);
          }
        }
      }
    }
  });
}

setInterval(chatsFetch, 1000);

function chatCreator(json, ch) {
  var title = document.createElement("div");
  var time = document.createElement("div");
  var divider = document.createElement("div");
  divider.className = "dropdown-divider";
  title.className = "text-secondary";
  time.className = "text-primary";
  title.innerHTML = json.title;
  time.innerHTML = json.start_date.substring(0, 10);
  var chatDiv = document.createElement("div");
  chatDiv.appendChild(time);
  chatDiv.appendChild(title);
  chatDiv.appendChild(divider);
  chatDiv.setAttribute("data-id", json.id);
  ch.appendChild(chatDiv);
}

$("#chat").click(function() {
  // var obj = [];
  var ck = $.cookie("userID");
  var uID = ck.toString();
  var childNum = document.getElementById("chats").children.length;
  var children = document.getElementById("chats").children;
  var eventID = "";
  for (var i = 0; i < childNum; i++) {
    eventID += children[i].getAttribute("data-id") + ",";
  }
  $.ajax({
    url: "setChats.php",
    type: "POST",
    data: { uID: uID, eventID: eventID },
    success: function(data) {
      console.log(data);
    }
  });
});

//===================================================================================

// SEARCH BOX

$(document).ready(function() {
  $(".search_filter").keyup(function() {
    searchValue($(this).val());
  });

  function searchValue(value) {
    $("table tbody tr").each(function() {
      var found = "false";

      $(this).each(function() {
        if (
          $(this)
            .text()
            .toLowerCase()
            .indexOf(value.toLowerCase()) >= 0
        ) {
          found = "true";
        }
      });
      if (found == "true") {
        $(this).show();
      } else {
        $(this).hide();
      }
    });
  }
});
//===================================================================================

// Accepted candidate Mailing AJAX

$(document).ready(function() {
  $(".email_button").click(function() {
    $(this).attr("disabled", "disabled");
    $(this).css("opacity", ".1");
    var id = $(this).attr("id");
    // alert(id);
    var action = $(this).data("action");
    // alert(action);
    // var  email=$(this).data("email");op
    // alert(email);
    var email_data = [];

    if (action == "email_single") {
      email_data.push({
        email: $(this).data("email"),
        name: $(this).data("name")
      });
    } else {
      $(".checkbox-child").each(function() {
        var ischecked = $(this).is(":checked");
        if ($(this).is(":checked")) {
          // alert('hiiii');
          email_data.push({
            email: $(this).data("email")
          });
        }
      });
    }
    console.log(email_data);
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
//===================================================================================
