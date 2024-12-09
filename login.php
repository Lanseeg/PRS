<?php
require('config.php');
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
<html>
<head>
	<meta charset="utf-8" />
	<link rel="stylesheet" href="stylePRS.css" />
	<link rel="preconnect" href="https://fonts.googleapis.com">
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
</head>
<body>
<?php 
if (isset($_POST['username'])){
	$username = stripslashes($_REQUEST['username']);
	$username = mysqli_real_escape_string($conn, $username);
	$_SESSION['username'] = $username;
	$password = stripslashes($_REQUEST['password']);
	$password = mysqli_real_escape_string($conn, $password);
	//FAILLE de sécurité dans la requete ci dessous avec USERNAME
    $query = "SELECT * FROM `users` WHERE username='$username' and password='".hash('sha256', $password)."'";
	$result = mysqli_query($conn,$query) or die(mysql_error());
	if (mysqli_num_rows($result) == 1) {
		$user = mysqli_fetch_assoc($result);
                    //RECOVER USER IN SESSION
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
                    }
					else{}
                    }
					// is it an ADMIN account?
					if ($user['type'] == 'admin') {
						header('location: adminhome.php');		  
					}else{
						header('location: home.php');
					}
				}else{
					$message = "Incorrect user or password";
				}
			}
?>
<header>
    <?php include('header.php'); ?>
</header>
<section>
            <h2>PRS Connect</h2>
            <div class="boxx">
                <form class="box" action="" method="post" name="login">
                <h2 class="box-title">Connect to our online services!</h2>
                <?php if (! empty($message)) { ?>
                    <p class="errorMessage"><?php echo $message; ?></p>
                <?php } ?>
                <input type="text" class="box-input" name="username" placeholder="Username">
                <input type="password" class="box-input" name="password" placeholder="Password">
                <input type="submit" value="Log in" name="submit" class="box-button">
                <p class="box-register">Don't have an account? <a href="register.php">Create one!</a></p>
                </form>
                </div>
</section>
<footer>
        <?php include('footer.php'); ?>
</body>
</html>
