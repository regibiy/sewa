$("#sewa").DataTable();

$(function () {
  $(".btn-add-lapangan").on("click", function () {
    $("#lapanganModalLabel").html("Tambah Data Lapangan");
    $(".modal-content-lapangan form").attr(
      "action",
      "http://localhost/sewa-lapangan/admin/dashboard/addlapangan"
    );
    $(".input-lapangan").val("");
    $(".select-lapangan").val("Aktif");
  });

  $(document).on("click", ".btn-edit-lapangan", function () {
    $("#lapanganModalLabel").html("Edit Data Lapangan");
    $(".modal-content-lapangan form").attr(
      "action",
      "http://localhost/sewa-lapangan/admin/dashboard/editlapangan"
    );

    const id = $(this).data("id");
    $.ajax({
      url: "http://localhost/sewa-lapangan/admin/dashboard/getlapanganjson",
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
      "http://localhost/sewa-lapangan/admin/dashboard/addpaymentmethod"
    );
    $(".input-method").val("");
    $(".select-method").val("Aktif");
  });

  $(document).on("click", ".btn-edit-payment", function () {
    $("#paymentModalLabel").html("Edit Data Rekening");
    $(".modal-content-payment form").attr(
      "action",
      "http://localhost/sewa-lapangan/admin/dashboard/editpaymentmethod"
    );

    const id = $(this).data("id");
    $.ajax({
      url: "http://localhost/sewa-lapangan/admin/dashboard/getpaymentmethodjson",
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
      "http://localhost/sewa-lapangan/admin/dashboard/addjadwal"
    );
    $(".input-jadwal").val("");
    $(".select-jadwal option:first").prop("selected", true);
  });

  $(document).on("click", ".btn-edit-jadwal", function () {
    $("#jadwalModalLabel").html("Edit Data Jadwal");
    $(".modal-content-jadwal form").attr(
      "action",
      "http://localhost/sewa-lapangan/admin/dashboard/editjadwal"
    );

    const id = $(this).data("id");
    $.ajax({
      url: "http://localhost/sewa-lapangan/admin/dashboard/getjadwaljson",
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
        window.location.href = `http://localhost/sewa-lapangan/admin/dashboard/deletejadwal/${id}`;
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
      url: "http://localhost/sewa-lapangan/dashboard/getdetailbookingjson",
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
      url: "http://localhost/sewa-lapangan/dashboard/getdetailbookingjson",
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
          `http://localhost/sewa-lapangan/dashboard/cetakbooking/${data.no_transaksi}`
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
      url: "http://localhost/sewa-lapangan/dashboard/getdetailbookingjson",
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
      url: "http://localhost/sewa-lapangan/dashboard/getdetailbookingjson",
      data: { id: noTrans },
      method: "post",
      dataType: "json",
      success: function (data) {
        $(".modal-body-evidence img").attr(
          "src",
          "http://localhost/sewa-lapangan/public/img/evidence/" +
            data.bukti_bayar
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
        window.location.href = `http://localhost/sewa-lapangan/dashboard/cancelbooking/${noTrans}`;
      }
    });
  });
});
