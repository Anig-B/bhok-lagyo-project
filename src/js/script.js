// Toggle button functionality for responsive nav
document.addEventListener("DOMContentLoaded", () => {
  const navbarToggle = document.getElementById("navbar-toggle");
  const navbarLinks = document.getElementById("navbar-links");

  navbarToggle.addEventListener("click", () => {
    navbarLinks.classList.toggle("show");
  });

  // Close navbar links if clicked outside
  document.addEventListener("click", (event) => {
    if (
      !navbarToggle.contains(event.target) &&
      !navbarLinks.contains(event.target)
    ) {
      navbarLinks.classList.remove("show");
    }
  });
});
