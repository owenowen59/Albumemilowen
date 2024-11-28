//Code pour la barre nav
document.addEventListener("DOMContentLoaded", function() {
    const burger = document.querySelector(".burger");
    const menu = document.querySelector(".menu-items");

    burger.addEventListener("click", function() {
        menu.classList.toggle("active");
    });
});