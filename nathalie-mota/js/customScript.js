jQuery(document).ready(function($) {
    // Gestion du survol des flèches de navigation pour changer la miniature
    $('.arrow-left, .arrow-right').hover(
        function() {
            // Au survol, récupérer l'URL de la miniature associée et l'afficher
            var thumbnailUrl = $(this).data('thumbnail-url');
            $('#miniature-image').attr('src', thumbnailUrl);
        },
        function() {
            // À la fin du survol, restaurer l'image actuelle de la photo
            var currentPhotoUrl = $('#miniature-image').data('current-photo-url');
            $('#miniature-image').attr('src', currentPhotoUrl);
        }
    );

});

