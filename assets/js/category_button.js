document.addEventListener("DOMContentLoaded", () => {
    const btn = document.getElementById("btn-category");
    const arrow = document.getElementById("arrow");
    const menu = document.getElementById("menu-category");

    btn.addEventListener("click", () => {
        menu.classList.toggle("active");
        arrow.textContent = menu.classList.contains("active") ? '  /\\' : '  \\/';
    });
});
