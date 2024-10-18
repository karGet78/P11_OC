<?php
// ============================
// Configuration de base du thème
// ============================
function nathalie_mota_theme_setup() {
    // Enregistrer les menus de navigation
    register_nav_menus(array(
        'header-menu' => esc_html__('Menu en-tête', 'nathalie-mota'),
        'footer-menu' => esc_html__('Menu pied de page', 'nathalie-mota'),
    ));
    
    // Activer les images mises en avant pour les articles
    add_theme_support('post-thumbnails');
    
    // Définir des tailles d'images personnalisées
    add_image_size('catalogue-image', 564, 495, true); // Image utilisée pour le catalogue
    add_image_size('thumbnail', 150, 150, true);        // Miniature utilisée ailleurs
}
add_action('after_setup_theme', 'nathalie_mota_theme_setup');

// ============================
// Chargement des styles et scripts
// ============================
function nathalie_mota_theme_assets() {
    // Enregistrement des feuilles de style
    wp_enqueue_style('theme-style', get_template_directory_uri() . '/css/theme.css');
    wp_enqueue_style('contact-modal-style', get_template_directory_uri() . '/css/contact_modal.css');
    wp_enqueue_style('gallery-style', get_template_directory_uri() . '/css/gallery.css');
    wp_enqueue_style('single-photo-style', get_template_directory_uri() . '/css/single_photo.css');
    wp_enqueue_style('lightbox-style', get_template_directory_uri() . '/css/lightbox.css');
    wp_enqueue_style('header-style', get_template_directory_uri() . '/css/header.css');
    wp_enqueue_style('header-mobile-style', get_template_directory_uri() . '/css/header-mobile.css');

    // Enregistrement des scripts JavaScript
    wp_enqueue_script('jquery');
    wp_enqueue_script('contactModal', get_template_directory_uri() . '/js/contactModal.js', array('jquery'), null, true);
    wp_enqueue_script('navigationModal', get_template_directory_uri() . '/js/navigationModal.js', array('jquery'), null, true);
    wp_enqueue_script('lightbox', get_template_directory_uri() . '/js/lightbox.js', array('jquery'), null, true);
    wp_enqueue_script('filters', get_template_directory_uri() . '/js/filters.js', array('jquery'), null, true);
    wp_enqueue_script('customScript', get_template_directory_uri() . '/js/customScript.js', array('jquery'), null, true);

    if (is_front_page()) {
        // Enregistre le style et le script de Select2 uniquement sur la page d'accueil
        wp_enqueue_style('select2-css', 'https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css');
        wp_enqueue_script('select2-js', 'https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js', array('jquery'), null, true);

        // Initialisation de Select2 après le chargement de la page
        wp_add_inline_script('select2-js', "
            jQuery(document).ready(function($) {
                $('#category-filter, #format-filter, #sort-filter').select2({
                    dropdownAutoWidth: true,
                    theme: 'default'
                });
            });
        ");
    }

    // Localisation des scripts pour AJAX
    wp_localize_script('filters', 'ajax_vars', array(
        'ajaxurl' => admin_url('admin-ajax.php'),
        'template_directory' => get_template_directory_uri(),
    ));
}
add_action('wp_enqueue_scripts', 'nathalie_mota_theme_assets');


// ============================
// Fonction AJAX pour charger des photos
// ============================
function load_photos_callback() {
    // Nettoyage et validation des données reçues
    $page = intval($_POST['page']);
    $category = sanitize_text_field($_POST['category']);
    $format = sanitize_text_field($_POST['format']);
    $sort = sanitize_text_field($_POST['sort']);

    // Paramètres de la requête WP_Query
    $args = array(
        'post_type' => 'photo',
        'posts_per_page' => 8,
        'paged' => $page,
        'order' => ($sort === 'date_asc') ? 'ASC' : 'DESC',
    );

    // Ajout de la taxonomie de catégorie si présente
    if ($category) {
        $args['tax_query'][] = array(
            'taxonomy' => 'categorie_photo',
            'field' => 'slug',
            'terms' => $category,
        );
    }

    // Ajout de la taxonomie de format si présente
    if ($format) {
        $args['tax_query'][] = array(
            'taxonomy' => 'format_photo',
            'field' => 'slug',
            'terms' => $format,
        );
    }

    // Exécution de la requête WP_Query
    $query = new WP_Query($args);

    // Vérification des résultats
    if ($query->have_posts()) {
        while ($query->have_posts()) {
            $query->the_post();

            // Récupération des informations personnalisées
            $reference = get_field('reference');
            $categorie_terms = get_the_terms(get_the_ID(), 'categorie_photo');
            $categorie = (!empty($categorie_terms) && !is_wp_error($categorie_terms)) ? $categorie_terms[0]->name : __('Non défini', 'nathalie-mota');

            // Affichage des résultats en HTML
            ?>
            <div class="photo-item">
                <img src="<?php echo esc_url(get_the_post_thumbnail_url(get_the_ID(), 'catalogue-image')); ?>" alt="">
                <div class="photo-hover-icons">
                    <a href="<?php the_permalink(); ?>" class="view-icon">
                        <img src="<?php echo esc_url(get_template_directory_uri()); ?>/assets/images/Icon_eye.png" alt="Eye Icon">
                    </a>
                    <a href="#" class="fullscreen-icon" data-photo-url="<?php echo esc_url(wp_get_attachment_url(get_post_thumbnail_id())); ?>">
                        <img src="<?php echo esc_url(get_template_directory_uri()); ?>/assets/images/Icon_fullscreen.png" alt="Fullscreen Icon">
                    </a>
                </div>
                <div class="photo-info">
                    <p class="photo-title"><?php echo esc_html(mb_strtoupper(html_entity_decode(get_the_title(), ENT_QUOTES | ENT_HTML5, 'UTF-8'), 'UTF-8')); ?></p>
                    <p class="photo-category"><?php echo strtoupper(esc_html($categorie)); ?></p>
                    <p class="photo-reference" style="display:none;"><?php echo strtoupper(esc_html($reference)); ?></p> <!-- Champ caché pour la lightbox -->
                </div>
            </div>
            <?php
        }
    } else {
        echo '<p>' . __('Aucune photo trouvée.', 'nathalie-mota') . '</p>';
    }

    // Réinitialisation des données de la requête
    wp_reset_postdata();
    wp_die(); // Fin du traitement AJAX
}
add_action('wp_ajax_load_photos', 'load_photos_callback');
add_action('wp_ajax_nopriv_load_photos', 'load_photos_callback');

