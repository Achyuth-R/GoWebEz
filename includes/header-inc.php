 <?php
  ob_start();
  session_start();
  require "init.php";
  if (!isset($_SESSION['username'])) {
    header('Location:login.php');
    exit();
  }
  $username = $_SESSION['username'];
  $user_id = $_SESSION['user_id'];
  $select_session_user = "SELECT * FROM login WHERE email = '" . $_SESSION['email'] . "' ";
  $result = $db->query($select_session_user);
  $row = $result->fetch(PDO::FETCH_OBJ);
  $position = $row->position;
  ?>
 <!-- <!DOCTYPE html> -->
 <html>

 <head>
   <title>GoWebEz Application</title>
   <meta charset="utf-8">
   <meta name="viewport" content="width=device-width, initial-scale=1">
   <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.4.0/fullcalendar.css" />
   <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
   <script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
   <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.18.1/moment.min.js"></script>
   <script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.4.0/fullcalendar.min.js"></script>
   <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
   <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
   <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css" />
   <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-cookie/1.4.1/jquery.cookie.js"></script>

   <link rel="stylesheet" type="text/css" href="assets/css/style.css">

   <link rel="stylesheet" type="text/css" href="assets/css/candidatelist-syle.css">
   <link rel="stylesheet" type="text/css" href="assets/css/candidate_profile.css">
   <link rel="stylesheet" type="text/css" href="assets/css/header-notification.css">
   <link rel="stylesheet" type="text/css" href="assets/css/accepted.css">
   <link rel="stylesheet" type="text/css" href="assets/css/rejected.css">

   <!-- font-awesome-icon -->
   <!-- =============================== -->

   <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous" />

   <link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
 </head>

 <body>


   <header class="site-header">
     <nav class="navbar default-cursor navbar-expand-lg">
       <a class="navbar-brand logo" href="">
         <center><img src="assets/images/gowebezlogo.png" class="img-fluid show_img" alt="company-logo"></center>
         <center><img src="assets/images/index.png" class="img-fluid hide_img" alt="company-logo"></center>
       </a>
       <div class="hamburgers">

         <button class="hamburger h-2">
           <span></span>
           <span></span>
           <span></span>
         </button>

       </div>

       <ul class="navbar-nav ml-auto mr-md-2 mt-lg-0 ">
         <li>
           <input type="text" name="" placeholder="search" class="search_filter">
           <i class="fa fa-search" id="search_button" aria-hidden="true" style="margin-left:-40px;font-size:25px;"></i></li>
         <?php
          if ($_SESSION['position'] == 'admin') {
            ?>
           <li class="mr-3 "><a id="notification-bell" class="btn btn-default pointer-cursor" data-container="body" data-toggle="popover" data-placement="left">
               <span class="fa-xs fa-stack"><i class="fas fa-xs fa-bell fa-stack-2x"></i><span id="notificationCount" class="fa-stack-1x fa-sm fa-inverse"></span></span>
             </a></li>
         <?php
        }
        ?>
         <li class="mr-3 "><a id="chat" class="btn btn-default pointer-cursor" data-container="body" data-toggle="popover" data-placement="bottom">
             <span class="fa-xs fa-stack"><i style="color: #003170" class="fas fa-xs fa-comment fa-stack-2x"></i><span id="chatCount" class="fa-stack-1x fa-sm fa-inverse"></span></span>
           </a></li>

         <li class="mr-3">
           <div class="profile  d-flex justify-content-center" id="profile" data-container="body" data-toggle="popover" data-placement="bottom" height="50px"><span class="align-self-center">
               <?php
                $firstLetter = substr($username, 0, 1);
                echo $firstLetter;
                ?>
             </span></div>
         </li>
         <div id="profile-content">
           <div class="profile-body-content text-center">
             <h6 class="text-uppercase default-cursor"><?php echo $username; ?></h6>
             <a href="logout.php" type="button" class="btn btn-danger text-center text-white">Logout</a>
           </div>

         </div>


       </ul>
     </nav>

     <div id="notification-content">
       <p class="text-danger text-center default-cursor notif-header">New Applicants</p>
       <div class="dropdown-divider"></div>
       <div class="innerbody">
         <div id="applicants" class="pointer-cursor">
         </div>
       </div>
     </div>

     <div id="chat-content">
       <p class="text-danger text-center default-cursor notif-header">Interview Schedule</p>
       <div class="dropdown-divider"></div>
       <div class="innerbody">
         <div id="chats" class="pointer-cursor">
         </div>
       </div>
     </div>
   </header>


   <?php
    require_once 'includes/sidebar.inc.php';
    require_once 'includes/footer.inc.php';
    ?>

   <main id="page-content">