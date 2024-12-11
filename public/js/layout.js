/* Commun */

document.addEventListener("DOMContentLoaded", function() {
    const burger = document.querySelector(".burger");
    const menu = document.querySelector(".menu-items");

    burger.addEventListener("click", function() {
        menu.classList.toggle("active");
    });
});


document.addEventListener("DOMContentLoaded", () => {
    const modal = document.getElementById("modal");
    const modalImage = document.getElementById("modal-image");
    const nomSpan = document.getElementById("nom");
    const tagSpan = document.getElementById("tag");
    const noteSpan = document.getElementById("note");
    const closeModal = document.getElementById("closeModal");

    console.log("coucou");
    document.querySelectorAll(".image-modal").forEach(image => {
        image.addEventListener("click", () => {
            const url = image.dataset.url;
            const titre = image.dataset.titre;
            const tags = image.dataset.tags;
            const note= image.dataset.note;

            modalImage.src = url;
            modalImage.alt = `Image de ${titre}`;
            nomSpan.textContent = `Nom : ${titre}`;
            noteSpan.textContent = `Note : ${note} /5`;
            tagSpan.textContent = `Tags : ${tags}`;
            
            modal.style.display = "block";
        });
    });

    
    closeModal.addEventListener("click", () => {
        modal.style.display = "none";
    });
});

/* Page Photo */ 

document.addEventListener("DOMContentLoaded", () => {
    const buttonazphoto = document.getElementById('buttonazphoto');
    const buttonzaphoto = document.getElementById('buttonzaphoto');
    const photoList = document.querySelector('#photo-list'); // Liste contenant les photos

    // Vérification si photoList existe
    if (!photoList) {
        console.error('Le conteneur des photos (photo-list) est introuvable.');
        return; // Arrêt du script si photoList n'existe pas
    }

    // Mélanger les photos au départ (ordre aléatoire)
    shufflePhotos();

    // Fonction pour mélanger les photos (ordre aléatoire)
    function shufflePhotos() {
        const photos = Array.from(photoList.children); // Récupère les éléments enfants
        for (let i = photos.length - 1; i > 0; i--) {
            const j = Math.floor(Math.random() * (i + 1));
            [photos[i], photos[j]] = [photos[j], photos[i]]; // Échange les éléments
        }
        photos.forEach(photo => photoList.appendChild(photo)); // Réorganise les photos dans le DOM
    }

    // Fonction pour trier les photos
    function sortPhotos(order) {
        const photos = Array.from(photoList.children); // Récupère les éléments enfants
    
        photos.sort((a, b) => {
            // Récupère les titres des photos en vérifiant si l'élément existe
            const titleA = a.querySelector('.photo-title') ? a.querySelector('.photo-title').textContent.trim().toLowerCase() : '';
            const titleB = b.querySelector('.photo-title') ? b.querySelector('.photo-title').textContent.trim().toLowerCase() : '';
    
            // Trie A-Z ou Z-A en fonction de l'ordre
            if (order === 'asc') {
                return titleA.localeCompare(titleB); // Trie A-Z
            } else {
                return titleB.localeCompare(titleA); // Trie Z-A
            }
        });
    
        // Réorganise les photos dans le DOM
        photos.forEach(photo => photoList.appendChild(photo));
    }

    // Initialisation des boutons et tri
    const urlParams = new URLSearchParams(window.location.search);
    const currentSort = urlParams.get('sort');
    if (currentSort === 'asc') {
        buttonazphoto.style.display = "none";
        buttonzaphoto.style.display = "block";
        sortPhotos('asc');
    } else if (currentSort === 'desc') {
        buttonazphoto.style.display = "block";
        buttonzaphoto.style.display = "none";
        sortPhotos('desc');
    }

    // Gestion des clics sur les boutons
    buttonazphoto.addEventListener('click', (e) => {
        e.preventDefault(); // Empêche le rechargement
        buttonazphoto.style.display = "none";
        buttonzaphoto.style.display = "block";

        // Met à jour l'URL sans recharger
        const newUrl = new URL(window.location.href);
        newUrl.searchParams.set('sort', 'asc');
        window.history.pushState(null, '', newUrl);

        // Applique le tri
        sortPhotos('asc');
    });

    buttonzaphoto.addEventListener('click', (e) => {
        e.preventDefault(); // Empêche le rechargement
        buttonazphoto.style.display = "block";
        buttonzaphoto.style.display = "none";

        // Met à jour l'URL sans recharger
        const newUrl = new URL(window.location.href);
        newUrl.searchParams.set('sort', 'desc');
        window.history.pushState(null, '', newUrl);

        // Applique le tri
        sortPhotos('desc');
    });
});



/* Page albums */
document.addEventListener("DOMContentLoaded", () => {
    const buttonazalbum = document.getElementById('azalbum');
    const buttonzaalbum = document.getElementById('zaalbum');
    const buttonazdate = document.getElementById('azdate');
    const buttonzadate = document.getElementById('zadate');

    // Vérifier l'état initial de la page via l'URL
    const urlParams = new URLSearchParams(window.location.search);
    const sort = urlParams.get('sort');
    const sortBy = urlParams.get('sort_by');

    // Si la page est triée par titre (ascendant ou descendant)
    if (sortBy === 'titre') {
        if (sort === 'asc') {
            buttonazalbum.style.display = "none";
            buttonzaalbum.style.display = "block";
        } else if (sort === 'desc') {
            buttonazalbum.style.display = "block";
            buttonzaalbum.style.display = "none";
        }
    }

    // Si la page est triée par date (ascendant ou descendant)
    if (sortBy === 'creation') {
        if (sort === 'asc') {
            buttonazdate.style.display = "none";
            buttonzadate.style.display = "block";
        } else if (sort === 'desc') {
            buttonazdate.style.display = "block";
            buttonzadate.style.display = "none";
        }
    }

    // Écouter les clics pour les boutons de tri par titre
    buttonzaalbum.addEventListener('click', (e) => {
        e.preventDefault(); // Empêche le rechargement de la page
        window.location.href = buttonzaalbum.href; // Redirige vers le lien pour trier
    });

    buttonazalbum.addEventListener('click', (e) => {
        e.preventDefault(); // Empêche le rechargement de la page
        window.location.href = buttonazalbum.href; // Redirige vers le lien pour trier
    });

    // Écouter les clics pour les boutons de tri par date
    buttonzadate.addEventListener('click', (e) => {
        e.preventDefault(); // Empêche le rechargement de la page
        window.location.href = buttonzadate.href; // Redirige vers le lien pour trier
    });

    buttonazdate.addEventListener('click', (e) => {
        e.preventDefault(); // Empêche le rechargement de la page
        window.location.href = buttonazdate.href; // Redirige vers le lien pour trier
    });
});

