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
