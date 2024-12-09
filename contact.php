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
                    <form action="submit_contact.php" method="get">
                    <legend>Send us a message</legend> <!-- Titre du fieldset --> 
                    <p>
                        <select name="Enquirytopic" id="Enquirytopic" size="1" autofocus required> <!-- fonction autofocus --> 
                            <option value="Selection">- Select inquiry topic -</option>
                            <option value="Commercial">Sales department - Order enquiries</option>
                            <option value="Purchasing">Suppliers & prospects - Purchasing department</option>
                            <option value="Support">Customer support - Technical solutions</option>
                            <option value="Gama">GAMA Network inquiries</option>
                            <option value="Other">Other requests</option>
                        </select>
                    </p>
                        <div>
                            <label for="email"></label>
                            <input type="email" id="email" name="email" placeholder="Your email address">
                        </div>
                        <div>
                            <label for="message"></label>
                            <textarea placeholder="Your message" id="message" name="message" rows="6" cols="40"></textarea>
                        </div>
                        <button type="submit">Send</button>
                    </form>
                    <br />
            </div>
            </section>
        </div>
        <footer>
		<?php include('footer.php'); ?>
	</body>
</html>