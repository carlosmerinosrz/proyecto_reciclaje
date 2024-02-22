const mobileNav = document.querySelector(".hamburger");
const navbar = document.querySelector(".menubar");

mobileNav.addEventListener("click", () => {
  navbar.classList.toggle("active");
  mobileNav.classList.toggle("menu-active");
  console.log("esta activo")
});

