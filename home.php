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
	<link rel="preconnect" href="https://fonts.gstatic.com">
</head>
	<body>
    <div id="main_wrapper">
        <header>
                <?php include('header.php'); ?>
        </header>
        <section>
            <h2>PRS Connect <a href="logout.php"><img src="pics/Power.png" alt="Logout" class="ico_categorie" title="Click here to log out"/></a></br></h2>
            <div class="boxx">
                <div class="sucess">
                    <h3>Welcome <?php echo $_SESSION['username']; ?></h3>
                    <p>Order GAMA Network data plans, get materials and manage your orders with PRS Connect</p>
                    <a href="materials.php"><img src="pics/materials_banner.png" alt="Get Materials" class="imgRdreact" title="Get Materials"/></a></br><br/>
                </div>
            </div>
            <div class="boxx">
            <h2>Gama Network</h2>
                    <?php
                    //LOOK IF USER ALREADY ORDERED THIS SUBSCRIPTION, THEN LOOK IF THE PLAN IS STILL VALID
                    $sqlQuery1 = "SELECT * FROM orders WHERE customer_account = :customer_account AND (item = :item1 OR item = :item2 OR item = :item3) ORDER BY requdate DESC LIMIT 1";
                    $ordersStatement = $mysqlClient->prepare($sqlQuery1);
                    $ordersStatement->execute([
                    'customer_account' => $_SESSION['email'],
                    'item1' => "GAMA1MONTH",
                    'item2' => "GAMA6MONTHS",
                    'item3' => "GAMA12MONTHS",
                    ]);
                    //COUNT ROWS
                    $num_of_rows1 = $ordersStatement->rowCount();
                    $orders = $ordersStatement->fetchAll();
                    $date = date('Y-m-d');
                    if ($num_of_rows1 == 0){
                        //NEW USER SUBSCRIPTION PROPOSAL
                        ?>
                                <img src="pics/gamacom.jpg" alt="Gama" class="imgRd" title="Gama your BIG data plan"/></br>
                                <h5>Save up to 30% and get up to 2 times more data with the 12 months plan!</h5>
                                <img src="pics/gamaprom.png" alt="Gama service" class="imgRd" title="Gama network services"/></br>
                                <h2>Available offers:</h2>
                                <form class="box" action="ordergama.php" method="post">
                                    <p>
                                        <select name="Material" id="Material" size="1"> <!-- fonction autofocus -->
                                            <option value="GAMA1MONTH">1 month plan - 699u - 10,000 TB LIMIT</option>
                                            <option value="GAMA6MONTHS">6 months plan - 3799u - 100,000 TB LIMIT</option>
                                            <option value="GAMA12MONTHS">12 months plan - 6500u - 250,000 TB LIMIT</option>
                                        </select>
                                    </p>
                                    <input type="submit" value="Get plan" />
                                </form>
                                </br>
                        <?php
                    }
                    else if ($num_of_rows1 >= 1){
                        foreach ($orders as $order) {
                            $date1 = $date;  
                            $date2 = $order['requdate'];
                            if ($date1 < $date2) {
                                //EXISTING USER WITH AN ACTIVE RUNNING PLAN
                                ?>
                                <img src="pics/gamactive.gif" alt="Gama service" class="imgRd" title="Gama network connected"/></br><br/>
                                <p>Enjoy GAMA Network from this device or access compatible satellite devices with the code provided above.</p>
                                <p>Any question regarding GAMA network? <a href="contact.php">Contact us!</a></p>
                                <h3>You can enjoy GAMA Network till <?php echo $order['requdate']; ?></h3>
                                <br/>

                                <?php 
                            }
                            else{
                                //EXISTING USER WITH A PLAN NO MORE ACTIVE
                                ?>
                                <img src="pics/gamarenew.png" alt="Gama service" class="imgRd" title="Gama network services"/></br>
                                <h2>Available offers:</h2>
                                <form class="box" action="ordergama.php" method="post">
                                    <p>
                                        <select name="Material" id="Material" size="1" autofocus> <!-- fonction autofocus -->
                                            <option value="GAMA1MONTH">1 month plan - 699u - 10,000 TB LIMIT</option>
                                            <option value="GAMA6MONTHS">6 months plan - 3799u - 100,000 TB LIMIT</option>
                                            <option value="GAMA12MONTHS">12 months plan - 6500u - 250,000 TB LIMIT</option>
                                        </select>
                                    </p>
                                    <input type="submit" value="Get plan" />
                                </form>
                                </br>
                                <?php
                            }
                        }
                    }
                    ?>
            </div>
            <div class="boxx">
                    <h2>Your orders:
                    <?php
                    //RECOVER USER ORDERS
                    //SAVE FROM USER DATABASE THE ASSOCIATED EMAIL
                    $sqlQuery = "SELECT * FROM users";
                    $usersStatement = $mysqlClient->prepare($sqlQuery);
                    $usersStatement->execute();
                    $num_of_rows = $usersStatement->rowCount();
                    $users = $usersStatement->fetchAll();
                    foreach ($users as $user) {?>
                    <?php
                    if ($_SESSION['username'] == $user['username']){ ?>
                    <?php 
                    $userEmail = $user['email'];
                    $_SESSION['email'] = $userEmail;
                    ?>
                    </h2>
                    <?php 
                    }?>
                    <?php
                    }?>
                    <?php
                    //FILTER ORDERS DATABASE WITH USEREMAIL
                    $sqlQuery = "SELECT * FROM orders WHERE customer_account = :customer_account";
                    $ordersStatement = $mysqlClient->prepare($sqlQuery);
                    $ordersStatement->execute([
                    'customer_account' => $userEmail,
                    ]);
                    $orders = $ordersStatement->fetchAll();
                    //FINALLY, DISPLAYING ORDERS DETAILS for the user
                    if ($num_of_rows == 0){
                        echo "No order to show";
                        echo $num_of_rows;
                    }
                    else if ($num_of_rows >= 1){
                        foreach ($orders as $order) {
                        ?>
                        <p>
                        <em>
                        <?php echo $order['date_order']; ?>
                        </em>
                        :
                        <?php echo $order['quantity'];?> 
                        x 
                        <strong>
                        <?php echo $order['item']; ?>
                        </strong>
                        =
                        <?php echo $order['price']*$order['quantity']; ?>
                         U. 
                        - Delivery/Expiration Date: 
                        <?php echo $order['requdate']; ?>
                        - Quantity Sent:
                        <?php echo $order['qtySent']; ?>
                        </p>
                        <?php
                        }
                    //END OF USER ORDERS DISPLAY
                    }
                    ?>
            </div>
        </section>
    </div>
    <footer>
        <?php include('footer.php'); ?>
	</body>
</html>