<div class="col-10 p-5">
    <h2>Data Member</h2>
    <div class="row">
        <div class="col">
            <div class="table-responsive border p-3 rounded">
                <table id="sewa" class="table table-striped table-bordered" style="width:100%">
                    <thead>
                        <tr>
                            <th class="fw-medium bg-info-subtle">No.</th>
                            <th class="fw-medium bg-info-subtle">No. Transaksi</th>
                            <th class="fw-medium bg-info-subtle">Nama</th>
                            <th class="fw-medium bg-info-subtle">Tanggal</th>
                            <th class="fw-medium bg-info-subtle">Paket Member</th>
                            <th class="fw-medium bg-info-subtle">Jenis Paket</th>
                            <th class="fw-medium bg-info-subtle">Harga</th>
                            <th class="fw-medium bg-info-subtle">Bukti Pembayaran</th>
                            <th class="fw-medium bg-info-subtle">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $no = 0;
                        foreach ($data["member"] as $value) {
                            $no++;
                            echo "<tr>";
                            echo "<td>" . $no . "</td>";
                            echo "<td>" . $value["no_transaksi"] . "</td>";
                            echo "<td>" . $value["nama"] . "</td>";
                            echo "<td>" . $value["tanggal_transaksi"] . "</td>";
                            echo "<td>" . $value["nama_paket"];
                            echo "<td>" . $value["hari"] . " " . $value["jadwal"] . " " . "</td>";
                            echo "<td>" . $value["harga"] .  "</td>";
                            echo "<td><button type='button' class='btn btn-sm btn-outline-secondary btn-show-evidence-3 mb-1' data-memberid='" . $value["member_id"] . "' data-bs-toggle='modal' data-bs-target='#buktiBayar'>Lihat Bukti</button></td>";
                            echo "<td><a href='#' class='btn btn-sm btn-outline-secondary'><i class='bi bi-file-arrow-down-fill'></i></a>
                            <a href='#' class='btn btn-sm btn-outline-secondary'><i class='bi bi-trash-fill'></i></a>
                            <button type='button' class='btn btn-sm btn-outline-secondary' data-memberid='" . $value["member_id"] . "' data-bs-toggle='modal' data-bs-target='#konfirmasi'><i class='bi bi-check-square-fill'></i></button></td>";
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
</div>

<!-- Modal -->
<div class="modal fade" id="konfirmasi" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true" data-bs-backdrop="static" data-bs-keyboard="false">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Konfirmasi Data Booking</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col p-3">
                        <div class="row border rounded mb-4">
                            <div class="row mb-4">
                                <div class="col">
                                    <p class="m-0">Nama</p>
                                    <p class="m-0">Agus</p>
                                </div>
                                <div class="col">
                                    <p class="m-0">Email</p>
                                    <p class="m-0">agus@gmail.com</p>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <p class="m-0">No. Telepon / WA</p>
                                    <p class="m-0">08991332811</p>
                                </div>
                                <div class="col">
                                    <p class="m-0">Jenis Kelamin</p>
                                    <p>Laki-Laki</p>
                                </div>
                            </div>
                        </div>
                        <div class="row mb-4">
                            <div class="col">
                                <h6>Bukti Pembayaran</h6>
                            </div>
                            <div class="col border rounded">
                                <img src="<?= BASEURL ?>/public/img/cth.png" class="img-fluid img-zoom" alt="bukti bayar" data-bs-toggle="modal" data-bs-target="#buktiBayar">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary">Konfirmasi</button>
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
            </div>
        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="buktiBayar" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Bukti Pembayaran</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body text-center modal-body-evidence">
                <img src="" class="img-fluid w-100" alt="bukti bayar">
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
            </div>
        </div>
    </div>
</div>