document.addEventListener("DOMContentLoaded", () => {
  const menuToggle = document.getElementById("menu-toggle");
  const navLinks = document.getElementById("nav-links");

  if (!menuToggle || !navLinks) {
    return;
  }

  menuToggle.addEventListener("click", () => {
    const isOpen = navLinks.classList.toggle("active");

    menuToggle.setAttribute("aria-expanded", isOpen);
  });
});

document.querySelectorAll(".policy-link").forEach((link) => {
  link.addEventListener("click", async (e) => {
    e.preventDefault();

    const response = await fetch(link.href);
    const policy = await response.json();

    document.getElementById("policyTitle").textContent = policy.title;

    const content = document.getElementById("policyContent");

    content.innerHTML = `
          <p>${policy.description}</p>
      `;

    const sections = policy[link.dataset.policy];

    sections.forEach((section, index) => {
      content.innerHTML += `
              <h2>${index + 1}. ${section.title}</h2>
          `;

      if (Array.isArray(section.description)) {
        section.description.forEach((description) => {
          content.innerHTML += `
                      <p>${description}</p>
                  `;
        });
      } else {
        content.innerHTML += `
                  <p>${section.description}</p>
              `;
      }
    });

    document.getElementById("policyModal").style.display = "flex";
  });
});

document.querySelector(".policy-close").addEventListener("click", () => {
  document.getElementById("policyModal").style.display = "none";
});
