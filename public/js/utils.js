function generateNoTransaction() {
  let date = new Date();
  let getDate = date.getDate();
  let getMonth = date.getMonth();
  let random = Math.random().toString();
  return `${getDate}${getMonth}${random.slice(2, 6)}`;
}

function generateNoBooking() {
  let random = Math.random().toString();
  return random.slice(2, 8);
}

function swalAlert(title, message, icon) {
  Swal.fire({
    title: title,
    text: message,
    icon: icon,
  });
}

function swalAlertMenit(input) {
  swalAlert("Upss..", "Hanya Menit 00 Atau 30 Yang Diizinkan!", "warning");
  input.value = null;
}

function swalAlertPagi(select) {
  swalAlert(
    "Upss..",
    "Jadwal pagi hanya di antara pukul 07:00 hingga 11:00 WIB!",
    "warning"
  );
  select.value = null;
}

function swalAlertSiang(select) {
  swalAlert(
    "Upss..",
    "Jadwal siang hanya di antara pukul 11:00 hingga 17:00 WIB!",
    "warning"
  );
  select.value = null;
}

function swalAlertMalam(select) {
  swalAlert(
    "Upss..",
    "Jadwal malam hanya di antara pukul 17:00 hingga 23:00 WIB!",
    "warning"
  );
  select.value = null;
}

function validasiWaktuMain(jamUser, jamMin, jamMax, inputJam, menit, jamObj) {
  if (jamUser < jamMin || jamUser > jamMax) swalAlertPagi(inputJam);
  else if (menit % 30 !== 0) swalAlertMenit(inputJam);
  else {
    jamObj = inputJam.value;
    return true;
  }
}

function selisihWaktu(jamMainMulai, jamMainSelesai) {
  let [jamMulai, menitMulai] = jamMainMulai.split(":").map(Number);
  let [jamSelesai2, menitSelesai] = jamMainSelesai.split(":").map(Number);
  let differenceInMinutes =
    (jamSelesai2 - jamMulai) * 60 + (menitSelesai - menitMulai);

  if (differenceInMinutes < 60 || differenceInMinutes % 60 !== 0) {
    swalAlert(
      "Upss..",
      "Waktu Yang Anda Pilih Kurang Dari 1 Jam Atau Tidak Kelipatan 1 Jam!",
      "warning"
    );
  }
}

export {
  generateNoTransaction,
  generateNoBooking,
  swalAlertPagi,
  swalAlertSiang,
  swalAlertMalam,
  swalAlertMenit,
  selisihWaktu,
  validasiWaktuMain,
};
