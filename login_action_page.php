<?php
session_start();
require ('init.php');
?>

<?php
   $error_msg="invalid username/password";
if (isset($_POST['submit'])) {
	
	$email=$_POST['email'];
	$password=$_POST['password'];
	// echo 'success'.$email.$password;
	$sql=  $db->prepare("SELECT username,password FROM login WHERE(email=:email)");
	$sql->bindParam(':email',$email,PDO::PARAM_STR);
	$sql->execute();
	$result=$sql->fetchAll(PDO::FETCH_OBJ);


if (!empty($_POST["remember_me"]))
  {
  setcookie("eml", $_POST["email"], time() + (10 * 365 * 24 * 60 * 60));
  setcookie("pass", $_POST["password"], time() + (10 * 365 * 24 * 60 * 60));
  }
  else
  {
  if (isset($_COOKIE["eml"]))
    {
    setcookie("eml", "");
    }

  if (isset($_COOKIE["pass"]))
    {
    setcookie("pass", "");
    }
  }
      


	// print_r($result);
	if ($sql->rowCount()>0) {
		foreach ($result as $row) 
       	{
            $pass=$row->password;
        }
			if($pass == $password)
			{

			$_SESSION['email']=$_POST['email'];
			$select= "SELECT * FROM login WHERE email = '".$_SESSION['email']."' ";
			$result = $db->query($select);
			$row = $result->fetch(PDO::FETCH_OBJ);
			$_SESSION['username']=$row->username;
			$_SESSION['user_id']=$row->id;
			header('Location:dashboard.php');
			}
        else
        {
	          $_SESSION["error_msg"] =$error_msg;
              header("location:dashboard.php");
          }
	}
	else
	{
		$_SESSION["error_msg"] =$error_msg;
		header('Location:login.php');
	}


}





?>