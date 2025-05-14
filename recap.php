<?php
    session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="style.css" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Oswald:wght@200..700&family=Raleway:ital,wght@0,100..900;1,100..900&family=Tagesschrift&display=swap" rel="stylesheet">
    <title>Récapitulatif des produits</title>
</head>
<body>
    <?php 
    
    $panier = 0;
        if(!isset($_SESSION['products']) || empty($_SESSION['products']))
            $panier = 0;
        else
            foreach($_SESSION['products'] as $index => $product)
                $panier +=  $product['qtt'];
    ?>
    <nav>
        <a href="index.php">Commander</a>
        <p class="deja">Recap</p>
        <figure>
            <img class="panierimg" src="126083 (2).png" alt ="panier">
        </figure>
        <?php
        echo "<p>".$panier."</p>";
        ?>
    </nav>
    <?php 
        if(!isset($_SESSION['products']) || empty($_SESSION['products']))
            echo "<p class=paniervide>Vous n'avez rien dans votre panier ...</p>";
        elseif(isset($_SESSION['products']))
        {
            echo
                "<p class=panier>Votre panier :</p>",
                "<table>",
                    "<thead>",
                        "<tr>",
                            "<th>#</th>",
                            "<th>Nom</th>",
                            "<th>Prix unitaire</th>",
                            "<th>Quantité</th>",
                            "<th>Total</th>",
                        "</tr>",
                    "</thead>",
                "<tbody>";
        $totalGeneral = 0;
        foreach($_SESSION['products'] as $index => $product)
        {  
            echo "<tr>",
                    "<td>" .$index. "</td>",
                    "<td>".$product['name']."</td>",
                    "<td>".number_format($product['price'], 2, ",", "&nbsp;"). "&nbsp;€</td>",
                    "<td><a class='updown' href='traitement.php?action=down-qtt&index=" . $index ."'> - </a> " .$product['qtt']. " <a class=updown href='traitement.php?action=up-qtt&index=" . $index . "'> + </a></td>",
                    "<td>".number_format($product['total'], 2, ",", "&nbsp;"). "&nbsp;€</td>", // Modifier l'affichage d'une valeur numérique en précisant plusieurs paramètres
                    "<td><a class='delete' href='traitement.php?action=delete&index=" .$index."'>supprimer</a>",
                "</tr>";
            $totalGeneral += $product['total'];
        }
        echo "<tr>",
                "<td colspan=4>Total général : </td>",
                "<td><strong>".number_format($totalGeneral, 2, ",", "&nbsp;")."&nbsp;€</strong></td>",
             "</tr>",
             "<tr>",
                "<td><a class=clear href=traitement.php?action=clear>Clear All</a></td>",
             "</tr>",
            "</tbody>",
            "</table>";
        }
    ?>
    
</body>
</html>