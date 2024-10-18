jQuery(document).ready(function($) {
    const $lightbox = $('#lightbox'); // Sélectionne l'élément lightbox
    const $lightboxImage = $lightbox.find('.lightbox-image'); // Sélectionne l'image de la lightbox
    const $lightboxReference = $lightbox.find('.photo-reference'); // Sélectionne l'élément de référence
    const $lightboxCategory = $lightbox.find('.photo-category'); // Sélectionne l'élément de catégorie

    let photos = []; // Stocke les données des photos
    let currentIndex = 0; // Index de la photo en cours

    // Fonction pour configurer la lightbox avec les informations des photos
    function setupLightbox() {
        photos = $('.photo-item').map(function(index, item) {
            return {
                imageUrl: $(item).find('.fullscreen-icon').data('photo-url'), // Récupère l'URL de la photo
                reference: $(item).find('.photo-reference').text(),           // Récupère la référence de la photo
                category: $(item).find('.photo-category').text(),             // Récupère la catégorie de la photo
                index: index                                                  // Index de la photo dans la galerie
            };
        }).get(); // Retourne un tableau des objets photo

        // Ajoute un événement "click" à chaque icône fullscreen pour ouvrir la lightbox
        $('.fullscreen-icon').off('click').on('click', function(event) {
            event.preventDefault();
            currentIndex = $(this).closest('.photo-item').index(); // Récupère l'index de la photo
            openLightbox(currentIndex); // Ouvre la lightbox pour la photo correspondante
        });
    }

    // Fonction pour ouvrir la lightbox avec la photo sélectionnée
    function openLightbox(index) {
        const photo = photos[index]; // Récupère les données de la photo sélectionnée

        // Met à jour le contenu de la lightbox avec les informations de la photo
        $lightboxImage.attr('src', photo.imageUrl); // Met à jour l'image
        $lightboxReference.text(photo.reference); // Met à jour la référence
        $lightboxCategory.text(photo.category); // Met à jour la catégorie

        $lightbox.addClass('active'); // Affiche la lightbox
    }

    // Navigation dans la lightbox avec les flèches
    $lightbox.on('click', '.arrow.left', function() {
        currentIndex = (currentIndex > 0) ? currentIndex - 1 : photos.length - 1; // Passe à la photo précédente
        openLightbox(currentIndex);
    });

    $lightbox.on('click', '.arrow.right', function() {
        currentIndex = (currentIndex < photos.length - 1) ? currentIndex + 1 : 0; // Passe à la photo suivante
        openLightbox(currentIndex);
    });

    // Ferme la lightbox en cliquant sur la croix
    $lightbox.find('.close').on('click', function() {
        $lightbox.removeClass('active');
    });
   

    // Initialisation de la lightbox au chargement de la page
    setupLightbox();

    // Réinitialisation de la lightbox après un rechargement via AJAX
    $(document).ajaxComplete(function() {
        setupLightbox(); // Reconfigure la lightbox après chaque appel AJAX
    });
});
