jQuery(document).ready(function($) {
    const $navigationModal = $('.navigation-modal'); // Sélection de la modale de navigation

    // Gestion du clic sur le menu burger
    $('.menu-burger').on('click', function() {

        // Bascule de l'état 'open' pour la modale
        if ($navigationModal.hasClass('open')) {
            $navigationModal.removeClass('open'); // Ferme la modale si elle est déjà ouverte
        } else {
            $navigationModal.addClass('open'); // Ouvre la modale si elle est fermée
        }
    });

    // Fermeture de la modale en cliquant sur l'icône de fermeture (la croix)
    $('.navigation-modal .close').on('click', function() {
        $navigationModal.removeClass('open'); // Ferme la modale
    });

});
