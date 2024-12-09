<!DOCTYPE html>
<html>
    <head>
        <title>Notre première instruction : echo</title>
        <meta charset="utf-8" />
    </head>
    <body>
    <?php
    //phpinfo();
    ?>
        <h2>Affichage de texte avec PHP</h2>
        
        <p>
            Cette ligne a été écrite entièrement en HTML.<br />
            <?php echo("Celle-ci a été écrite entièrement en PHP."); ?>
        </p>

        <p>Aujourd'hui nous sommes le <?php echo date('d/m/Y h:i:s'); ?>.</p>
<h1>Déclarer et afficher une variable</h1></br>
        <?php
        $fullname = 'Mathieu Nebra';
        echo $fullname;
        ?>
</br>
    <?php
    $isEnabled = true;

    if ($isEnabled == true) {
        echo "Vous êtes autorisé(e) à accéder au site ✅";
    }
    else {
        echo "Accès refusé ❌ ";
    }
    ?>
</br>

<?php
$grade = 20;

switch ($grade) // on indique sur quelle variable on travaille
{ 
    case 0: // dans le cas où $grade vaut 0
        echo "Tu es vraiment un gros nul !!!";
    break;
    
    case 5: // dans le cas où $grade vaut 5
        echo "Tu es très mauvais";
    break;
    
    case 7: // dans le cas où $grade vaut 7
        echo "Tu es mauvais";
    break;
    
    case 10: // etc. etc.
        echo "Tu as pile poil la moyenne, c'est un peu juste…";
    break;
    
    case 12:
        echo "Tu es assez bon";
    break;
    
    case 16:
        echo "Tu te débrouilles très bien !";
    break;
    
    case 20:
        echo "Excellent travail, c'est parfait !";
    break;
    
    default:
        echo "Désolé, je n'ai pas de message à afficher pour cette note";
}
?>
</br>
<h1>TABLEAU</h1>
<?php

$mickael = ['Mickaël Andrieu', 'mickael.andrieu@exemple.com', 'S3cr3t', 34];
$mathieu = ['Mathieu Nebra', 'mathieu.nebra@exemple.com', 'devine', 33];
$laurene = ['Laurène Castor', 'laurene.castor@exemple.com', 'P4ssw0rD', 28];

$users = [$mickael, $mathieu, $laurene];

echo $users[1][1]; // "mathieu.nebra@exemple.com"
?>

</br>
<?php
$lines = 1;

while ($lines <= 10) {
    echo 'Je ne dois pas regarder les mouches voler quand j\'apprends le PHP.<br />';
    $lines++; // $lines = $lines + 1
}
?>

</br>
<?php
$lines = 1;

while ($lines <= 10)
{
    echo 'Ceci est la ligne n°' . $lines . '<br />';
    $lines++;
}
?>

<!--

Ceci est la ligne n°1
Ceci est la ligne n°2
...
-->

</br>
<h1>WHILE</h1>
<?php

$lines = 3; // nombre d'utilisateurs dans le tableau
$counter = 0;

while ($counter < $lines) {
    echo $users[$counter][0] . ' ' . $users[$counter][1] . '<br />';
    $counter++; // Ne surtout pas oublier la condition de sortie !
}
?>


<h1>FOR</h1></br>
<?php
for ($lines = 0; $lines <= 2; $lines++)
{
    echo $users[$lines][0] . ' ' . $users[$lines][1] . '<br />';
}
?>
</br>
<h1>PRINT_R</h1>
<?php

$recipes = [
    [
        'title' => 'Cassoulet',
        'recipe' => '',
        'author' => 'mickael.andrieu@exemple.com',
        'is_enabled' => true,
    ],
    [
        'title' => 'Couscous',
        'recipe' => '',
        'author' => 'mickael.andrieu@exemple.com',
        'is_enabled' => false,
    ],
];

echo '<pre>';
print_r($recipes);
echo '</pre>';
?>

<?php
$recipe = 'Etape 1 : des flageolets ! Etape 2 : de la saucisse toulousaine';
$length = strlen($recipe);
 
 
echo 'La phrase ci-dessous comporte ' . $length . ' caractères :' . PHP_EOL . $recipe;
?>

</body>
</html>