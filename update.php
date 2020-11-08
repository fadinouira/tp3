<?php 
if (isset($_POST['add'])) {
	$id = $_POST['id'];
	$name =  $_POST['name'];
	$prename = $_POST['prename'];
	$bd =  $_POST['bd'];
	$ad = $_POST['ad'];

  
	if (empty($id)) {
		$e1 =  "all champs are required";
	}
	else {$e1 = "" ;}
	if (empty($name)) {
		$e2 =  "all champs are required";
	}
	else {$e2 = "" ;}
	if (empty($prename)) {
		$e3 =  "all champs are required";
	}
	else {$e3 = "" ;}
	if (empty($bd)) {
		$e4 =  "all champs are required";
	}
	else {$e4 = "" ;}
	if (empty($ad)) {
		$e5 =  "all champs are required";
	}
	else {$e5 = "" ;}
  
	if (($e1 == $e2) AND ($e2 == $e3) AND ($e3 == $e4) AND ($e4 == $e5) AND ($e5 ==  "")) {
		try {
			$dbh = new PDO('mysql:host=localhost;dbname=tp', "fedi", "root");
			$sth = $dbh->prepare('INSERT INTO employee (id, name, prename, DN, DA)
			VALUES (:id, :name, :prename,:bd,:ad);') ;
			$sth->bindValue(':id', $id);
			$sth->bindValue(':name', $name);
			$sth->bindValue(':prename', $prename);
			$sth->bindValue(':bd', $bd);
			$sth->bindValue(':ad', $ad);

			$sth->execute();
			
			$dbh = null;

			$id=  $name =  $prename = $bd = $ad = "" ;
			
			
		} catch (PDOException $e) {
			print "Erreur !: " . $e->getMessage() . "<br/>";
			die();
		}
	
		
	}
  }


  if (isset($_POST['edit'])) {
	$id = $_POST['id2'];
	$name =  $_POST['name2'];
	$prename = $_POST['prename2'];
	$bd =  $_POST['bd2'];
	$ad = $_POST['ad2'];

		$dbh = new PDO('mysql:host=localhost;dbname=tp', "fedi", "root");


	if (!empty($id)) {
		if (!empty($name)) {
			$sth = $dbh->prepare('UPDATE employee SET name = :v where id = :id') ;
			$sth->bindValue(':id', $id);
			$sth->bindValue(':v', $name);
			$sth->execute();
		}
		if (!empty($prename)) {
			$sth = $dbh->prepare('UPDATE employee SET prename = :v where id = :id') ;
			$sth->bindValue(':id', $id);
			$sth->bindValue(':v', $prename);
			$sth->execute();
	
		}
		if (!empty($bd)) {
			$sth = $dbh->prepare('UPDATE employee SET DN = :v where id = :id') ;
			$sth->bindValue(':id', $id);
			$sth->bindValue(':v', $bd);
			$sth->execute();
	
		}
		if (!empty($ad)) {
			$sth = $dbh->prepare('UPDATE employee SET DA = :v where id = :id') ;
			$sth->bindValue(':v', $ad);
			$sth->execute();
	
		}
		
	}
	
  
	
}

if (isset($_POST['delete'])) {
	$id = $_POST['id3'];
	

		$dbh = new PDO('mysql:host=localhost;dbname=tp', "fedi", "root");
		

	if (!empty($id)) {
		
			$sth = $dbh->prepare('DELETE FROM employee where id = :id') ;
			$sth->bindValue(':id', $id);
			$sth->execute();
		
	}
	
  
	
}



?>




<!DOCTYPE html>
<html>
<head>
  <title>Update</title>
  <link rel="stylesheet" href="style.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
</head>
<body>
  <div class="header">
  	<h2>Add New</h2>
  </div>
	
  <form method="post" action="update.php" name="add">
  	<div class="input-group">
		<label>ID </label>
		<label style="color : red ;"><?php echo $e1; ?></label>
  	  <input type="number" name="id" value="<?php echo $id; ?>">
  	</div>
  	<div class="input-group">
  	  	<label>Name</label>
		<label style="color : red ;"><?php echo $e2; ?></label>

  	  <input type="text" name="name" value="<?php echo $name; ?>">
  	</div>
  	<div class="input-group">
  	  	<label>Prename</label>
		<label style="color : red ;"><?php echo $e3; ?></label>

  	  <input type="text" name="prename" value="<?php echo $prename; ?>">
  	</div>
  	<div class="input-group">
  	  <label>Birth Date</label>
		<label style="color : red ;"><?php echo $e4; ?></label>

  	  <input type="date" name="bd">
	</div>
	<div class="input-group">
  	  <label>Arrival Date</label>
		<label style="color : red ;"><?php echo $e5; ?></label>

  	  <input type="date" name="ad">
  	</div>
  	<div class="input-group">
  	  <button type="submit" class="btn" name="add">Add</button>
  	</div>
  </form>

  <br>
  <br>

  <div class="header">
  	<h2>Edit By ID</h2>
  </div>
	
  <form method="post" action="update.php" name="edit">
  	<div class="input-group">
  	  <label>ID</label>
  	  <input type="number" name="id2" value="<?php echo $id; ?>">
  	</div>
  	<div class="input-group">
  	  <label>Name</label>
  	  <input type="text" name="name2" value="<?php echo $name; ?>">
  	</div>
  	<div class="input-group">
  	  <label>Prename</label>
  	  <input type="text" name="prename2">
  	</div>
  	<div class="input-group">
  	  <label>Birth Date</label>
  	  <input type="date" name="bd2">
	</div>
	<div class="input-group">
  	  <label>Arrival Date</label>
  	  <input type="date" name="ad2">
  	</div>
  	<div class="input-group">
  	  <button type="submit" class="btn" name="edit">Edit</button>
  	</div>
  </form>

  <br>
  <br>

  <div class="header">
  	<h2>Delete By ID</h2>
  </div>

  <form method="post" action="update.php" name="delete">
  	<div class="input-group">
  	  <label>ID</label>
  	  <input type="number" name="id3" value="<?php echo $id; ?>">
  	</div>
  	
  	<div class="input-group">
  	  <button type="submit" class="btn red" name="delete">Delete</button>
  	</div>
  </form>

  <br>
  <br>


</body>
</html>
