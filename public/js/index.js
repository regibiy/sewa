import { generateNoTransaction, generateNoBooking } from "./utils.js";

const BASEURL = "http://localhost/sewa-lapangan";

document.addEventListener("DOMContentLoaded", function () {
  const checkShowPass = document.querySelector("#showPassword"),
    inputPass = document.querySelector("#password");

  if (checkShowPass) {
    checkShowPass.addEventListener("click", function () {
      if (inputPass.type == "password") inputPass.type = "text";
      else inputPass.type = "password";
    });
  }

  // -----

  const formProfil = document.querySelector("#formProfil");
  const editProfilBtn = document.querySelector("#editProfil");
  const ubahPasswordBtn = document.querySelector(".ubahPassword");
  const simpanProfilBtn = document.querySelector(".simpanProfil");

  if (editProfilBtn) {
    editProfilBtn.addEventListener("click", function () {
      let inputElements = formProfil.querySelectorAll("input");
      let selectElements = formProfil.querySelectorAll("select");

      if (
        ubahPasswordBtn.classList.contains("d-none") &&
        simpanProfilBtn.classList.contains("d-none")
      ) {
        ubahPasswordBtn.classList.remove("d-none");
        simpanProfilBtn.classList.remove("d-none");
      } else {
        ubahPasswordBtn.classList.add("d-none");
        simpanProfilBtn.classList.add("d-none");
      }

      inputElements.forEach(function (input) {
        if (input.hasAttribute("disabled")) input.removeAttribute("disabled");
        else input.setAttribute("disabled", true);
      });

      selectElements.forEach(function (select) {
        if (select.hasAttribute("disabled")) select.removeAttribute("disabled");
        else select.setAttribute("disabled", true);
      });
    });
  }

  // -----

  const oldPassInput = document.querySelector("#oldPassword");
  const newPassInput = document.querySelector("#newPassword");
  const oldNewPassCheck = document.querySelector("#showOldNewPassword");

  if (oldNewPassCheck) {
    oldNewPassCheck.addEventListener("click", function () {
      if (oldPassInput.type == "password" && newPassInput.type == "password") {
        oldPassInput.type = "text";
        newPassInput.type = "text";
      } else {
        oldPassInput.type = "password";
        newPassInput.type = "password";
      }
    });
  }

  // -----

  const noTransInput = document.querySelector("#noTrans");
  generateNoTransaction(`${BASEURL}/dashboard/getmaxtransnumberbookjson`)
    .then((result) => {
      if (noTransInput) noTransInput.value = result;
    })
    .catch((error) => console.error(error));

  const noBookingInput = document.querySelector("#kodeBooking");
  if (noBookingInput) noBookingInput.value = generateNoBooking();
});
