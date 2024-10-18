<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Nathalie Mota, photographe professionnelle</title>
    <?php wp_head(); ?> <!-- Appel de wp_head() pour charger les styles, scripts et autres éléments du thème -->
</head>

<body <?php body_class(); ?>><!-- Ajoute des classes dynamiques au body pour une personnalisation CSS selon le contexte -->
<header>
    <div class="nav-container">
        <!-- Logo -->
        <div class="logo">
            <a href="<?php echo esc_url(home_url('/')); ?>">
                <img src="<?php echo get_template_directory_uri(); ?>/assets/images/logo-nMota.png" alt="Nathalie Mota">
            </a>
        </div>

        <!-- Menu burger pour la version mobile -->
        <div class="menu-burger">
            <span class="bar"></span>
            <span class="bar"></span>
            <span class="bar"></span>
        </div>

        <!-- Menu principal de navigation -->
        <nav class="navigation">
            <?php
            wp_nav_menu(array(
                'theme_location' => 'header-menu', // Indique la zone de menu dans le thème
                'container' => false, // Supprime l'élément conteneur par défaut
                'menu_class' => 'navigation--menu', // Ajoute une classe personnalisée au menu
            ));
            ?>
        </nav>
    </div>
</header>

<!-- Modale de navigation pour le menu mobile -->
<div class="navigation-modal">
    <div class="modal-top">
        <!-- Logo dans la modale -->
        <div class="logo">
            <a href="<?php echo esc_url(home_url('/')); ?>">
                <img src="<?php echo get_template_directory_uri(); ?>/assets/images/logo-nMota.png" alt="Nathalie Mota">
            </a>
        </div>

        <!-- Bouton pour fermer la modale -->
        <div class="close">
            <span class="bar"></span>
            <span class="bar"></span>
            <span class="bar"></span>
        </div>
    </div>

    <!-- Menu dans la modale pour la navigation mobile -->
    <div class="modal-bottom">
        <?php
        wp_nav_menu(array(
            'theme_location' => 'header-menu', // Même menu que dans l'en-tête
            'container' => false,
            'menu_class' => 'navigation--menu',
        ));
        ?>
    </div>
</div>

<!-- Inclusion de la modale de contact -->
<?php get_template_part('contact-modale'); ?>

<main> <!-- Début de la section principale de la page -->

<?php wp_footer(); ?> <!-- Appel de wp_footer() pour charger les scripts en bas de page -->
</body>
</html>













