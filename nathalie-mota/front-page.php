<?php get_header(); ?>

<!-- Section d'en-tête avec une image de type 'photo' affichée de manière aléatoire -->
<section class="hero">
    <div class="photo-hero">
        <?php
            // Récupérer un post aléatoire de type 'photo'
            $photos = get_posts(array(
                'post_type' => 'photo', // Spécifie que nous recherchons des posts de type 'photo'
                'posts_per_page' => 1,  // Limite à un post
                'orderby' => 'rand',    // Trie de manière aléatoire pour récupérer une photo différente à chaque chargement
            ));

            // Vérifie s'il y a des résultats et affiche la photo
            if (!empty($photos)) {
                $photo_id = $photos[0]->ID; // Récupère l'ID de la première photo
                // Affiche l'image de la photo avec 'lazy-loading' activé pour améliorer les performances
                echo wp_get_attachment_image(get_post_thumbnail_id($photo_id), 'full', false, array('loading' => 'lazy'));
            }
        ?>
        <h2>PHOTOGRAPHE EVENT</h2> <!-- Titre sur l'image de la section -->
    </div>
</section>

<!-- Section des filtres pour filtrer les photos par catégories, formats et ordre -->
<div class="filters-container">
    <!-- Filtre par catégorie -->
    <div class="filter filter-category">
        <div class="custom-select-wrapper">
            <div class="custom-select">
                <div class="custom-select-trigger">
                    <span>Catégories</span> <!-- Titre du filtre Catégories -->
                </div>
                <div class="custom-arrow"></div> <!-- Flèche pour ouvrir/fermer le sélecteur -->
                <div class="custom-options">
                    <span class="custom-option reset-option" data-value=""></span> <!-- Option vide pour réinitialiser la sélection -->
                    <?php
                        // Récupère toutes les catégories de la taxonomie 'categorie_photo'
                        $categories = get_terms('categorie_photo');
                        // Vérifie qu'il y a des catégories et qu'il n'y a pas d'erreur
                        if (!empty($categories) && !is_wp_error($categories)) {
                            // Affiche chaque catégorie comme option de sélection
                            foreach ($categories as $category) {
                                echo '<span class="custom-option" data-value="' . esc_attr($category->slug) . '">' . esc_html($category->name) . '</span>';
                            }
                        }
                    ?>
                </div>
            </div>
        </div>
    </div>

    <!-- Filtre par format -->
    <div class="filter filter-format">
        <div class="custom-select-wrapper">
            <div class="custom-select">
                <div class="custom-select-trigger">
                    <span>Formats</span> <!-- Titre du filtre Formats -->
                </div>
                <div class="custom-arrow"></div> <!-- Flèche pour ouvrir/fermer le sélecteur -->
                <div class="custom-options">
                    <span class="custom-option reset-option" data-value=""></span> <!-- Option vide pour réinitialiser la sélection -->
                    <?php
                        // Récupère tous les formats de la taxonomie 'format_photo'
                        $formats = get_terms('format_photo');
                        // Vérifie qu'il y a des formats et qu'il n'y a pas d'erreur
                        if (!empty($formats) && !is_wp_error($formats)) {
                            // Affiche chaque format comme option de sélection
                            foreach ($formats as $format) {
                                echo '<span class="custom-option" data-value="' . esc_attr($format->slug) . '">' . esc_html($format->name) . '</span>';
                            }
                        }
                    ?>
                </div>
            </div>
        </div>
    </div>

    <!-- Filtre pour trier les photos par date -->
    <div class="filter filter-sort">
        <div class="custom-select-wrapper">
            <div class="custom-select">
                <div class="custom-select-trigger">
                    <span>Trier par</span> <!-- Titre du filtre Trier par -->
                </div>
                <div class="custom-arrow"></div> <!-- Flèche pour ouvrir/fermer le sélecteur -->
                <div class="custom-options">
                    <span class="custom-option reset-option" data-value=""></span> <!-- Option vide pour réinitialiser la sélection -->
                    <!-- Options de tri : par ordre décroissant ou croissant de date -->
                    <span class="custom-option" data-value="date_desc">Du plus récent au plus ancien</span>
                    <span class="custom-option" data-value="date_asc">Du plus ancien au plus récent</span>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Conteneur de la galerie de photos, où les photos seront chargées via AJAX -->
<section id="photo-gallery" class="photo-gallery">
    <!-- Les photos seront affichées ici après la sélection des filtres -->
</section>

<!-- Bouton pour charger plus de photos (pagination) -->
<button id="load-more">Charger plus</button>

<?php get_footer(); ?>



