import {
  generateNoBooking,
  generateNoTransaction,
  selisihWaktu,
} from "./utils.js";

const BASEURL = "http://localhost/sewa-lapangan";

$("#sewa").DataTable();

$(function () {
  $(document).on("click", ".btn-detail-booking", function () {
    const noTrans = $(this).data("notrans");
    const nama = $(this).data("nama");
    const status = $(this).data("status");
    const lama = $(this).data("lama");
    $.ajax({
      url: `${BASEURL}/dashboard/getdetailbookingjson`,
      data: { id: noTrans },
      method: "post",
      dataType: "json",
      success: function (data) {
        let harga = 0;
        if (data.status_member_when_book !== "Member") harga = data.harga;
        let confirm = "Belum Dikonfirmasi";
        if (data.status_booking !== "Menunggu") confirm = "Sudah Dikonfirmasi";
        let ket = "Segera Upload Bukti Transfer";
        if (data.bukti_bayar !== null) {
          if (data.status_booking === "Aktif") ket = "Aktif";
          else if (data.status_booking === "Selesai") ket = "Selesai";
        }
        $("#detail-no-trans").text(data.no_transaksi);
        $("#detail-no-book").text(data.kode_booking);
        $("#detail-nama").text(nama);
        $("#detail-status").text(status);
        $("#detail-lapangan").text(data.nama_lapangan);
        $("#detail-tanggal").text(data.tanggal_sewa);
        $("#detail-jadwal").text(data.jadwal);
        $("#detail-jam").text(data.jam_mulai + " - " + data.jam_selesai);
        $("#detail-lama").text(lama + " Jam");
        $("#detail-harga").text(harga * lama);
        $("#detail-konfir").text(confirm);
        $("#detail-ket").text(ket);
      },
    });
  });

  $(document).on("click", ".btn-print", function () {
    const noTrans = $(this).data("notrans");
    const nama = $(this).data("nama");
    const status = $(this).data("status");
    const lama = $(this).data("lama");
    $.ajax({
      url: `${BASEURL}/dashboard/getdetailbookingjson`,
      data: { id: noTrans },
      method: "post",
      dataType: "json",
      success: function (data) {
        $("#print-nama").text(nama);
        $("#print-member").text(status);
        $("#print-lapangan").text(data.nama_lapangan);
        $("#print-tanggal").text(data.tanggal_sewa);
        $("#print-sewa").text(data.jadwal);
        $("#print-jam").text(data.jam_mulai + " - " + data.jam_selesai);
        $("#print-lama").text(lama + " Jam");
        $("#print-harga").text(data.harga * lama);
        $("#print-kode-book").text(data.kode_booking);
        $(".btn-anchor-print").attr(
          "href",
          `${BASEURL}/dashboard/cetakbooking/${data.no_transaksi}`
        );
      },
    });
  });

  $(document).on("click", ".btn-upload", function () {
    const noTrans = $(this).data("notrans");
    $("#id").val(noTrans);
    $.ajax({
      url: `${BASEURL}/dashboard/getdetailbookingjson`,
      data: { id: noTrans },
      method: "post",
      dataType: "json",
      success: function (data) {
        if (data.bukti_bayar !== null) {
          Swal.fire({
            title: `Anda Telah Mengunggah Bukti Pembayaran. Yakin Untuk Mengunggah Ulang?`,
            text: "Anda Tidak Dapat Mengembalikan Ini!",
            icon: "question",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "Ya, Upload!",
          }).then((result) => {
            if (result.isConfirmed) {
              $("#upload").modal("show");
            }
          });
        } else {
          $("#upload").modal("show");
        }
      },
    });
  });

  $(document).on("click", ".btn-show-evidence", function () {
    const noTrans = $(this).data("notrans");
    $.ajax({
      url: `${BASEURL}/dashboard/getdetailbookingjson`,
      data: { id: noTrans },
      method: "post",
      dataType: "json",
      success: function (data) {
        $(".modal-body-evidence img").attr(
          "src",
          `${BASEURL}/public/img/evidence/${data.bukti_bayar}`
        );
      },
    });
  });

  $(document).on("click", ".btn-cancel-booking", function () {
    const noTrans = $(this).data("notrans");
    const statusBooking = $(this).data("statusbook");
    if (statusBooking !== "Menunggu") {
      Swal.fire({
        title: "Upss...",
        text: `Status Booking Saat Ini ${statusBooking}. Anda Tidak Dapat Melakukan Pembatalan!`,
        icon: "warning",
      });
    } else {
      Swal.fire({
        title: "Apakah Anda Yakin?",
        text: "Saat Membatalkan, Pembayaran Yang Telah Dilakukan Tidak Dapat Dikembalikan!",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Ya, Batalkan!",
      }).then((result) => {
        if (result.isConfirmed) {
          window.location.href = `${BASEURL}/dashboard/cancelbooking/${noTrans}`;
        }
      });
    }
  });

  const statusMember = $(".status-user").text();
  if (statusMember === "Member") {
    $(document).on("click", ".btn-buy-package", function () {
      Swal.fire({
        title: "Upss...",
        text: "Anda Telah Menjadi Member Di Gor Unipol!",
        icon: "info",
      }).then((result) => {
        if (result.isConfirmed) {
          window.location.href = `${BASEURL}/dashboard/membersuccess`;
        }
      });
    });
  } else {
    $(".btn-buy-package")
      .attr("data-bs-toggle", "modal")
      .attr("data-bs-target", "#detailPembelian");
    $(document).on("click", ".btn-buy-package", function () {
      const id = $(this).data("id");
      const noTrans = generateNoTransaction();
      const date = new Date();
      const currentDate = date.toISOString().split("T")[0];
      date.setDate(date.getDate() + 30);
      const validUntil = date.toISOString().split("T")[0];
      $.ajax({
        url: `${BASEURL}/dashboard/getpaketmemberjson`,
        data: { id: id },
        method: "post",
        dataType: "json",
        success: function (data) {
          $(".p-no-transaksi").text(noTrans);
          $(".input-no-transaksi").val(noTrans);
          $(".p-jenis-paket").text(data.nama_paket);
          $(".input-jenis-paket").val(data.id);
          $(".p-harga").text(data.harga);
          $(".input-tanggal-beli").val(currentDate);
          $(".input-berlaku-sampai").val(validUntil);
          $(".p-keterangan-paket").text(data.keterangan);
        },
      });
    });
  }

  $(document).on("click", ".btn-show-evidence-2", function () {
    const memberId = $(this).data("memberid");
    $.ajax({
      url: `${BASEURL}/dashboard/getdetailmemberjson`,
      data: { id: memberId },
      method: "post",
      dataType: "json",
      success: function (data) {
        $(".modal-body-evidence img").attr(
          "src",
          `${BASEURL}/public/img/evidence/${data.bukti_bayar}`
        );
      },
    });
  });

  $(document).on("click", ".btn-edit-member", function () {
    const memberid = $(this).data("memberid");
    $("#id").val(memberid);
    const statusTransaksi = $(this).data("statustransaksi");
    if (statusTransaksi !== "Menunggu") {
      Swal.fire({
        title: "Upss...",
        text: `Transaksi berstatus ${statusTransaksi}. Anda Tidak Dapat Melakukan Perubahan!`,
        icon: "error",
      });
    } else {
      $.ajax({
        url: `${BASEURL}/dashboard/getdetailmemberjson`,
        data: { id: memberid },
        method: "post",
        dataType: "json",
        success: function (data) {
          if (data.bukti_bayar !== null) {
            Swal.fire({
              title: `Anda Telah Mengunggah Bukti Pembayaran. Yakin Untuk Mengunggah Ulang?`,
              text: "Anda Tidak Dapat Mengembalikan Ini!",
              icon: "question",
              showCancelButton: true,
              confirmButtonColor: "#3085d6",
              cancelButtonColor: "#d33",
              confirmButtonText: "Ya, Upload!",
            }).then((result) => {
              if (result.isConfirmed) {
                $("#upload").modal("show");
              }
            });
          } else {
            $("#upload").modal("show");
          }
        },
      });
    }
  });

  $(document).on("click", ".btn-cancel-member", function () {
    const memberId = $(this).data("memberid");
    const statusTransaksi = $(this).data("statustransaksi");
    if (statusTransaksi !== "Menunggu") {
      Swal.fire({
        title: "Upss...",
        text: `Transaksi berstatus ${statusTransaksi}. Anda Tidak Dapat Melakukan Pembatalan!`,
        icon: "error",
      });
    } else {
      Swal.fire({
        title: "Apakah Anda Yakin?",
        text: "Saat Membatalkan, Pembayaran Yang Telah Dilakukan Tidak Dapat Dikembalikan!",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Ya, Batalkan!",
      }).then((result) => {
        if (result.isConfirmed) {
          window.location.href = `${BASEURL}/dashboard/cancelmember/${memberId}`;
        }
      });
    }
  });

  let opsidefMulai = $("<option>")
    .attr({ value: 0, hidden: true })
    .text("Silakan Pilih Jam Mulai");
  let opsidefSelesai = $("<option>")
    .attr({ value: 0, hidden: true })
    .text("Silakan Pilih Jam Selesai");

  $(".btn-booking-reset").on("click", function () {
    $("#formBooking").trigger("reset");
    $("#jamMulai").empty();
    $("#jamMulai").append(opsidefMulai);

    $("#jamSelesai").empty();
    $("#jamSelesai").append(opsidefSelesai);
    $("#noTrans").val(generateNoTransaction());
    $("#kodeBooking").val(generateNoBooking());
  });

  $(document).on("change", "#jadwal", function () {
    $("#jamMulai").empty();
    $("#jamSelesai").empty();
    $("#jamMulai").append(opsidefMulai);
    $("#jamSelesai").append(opsidefSelesai);

    let opsiData = [];
    if ($("#jadwal").val() === "pagi") {
      for (let i = 7; i < 12; i++) {
        if (i < 10) opsiData.push({ value: `0${i}:00:00`, text: `0${i}:00` });
        else opsiData.push({ value: `${i}:00:00`, text: `${i}:00` });
      }
      $.each(opsiData, function (_, opsi) {
        $("#jamMulai").append(
          $("<option>", {
            value: opsi.value,
            text: opsi.text,
          })
        );
        $("#jamSelesai").append(
          $("<option>", {
            value: opsi.value,
            text: opsi.text,
          })
        );
      });
    } else if ($("#jadwal").val() === "siang") {
      for (let i = 11; i < 18; i++) {
        opsiData.push({ value: `${i}:00:00`, text: `${i}:00` });
      }
      $.each(opsiData, function (_, opsi) {
        $("#jamMulai").append(
          $("<option>", {
            value: opsi.value,
            text: opsi.text,
          })
        );
        $("#jamSelesai").append(
          $("<option>", {
            value: opsi.value,
            text: opsi.text,
          })
        );
      });
    } else {
      for (let i = 17; i < 24; i++) {
        opsiData.push({ value: `${i}:00:00`, text: `${i}:00` });
      }
      $.each(opsiData, function (_, opsi) {
        $("#jamMulai").append(
          $("<option>", {
            value: opsi.value,
            text: opsi.text,
          })
        );
        $("#jamSelesai").append(
          $("<option>", {
            value: opsi.value,
            text: opsi.text,
          })
        );
      });
    }
  });

  let jamMain = new Object();

  $("#jamMulai").on("change", function () {
    jamMain.mulai = $("#jamMulai").val();
    if ($("#jamMulai").val() === $("#jamSelesai").val()) {
      Swal.fire({
        title: "Upss",
        text: "Anda Memilih Jam Yang Invalid!",
        icon: "error",
      });
      $("#jamMulai option:first").prop("selected", true);
    }
  });

  $("#jamSelesai").on("change", function () {
    jamMain.selesai = $("#jamSelesai").val();
    if ($("#jamSelesai").val() === $("#jamMulai").val()) {
      Swal.fire({
        title: "Upss...",
        text: "Anda Memilih Jam Yang Invalid!",
        icon: "error",
      });
      $("#jamSelesai option:first").prop("selected", true);
    }
  });

  $.ajax({
    url: `${BASEURL}/dashboard/checkbeforebooking`,
    method: "post",
    dataType: "json",
    success: function (data) {
      // a member
      if (data) {
        $("#noTransMember").val(data.no_transaksi);
        const hariObj = {
          Minggu: 0,
          Senin: 1,
          Selasa: 2,
          Rabu: 3,
          Kamis: 4,
          Jumat: 5,
          Sabtu: 6,
        };
        $("#tanggalSewa").on("change", function () {
          let tglSewa = new Date($("#tanggalSewa").val());
          let hari = tglSewa.getDay();
          let rentangHari = data.hari;
          let [dari, sampai] = rentangHari
            .split("-")
            .map((hari) => hariObj[hari]);
          if (dari === hariObj.Sabtu && sampai === hariObj.Minggu) {
            if (!(hari === hariObj.Sabtu || hari === hariObj.Minggu)) {
              Swal.fire({
                title: `Upss...`,
                text: `${data.nama_paket} Hanya Dapat Memilih Hari ${data.hari}!`,
                icon: "warning",
              });
              $("#tanggalSewa").val(null);
            }
          } else {
            if (!(hari >= dari && hari <= sampai)) {
              Swal.fire({
                title: `Upss...`,
                text: `${data.nama_paket} Hanya Dapat Memilih Hari ${data.hari}!`,
                icon: "warning",
              });
              $("#tanggalSewa").val(null);
            }
          }
        });

        $("#jadwal").on("change", function () {
          if (data.jadwal !== "semua") {
            if ($(this).val() !== data.jadwal) {
              Swal.fire({
                title: `Upss...`,
                text: `${data.nama_paket} Hanya Dapat Memilih Sesi ${data.jadwal}!`,
                icon: "warning",
              });
              $("#jadwal option:first").prop("selected", true);
            }
          }
        });
        $("#jamMulai").on("change", function () {
          if (
            jamMain.hasOwnProperty("mulai") &&
            jamMain.hasOwnProperty("selesai")
          ) {
            if (selisihWaktu(jamMain.mulai, jamMain.selesai)) {
              Swal.fire({
                title: `Upss...`,
                text: `Waktu Member Bermain Adalah 3 Jam!`,
                icon: "warning",
              });
              $("#jamMulai option:first").prop("selected", true);
              $("#jamSelesai option:first").prop("selected", true);
              delete jamMain.mulai;
              delete jamMain.selesai;
            }
          }
        });
        $("#jamSelesai").on("change", function () {
          if (
            jamMain.hasOwnProperty("mulai") &&
            jamMain.hasOwnProperty("selesai")
          ) {
            if (selisihWaktu(jamMain.mulai, jamMain.selesai)) {
              Swal.fire({
                title: `Upss...`,
                text: `Waktu Member Bermain Adalah 3 Jam!`,
                icon: "warning",
              });
              $("#jamMulai option:first").prop("selected", true);
              $("#jamSelesai option:first").prop("selected", true);
              delete jamMain.mulai;
              delete jamMain.selesai;
            }
          }
        });
      } else {
        $("#noTransMember").val(0);
      }
    },
  });
});
