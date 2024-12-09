<?php
	// SESSION START
	session_start();
	
	// END SESSION
	if(session_destroy())
	{
		// Redirect to login page
		header("Location: login.php");
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
<head>
	<meta charset="utf-8" />
	<link rel="stylesheet" href="stylePRS.css" />
	<title>PRS Industries</title>
	<link rel="preconnect" href="https://fonts.googleapis.com">
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" 
        rel="stylesheet"
    >
</head>
	<body>
    <div id="main_wrapper"><!-- tout le contenu de la page est placé dans une grande balise-->
			<header>
                <?php include('header.php'); ?>
			</header>
            <section>
            <h2>PRS Connect</h2>
            <div class="boxx">
            <p>Successfully logged out!</p>
            </div>


            </div>
            </br>
            </section>
        </div>
		<footer>
		<?php include('footer.php'); ?>
	</body>
</html>
