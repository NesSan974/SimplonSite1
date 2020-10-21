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
  		<?php echo ' <input type="date" id ="show_date" value= "' . date("Y-m-d") . '" name="show_date"> '; ?>
  		<input type="button" name="suiv" onclick="btn()" value="suivant">
  	</form>

  	<script type="text/javascript">

  		var dateControl = document.querySelector('input[type="date"]');
  		document.write = dateControl.value;
  		var newDate;

  		for (var i = 0 ; i >= 8; i++) {
  			var newDate = newDate + dateControl.value[i];
  		}

  		document.write(newDate.value);
  		document.write(dateControl.value);
		dateControl.value = '2017-06-01';

  	</script>

<!---

  	<script type="text/javascript">
  		let form = document.createElement('form');
		form.action = '';
		form.method = 'POST';

		form.innerHTML = '<input type="date" name="show_date" value="2020-01-30">';

		// the form must be in the document to submit it
		document.body.append(form);

		//form.submit();
  	</script>





  	<script src="js/jquery.js" type="text/javascript"></script>

  	<script type="text/javascript"></script>
--->

  </body>



</html>

