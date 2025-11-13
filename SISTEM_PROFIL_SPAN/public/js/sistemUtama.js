// js/sistemUtama.js
document.addEventListener("DOMContentLoaded", () => {
  const addBtn = document.querySelector(".add-btn");
  if (addBtn) {
    addBtn.addEventListener("click", () => {
      addBtn.classList.add("clicked");
      setTimeout(() => addBtn.classList.remove("clicked"), 300);
    });
  }
});
