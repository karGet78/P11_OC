document.addEventListener('DOMContentLoaded', function () {
    // ============================
    // Initialisation générale et variables globales
    // ============================
    const customSelectWrappers = document.querySelectorAll('.custom-select-wrapper'); // Tous les conteneurs de sélection personnalisée
    let page = 1; // Variable de gestion de la pagination des photos
    const loadMoreButton = document.getElementById('load-more'); // Bouton pour charger plus de photos
    const photoGallery = document.getElementById('photo-gallery'); // Conteneur de la galerie de photos

    // ============================
    // Gestion des filtres
    // ============================

    // Fonction pour fermer toutes les sélections ouvertes
    function closeAllSelects() {
        document.querySelectorAll('.custom-select').forEach(select => select.classList.remove('open'));
    }

    // Pour chaque sélecteur personnalisé, définir les interactions
    customSelectWrappers.forEach(wrapper => {
        const select = wrapper.querySelector('.custom-select'); // Sélecteur principal
        const trigger = wrapper.querySelector('.custom-select-trigger'); // Eléments déclenchant l'ouverture du sélecteur
        const arrow = wrapper.querySelector('.custom-arrow'); // Flèche pour ouvrir/fermer le sélecteur
        const defaultText = trigger.textContent; // Texte par défaut du sélecteur

        // Gérer l'ouverture/fermeture des sélecteurs
        const toggleSelect = function (event) {
            event.stopPropagation(); // Empêche la fermeture immédiate en cliquant à l'extérieur
            if (select.classList.contains('open')) {
                closeAllSelects(); // Ferme les sélecteurs ouverts
            } else {
                closeAllSelects(); // Ferme toutes les sélections
                select.classList.add('open'); // Ouvre le sélecteur actuel
            }
        };

        trigger.addEventListener('click', toggleSelect); // Clic pour ouvrir/fermer
        arrow.addEventListener('click', toggleSelect); // Clic sur la flèche

        // Gérer la sélection d'une option dans le sélecteur
        wrapper.querySelectorAll('.custom-option').forEach(option => {
            option.addEventListener('click', function () {
                trigger.textContent = option.textContent || defaultText; // Mise à jour du texte du sélecteur
                wrapper.querySelectorAll('.custom-option').forEach(opt => opt.classList.remove('selected')); // Réinitialise les sélections précédentes
                option.classList.add('selected'); // Marque la nouvelle option sélectionnée
                closeAllSelects(); // Ferme le sélecteur après la sélection
                loadPhotos(true); // Recharge les photos avec les nouveaux filtres appliqués
            });
        });
    });

    // Fermer toutes les listes déroulantes si l'utilisateur clique en dehors
    document.addEventListener('click', function (e) {
        if (!e.target.closest('.custom-select-wrapper')) {
            closeAllSelects();
        }
    });

    // ============================
    // Chargement des photos via AJAX
    // ============================

    // Fonction pour charger les photos depuis le serveur
    function loadPhotos(resetPage = false) {
        if (resetPage) {
            page = 1; // Réinitialise la page si demandé
            photoGallery.innerHTML = ''; // Vide la galerie pour recharger le contenu
        }

        // Récupère les valeurs de chaque filtre (catégorie, format, tri)
        const category = document.querySelector('.filter-category .custom-option.selected')?.getAttribute('data-value') || '';
        const format = document.querySelector('.filter-format .custom-option.selected')?.getAttribute('data-value') || '';
        const sort = document.querySelector('.filter-sort .custom-option.selected')?.getAttribute('data-value') || '';

        // Prépare les données pour l'appel AJAX
        const data = {
            action: 'load_photos', // Action AJAX configurée dans functions.php
            category: category, // Filtre par catégorie
            format: format, // Filtre par format
            sort: sort, // Critère de tri
            page: page // Numéro de la page
        };

        // Envoie une requête AJAX pour charger les photos
        jQuery.post(ajax_vars.ajaxurl, data, function (response) {
            if (response) {
                photoGallery.insertAdjacentHTML('beforeend', response); // Ajoute les nouvelles photos à la galerie
            } else {
                loadMoreButton.style.display = 'none'; // Masque le bouton si aucune autre photo n'est disponible
            }
        });
    }

    // ============================
    // Bouton "Charger plus"
    // ============================

    // Gérer le clic sur le bouton "Charger plus" pour charger d'autres photos
    if (loadMoreButton) {
        loadMoreButton.addEventListener('click', function () {
            page++; // Passe à la page suivante
            loadPhotos(); // Charge la nouvelle page de photos
        });
    }

    // Charger les photos initialement au chargement de la page
    loadPhotos();
});
