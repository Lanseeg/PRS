<?php
    require('config.php');
	// Start session?
    session_start();
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
<head>
	<meta charset="utf-8" />
	<link rel="stylesheet" href="stylePRS.css" />
	<title>PRS Industries: Materials</title>
	<link rel="preconnect" href="https://fonts.googleapis.com">
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
</head>
	<body>
		<div id="main_wrapper">
			<header>
            <?php include('header.php'); ?>
			</header>
			<section>
                <div class="whatsnpassding"><h2>Materials selector</h2></div>
                    <div class="widearticle">
                        <h2>Order review</h2>
                        <?php
                if (!isset($_POST['quantity']) && !isset($_SESSION["Material"])){
                    //Check if request valid
                    echo "Invalid request, please try again";
                    header("Refresh: 3;url=home.php");
                }
                else if (isset($_POST['quantity']) && isset($_SESSION["Material"])){
                $date = date('Y-m-d');
                $_SESSION["date"]=$date;
                $matsel = $_SESSION["Material"];
                $requQty = $_POST["quantity"];
                $_SESSION["quantity"] = $requQty;
                $requDate = $_POST["requDate"];
                $_SESSION["requDate"] = $requDate;
                $price100 = $_SESSION["price100"];
                $price1000 = $_SESSION["price1000"];
                //Display the right price range
                if ($requQty >= 1000){
                    $priceorder = $price1000;
                }
                else{
                    $priceorder = $price100;
                }
                $_SESSION["priceorder"] = $priceorder;
                $totalorder = $priceorder * $requQty;
                ?>
                <h4>
                <?php
                echo "$requQty x $matsel ($priceorder units) = $totalorder units";
                $_SESSION["totalorder"] = $totalorder;
                ?>
                </h4>
                <h5>
                <?php 
                echo "Delivery: $requDate";
                ?>
                </h5>
                <form method="post" action="materials.php">
                <input type="submit" value="Go back to selection" />
                </form>
                <form method="post" action="orderdone.php">
                <input type="submit" value="Validate order" />
                </form>
                <?php
                }
                ?>
                    </div>
                </div>
            </section>
		</div>
		<footer>
		<?php include('footer.php'); ?>
	</body>
</html>
