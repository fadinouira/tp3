<?php 
    try {
        $dbh = new PDO('mysql:host=sql7.freesqldatabase.com:3306;dbname=sql7375302', "sql7375302", "aPQiISPgqq);
        foreach($dbh->query('SELECT * from employee') as $row) {
            $tab[] = $row ;
        }
        $dbh = null;
    } catch (PDOException $e) {
        print "Erreur !: " . $e->getMessage() . "<br/>";
        die();
    }


?>

<!DOCTYPE html>
<html>
<head>
  <link rel="stylesheet" href="style.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">

</head>
<body>

<div class="topnav">
    <a href="index.php">Home</a>
    <a class="active" href="List_employes.php">Employees</a>
    <a href="jobs.php">Jobs</a>
    <a href="services.php">Services</a>
</div>

<br>

<div class="container">
    <table>
        <thead>
            <tr>
                <td>ID</td>
                <td>Name</td>
                <td>Prename</td>
                <td>Date of Birth</td>
                <td>Arrival Date</td>
            </tr>
        </thead>
        <tbody>
            <?php 
                foreach($tab as $employee) {
                    $id = $employee[0] ;
                    $name = $employee[1] ;
                    $prename = $employee[2] ;
                    $dn = $employee[3] ;
                    $da = $employee[4] ;
                    echo <<<Html
                    <tr>
                        <td>$id</td>
                        <td>$name</td>
                        <td>$prename</td>
                        <td>$dn</td>
                        <td>$da</td>
                    </tr>

                    Html ;
                }
            ?>
        </tbody>
    </table>

    <div class="center">
    <button class ="btn"><a style="color: white;" href="update.php">Edit Employees</a></button>
    </div>


</div>

</body>
</html>
 


