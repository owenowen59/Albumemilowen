//Code pour la barre nav
document.addEventListener("DOMContentLoaded", function() {
    const burger = document.querySelector(".burger");
    const menu = document.querySelector(".menu-items");

    burger.addEventListener("click", function() {
        menu.classList.toggle("active");
    });
});

function openModule(imageUrl, titre) {
    const module = document.getElementById("module");
    const moduleImg = document.getElementById("module-img");
    const moduleTitle = document.getElementById("module-title");

    // Afficher l'image et le titre dans le module
    moduleImg.src = imageUrl;
    moduleTitle.textContent = titre;

    // Afficher le module
    module.style.display = "block";
}

function closeModule() {
    const module = document.getElementById("module");
    module.style.display = "none";
}
