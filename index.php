<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8" />
	<link rel="preconnect" href="https://fonts.googleapis.com">
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
	<link rel="stylesheet" href="stylePRS.css" />
	<title>PRS Industries</title>
</head>
	<body>
		<div id="main_wrapper"><!-- tout le contenu de la page est placé dans une grande balise-->
			<header>
            <?php include('header.php'); ?>
			</header>
				<div class="belowheaderblock">
					<div class="blankspace"></div>
					<div class="ensemble_subqt"><div class="floating_text">
					"Across systems, our starfleet delivers core ressources with care for the local life"»</div>
					<p></p>
					<div class="subquote">John – PRS Silver Point employee</div>
				</div>
				</div>
			<section>
			<div class="whatsnpassding"><h2>OUR SERVICES</h2></div>
			<?php include('services.php'); ?>
			<div class="whatsnpassding"><h2>PRS Connect</h2>
			<a href="home.php"> <img src="pics/PRSconnect.png" alt="PRS Connect"></a>
			</div>
			</section>
			<section>
			<div class="whatsnpassding"><h2>WHAT'S NEW?</h2></div>
			<div class="articlesConteneur">
				<article>
				<h2>PRS acquired a new com tower in the remote southern star region</h2>
				<p>Extending the GAMA network, keeping fast coms with remote galaxy sites allows earth and far places to conn… READ MORE</p>
				</article>

				<article>
				<h2>Our galaxy trade posts</h2>
				<p>With 5 effective trade points and galaxy wide presence, we offer you to visit us in one of our trade vessels and buildings. The vibrant sightseeings and our high standards… READ MORE</p>
				</article>

				<article>
				<h2>New remotely operated plant </h2>
				<p>After the PRS Explorer vessel studied this LFRX planet, what was initially considered a dead planet is finally a home for a rich fauna and flora. Considering this, and… READ MORE</p>
				</article>

				<article>
				<h2>Plants built for security</h2>
				<p>In radioactive, very hot or freezing environments, we can proudly claim that PRS industries reaches the highest standards in security and the worker’s experie… READ MORE</p>
				</article>
			</div>
			</section>


		</div>
		<footer>
		<?php include('footer.php'); ?>
	</body>
</html>
