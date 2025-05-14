<?php // Plusieurs variables prédéfinies en PHP sont "superglobales", ce qui signifie qu'elles sont disponibles quel que soit le contexte du script.
    
    session_start(); // Démarrer une session sur le serveur pour l'utilisateur courant ou récupérer la session de cet utilisateur s'il en avait déjà une

    if(isset($_GET['action']))
    {
        switch($_GET['action'])
        {
            case "add":
                if(isset($_POST['submit'])) // Vérification de l'existance de la clé "submit"(attribut "name" du bouton <input type="submit" name="submit" du formulaire) dans le tableau "$_POST"
                {                           // Vrai seulement si la requête POST transmet bien une clé "submit" au serveur

                    $name = filter_input(INPUT_POST, "name", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
                    $price = filter_input(INPUT_POST, "price", FILTER_VALIDATE_FLOAT); // Différents filtres pour empêcher la saisie de mauvaises informations (injection de code etc)
                    $qtt = filter_input(INPUT_POST, "qtt", FILTER_VALIDATE_INT);

                        if($name && $price && $qtt) // Vérification si les filtres ont bien fonctionné et que n p q ne sont pas null ou vides
                        {
                            $product = [ // récupération des infos du produit
                            "name" => $name,
                            "price" => $price,
                            "qtt" => $qtt,
                            "total" => $price*$qtt
                            ];

                            $_SESSION['products'][] = $product;
                        }
                }
                break;
            
            case "clear":
                session_destroy();
                break;
            
            case "down-qtt":
                if (isset($_GET['index']) && isset($_SESSION['products']) && isset($_SESSION['products'][$_GET['index']])) 
                {
                    if ($_SESSION['products'][$_GET['index']]['qtt'] > 1)
                    {
                        $_SESSION['products'][$_GET['index']]['qtt']--;
                        $_SESSION['products'][$_GET['index']]['total'] -= $_SESSION['products'][$_GET['index']]['price'];
                    }
                    else
                        unset($_SESSION['products'][$_GET['index']]);
                }
                break;
            
            case "up-qtt":
                if (isset($_GET['index']) && isset($_SESSION['products']) && isset($_SESSION['products'][$_GET['index']])) 
                {
                    $_SESSION['products'][$_GET['index']]['qtt']++;
                    $_SESSION['products'][$_GET['index']]['total'] += $_SESSION['products'][$_GET['index']]['price'];
                }
                break;
            
            case "delete":
                if (isset($_GET['index']) && isset($_SESSION['products']) && isset($_SESSION['products'][$_GET['index']])) 
                    unset($_SESSION['products'][$_GET['index']]);
                break;


        }
    }

    header("Location:recap.php"); // Dans le cas ou le if du dessus n'est pas vrai,  effectue une redirection grâce à la fonction header() (code 302) --> (code 200 sur la page cible)
?>