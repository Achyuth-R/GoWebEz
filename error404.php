<? php
    header($_SERVER["SERVER_PROTOCOL"]."404 Not Found");
?>

<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>404</title>
	<link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet"> 
	<link type="text/css" rel="stylesheet" href="assets/css/error.css" />
</head>

<body>
    <style>
        body{
            background-color: #003170;
        }
        .notfound-404
        {
            background-color: #003170;   
        }
    </style>
    <div id="circle-right"></div>
    <div id= "circle-left"></div>
	<div id="notfound">
		<div class="notfound">
			<div class="notfound-404">
				<h1>Oops!</h1>
				<h2>404 - The Page can't be found</h2>
			</div>
			<a href="login.php">Go TO Homepage</a>
		</div>
	</div>
</body>
</html>
