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

  $(".btn-edit-lapangan").on("click", function () {
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

  $(".btn-edit-payment").on("click", function () {
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

  $(".btn-edit-jadwal").on("click", function () {
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
  $(".btn-delete-jadwal").on("click", function () {
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
        $.ajax({
          url: `http://localhost/sewa-lapangan/admin/dashboard/deletejadwal`,
          data: { id: id },
          method: "post",
          success: function () {
            Swal.fire({
              title: "Data Jadwal",
              text: "Berhasil Dihapus",
              icon: "success",
              didClose: () => {
                window.location.href = `http://localhost/sewa-lapangan/admin/dashboard/datajadwal`;
              },
            });
          },
        });
      }
    });
  });
});

$(function () {
  $(".btn-detail-booking").on("click", function () {
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
  $(".btn-print").on("click", function () {
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
  $(".btn-upload").on("click", function () {
    $("#id").val($(this).data("notrans"));
  });
});
