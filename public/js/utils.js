function generateNoTransaction(url) {
  return new Promise((resolve, reject) => {
    let date = new Date();
    let getDate = date.getDate();
    let getMonth = date.getMonth() + 1;
    let getYear = date.getFullYear().toString();
    let counter;
    $.ajax({
      url: url,
      method: "post",
      dataType: "json",
      success: function (data) {
        if (data.max_no_trans === null) {
          counter = "01";
        } else {
          let noTransBefore = data.max_no_trans.toString();
          counter = (parseInt(noTransBefore.slice(6, 8)) + 1)
            .toString()
            .padStart(2, "0");
        }
        resolve(`${getDate}${getMonth}${getYear.slice(2, 4)}${counter}`);
      },
      error: function (error) {
        reject(error);
      },
    });
  });
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

function selisihWaktu(jamMainMulai, jamMainSelesai) {
  let jamMulai = new Date(`1970-01-01T${jamMainMulai}`);
  let jamSelesai = new Date(`1970-01-01T${jamMainSelesai}`);

  let selisihMilDetik = jamSelesai - jamMulai;
  let selisihJam = selisihMilDetik / (1000 * 60 * 60);
  if (selisihJam < 3 || selisihJam > 3) return true;
  else return false;
}

export {
  generateNoTransaction,
  generateNoBooking,
  swalAlertPagi,
  swalAlertSiang,
  swalAlertMalam,
  swalAlertMenit,
  selisihWaktu,
};
