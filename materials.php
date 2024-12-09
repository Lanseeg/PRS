<?php
    require('config.php');
	// Start session?
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
<html lang="en">
<head>
	<meta charset="utf-8" />
    <link rel="stylesheet" href="stylePRS.css"/>
	<title>PRS Industries: Materials</title>
	<link rel="preconnect" href="https://fonts.googleapis.com">
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
</head>
	<body>
		<div id="main_wrapper"><!-- tout le contenu de la page est placé dans une grande balise-->
			<header>
            <?php include('header.php'); ?>
			</header>
			<section>
            <div class="whatsnpassding"><h2>Materials selector</h2></div>
                <div class="widearticle">
                    <img src="pics/vesselbanner.png" class="illusB" alt="PRS vessel picture" title="Make your selection and get a quote for Indium, Emeril, Hydrogen, Gold, Cadmium or Silver"><br/>
                    <h2>Quick estimation</h2> <!-- Titre du fieldset -->
                    <form class="box" action="" method="post">
                        <p>
                            <select name="Material" id="Material" size="1" autofocus> <!-- fonction autofocus --> 
                                <option value="Selection">- Make your selection -</option>
                                <option value="Cadmium">Cadmium powder 0.3-1.6 mm MQ3000, per KG</option>
                                <option value="Emeril">Emeril 10", per KG</option>
                                <option value="Emeril+">Emeril+ (enriched, natural) 10", per KG</option>
                                <option value="Gold10">Gold (refined pure, 10"), per KG</option>
                                <option value="GoldStd">Gold standard bar (refined 98% quality, 10"), per KG</option>
                                <option value="H2C24">Hydrogen C24 refill</option>
                                <option value="H2C44">Hydrogen C44 refill</option>
                                <option value="H2mini">Hydrogen miniCAP refill</option>
                                <option value="Indium">Indium 10", per KG</option>
                                <option value="Indium+">Indium+(enriched) 10", per KG</option>
                                <option value="Silver">Silver (refined pure, 10"), per KG</option>
                            </select>
                        </p>
                        <input type="submit" value="Quote" />
                    </form>
                </div>
            </div>
            </section>
            <?php
            if (isset($_POST['Material']) && ($_POST['Material']) == "Selection"){
                //Si on a appuyé sur le bouton d'envoi sans choisir d'item
                ?>
                <section>
                <div class="whatsnpassding"><h2>Select a material to get an estimation</h2></div>
                <div class="ServicesConteneur">
                </div>
                </div>
                </section>
                <?php
            }
            else if (isset($_POST['Material'])){
                //Si un item est selectionné, on remonte ses caractéristiques. On entre dans la session la matière selectionnée
                $material = $_POST['Material'];
                $_SESSION["Material"] = $material;
                $sqlQuery = "SELECT * FROM `materials` WHERE short =:short";
                $materialsStatement = $mysqlClient->prepare($sqlQuery);
                $materialsStatement->execute([
                'short' => $_POST['Material'],]);
                $materials = $materialsStatement->fetchAll();
                foreach ($materials as $material) {
                                $matsel = $material['item'];
                                $price100 = $material['price_100'];
                                $_SESSION["price100"] = $price100;
                                $price1000 = $material['price_1000'];
                                $_SESSION["price1000"] = $price1000;
                }
            if (isset($_SESSION['Material'])){
                //Si on a choisi un item et soumis le formulaire, on affiche les tranches de prix
                    ?>

            <section>
                <div class="whatsnpassding"><h2>Instant quote</h2></div>
                <div class="ServicesConteneur">
                    <div class="services_box">
                    <h3><?php echo $matsel ?></h3>
                    </div>
                    <div class="services_box">
                    <h3><?php echo $price100; ?></h3>
                    <p>Units /100</p>
                    </div>
                    <div class="services_box">
                    <h3><?php echo $price1000 ?></h3>
                    <p>Units /1000</p>
                    </div>
                </div>
                <?php
                if(!isset($_SESSION["username"]) && isset($_SESSION['Material'])){
                    //Si l'utilisateur n'est pas connecté mais qu'un item à été choisi
                ?>
                <div class="whatsnpassding"><h2><a href="home.php">Create or login to a PRS connect account to order</a></h2></div>
                <?php
                }
                if(isset($_SESSION["username"])){
                    //Si l'utilisateur est connecté, acces au formulaire de commande ?>
                <div class="whatsnpassding"><h2>Order</h2></div>
                <div class="boxx">
                <p>Select requested quantity & delivery time:</p>
                <form class="box" action="orderconf.php" method="post">
                <input type="number" name="quantity" id="quantity" placeholder="Insert qty" min="5" step="5" size="5" required/> Units/KG<br/>
                <label for="date">Requested delivery time</label>
       			<input type="date" name="requDate" id="requDate" required/><br/>
                <input type="submit" value="Order" name="submit" class="box-button">
                </form>
                <?php
                }
                ?>
                </br>
                </div>
                <?php
                }
                ?>
            </section>
                <?php
                }
                ?>
            <section>
                <div class="whatsnpassding"><h2>PRS Materials</h2></div>
			        <div class="widearticle">
			            <h2>Emeril</h2>
			                <div class="conteneurArt">
			                    <img src="pics/actemerilmine.png" class="illusT" alt="Activated Emeril mine" title="Our harsh-condition-ready plant for activated Emeril.">
			                    <p>Extracted in enriched and neutral mines, our extractions sites deliver pure processed Emeril quality, used in space industry, laboratories and general electronics and power devices.</p>
			                </div>
                        <h2>Indium</h2>
			                <div class="conteneurArt">
                                <p>The "blue gold" is extracted in both euclidian sites, one in the raw neutral version, the other being an high efficiency metal. PRS industries is able to provide laboratory quality, military M9001 grade and gazeous byproducts. Security of our workers is guaranteed by <a href="ourplants.html" title="discover our facilities"> high security buildings.</a></p>
                                <img src="pics/indiummine.png" class="illusT" alt="Indium mine" title="Our indium remotely operated plant">
			                </div>
			            <h2>H2 - Hydrogen</h2>
			                <div class="conteneurArt">
			                    <p>With high efficiency condensors, PRS plants are able to safely condensate hydrogen and deliver it in miniCAP, C24 or C44 cartridges. From batches of 35 to big orders, inquire for our H2 refills in the form below.</p>
			                </div>
			            <h2>Silver, Gold & Cadmium</h2>
			                <div class="conteneurArt">
			                    <img src="pics/golddeposit.png" class="illusT" alt="A natural gold deposit on an euclidian planet" title="A natural gold deposit on an euclidian planet">
			                    <p>Our silver is processed and available in 10" bars, and gold has several delivery sizes options. With cutting-edge technology extraction plants, extraction of the metals, especially cadmium, is safely done by qualified operators.</p>
			        </div>
                </div>
			</section>
		</div>
		<footer>
		<?php include('footer.php'); ?>
	</body>
</html>
