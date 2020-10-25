<?php

require_once("./bdd/connexion.php");
require("./bdd/fonctionBDD.php");
$con = connexionBDD();



if ( !isset( $_SESSION['c'] ) ){
  echo '<script>document.location.href = \'index.php\' </script> ';
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
    <script src="js/autocomplete.js" type="text/javascript"></script>

    <script type="text/javascript">
  
  var prenomtab = new Array();

    <?php
    $i=0;

    $res = listerUser($con);

    foreach ($res as $ligne) {
      echo 'prenomtab['. $i .'] = "';
      echo $ligne['prenom'];
      echo '";';

      $i++;
    }

    ?>
</script>





    <form action="" id ="form" method="POST">
      <?php echo ' <input type="date" id ="show_date" value= "';

      $date;

      if ( isset( $_GET['date'] ) ){ $date = $_GET['date']; echo $date; } else { $date = date("Y-m-d"); echo $date;}

       echo '" name="show_date"> '; ?>
    </form>

    <p id="d"><?php echo $date; ?> </p>

    <script type="text/javascript">

      var is_ok = false;

      document.getElementById("d").innerHTML = document.querySelector('input[type="date"]').value;

      var dateControl = document.querySelector('input[type="date"]');

      setInterval(function(){

        dateControl = document.querySelector('input[type="date"]');   

        if (dateControl.value != document.getElementById("d").innerHTML)
        {
          document.location.href = 'dashboard.php?date=' + dateControl.value;
        }
      
      }, 1000);    

    </script>


<?php
$d = date("Y-m-d");

if ( isset ( $_GET['date'] ) ){
  $d = $_GET['date'];
}

$res = listerOrdinateur($con);

echo '<div class="container">';
echo '<div class="w-100 p-2 row ">';
foreach ($res as $ligne) {
  
    echo '<div class="col-4">';
    echo '<ul class="list-group">';

      echo '<li class="list-group-item d-flex  justify-content-between align-items-center active">'. $ligne['nom'] .'<button class="btn btn-danger" type="button" title="Delete"></button> </li>';
      
      for ($i=8; $i < 20; $i++) { 
        echo '<li class="list-group-item d-flex justify-content-between align-items-center">';

          echo '<span>' . $i . 'H </span>';

          if ( listerAttribuerDateOrd($con, $d, $ligne['nom'], $i) ){
            print(listerAttribuerDateOrd($con, $d, $ligne['nom'], $i)[3]);
            echo '<button class="btn btn-danger" type="button" title="Delete" data-toggle="modal" data-target="#delAttModal_' . $i .          '"></button>';

            echo '
            <div class="modal fade" id="delAttModal_'.$i.'" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
              <div class="modal-dialog" role="document">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Suppression</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
                  <div class="modal-body">
                    Etes-vous sûr ?
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-success" ';
                    
                    echo 'onclick="document.location.href = \'dashboard.php?date=';
                    echo $d;
                    echo '&h=' . $i . '&delAtt=1&ord='; echo $ligne['nom'];
                    //echo listerAtbuttontribuerDateOrd($con, $d, $ligne['nom'], $i)[3] . " '\" ";

                    echo '\'" data-dismiss="modal">Oui</button>
                    <button type="button" class="btn btn-danger">Non</button>
                  </div>
                </div>
              </div>
            </div>
          ';


          } else {
            echo '<button class="btn btn-success" value="" type="button" title="Add" data-toggle="modal" data-target="#userAdd_' . $i . '-' . $ligne['nom'] . '     ">+</button>';
          

             echo '
            <div class="modal fade" id="userAdd_'.$i. '-' . $ligne['nom'] . '" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
              <div class="modal-dialog" role="document">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Ajout</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>

                  <form autocomplete="off" action="dashboard.php?" method="get">
                    
                    <div class="modal-body">

                      <input name="h" value="'.$i.'" hidden>
                      <input name="date" value="'. $d . '" hidden>
                      <input name="ord" value="'. $ligne["nom"] . '" hidden>

                      <div class="autocomplete">
                        <input id="prenomAdd_' . $ligne['nom'] . '-' . $i . '" name="prenomAdd" type="text" placeholder="prenom">
                      </div>
                          
                    </div>
                    <div class="modal-footer">
                      <input type="submit" class="btn btn-success" value="Ajouter">
                    </div>
                  
                  </form>
                
                </div>
              </div>
            </div>
          ';
           

          echo '<script type="text/javascript"> autocomplete(document.getElementById("prenomAdd_' . $ligne['nom'] . '-' . $i .'"), prenomtab); </script>';


          }



          

        echo ' </li>';
      }

    echo '</ul>';
    echo '</div>';
  
}
echo '</div>';
echo '</div>';
?>

<style type="text/css">

.autocomplete {
  /*the container must be positioned relative:*/
  position: relative;
  display: inline-block;
}


.autocomplete-items {
  position: absolute;
  border: 1px solid #d4d4d4;
  border-bottom: none;
  border-top: none;
  z-index: 99;
  /*position the autocomplete items to be the same width as the container:*/
  top: 100%;
  left: 0;
  right: 0;
}
.autocomplete-items div {
  padding: 10px;
  cursor: pointer;
  background-color: #fff;
  border-bottom: 1px solid #d4d4d4;
}
.autocomplete-items div:hover {
  /*when hovering an item:*/
  background-color: #e9e9e9;
}
.autocomplete-active {
  /*when navigating through the items using the arrow keys:*/
  background-color: DodgerBlue !important;
  color: #ffffff;
}
</style>



<?php

    //suupr attribution

  if ( isset ( $_GET['date'] ) && isset( $_GET['h'] ) && isset( $_GET['delAtt'] ) && isset ( $_GET['ord'] ) ) {
    supprAttr( $con, $d, $_GET['h'] );
    echo '<script>document.location.href = \'dashboard.php?date=' . $d . '  \' </script> ';

  } 

    //add attr
  if ( isset ( $_GET['date'] ) && isset( $_GET['h'] ) && isset( $_GET['prenomAdd'] ) && isset ( $_GET['ord'] ) ) {
    //echo '<script>document.location.href = \'dashboard.php?date=' . $d . '  \' </script> ';
/*
    $res = listerIdClientByPrenom($con,$_GET['prenomAdd']);
    $idPrenom = $res[0][0];

    $res = listerIdOrdByNom($con,$_GET['ord']);
    $idOrd = $res[0][0];

    echo '<script>document.location.href = \'dashboard.php?date=' . $d . '  \' </script> ';
*/
    //addAttr( $con, $d, $_GET['h'], $idPrenom, $idOrd ) );
}


?>












<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>




  </body>



</html>