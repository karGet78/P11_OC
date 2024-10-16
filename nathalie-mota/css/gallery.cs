@charset "UTF-8";
/* Conteneur principal de la galerie */
.photo-gallery {
  width: 1148px;
  margin: 170px auto 0;
  display: flex;
  flex-wrap: wrap;
  justify-content: center;
  gap: 20px;
  height: auto; /* Ajuste automatiquement la hauteur */
}

/* Élément de la galerie (chaque photo) */
.photo-gallery .photo-item {
  width: calc(50% - 20px); /* 50% avec un espace de 20px entre les photos */
  height: 495px;
  margin-bottom: 20px;
  border: 1px solid #000;
  position: relative;
  overflow: hidden; /* Cache le contenu débordant */
  /* Effet de survol */
  /* Image de la photo dans la galerie */
}
.photo-gallery .photo-item::before {
  content: "";
  position: absolute;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  background: rgba(0, 0, 0, 0.6); /* Utilisation de rgba pour un effet transparent */
  opacity: 0;
  transition: opacity 0.3s ease;
  z-index: 1; /* Place la superposition au-dessus de l'image */
}
.photo-gallery .photo-item:hover::before {
  opacity: 1;
}
.photo-gallery .photo-item img {
  width: 100%;
  height: 100%;
  object-fit: cover; /* Assure que l'image couvre l'espace sans déformation */
  position: relative;
  z-index: 0;
}

/* Icônes visibles au survol */
.photo-gallery .photo-hover-icons {
  position: absolute;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  display: flex;
  justify-content: space-between;
  align-items: center;
  opacity: 0;
  transition: opacity 0.3s ease;
  z-index: 2; /* Au-dessus de l'image */
}

.photo-gallery .photo-item:hover .photo-hover-icons {
  opacity: 1;
}

/* Icône "Eye" */
.photo-gallery .view-icon {
  position: absolute;
  width: 46px;
  height: 31.2px;
  top: 50%;
  left: 50%;
  transform: translate(-50%, -50%);
}

/* Icône "Full Screen" */
.photo-gallery .fullscreen-icon {
  position: absolute;
  width: 34px;
  height: 34px;
  top: 11px;
  right: 11px;
}

/* Informations sur la photo */
.photo-gallery .photo-info {
  position: absolute;
  bottom: 10px;
  left: 10px;
  width: calc(100% - 20px);
  display: flex;
  justify-content: space-between;
  padding: 0 10px;
  z-index: 2;
  opacity: 0;
  transition: opacity 0.3s ease;
}

.photo-gallery .photo-item:hover .photo-info {
  opacity: 1;
}

/* Référence de la photo */
.photo-gallery .photo-reference {
  font-family: "Poppins", sans-serif;
  font-size: 14px;
  font-weight: 500;
  line-height: 21px;
  color: #FFFFFF;
  text-transform: uppercase;
  width: 170px;
  height: 21px;
}

/* Catégorie de la photo */
.photo-gallery .photo-category {
  font-family: "Space Mono", monospace;
  font-size: 14px;
  font-weight: 400;
  line-height: 20.73px;
  text-align: right;
  margin-right: 10px;
  color: #FFFFFF;
  text-transform: uppercase;
  width: 89px;
  height: 21px;
}

/* Conteneur principal des filtres */
.filters-container {
  width: 100%;
  position: relative;
  z-index: 10;
  padding: 0 60px;
  margin-top: 20px;
}

/* Filtre individuel */
.filter {
  position: absolute;
  top: 0;
  width: 260px !important;
}

/* Positions des filtres */
.filter-category {
  left: 65px;
}

.filter-format {
  left: 358px;
}

.filter-sort {
  left: 935px;
}

.custom-select-wrapper {
  position: relative;
  user-select: none;
  width: 260px !important;
  box-sizing: border-box;
}

.custom-select {
  position: relative;
  display: flex;
  justify-content: space-between;
  align-items: center;
  width: 260px !important;
  height: 43px;
  padding: 0 10px;
  font-family: "Poppins", sans-serif;
  font-size: 12px;
  font-weight: 500;
  text-transform: uppercase;
  border: 1px solid #ccc;
  border-radius: 4px;
  background-color: #fff;
  cursor: pointer;
  box-sizing: border-box;
  /* Ajout de la flèche */
}
.custom-select .custom-arrow {
  width: 16px;
  height: 16px;
  background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 512 512'%3E%3Cpath d='M233.4 406.6c12.5 12.5 32.8 12.5 45.3 0l192-192c12.5-12.5 12.5-32.8 0-45.3s-32.8-12.5-45.3 0L256 338.7 86.6 169.4c-12.5-12.5-32.8-12.5-45.3 0s-12.5 32.8 0 45.3l192 192z'/%3E%3C/svg%3E");
  background-size: cover;
  background-repeat: no-repeat;
  margin-left: 10px;
  cursor: pointer;
}
.custom-select.open .custom-arrow {
  transform: rotate(-135deg); /* Flèche vers le haut */
}

/* Options du sélecteur */
.custom-options {
  position: absolute;
  top: 100%;
  left: 0;
  width: 260px !important;
  border: 1px solid #ccc;
  border-radius: 4px;
  background-color: #fff;
  z-index: 999;
  max-height: 0;
  overflow: hidden;
  transition: max-height 0.3s ease-in-out;
  display: flex;
  flex-direction: column;
  box-sizing: border-box;
}

.custom-options .custom-option {
  width: 260px !important;
  height: 42px;
  padding: 0 24px;
  display: flex;
  align-items: center;
  text-transform: capitalize;
  font-family: "Poppins", sans-serif;
  font-size: 12px;
  background-color: white;
  color: #313144;
  cursor: pointer;
  box-sizing: border-box;
}

.custom-options .custom-option:hover {
  background-color: #E00000;
  color: #fff;
}

.custom-select.open .custom-options {
  max-height: 200px;
  overflow-y: auto;
}

.custom-option.selected {
  background-color: #E00000 !important;
  color: #fff !important;
}

/* Bouton pour charger plus de photos */
#load-more {
  display: block;
  width: 200px;
  margin: 20px auto;
  padding: 10px 20px;
  font-size: 16px;
  background-color: #D8D8D8;
  color: #000000;
  border: none;
  cursor: pointer;
  border-radius: 5px;
  text-align: center;
}
#load-more:hover {
  background-color: #ccc;
}

@media (min-width: 768px) and (max-width: 1024px) {
  /* Filtres pour tablette */
  .filters-container {
    display: flex;
    justify-content: space-between;
    padding: 0 20px;
    max-width: 768px;
  }
  .filter-category,
  .filter-format,
  .filter-sort {
    width: 20% !important;
    max-width: 100px !important;
  }
  /* Filtre individuel */
  .filter {
    width: 100px !important;
  }
  /* Positions des filtres */
  .filter-category {
    left: 25px !important;
  }
  .filter-format {
    left: 290px !important;
  }
  .filter-sort {
    left: 555px !important;
  }
  .custom-select-wrapper {
    width: 160px !important;
  }
  /* Galerie pour tablette */
  .photo-gallery {
    max-width: 768px;
    gap: 10px;
    margin: 80px auto 20px;
  }
  .photo-gallery .photo-item {
    width: calc(50% - 10px);
    height: 350px;
  }
  .photo-gallery .photo-item img {
    width: 100%;
    height: 100%;
    object-fit: cover;
  }
  .photo-gallery .view-icon {
    top: 175px;
  }
}
@media (max-width: 767px) {
  /* Filtres pour mobile */
  .filters-container {
    display: flex;
    flex-direction: column;
    align-items: center !important;
    margin: 20px 0 20px 0 !important;
    width: 100%;
    padding: 0;
    max-width: 375px;
  }
  .filter {
    width: 100%;
    display: flex;
    flex-direction: column;
    align-items: center !important;
    margin: 10px 0 !important;
    position: relative;
    top: auto;
    left: auto;
  }
  /* Réorganisation des filtres */
  .filter-format {
    order: 1; /* Met le filtre "Formats" en premier */
  }
  .filter-category {
    order: 2; /* Met le filtre "Categories" au milieu */
  }
  .filter-sort {
    order: 3; /* Met le filtre "Trier par" en dernier */
  }
  /* Corriger tout comportement étrange de flex */
  .custom-select-wrapper {
    width: 100% !important;
    max-width: 260px;
    box-sizing: border-box;
  }
  .custom-select {
    width: 100% !important;
  }
  /* Galerie pour mobile */
  .photo-gallery {
    max-width: 317.66px;
    margin: 20px auto;
    gap: 20px;
    flex-direction: column;
    align-items: center;
  }
  .photo-gallery .photo-item {
    width: 100%;
    height: 237.8px;
  }
  .photo-gallery .photo-item img {
    width: 100%;
    height: 100%;
    object-fit: cover;
  }
  .photo-gallery .view-icon {
    top: 45%;
  }
}

/*# sourceMappingURL=gallery.cs.map */
