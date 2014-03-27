

<!DOCTYPE html>
<html>
    <head>
	<img src="images/boutique.gif"	alt="Boutique" title="Boutique"/>
        <meta charset="utf-8" />
        <!-- Our CSS stylesheet file -->
        <link rel="stylesheet" href="assets/css/styles.css" />

        <!-- Including the Lobster font from Google's Font Directory -->
        <link rel="stylesheet" href="http://fonts.googleapis.com/css?family=Lobster" />

        <!-- Enabling HTML5 support for Internet Explorer -->
        <!--[if lt IE 9]>
          <script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
        <![endif]-->
    </head>

    <body>
        <nav>
            <ul class="fancyNav">
                <li id="home"><a href="index.php?uc=accueil" class="homeIcon">acceuil</a></li>
                <li id="catalogue"><a href="index.php?uc=voirProduits&action=voirCategories">Voir le catalogue</a></li>
                <li id="panier"><a href="index.php?uc=gererPanier&action=voirPanier">Voir son panier</a></li>
                <li id="Administrer"><a href="index.php?uc=administrer&action=connexion">Administrer</a></li>
                <?php if(estAdmin()){ ?><li id="deconnecter"><a href="index.php?uc=administrer&action=deconnexion">Se deconnecter</a></li><?php } ?>
            </ul>
        </nav>
    </body>
</html>