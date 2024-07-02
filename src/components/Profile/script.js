function showSection(sectionId) {
  document.querySelectorAll(".section").forEach((section) => {
    section.style.display = "none";
  });
  document.getElementById(sectionId).style.display = "block";
}

function logout() {
  document.getElementById("overlay").style.display = "block";
  alert("Logging out...");
  document.getElementById("overlay").style.display = "none";
}
