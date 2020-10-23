<?php

require_once("./bdd/connexion.php");
require("./bdd/fonctionBDD.php");
$con = connexionBDD();


if (isset($_SESSION['c'])){
	echo '<script>document.location.href = \'dashboard.php\' </script> ';
	die();
}

?>



<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    
    <link rel="stylesheet" href=css/style.css>

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">

    <title>Connexion</title>
  </head>
  <body>

  <div class="connexion">
    <form method="POST" action="">
  <div class="form-group">
    <label for="exampleInputEmail1">Email address</label>
    <input type="email" name="P_mail" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter email">
    <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
  </div>
  <div class="form-group">
    <label for="exampleInputPassword1">Password</label>
    <input type="password" name="P_pass" class="form-control" id="exampleInputPassword1" placeholder="Password">
  </div>
  <div class="form-check">
    <input type="checkbox" class="form-check-input" id="exampleCheck1">
    <label class="form-check-label" for="exampleCheck1">Check me out</label>
  </div>
  <button type="submit" class="btn btn-primary">Submit</button>
</form>
  </div>

	<?php
	if ( ( isset($_POST['P_mail']) && trim( $_POST['P_mail'] ) != '' ) && ( isset($_POST['P_pass']) && trim ( $_POST['P_pass'] ) != '' ) ) {
		
		$_SESSION['c'] = hash("sha256", "non");

		$res = listerConnexionByPass($con, $_POST['P_pass'], $_POST['P_mail']);
		// echo $s;



		if ($res->rowCount () == 1) {
			$_SESSION['c'] = hash("sha256", "oui");
			echo '<script>document.location.href = \'dashboard.php\' </script> ';
			echo "oui";
		}else{
			session_destroy();
			echo '<script>document.location.href = \'index.php\' </script> ';
		}
	}
	
	?>


</body>
</html>