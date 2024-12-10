//Code pour la barre nav
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
            noteSpan.textContent = `Note : ${note}`;
            tagSpan.textContent = `Tags : ${tags}`;
            
            modal.style.display = "block";
        });
    });

    
    closeModal.addEventListener("click", () => {
        modal.style.display = "none";
    });
});




