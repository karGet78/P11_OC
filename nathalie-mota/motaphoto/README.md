##MotaPhoto - Site WordPress pour une photographe freelance##

Description du projet

MotaPhoto est un site WordPress conçu pour Nathalie Mota, une photographe professionnelle spécialisée dans l'événementiel. Ce site a pour objectif de présenter son portfolio, de partager des séries de photos avec ses clients, et de permettre l’achat de droits d’utilisation des images. Le site a été conçu pour être entièrement personnalisable grâce à l’utilisation de Custom Post Types et de champs personnalisés ACF, permettant à Nathalie de gérer ses photos et d’ajouter de nouveaux contenus via l’interface d’administration.

Objectifs du projet

*	Créer un site WordPress sur mesure, basé sur des maquettes fournies par la cliente, respectant les principes de Responsive Design.
*	Mettre en place des Custom Post Types et des champs personnalisés (ACF) pour structurer les données des photos et faciliter leur gestion.
*	Intégrer des fonctionnalités dynamiques et interactives telles qu’une lightbox pour les photos, une pagination infinie, ainsi qu’un système de filtrage et de tri.
*	Appliquer des pratiques Green IT pour optimiser le site, notamment en réduisant la taille des images et en optimisant les interactions avec l’API de WordPress.
Fonctionnalités principales
*	Affichage du portfolio : Galerie dynamique avec possibilité de visualiser chaque photo en pleine page via une lightbox.
*	Filtres et tri : Filtrage dynamique des photos par catégorie, format, et autres critères, avec un affichage instantané.
*	Modale de contact : Intégrée dans le footer, permettant à Nathalie de rester en contact avec ses clients potentiels.
*	Pages de projet : Chaque photo possède une page dédiée incluant des informations détaillées et une option de préremplissage automatique du champ référence pour la modale de contact.
*	Green IT : Réduction de la taille des images et limitation des appels API pour une performance optimisée.

Technologies utilisées

-	WordPress
-	PHP
-	HTML/CSS
-	JavaScript/jQuery
-	Advanced Custom Fields (ACF)
-	Custom Post Types (CPT UI)
-	Ajax pour la pagination infinie et les filtres
-	jQuery pour la gestion des interactions utilisateur
-	GitHub pour la gestion de version et le déploiement du thème personnalisé

Étapes de réalisation

Étape 1 : Création du thème personnalisé

-	Création des fichiers de base : style.css, functions.php, header.php, et footer.php.
-	Intégration de la structure générale du site avec le header, le footer, et la modale de contact.

Étape 2 : Mise en place de la structure de contenu

-	Installation et configuration de CPT UI pour créer un type de contenu personnalisé “photo”.
-	Mise en place des champs personnalisés via ACF pour ajouter des données spécifiques aux photos (catégorie, format, type, référence).

Étape 3 : Intégration des templates

-	Création de single-photo.php pour afficher chaque photo individuellement avec une navigation entre les photos de la même catégorie.
-	Développement de la fonctionnalité de pré-remplissage du champ référence dans la modale de contact à l’aide de jQuery.

Étape 4 : Intégration de la page d'accueil

-	Mise en place de la galerie avec pagination infinie en Ajax pour un chargement fluide.
-	Ajout des filtres et options de tri, alimentés dynamiquement à partir des taxonomies et champs personnalisés.

Étape 5 : Lightbox pour l'affichage plein écran

-	Création d’une lightbox interactive pour afficher les photos en plein écran avec des options de navigation.

Étape 6 : Exportation finale

-	Export du site au format ZIP, incluant la base de données et les fichiers nécessaires, pour un déploiement facile sur l’hébergement de la cliente.
Principaux défis techniques
-	Optimisation des images : Mise en œuvre de principes Green IT pour réduire la taille des images.
-	Pagination Ajax : Intégration de la pagination infinie pour un chargement progressif du contenu.
-	Gestion des champs personnalisés : Utilisation d’ACF et de CPT UI pour rendre le site entièrement personnalisable.

