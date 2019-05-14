<?php
	require_once('init.php');
	if (isset($_POST['submit'])) 
	{
		$comment=$_POST['comment'];
		$sql="INSERT INTO wish(commend) values(:comment)";
		$result=$db->prepare($sql);
		
		$result->execute( array		
				(":comment"=>$comment)		
			);

	}


?>
<!DOCTYPE html>
<html>
<head>
<body>
	<form method="post">
	<input type="text" name="comment">
	<button type="submit" name="submit">submit</button>
</form>

</body>
</html>