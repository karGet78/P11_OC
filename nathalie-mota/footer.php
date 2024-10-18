</main> <!-- Fin du contenu principal -->

<footer>
    <!-- Navigation du menu pied de page -->
    <nav class="footer-nav">
        <?php
            wp_nav_menu(array(
                'theme_location' => 'footer-menu', // Localisation du menu de pied de page
                'container' => false,              // Désactiver l'ajout d'un conteneur <div> autour du menu
                'menu_class' => 'footer-menu',     // Classe CSS pour la personnalisation du menu
            ));
        ?>
    </nav>
    
    <?php wp_footer(); ?> <!-- Appel aux scripts et autres éléments ajoutés via WordPress -->
</footer>

<!-- Lightbox pour afficher les images en plein écran -->
<div id="lightbox" class="lightbox">
    <div id="lightbox-overlay">
        <span class="close">&times;</span>
        <img class="lightbox-image" src="" alt="">
        <div class="photo-info">
            <p class="photo-reference"></p>
            <p class="photo-category"></p>
        </div>
        <span class="arrow left"></span>
        <span class="arrow right"></span>
    </div>
</div>


<!-- Inclusion de la modale de contact -->
<?php get_template_part('templates_part/contact-modal'); ?>

</body>
</html>



