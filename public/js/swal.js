document.addEventListener("DOMContentLoaded", function () {
  const notif = document.querySelector("#notification");

  if (notif) {
    let title = notif.getAttribute("data-title");
    let message = notif.getAttribute("data-message");
    let icon = notif.getAttribute("data-icon");
    Swal.fire({
      title: title,
      text: message,
      icon: icon,
    });
  }
});
