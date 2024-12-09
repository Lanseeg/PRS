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
	<title>PRS Industries</title>
	<link rel="preconnect" href="https://fonts.googleapis.com">
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
</head>
<body>
<div id="main_wrapper"><!-- tout le contenu de la page est placé dans une grande balise-->
			<header>
                <?php include('header.php'); ?>
			</header>
            <section>
            <h2>PRS Connect</h2>
            <div class="boxx">

<?php
require('config.php');
if (isset($_REQUEST['username'], $_REQUEST['email'], $_REQUEST['password'])){
	// récupérer le nom d'utilisateur et supprimer les antislashes ajoutés par le formulaire
	$username = stripslashes($_REQUEST['username']);
	$username = mysqli_real_escape_string($conn, $username); 
	// récupérer l'email et supprimer les antislashes ajoutés par le formulaire
	$email = stripslashes($_REQUEST['email']);
	$email = mysqli_real_escape_string($conn, $email);
	// récupérer le mot de passe et supprimer les antislashes ajoutés par le formulaire
	$password = stripslashes($_REQUEST['password']);
	$password = mysqli_real_escape_string($conn, $password);
	
	$query = "INSERT into `users` (username, email, type, password)
				VALUES ('$username', '$email', 'user', '".hash('sha256', $password)."')";
	$res = mysqli_query($conn, $query);
    if($res){
       echo "<div class='sucess'>
             <h3>You are now registered</h3>
             <p><a href='home.php'>Click here to access your account</a></p>
			 </div>";
    }
}
else{
?>
<form class="box" action="" method="post">
    <h2 class="box-title">Create an account</h2>
	<input type="text" class="box-input" name="username" placeholder="Your username" required />
    <input type="text" class="box-input" name="email" placeholder="Email" required />
    <input type="password" class="box-input" name="password" placeholder="Your Password" required />
    <input type="submit" name="submit" value="Sign in" class="box-button" />
    <p class="box-register">Already have an account? <a href="home.php">Log in here !</a></p>
</form>
<?php } ?>

</div>
</section>
</div>

</body>
</html>