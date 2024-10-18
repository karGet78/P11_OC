jQuery(document).ready(function($) {
    // Sélecteurs pour la modale de contact et les éléments associés
    const $contactModal = $('#contactModal');
    const $contactButton = $('#contact-button');
    const $contactLink = $('a[href="#contact"]');
    const $referenceField = $('input[name="your-subject"]');

    // Fonction pour ouvrir la modale de contact
    function openContactModal(event) {
        event.preventDefault(); // Empêche l'action par défaut du lien ou du bouton
        $contactModal.addClass("show"); // Ajoute la classe "show" pour afficher la modale
        $('.navigation-modal').removeClass('open'); // Ferme la modale de navigation si elle est ouverte

        // Remplir automatiquement le champ "Référence" dans le formulaire de contact
        if ($referenceField.length && $contactButton.length) {
            const reference = $contactButton.data('reference'); // Récupère la référence depuis le bouton
            $referenceField.val(reference); // Remplit le champ "Référence" avec la valeur
        }
    }

    // Ouvrir la modale de contact via le bouton ou le lien
    $contactButton.on('click', openContactModal); // Clic sur le bouton
    $contactLink.on('click', openContactModal); // Clic sur le lien "Contact"

    // Fermer la modale de contact si l'utilisateur clique en dehors
    $(window).on('click', function(event) {
        if ($(event.target).is($contactModal)) {
            $contactModal.removeClass("show"); // Retire la classe "show" pour fermer la modale
        }
    });
});

