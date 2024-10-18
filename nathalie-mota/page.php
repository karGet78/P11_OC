<?php
/**
 * The template for displaying all pages
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site will use a
 * different template.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package WordPress
 * @subpackage Nathalie_Mota
 * @since Nathalie Mota 1.0
 */

get_header(); ?>

<!-- Zone de contenu principale -->
<div id="primary" class="content-area">
    <main id="main" class="site-main">

        <?php
        // Début de la boucle WordPress pour afficher le contenu de la page
        while ( have_posts() ) :
            the_post();

            // Inclut un modèle spécifique au contenu de la page
            get_template_part( 'template-parts/content', 'page' );

            // Si les commentaires sont ouverts ou s'il y a au moins un commentaire, charge le modèle de commentaires.
            if ( comments_open() || get_comments_number() ) :
                comments_template();
            endif;

        // Fin de la boucle.
        endwhile;
        ?>

    </main><!-- #main -->
</div><!-- #primary -->

<?php
get_sidebar();

get_footer();