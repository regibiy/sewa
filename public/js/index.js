import {
  generateNoTransaction,
  generateNoBooking,
  swalAlertPagi,
  swalAlertSiang,
  swalAlertMalam,
  swalAlertMenit,
  selisihWaktu,
  validasiWaktuMain,
} from "./utils.js";

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
  if (noTransInput) noTransInput.value = generateNoTransaction();

  const noBookingInput = document.querySelector("#kodeBooking");
  if (noBookingInput) noBookingInput.value = generateNoBooking();

  const btnBookingReset = document.querySelector(".btn-booking-reset");

  if (btnBookingReset) {
    btnBookingReset.addEventListener("click", function () {
      const formBooking = document.querySelector("#formBooking");
      formBooking.reset();
      noBookingInput.value = generateNoBooking();
      noTransInput.value = generateNoTransaction();
    });
  }

  const selectJadwal = document.querySelector("#jadwal");
  if (selectJadwal) {
    selectJadwal.addEventListener("change", function () {
      const inputJamMulai = document.querySelector("#jamMulai");
      const inputJamSelesai = document.querySelector("#jamSelesai");
      inputJamMulai.value = null;
      inputJamSelesai.value = null;
      let jamMain = new Object();
      inputJamMulai.addEventListener("change", function () {
        let jamMulai = new Date("1970-01-01T" + inputJamMulai.value);
        let jam = jamMulai.getHours();
        let menit = jamMulai.getMinutes();
        if (selectJadwal.value === "pagi") {
          // if (jam < 7 || jam > 11) swalAlertPagi(inputJamMulai);
          // else if (menit % 30 !== 0) swalAlertMenit(inputJamMulai);
          // else jamMain.mulai = inputJamMulai.value;
          if (
            validasiWaktuMain(
              jam,
              7,
              11,
              inputJamMulai,
              menit,
              (jamMain.mulai = inputJamMulai.value)
            )
          )
            selisihWaktu(jamMain.mulai, jamMain.selesai, inputJamMulai);
        } else if (selectJadwal.value === "siang") {
          if (
            validasiWaktuMain(
              jam,
              11,
              17,
              inputJamMulai,
              menit,
              (jamMain.mulai = inputJamMulai.value)
            )
          )
            selisihWaktu(jamMain.mulai, jamMain.selesai, inputJamMulai);
        } else if (selectJadwal.value === "malam") {
          if (
            validasiWaktuMain(
              jam,
              17,
              23,
              inputJamMulai,
              menit,
              (jamMain.mulai = inputJamMulai.value)
            )
          )
            selisihWaktu(jamMain.mulai, jamMain.selesai, inputJamMulai);
        }
      });

      inputJamSelesai.addEventListener("change", function () {
        let jamSelesai = new Date("1970-01-01T" + inputJamSelesai.value);
        let jam = jamSelesai.getHours();
        let menit = jamSelesai.getMinutes();
        if (selectJadwal.value === "pagi") {
          if (
            validasiWaktuMain(
              jam,
              7,
              11,
              inputJamSelesai,
              menit,
              (jamMain.selesai = inputJamSelesai.value)
            )
          )
            selisihWaktu(jamMain.mulai, jamMain.selesai, inputJamSelesai);
        } else if (selectJadwal.value === "siang") {
          if (
            validasiWaktuMain(
              jam,
              11,
              17,
              inputJamSelesai,
              menit,
              (jamMain.selesai = inputJamSelesai.value)
            )
          )
            selisihWaktu(jamMain.mulai, jamMain.selesai, inputJamSelesai);
        } else if (selectJadwal.value === "malam") {
          if (
            validasiWaktuMain(
              jam,
              17,
              23,
              inputJamSelesai,
              menit,
              (jamMain.selesai = inputJamSelesai.value)
            )
          )
            selisihWaktu(jamMain.mulai, jamMain.selesai, inputJamSelesai);
        }
      });
    });
  }
});
