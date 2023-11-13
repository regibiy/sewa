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
                            <th class="fw-medium bg-info-subtle">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $no = 0;
                        foreach ($data["data_booking"] as $value) {
                            $no++;
                            echo "<tr>";
                            echo  "<td>" . $no . "</td>";
                            echo  "<td>" . $value["nama_lapangan"] . "</td>";
                            echo  "<td>" . $value["harga"] . "</td>";
                            echo  "<td>" . $value["jam_mulai"] . "</td>";
                            echo  "<td>" . $value["jam_selesai"] . "</td>";
                            echo  "<td>" . $value["jam_selesai"] . "</td>";
                            echo  "<td>" . ($value["bukti_bayar"] === null ? "Segera upload bukti pembayaran Anda!" : "<button class='btn btn-outline-secondary'>Lihat Bukti</button>") . "</td>";
                            echo  "<td>Undefined By User</td>";
                            echo  "<td><button type='button' class='btn btn-sm btn-outline-secondary btn-detail-booking' data-bs-toggle='modal' data-bs-target='#detailBooking'>
                            <i class='bi bi-file-text'></i></button></td>";
                            echo "</tr>";
                        }
                        ?>
                        <!-- <button type="button" class="btn btn-sm btn-outline-secondary" data-bs-toggle="modal" data-bs-target="#cetak">
                                <i class="bi bi-printer-fill"></i>
                            </button>
                            <button type="button" class="btn btn-sm btn-outline-secondary" data-bs-toggle="modal" data-bs-target="#upload">
                                <i class="bi bi-cloud-arrow-up-fill"></i>
                            </button>
                            <a href="#" class="btn btn-sm btn-outline-secondary"><i class="bi bi-x-circle-fill"></i></a> -->
                    </tbody>
                </table>
            </div>
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
                        <p>123456789</p>
                        <p>12345</p>
                        <p>Agus</p>
                        <p>Non-Member</p>
                        <p>Lapangan 1</p>
                        <p>01 November 2023</p>
                        <p>Pagi</p>
                        <p>09:00 - 10:00</p>
                        <p>1 Jam</p>
                        <p>Rp. 35.000,00</p>
                        <p>Belum Dikonfirmasi / Sudah Dikonfirmasi</p>
                        <p>Segera Upload Bukti Transfer / Aktif / Selesai</p>
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
                        <p>Agus</p>
                        <p>Non-Member</p>
                        <p>Lapangan 1</p>
                        <p>01 November 2023</p>
                        <p>Pagi</p>
                        <p>09:00 - 10:00</p>
                        <p>1 Jam</p>
                        <p>Rp. 35.000,00</p>
                    </div>
                </div>
                <h5 class="text-center mb-4">Kode Booking : <br /> 123456</h5>
                <div class="text-center">
                    <p class="m-0">Gor Unipol</p>
                    <p class="m-0">Jalan Patikrama, Kec. Nanga Pinoh, Kab. Melawi, Kalimantan Barat</p>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                <button type="button" class="btn btn-primary">Cetak</button>
            </div>
        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="upload" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true" data-bs-backdrop="static" data-bs-keyboard="false">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Upload Bukti Pembayaran</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="mb-5">
                    <label for="buktiBayar" class="form-label">Upload Bukti Pembayaran</label>
                    <input type="file" id="buktiBayar" class="form-control">
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                <button type="button" class="btn btn-primary">Upload</button>
            </div>
        </div>
    </div>
</div>