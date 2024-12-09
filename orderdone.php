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
                    <?php
                    if (!isset($_SESSION['email']) && !isset($_SESSION["totalorder"])){
                    //Problem check
                        echo "There is a problem with your order, please retry.";
                        header("Refresh: 3;url=materials.php");
                    }
                    else if (isset($_SESSION['email']) && isset($_SESSION["totalorder"])){
                    //Get variables from SESSION info and add ORDER to database
                    $customer_account = $_SESSION['email'];
                    $priceorder = $_SESSION["priceorder"];
                    $item = $_SESSION["Material"];
                    $quantity = $_SESSION["quantity"];
                    $totalorder = $_SESSION["totalorder"];
                    $date_order = $_SESSION["date"];
                    $requDate = $_SESSION["requDate"];
                    // Ecriture de la requête
                    $sqlQuery = 'INSERT INTO orders(item, quantity, price, totalorder, customer_account, date_order, requdate) VALUES (:item, :quantity, :price, :totalorder, :customer_account, :date_order, :requdate)';
                    // Préparation
                    $insertRecipe = $mysqlClient->prepare($sqlQuery);
                    // Exécution
                    $insertRecipe->execute([
                        'item' => $item,
                        'quantity' => $quantity,
                        'price' => $priceorder,
                        'totalorder' => $totalorder,
                        'customer_account' => $customer_account,
                        'date_order' => $date_order,
                        'requdate' => $requDate,
                    ]);
                    echo "Thank you, we will now take care of your order! Please do not refresh page.";
                    header("Refresh: 5;url=home.php");
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
