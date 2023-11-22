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

  $(document).on("click", ".btn-delete-payment", function () {
    const id = $(this).data("id");
    const bank = $(this).data("bank");

    Swal.fire({
      title: `Data Rekening Bank ${bank} Akan Dihapus. Apakah Anda Yakin?`,
      text: "Anda Tidak Dapat Mengembalikan Ini!",
      icon: "warning",
      showCancelButton: true,
      confirmButtonColor: "#3085d6",
      cancelButtonColor: "#d33",
      confirmButtonText: "Ya, Hapus!",
    }).then((result) => {
      if (result.isConfirmed) {
        window.location.href = `${BASEURL}/admin/dashboard/deletepaymentmethod/${id}`;
      }
    });
  });

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
        $("#status").val(data.status_member);
        $("#id").val(data.id);
      },
    });
  });

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

  $(document).on("click", ".btn-show-evidence-3", function () {
    $(".btn-navigation-modal")
      .removeAttr("data-bs-target")
      .removeAttr("data-bs-toggle")
      .attr("data-bs-dismiss", "modal")
      .text("Tutup");
    const memberId = $(this).data("memberid");
    $.ajax({
      url: `${BASEURL}/admin/dashboard/getdetailtransjson`,
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

  $(document).on("click", ".btn-confirm-booking", function () {
    $(".btn-navigation-modal")
      .removeAttr("data-bs-dismiss")
      .attr("data-bs-target", "#konfirmasi")
      .attr("data-bs-toggle", "modal")
      .text("Kembali");
    const memberId = $(this).data("memberid");
    $("#id").val(memberId);
    $.ajax({
      url: `${BASEURL}/admin/dashboard/getdetailtransjson`,
      data: { id: memberId },
      method: "post",
      dataType: "json",
      success: function (data) {
        $("#id_user").val(data.id_user);
        $(".p-confirm-name").text(data.nama);
        $(".p-confirm-email").text(data.email);
        $(".p-confirm-telp").text(data.no_telp);
        $(".p-confirm-gender").text(data.jenis_kelamin);
        $(".img-confirm").attr(
          "src",
          `${BASEURL}/public/img/evidence/${data.bukti_bayar}`
        );
        $(".modal-body-evidence img").attr(
          "src",
          `${BASEURL}/public/img/evidence/${data.bukti_bayar}`
        );
      },
    });
  });

  $(".btn-add-inform").on("click", function () {
    $("#informModalLabel").html("Tambah Data Informasi");
    $(".modal-content-inform form").attr(
      "action",
      `${BASEURL}/admin/dashboard/addinform`
    );
    $(".input-inform").val("");
    $(".textarea-inform").val("");
  });

  $(document).on("click", ".btn-edit-inform", function () {
    $("#informModalLabel").html("Edit Data Informasi");
    $(".modal-content-inform form").attr(
      "action",
      `${BASEURL}/admin/dashboard/editinform`
    );

    const id = $(this).data("id");
    $.ajax({
      url: `${BASEURL}/admin/dashboard/getinformbyidjson`,
      data: { id: id },
      method: "post",
      dataType: "json",
      success: function (data) {
        $("#judul").val(data.judul);
        $("#isi").val(data.isi);
        $("#id").val(id);
      },
    });
  });

  $(document).on("click", ".btn-delete-inform", function () {
    const id = $(this).data("id");
    const judul = $(this).data("judul");
    Swal.fire({
      title: `${judul} Akan Dihapus. Apakah Anda Yakin?`,
      text: "Anda Tidak Dapat Mengembalikan Ini!",
      icon: "warning",
      showCancelButton: true,
      confirmButtonColor: "#3085d6",
      cancelButtonColor: "#d33",
      confirmButtonText: "Ya, Hapus!",
    }).then((result) => {
      if (result.isConfirmed) {
        window.location.href = `${BASEURL}/admin/dashboard/deleteinform/${id}`;
      }
    });
  });

  $(document).on("click", ".btn-edit-akun-pengguna", function () {
    const username = $(this).data("username");
    $.ajax({
      url: `${BASEURL}/admin/dashboard/getdataakunjson`,
      data: { username: username },
      method: "post",
      dataType: "json",
      success: function (data) {
        $("#akunModalLabel").text(`Ubah Status Akun ${data.nama}`);
        $("#id").val(data.id);
        $("#statusAkun").val(data.status_akun);
      },
    });
  });
});
