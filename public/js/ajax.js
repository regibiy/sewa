import { generateNoTransaction } from "./utils.js";

const BASEURL = "http://localhost/sewa-lapangan";

$("#sewa").DataTable();

$(function () {
  $(".btn-add-lapangan").on("click", function () {
    $("#lapanganModalLabel").html("Tambah Data Lapangan");
    $(".modal-content-lapangan form").attr(
      "action",
      `${BASEURL}/admin/dashboard/addlapangan`
    );
    $(".input-lapangan").val("");
    $(".select-lapangan").val("Aktif");
  });

  $(document).on("click", ".btn-edit-lapangan", function () {
    $("#lapanganModalLabel").html("Edit Data Lapangan");
    $(".modal-content-lapangan form").attr(
      "action",
      `${BASEURL}/admin/dashboard/editlapangan`
    );

    const id = $(this).data("id");
    $.ajax({
      url: `${BASEURL}/admin/dashboard/getlapanganjson`,
      data: { id: id },
      method: "post",
      dataType: "json",
      success: function (data) {
        $("#namaLapangan").val(data.nama_lapangan);
        $("#statusLapangan").val(data.status_lapangan);
        $("#id").val(data.id);
      },
    });
  });
});

$(function () {
  $(".btn-add-payment").on("click", function () {
    $("#paymentModalLabel").html("Tambah Data Rekening");
    $(".modal-content-payment form").attr(
      "action",
      `${BASEURL}/admin/dashboard/addpaymentmethod`
    );
    $(".input-method").val("");
    $(".select-method").val("Aktif");
  });

  $(document).on("click", ".btn-edit-payment", function () {
    $("#paymentModalLabel").html("Edit Data Rekening");
    $(".modal-content-payment form").attr(
      "action",
      `${BASEURL}/admin/dashboard/editpaymentmethod`
    );

    const id = $(this).data("id");
    $.ajax({
      url: `${BASEURL}/admin/dashboard/getpaymentmethodjson`,
      data: { id: id },
      method: "post",
      dataType: "json",
      success: function (data) {
        $("#namaBank").val(data.nama_bank);
        $("#namaPemilik").val(data.nama_pemilik);
        $("#noRek").val(data.no_rekening);
        $("#status").val(data.status);
        $("#id").val(data.id);
      },
    });
  });
});

$(function () {
  $(".btn-add-jadwal").on("click", function () {
    $("#jadwalModalLabel").html("Tambah Data Jadwal");
    $(".modal-content-jadwal form").attr(
      "action",
      `${BASEURL}/admin/dashboard/addjadwal`
    );
    $(".input-jadwal").val("");
    $(".select-jadwal option:first").prop("selected", true);
  });

  $(document).on("click", ".btn-edit-jadwal", function () {
    $("#jadwalModalLabel").html("Edit Data Jadwal");
    $(".modal-content-jadwal form").attr(
      "action",
      `${BASEURL}/admin/dashboard/editjadwal`
    );

    const id = $(this).data("id");
    $.ajax({
      url: `${BASEURL}/admin/dashboard/getjadwaljson`,
      data: { id: id },
      method: "post",
      dataType: "json",
      success: function (data) {
        $("#sesi").val(data.sesi);
        $("#hari").val(data.hari);
        $("#harga").val(data.harga);
        $("#id").val(data.id);
      },
    });
  });
});

$(function () {
  $(document).on("click", ".btn-delete-jadwal", function () {
    const id = $(this).data("id");
    const sesi = $(this).data("sesi");
    const hari = $(this).data("hari");

    Swal.fire({
      title: `Sesi ${sesi} Pada Hari ${hari} Akan Dihapus. Apakah Anda Yakin?`,
      text: "Anda Tidak Dapat Mengembalikan Ini!",
      icon: "warning",
      showCancelButton: true,
      confirmButtonColor: "#3085d6",
      cancelButtonColor: "#d33",
      confirmButtonText: "Ya, Hapus!",
    }).then((result) => {
      if (result.isConfirmed) {
        window.location.href = `${BASEURL}/admin/dashboard/deletejadwal/${id}`;
      }
    });
  });
});

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
        $("#detail-no-trans").text(data.kode_booking);
        $("#detail-nama").text(nama);
        $("#detail-status").text(status);
        $("#detail-lapangan").text(data.nama_lapangan);
        $("#detail-tanggal").text(data.tanggal_sewa);
        $("#detail-jadwal").text(data.jadwal);
        $("#detail-jam").text(data.jam_mulai + " - " + data.jam_selesai);
        $("#detail-lama").text(lama + " Jam");
        $("#detail-harga").text(data.harga * lama);
      },
    });
  });
});

$(function () {
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
});

$(function () {
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
});

$(function () {
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
});

$(function () {
  $(document).on("click", ".btn-cancel-booking", function () {
    const noTrans = $(this).data("notrans");
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
  });
});

$(function () {
  $(".btn-add-paket-member").on("click", function () {
    $("#memberModalLabel").html("Tambah Data Paket Member");
    $(".modal-content-member form").attr(
      "action",
      `${BASEURL}/admin/dashboard/addpaketmember`
    );
    $(".input-paket-member").val("");
    $(".textarea-paket-member").val(
      "3 Jam Setiap Booking, 4 Kali Pertemuan Selama Satu Bulan"
    );
    $(".select-paket-member option:first").prop("selected", true);
  });

  $(document).on("click", ".btn-edit-paket-member", function () {
    $("#memberModalLabel").html("Edit Data Paket Member");
    $(".modal-content-member form").attr(
      "action",
      `${BASEURL}/admin/dashboard/editpaketmember`
    );

    const id = $(this).data("id");
    $.ajax({
      url: `${BASEURL}/admin/dashboard/getpaketmemberjson`,
      data: { id: id },
      method: "post",
      dataType: "json",
      success: function (data) {
        $("#namaPaket").val(data.nama_paket);
        $("#hari").val(data.hari);
        $("#sesi").val(data.jadwal);
        $("#keterangan").val(data.keterangan);
        $("#harga").val(data.harga);
        $("#status").val(data.status);
        $("#id").val(data.id);
      },
    });
  });
});

$(function () {
  $(document).on("click", ".btn-delete-paket-member", function () {
    const id = $(this).data("id");
    const namaPaket = $(this).data("namapaket");

    Swal.fire({
      title: `${namaPaket} Akan Dihapus. Apakah Anda Yakin?`,
      text: "Anda Tidak Dapat Mengembalikan Ini!",
      icon: "warning",
      showCancelButton: true,
      confirmButtonColor: "#3085d6",
      cancelButtonColor: "#d33",
      confirmButtonText: "Ya, Hapus!",
    }).then((result) => {
      if (result.isConfirmed) {
        window.location.href = `${BASEURL}/admin/dashboard/deletepaketmember/${id}`;
      }
    });
  });
});

$(function () {
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
});

$(function () {
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
});

$(function () {
  $(document).on("click", ".btn-edit-member", function () {
    const memberid = $(this).data("memberid");
    $("#id").val(memberid);
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
  });
});

$(function () {
  $(document).on("click", ".btn-cancel-member", function () {
    const memberId = $(this).data("memberid");
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
  });
});

$(function () {
  $(document).on("click", ".btn-show-evidence-3", function () {
    const memberId = $(this).data("memberid");
    $.ajax({
      url: `${BASEURL}/admin/dashboard/getdetailtransjson`,
      data: { id: memberId },
      method: "post",
      dataType: "json",
      success: function (data) {
        console.log(data);
        $(".modal-body-evidence img").attr(
          "src",
          `${BASEURL}/public/img/evidence/${data.bukti_bayar}`
        );
      },
    });
  });
});
