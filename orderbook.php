<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8" />
	<link rel="stylesheet" href="stylePRS.css" />
	<title>PRS Industries - order book</title>
	<link rel="preconnect" href="https://fonts.googleapis.com">
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
</head>
	<body>
		<div id="main_wrapper"><!-- tout le contenu de la page est placé dans une grande balise-->
			<header>
            <?php include('header.php'); ?>
			</header>
            <section>
                <h2>Today'orders - Shipping list</h1>
                <?php
                include_once('variables.php');
                include_once('functions.php');
                ?>
                <p>
                <?php foreach(getOrders($orders) as $order) : ?>
                    <article>
                    <h3><?php echo $order['title']; ?></h3>
                    <div><?php echo $order['items']; ?></div>
                    <i><?php echo displayCustomer($order['customer'], $users); ?></i>
                    </article>
                    <?php endforeach ?>
                </p>
            </section>
            </div>
		<footer>
		<?php include('footer.php'); ?>
	</body>
</html>