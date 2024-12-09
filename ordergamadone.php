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
    <div id="main_wrapper"><!-- tout le contenu de la page est placé dans une grande balise-->
        <header>
                <?php include('header.php'); ?>
        </header>
        <section>
            <h2>Gama plan order confirmation</h2>
            <div class="boxx">
            <?php
            if (isset($_POST['pass'])){
                $customer_account = $_SESSION['email'];
                $priceorder = $_SESSION["priceorder"];
                $item = $_SESSION["Material"];
                $quantity = $_SESSION["quantity"];
                $totalorder = $_SESSION["totalorder"];
                $date_order = $_SESSION["date"];
                $requDate = $_SESSION["requDate"];

                                    // Ecriture de la requête
                    $sqlQuery = 'INSERT INTO orders(item, quantity, price, totalorder, customer_account, date_order, requdate, qtySent) VALUES (:item, :quantity, :price, :totalorder, :customer_account, :date_order, :requdate, :qtySent)';
                    
                    // Préparation
                    $insertOrder = $mysqlClient->prepare($sqlQuery);
                    
                    // Exécution 
                    $insertOrder->execute([
                        'item' => $item,
                        'quantity' => $quantity,
                        'price' => $priceorder,
                        'totalorder' => $totalorder,
                        'customer_account' => $customer_account,
                        'date_order' => $date_order,
                        'requdate' => $requDate,
                        'qtySent' => 1,
                    ]);

                    echo "Thank you, you can now enjoy PRS GAMA Network!";
                    ?>
                    <img src="pics/gamaenjoy.jpg" alt="Gama 12 months subscription" class="imgRdreact" title="Gama 12 months subscription"/>
                    <?php
                    header("Refresh: 5;url=home.php");


                }
            else{
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