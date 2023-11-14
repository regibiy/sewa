<div class="col-10 p-5">
    <div class="row justify-content-between mb-3">
        <div class="col">
            <h4>Data Sewa</h4>
        </div>
        <div class="col text-end">
            <button type="button" class="btn btn-primary btn-show-payment-method" data-bs-toggle="modal" data-bs-target="#metodePembayaran">
                Kode Pembayaran
            </button>
        </div>
    </div>
    <div class="row mb-5">
        <div class="col">
            <div class="table-responsive border p-3 rounded">
                <table id="sewa" class="table table-striped table-bordered" style="width:100%">
                    <thead>
                        <tr>
                            <th class="fw-medium bg-info-subtle">No.</th>
                            <th class="fw-medium bg-info-subtle">Lapangan</th>
                            <th class="fw-medium bg-info-subtle">Harga</th>
                            <th class="fw-medium bg-info-subtle">Jam Mulai</th>
                            <th class="fw-medium bg-info-subtle">Jam Selesai</th>
                            <th class="fw-medium bg-info-subtle">Lama Sewa</th>
                            <th class="fw-medium bg-info-subtle">Bukti Pembayaran</th>
                            <th class="fw-medium bg-info-subtle">Total</th>
                            <th class="fw-medium bg-info-subtle">Status</th>
                            <th class="fw-medium bg-info-subtle">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $no = 0;
                        foreach ($data["data_booking"] as $value) {
                            $no++;
                            $lama_sewa = getLamaSewa($value["jam_mulai"], $value["jam_selesai"]);
                            echo "<tr>";
                            echo  "<td>" . $no . "</td>";
                            echo  "<td>" . $value["nama_lapangan"] . "</td>";
                            echo  "<td>" . $value["harga"] . "</td>";
                            echo  "<td>" . $value["jam_mulai"] . "</td>";
                            echo  "<td>" . $value["jam_selesai"] . "</td>";
                            echo  "<td>" . $lama_sewa . " Jam</td>";
                            echo  "<td>" . ($value["bukti_bayar"] === null ? "Segera upload bukti pembayaran Anda!" : "<button type='button' class='btn btn-sm btn-outline-secondary btn-show-evidence mb-1' data-notrans='" . $value["no_transaksi"] . "' data-bs-toggle='modal' data-bs-target='#buktiBayar'>Lihat Bukti</button>") . "</td>";
                            echo  "<td>" . $value["harga"] * $lama_sewa . "</td>";
                            echo  "<td>" . $value["status_booking"] . "</td>";
                            echo  "<td>
                            <button type='button' class='btn btn-sm btn-outline-secondary btn-detail-booking mb-1' data-bs-toggle='modal' data-notrans='" . $value["no_transaksi"] . "' data-nama='" . $_SESSION["nama_user"] . "' data-status='" . $_SESSION["status_member"] . "' data-lama='" . $lama_sewa . "' data-bs-target='#detailBooking'><i class='bi bi-file-text'></i></button>
                            <button type='button' class='btn btn-sm btn-outline-secondary btn-print mb-1' data-notrans='" . $value["no_transaksi"] . "' data-nama='" . $_SESSION["nama_user"] . "' data-status='" . $_SESSION["status_member"] . "' data-lama='" . $lama_sewa . "' data-bs-toggle='modal' data-bs-target='#cetak'><i class='bi bi-printer-fill'></i></button>
                            <button type='button' class='btn btn-sm btn-outline-secondary btn-upload mb-1' data-notrans='" . $value["no_transaksi"] . "'>
                            <i class='bi bi-cloud-arrow-up-fill'></i>
                            </button>
                            <button type='button' class='btn btn-sm btn-outline-secondary btn-cancel-booking mb-1' data-notrans='" . $value["no_transaksi"] . "'><i class='bi bi-x-circle-fill'></i></button> 
                            </td>";
                            echo "</tr>";
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
</div>

<!-- Modal-->
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
                <button type="button" class="btn btn-secondary" data-bs-target="#konfirmasi" data-bs-toggle="modal">Tutup</button>
            </div>
        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="metodePembayaran" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Kode Pembayaran</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <?php
                foreach ($data["payment_method"] as $value) {
                    echo "<div class='border rounded mb-4 p-3'>";
                    echo "<p>Bank : <span class='fw-medium'>" . $value["nama_bank"] . "</span></p>";
                    echo "<p>Nomor Rekening : <span class='fw-medium'>" . $value["no_rekening"] . "</span></p>";
                    echo "<p>Atas Nama : <span class='fw-medium'>" . $value["nama_pemilik"] . "</span></p>";
                    echo "</div>";
                }
                ?>
            </div>
        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="detailBooking" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Detail Data</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row row-cols-3">
                    <div class="col-4">
                        <p>No Transaksi</p>
                        <p>Kode Booking</p>
                        <p>Nama</p>
                        <p>Status</p>
                        <p>Lapangan</p>
                        <p>Tanggal</p>
                        <p>Jadwal</p>
                        <p>Jam</p>
                        <p>Lama Sewa</p>
                        <p>Harga</p>
                        <p>Konfirmasi</p>
                        <p>Keterangan</p>
                    </div>
                    <div class="col-1">
                        <p>:</p>
                        <p>:</p>
                        <p>:</p>
                        <p>:</p>
                        <p>:</p>
                        <p>:</p>
                        <p>:</p>
                        <p>:</p>
                        <p>:</p>
                        <p>:</p>
                        <p>:</p>
                        <p>:</p>
                    </div>
                    <div class="col-7">
                        <p id="detail-no-trans"></p>
                        <p id="detail-no-book"></p>
                        <p id="detail-nama"></p>
                        <p id="detail-status"></p>
                        <p id="detail-lapangan"></p>
                        <p id="detail-tanggal"></p>
                        <p id="detail-jadwal"></p>
                        <p id="detail-jam"></p>
                        <p id="detail-lama"></p>
                        <p id="detail-harga"></p>
                        <p id="detail-konfir">Belum Dikonfirmasi / Sudah Dikonfirmasi</p>
                        <p id="detail-ket">Segera Upload Bukti Transfer / Aktif / Selesai</p>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
            </div>
        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="cetak" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Preview Bukti Booking</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row row-cols-3 mb-4">
                    <div class="col-4">
                        <p>Nama</p>
                        <p>Status</p>
                        <p>Lapangan</p>
                        <p>Tanggal</p>
                        <p>Jadwal</p>
                        <p>Jam</p>
                        <p>Lama Sewa</p>
                        <p>Harga</p>
                    </div>
                    <div class="col-1">
                        <p>:</p>
                        <p>:</p>
                        <p>:</p>
                        <p>:</p>
                        <p>:</p>
                        <p>:</p>
                        <p>:</p>
                        <p>:</p>
                    </div>
                    <div class="col-7">
                        <p id="print-nama"></p>
                        <p id="print-member"></p>
                        <p id="print-lapangan"></p>
                        <p id="print-tanggal"></p>
                        <p id="print-sewa"></p>
                        <p id="print-jam"></p>
                        <p id="print-lama"></p>
                        <p id="print-harga"></p>
                    </div>
                </div>
                <h5 class="text-center mb-4">Kode Booking : <br /> <span id="print-kode-book"></span></h5>
                <div class="text-center">
                    <p class="m-0">Gor Unipol</p>
                    <p class="m-0">Jalan Patikrama, Kec. Nanga Pinoh, Kab. Melawi, Kalimantan Barat</p>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                <a href="" class="btn btn-primary btn-anchor-print">Cetak</a>
            </div>
        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="upload" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true" data-bs-backdrop="static" data-bs-keyboard="false">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <form action="<?= BASEURL ?>/dashboard/uploadbuktibayar" method="post" autocomplete="off" enctype="multipart/form-data">
                <input type="hidden" name="id" id="id">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Upload Bukti Pembayaran</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-5">
                        <label for="buktiBayar" class="form-label">Upload Bukti Pembayaran</label>
                        <input type="file" id="buktiBayar" class="form-control" name="bukti_bayar" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                    <button type="submit" class="btn btn-primary">Upload</button>
                </div>
            </form>
        </div>
    </div>
</div>