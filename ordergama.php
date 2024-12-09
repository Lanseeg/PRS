<?php
    require('config.php');
	// Start session
	session_start();
	// Check if user is connected, or redirect to login page
	if(!isset($_SESSION["username"])){
		header("Location: login.php");
		exit(); 
	}
?>
<?php
try
{
	$mysqlClient = new PDO('mysql:host=localhost;dbname=prs_industries;charset=utf8', 'root', 'root');
}
catch (Exception $e)
{
        die('Erreur : ' . $e->getMessage());
}
?>
<!DOCTYPE html>
<html lang="en">
<html>
<head>
	<meta charset="utf-8" />
	<link rel="stylesheet" href="stylePRS.css" />
	<title>PRS Connect</title>
	<link rel="preconnect" href="https://fonts.googleapis.com">
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
</head>
	<body>
    <div id="main_wrapper">
        <header>
                <?php include('header.php'); ?>
        </header>
        <section>
            <h2>Order GAMA plan</h2>
            <div class="boxx">
            <?php
            //ON RECUPERE LE PLAN CHOISI ET ON CALCULE LEURS DATE DE VALIDITE RESPECTIVES
            if (isset($_POST['Material'])){
            $userEmail = $_SESSION['email'];
            $gamaplan = $_POST['Material'];
            $_SESSION['Material'] = $gamaplan;
            $quantity = 1;
            $_SESSION['quantity'] = $quantity;
            $date = date('Y-m-d');
            $date1m = date('Y-m-d', strtotime($date. ' + 31 days'));
            $date6m = date('Y-m-d', strtotime($date. ' + 6 months'));
            $date12m = date('Y-m-d', strtotime($date. ' + 12 months'));
            //AFFICHAGE EN FONCTION DE L OFFRE CHOISIE
            switch ($gamaplan)
            { 
                case "GAMA1MONTH":
                    $_SESSION['priceorder'] = 699;
                    $_SESSION['totalorder'] = 699;
                    $_SESSION['date'] = $date;
                    $_SESSION['requDate'] = $date1m;
                    ?>
                    <h2>Subscription for <?php echo $userEmail; ?></h2>
                    <img src="pics/gamacom.jpg" alt="Gama 12 months subscription" class="imgRdreact" title="Gama 12 months subscription"/>
                    <img src="pics/Gama1month.png" alt="Gama 1 month subscription" class="imgRdreact" title="Gama 1 month subscription"/></br><br/>
                    <h5>This is a 1 month plan - There is a data limit of 10,000 TB - QuantumHi certified and reliable internet speed</h5>
                    <h3>Cost: 699 units</h3>
                    <p>Your plan will start now and end on <?php echo $date1m; ?> (Y-m-d)</p>
                    <form class="box" action="home.php" method="post">
                        <input type="submit" value="Cancel" />
                    </form></br>
                    <form class="box" action="ordergamadone.php" method="post">
                        <input type="hidden" name="pass" id="pass" value="OK">
                        <input type="submit" value="Validate order" />
                    </form>
                    <?php
                break;
                case "GAMA6MONTHS":
                    $_SESSION['priceorder'] = 3799;
                    $_SESSION['totalorder'] = 3799;
                    $_SESSION['date'] = $date;
                    $_SESSION['requDate'] = $date6m;
                    ?>
                    <h2>Subscription for <?php echo $userEmail; ?></h2>
                    <img src="pics/gamacom.jpg" alt="Gama 12 months subscription" class="imgRdreact" title="Gama 12 months subscription"/>
                    <img src="pics/Gama6months.png" alt="Gama 6 month subscription" class="imgRdreact" title="Gama 6 months subscription"/></br><br/>
                    <h5>This is a 6 months plan - There is a data limit of 100,000 TB - QuantumHi certified and reliable internet speed</h5>
                    <h3>Cost: 3799 units</h3>
                    <p>Your plan will start now and end on <?php echo $date6m; ?> (Y-m-d)</p>
                    <form class="box" action="home.php" method="post">
                        <input type="submit" value="Cancel" />
                    </form></br>
                    <form class="box" action="ordergamadone.php" method="post">
                        <input type="hidden" name="pass" id="pass" value="OK">
                        <input type="submit" value="Validate order" />
                    </form>
                    <?php
                break;
                case "GAMA12MONTHS":
                    $_SESSION['priceorder'] = 6500;
                    $_SESSION['totalorder'] = 6500;
                    $_SESSION['date'] = $date;
                    $_SESSION['requDate'] = $date12m;
                    ?>
                    <h2>Subscription for <?php echo $userEmail; ?></h2>
                    <img src="pics/gamacom.jpg" alt="Gama 12 months subscription" class="imgRdreact" title="Gama 12 months subscription"/>
                    <img src="pics/Gama12months.png" alt="Gama 12 months subscription" class="imgRdreact" title="Gama 12 months subscription"/></br><br/>
                    <h5>This is a 12 months plan - There is a data limit of 250,000 TB - QuantumHi certified and reliable internet speed</h5>
                    <p>Save up to 30% and get the best data offer with this plan!</p>
                    <h3>Cost: 6500 units</h3>
                    <p>Your plan will start now and end on <?php echo $date12m; ?> (Y-m-d)</p>
                    <form class="box" action="home.php" method="post">
                        <input type="submit" value="Cancel" />
                    </form></br>
                    <form class="box" action="ordergamadone.php" method="post">
                        <input type="hidden" name="pass" id="pass" value="OK">
                        <input type="submit" value="Validate order" />
                    </form>
                    <?php
                break;
                 
                default:
                    echo "Sorry, no valid plan selected. Please retry";
            }
                ?>
                <?php
            }
            else{
                //Message d'erreur a afficher en cas de requête invalide
                echo "Invalid command - Please try again later";
                header("Refresh: 3;url=home.php");
            }
            ?>
            </br>
            </div>
        </section>
    </div>
    <footer>
        <?php include('footer.php'); ?>
	</body>
</html>