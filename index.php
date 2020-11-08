<?php 
    try {
        $dbh = new PDO('mysql:host=sql7.freesqldatabase.com:3306;dbname=sql7375302', "sql7375302", "aPQiISPgqq");
        $sth = $dbh->prepare("
        SELECT  * 
        FROM employee  
        WHERE id IN 
        (SELECT id_emp  
        FROM exerce 
        WHERE id_service IN 
        (SELECT id 
        FROM service  
        WHERE name =?));
                ");


    } catch (PDOException $e) {
        print "Erreur !: " . $e->getMessage() . "<br/>";
        die();
    }

    if(isset($_POST['submit'])){
        if(!empty($_POST['service'])) {
            $selected = $_POST['service'];
            if ($sth->execute(array($selected))) {
                while ($row = $sth->fetch()) {
                  $tab[] = $row ;
                }
              }
            
            
        }
        else { echo "<span>Please Select One Service.</span><br/>";}
    }


?>





<!DOCTYPE html>
<html>
<head>
  <link rel="stylesheet" href="style.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
  <title>home</title>
</head>
<body>

    <div class="topnav">
    <a class="active" href="index.php">Home</a>
    <a href="List_employes.php">Employees</a>
    <a href="jobs.php">Jobs</a>
    <a href="services.php">Services</a>
    </div>


    <div>
        <h1>Home</h1>

    </div>


    <form action="#" method="POST">
        <select name="service" class="browser-default">
            <option value="" disabled selected>Choose a Service</option>
            <option value="Commercial">Commercial</option>
            <option value="direction">direction</option>
            <option value="export">export</option>
            <option value="import">import</option>

        </select>
        <input type="submit" name="submit" value="Get Results" />
    </form>

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
    </div>

</body>
</html>
