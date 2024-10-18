<?php
get_header(); // Appelle le header du thème WordPress

// Boucle principale WordPress pour récupérer les informations du post actuel
while (have_posts()) : the_post();
    $post_id = get_the_ID(); // Récupère l'ID du post actuel
    $photo_url = get_the_post_thumbnail_url($post_id, 'large'); // URL de l'image mise en avant
    $reference = get_field('reference'); // Récupère la référence de la photo (champ personnalisé)
    $categories = get_the_terms($post_id, 'categorie_photo'); // Récupère les catégories associées
    $format = get_the_terms($post_id, 'format_photo'); // Récupère les formats associés
    $type = get_field('type'); // Récupère le type de la photo (champ personnalisé)
    $annee = get_field('annee'); // Récupère l'année de la photo (champ personnalisé)
    $previous_post = get_previous_post(); // Récupère le post précédent
    $next_post = get_next_post(); // Récupère le post suivant
    $previous_thumbnail_url = $previous_post ? get_the_post_thumbnail_url($previous_post->ID, 'thumbnail') : ''; // Miniature du post précédent
    $next_thumbnail_url = $next_post ? get_the_post_thumbnail_url($next_post->ID, 'thumbnail') : ''; // Miniature du post suivant
    ?>

    <!-- Section principale pour afficher les détails de la photo -->
    <section class="main-photo-container">
        <article class="photo-content" id="<?php echo $post_id; ?>">
            <!-- Informations sur la photo -->
            <div class="photo-info">
                <div class="info-content">
                    <h2 class="photo-title"><?php the_title(); ?></h2> <!-- Titre de la photo -->
                    <p>Référence : <span class="reference"><?php echo esc_html($reference); ?></span></p> <!-- Référence -->
                    <p>Categorie : <?php echo $categories && !is_wp_error($categories) ? esc_html($categories[0]->name) : 'Non défini'; ?></p> <!-- Catégorie -->
                    <p>Format : <?php echo $format && !is_wp_error($format) ? esc_html($format[0]->name) : 'Non défini'; ?></p> <!-- Format -->
                    <p>Type : <?php echo esc_html($type); ?></p> <!-- Type -->
                    <p>Année : <?php echo esc_html($annee); ?></p> <!-- Année -->
                </div>
            </div>

            <!-- Image principale de la photo -->
            <div class="photo-image">
             <img src="<?php echo esc_url($photo_url); ?>" alt="<?php the_title_attribute(); ?>" loading="lazy">
            </div>
        </article>
        
        <!-- Séparateur mobile (visuel seulement sur mobile) -->
        <div class="mobile-divider"></div>

        <!-- Navigation entre les photos (précédente et suivante) -->
        <article class="photo-navigation">
            <div class="photo-contact">
                <p class="contact-text">Cette photo vous intéresse ?</p>
                <button id="contact-button" class="modal-link" data-reference="<?php echo esc_html($reference); ?>">Contact</button> <!-- Bouton de contact -->
            </div>

            <!-- Navigation avec les flèches et miniatures -->
            <div class="photo-arrows-container">
                <div class="miniature">
                    <a href="#">
                        <img id="miniature-image" src="<?php echo esc_url($photo_url); ?>" alt="Current Photo" data-current-photo-url="<?php echo esc_url($photo_url); ?>">
                    </a>
                </div>

                <!-- Flèches de navigation -->
                <div class="arrows">
                    <?php if ($previous_post): ?>
                        <a href="<?php echo get_permalink($previous_post->ID); ?>" class="arrow-left arrow" data-thumbnail-url="<?php echo esc_url($previous_thumbnail_url); ?>">
                            <img src="<?php echo get_template_directory_uri(); ?>/assets/images/left-arrow.png" alt="Left arrow">
                        </a> <!-- Flèche gauche pour la photo précédente -->
                    <?php endif; ?>
                    
                    <?php if ($next_post): ?>
                        <a href="<?php echo get_permalink($next_post->ID); ?>" class="arrow-right arrow" data-thumbnail-url="<?php echo esc_url($next_thumbnail_url); ?>">
                            <img src="<?php echo get_template_directory_uri(); ?>/assets/images/right-arrow.png" alt="Right arrow">
                        </a> <!-- Flèche droite pour la photo suivante -->
                    <?php endif; ?>
                </div>
            </div>
        </article>
    </section>
    
    <!-- Section des photos apparentées -->
    <section class="related-photos-section">
    <h3>Vous aimerez aussi</h3>
    <div class="related-photos-grid">
        <?php
        // Requête pour obtenir des photos apparentées
        $args = array(
            'post_type' => 'photo',
            'posts_per_page' => 2, // Limite à 2 photos apparentées
            'post__not_in' => array($post_id), // Exclut la photo actuelle
            'tax_query' => array( // Filtre par la catégorie de la photo actuelle
                array(
                    'taxonomy' => 'categorie_photo',
                    'field' => 'id',
                    'terms' => $categories && !is_wp_error($categories) ? wp_list_pluck($categories, 'term_id') : array(),
                ),
            ),
        );
        $related_photos = new WP_Query($args); // Exécution de la requête
        if ($related_photos->have_posts()) :
            while ($related_photos->have_posts()) : $related_photos->the_post(); 
                $reference = get_field('reference'); // Ajout de la référence pour l’affichage dans la lightbox
                $categorie_terms = get_the_terms(get_the_ID(), 'categorie_photo');
                $categorie = (!empty($categorie_terms) && !is_wp_error($categorie_terms)) ? $categorie_terms[0]->name : __('Non défini', 'nathalie-mota');
        ?>
                <div class="related-photo-item photo-item">
                <img src="<?php echo get_the_post_thumbnail_url(get_the_ID(), 'large'); ?>" alt="<?php the_title_attribute(); ?>" loading="lazy">
                    
                    <!-- Icônes pour l'affichage en plein écran et vue de détails -->
                    <div class="photo-hover-icons">
                        <a href="<?php the_permalink(); ?>" class="view-icon">
                            <img src="<?php echo esc_url(get_template_directory_uri()); ?>/assets/images/Icon_eye.png" alt="Eye Icon">
                        </a>
                        <a href="#" class="fullscreen-icon" data-photo-url="<?php echo esc_url(wp_get_attachment_url(get_post_thumbnail_id())); ?>">
                        <img src="<?php echo esc_url(get_template_directory_uri()); ?>/assets/images/Icon_fullscreen.png" alt="Fullscreen Icon" loading="lazy">
                        </a>
                    </div>

                    <!-- Informations sur la photo -->
                    <div class="photo-info">
                        <p class="photo-title"><?php echo esc_html(mb_strtoupper(get_the_title(), 'UTF-8')); ?></p>
                        <p class="photo-category"><?php echo strtoupper(esc_html($categorie)); ?></p>
                        <p class="photo-reference" style="display: none;"><?php echo strtoupper(esc_html($reference)); ?></p>
                    </div>
                </div>
        <?php
            endwhile;
        else :
            echo '<p>Aucune photo apparentée trouvée.</p>';
        endif;
        wp_reset_postdata(); // Réinitialise les données du post
        ?>
    </div>
</section>


<?php
endwhile; // Fin de la boucle

get_footer(); // Appelle le footer du thème WordPress
?>

