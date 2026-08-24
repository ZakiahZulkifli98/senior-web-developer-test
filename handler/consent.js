document.addEventListener("DOMContentLoaded", () => {
  const consentModal = document.querySelector(".consent-overlay");

  if (!consentModal) {
    return;
  }

  const acceptButton = consentModal.querySelector(".consent-accept");
  const declineButton = consentModal.querySelector(".consent-decline");

  let scrollPosition = 0;

  const lockScroll = () => {
    scrollPosition = window.scrollY;

    document.documentElement.style.overflow = "hidden";
    document.body.style.overflow = "hidden";

    document.body.style.position = "fixed";
    document.body.style.top = `-${scrollPosition}px`;
    document.body.style.left = "0";
    document.body.style.right = "0";
    document.body.style.width = "100%";
  };

  const unlockScroll = () => {
    document.documentElement.style.overflow = "";
    document.body.style.overflow = "";

    document.body.style.position = "";
    document.body.style.top = "";
    document.body.style.left = "";
    document.body.style.right = "";
    document.body.style.width = "";

    window.scrollTo(0, scrollPosition);
  };

  lockScroll();

  const handleConsent = async (action, button) => {
    if (button.disabled) {
      return;
    }

    button.disabled = true;

    const originalText = button.textContent;

    button.textContent = "Processing...";

    try {
      const response = await fetch("/handler/consent.php", {
        method: "POST",

        headers: {
          "Content-Type": "application/json",
          Accept: "application/json",
        },

        body: JSON.stringify({
          action: action,
        }),
      });

      const result = await response.json();

      if (!response.ok || !result.success) {
        throw new Error(
          result.message || "Something went wrong. Please try again.",
        );
      }

      consentModal.remove();

      unlockScroll();
    } catch (error) {
      alert(error.message);

      button.disabled = false;
      button.textContent = originalText;
    }
  };

  // Accept

  acceptButton?.addEventListener("click", () => {
    handleConsent("accept", acceptButton);
  });

  // Decline

  declineButton?.addEventListener("click", () => {
    handleConsent("decline", declineButton);
  });
});
