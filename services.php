<?php 
    try {
        $dbh = new PDO(mysql:host=sql7.freesqldatabase.com:3306;dbname=sql7375302', "sql7375302", "aPQiISPgqq");
        foreach($dbh->query('SELECT * from service') as $row) {
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
    <a href="List_employes.php">Employees</a>
    <a  href="jobs.php">Jobs</a>
    <a class="active" href="services.php">Services</a>
</div>

<br>

<div class="container">
    <table>
        <thead>
            <tr>
                <td>ID</td>
                <td>Name</td>
                
            </tr>
        </thead>
        <tbody>
            <?php 
                foreach($tab as $employee) {
                    $id = $employee[0] ;
                    $name = $employee[1] ;
                    
                    echo <<<Html
                    <tr>
                        <td>$id</td>
                        <td>$name</td>
                        
                    </tr>
                    Html ;
                }
            ?>
        </tbody>
    </table>
</div>


</body>
</html>
 
