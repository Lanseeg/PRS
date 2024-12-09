<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8" />
	<link rel="stylesheet" href="stylePRS.css" />
	<title>PRS Industries - Contact us</title>
	<link rel="preconnect" href="https://fonts.googleapis.com">
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
</head>
	<body>
		<div id="main_wrapper"><!-- tout le contenu de la page est placé dans une grande balise-->
			<header>
                <?php include('header.php'); ?>
			</header>
            <section>
                <h2>Contact us</h2>
            <div class="boxx">
                    <?php
                    if (
                        (!isset($_GET['email']) || !filter_var($_GET['email'], FILTER_VALIDATE_EMAIL))
                        || (!isset($_GET['message']) || empty($_GET['message']))
                        )
                    {
                        echo('Invalid email address/No message - Please retry');
                        return;
                    }
                    ?>
            <h2>Thank you for reaching us!</h2>
        
        <div class="card">
            
            <div class="card-body">
                <p><b>Email</b> : <?php echo $_GET['email']; ?></p>
                <p><b>Service emailed</b> : <?php echo $_GET['Enquirytopic']; ?></p>
            </br>

            </div>
        </div>
            </div>
            </section>
        </div>
        <footer>
		<?php include('footer.php'); ?>
	</body>
</html>