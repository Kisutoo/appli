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
    <title>Ajout produit</title>
</head>
<body>
    <?php
        $panier = 0;

        if(isset($_SESSION['products']))
        {
            foreach($_SESSION['products'] as $index => $product)
                $panier +=  $product['qtt'];
        }

    ?>
    <nav>
        <p class="deja">Commander</p>
        <a href="recap.php">Recap</a>
        <figure>
            <img class="panierimg" src="126083 (2).png" alt ="panier">
        </figure>
        <?php
        echo "<p>".$panier."</p>";
        ?>
    </nav>
    <div class="formulaire">
        <h1>Ajouter un produit</h1>
        <form action="traitement.php?action=add" method="post">
            <p>
                <label>
                Nom du produit :
                <input type="text" name="name">
                </label>
            </p>
            <p>
                <label>
                Prix du produit :
                <input type="number" step="any" name="price">
                </label>
            </p>
            <p>
                <label>
                Quantité désirée :
                <input type="number" name="qtt" value="1">
                </label>
            </p>
            <p>
                <input type="submit" name="submit" value="Ajouter le produit">
            </p>
        </form>
    </div>

</body>
</html>