<?php

require_once("./bdd/connexion.php");
require("./bdd/fonctionBDD.php");
$con = connexionBDD();



if ( !isset( $_SESSION['c'] ) ){

  die();
}

?>


<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link rel="stylesheet" href="css/style.css">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">

    <title>Dashboard</title>
  </head>

  <body>
    
    <form action="" id ="form" method="POST">
      <?php echo ' <input type="date" id ="show_date" value= "';

      if ( isset( $_GET['date'] ) ){ echo $_GET['date']; } else { echo date("Y-m-d") ;}

       echo '" name="show_date"> '; ?>
    </form>

    <p id="d"><?php if ( isset( $_GET['date'] ) ){ echo $_GET['date']; } else { echo date("Y-m-d") ;} ?> </p>


    <script type="text/javascript">

    document.getElementById("d").innerHTML = document.querySelector('input[type="date"]').value;


      setInterval(function(){
        var dateControl = document.querySelector('input[type="date"]');

        if (dateControl.value != document.getElementById("d").innerHTML)
        {
          document.getElementById("d").innerHTML = dateControl.value;
          document.location.href = 'dashboard.php?date=' + dateControl.value;
        }
      
      }, 1000);

    </script>


<?php

if ( isset ( $_GET['date'] ) ){
  $d = $_GET['date'];
} else {
  $d = date(Y-m-d);
}

$res = listerOrdinateur($con);

echo '<div class="container">';
echo '<div class="w-100 p-2 row ">';
foreach ($res as $ligne) {
  
  
    echo '<div class="col-4">';
    echo '<ul class="list-group">';

      echo '<li class="list-group-item active">'. $ligne['nom'] .'</li>';
      
      for ($i=8; $i < 20; $i++) { 
        echo '<li class="list-group-item">';
            echo ' <div class="row">';
              echo '<div class="col-sm" >';

                echo'<p>'. $i .'H</p>';

              
                if ( listerAttribuerDateOrd($con, $d, $ligne['nom'], $i)){
                  print('<p>' . listerAttribuerDateOrd($con, $d, $ligne['nom'], $i)[3] . '</p>' );
                }
              echo '</div>';
          echo '</div>';
        echo ' </li>';
      }

    echo '</ul>';
    echo '</div>';
  
}
echo '</div>';
echo '</div>';
?>

  </body>



</html>