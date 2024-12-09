<?php
	// START SESSION
	session_start();
	// IF NOT CONNECTED, GO TO LOGIN
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
            <h2>PRS Admin</h2>
	<div class="boxx">
		<h3>Welcome admin <?php echo $_SESSION['username']; ?>!</h3>
		<p>This is your cockpit!</p>
		<a href="add_user.php">Add user</a>
		<div>
		<a href="logout.php">Log out</a>
		</div>
	</div>
	<div class="boxx">
	<h2>Admin Database</h2>
		<h3>Display Orders:</h3></br>
				<?php 
				// On récupère tout le contenu de la table orders
				$sqlQuery = 'SELECT * FROM orders';
				$ordersStatement = $mysqlClient->prepare($sqlQuery);
				$ordersStatement->execute();
				$orders = $ordersStatement->fetchAll();
				// On affiche chaque order
				foreach ($orders as $order) {
				?>
				<div><p><?php echo $order['order_id']; ?>
				, 
				<?php echo $order['customer_account']; ?>
				, 
				<?php echo $order['quantity']; ?>
				x 
				<?php echo $order['item']; ?>
				PAID: 
				<?php echo $order['paid']; ?>
				SENT: 
				<?php echo $order['sent']; ?>
				</p>
				</div>
				<?php
				}
				?>
		<h3>Display Users:</h3></br>
				<?php 
				// On récupère tout le contenu de la table users
				$sqlQuery = 'SELECT * FROM users';
				$usersStatement = $mysqlClient->prepare($sqlQuery);
				$usersStatement->execute();
				$users = $usersStatement->fetchAll();
				// On affiche chaque user
				foreach ($users as $user) {
				?>
				<div><p><?php echo $user['id']; ?>
				, 
				<?php echo $user['username']; ?>
				, 
				<?php echo $user['email']; ?>
				x 
				<?php echo $user['type']; ?>
				</div>
				<?php
				}
				?>
	</div>
</section>
</div>
<footer>
<?php include('footer.php'); ?>
</body>
</html>