function setActiveSideBar(idSideBar) {
    aktif = document.getElementById(idSideBar);
    aktif.classList.add("active");
}

function openMenu() {
    document.getElementById("listMenu").style.display = "block";
}
