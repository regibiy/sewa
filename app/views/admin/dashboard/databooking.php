<div class="col-10 p-5">
    <h2>Data Booking</h2>
    <div class="row">
        <div class="col">
            <div class="table-responsive border p-3 rounded">
                <table id="sewa" class="table table-striped table-bordered" style="width:100%">
                    <thead>
                        <tr>
                            <th class="fw-medium bg-info-subtle">No.</th>
                            <th class="fw-medium bg-info-subtle">No. Transaksi</th>
                            <th class="fw-medium bg-info-subtle">Status</th>
                            <th class="fw-medium bg-info-subtle">Lapangan</th>
                            <th class="fw-medium bg-info-subtle">Harga</th>
                            <th class="fw-medium bg-info-subtle">Jam Mulai</th>
                            <th class="fw-medium bg-info-subtle">Jam Selesai</th>
                            <th class="fw-medium bg-info-subtle">Lama Sewa</th>
                            <th class="fw-medium bg-info-subtle">Total</th>
                            <th class="fw-medium bg-info-subtle">Status Booking</th>
                            <th class="fw-medium bg-info-subtle">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $no = 0;
                        foreach ($data["booking"] as $value) {
                            $no++;
                            $value["status_member_when_book"] === "Member" ? $harga = 0 : $harga = $value["harga"];
                            $lama_sewa = getLamaSewa($value["jam_mulai"], $value["jam_selesai"]);
                            echo "<tr>";
                            echo "<td>" . $no . "</td>";
                            echo "<td>" . $value["no_transaksi"] . "</td>";
                            echo "<td>" . $value["status_member_when_book"] . "</td>";
                            echo "<td>" . $value["nama_lapangan"] . "</td>";
                            echo "<td>" . $harga . "</td>";
                            echo "<td>" . $value["jam_mulai"] . "</td>";
                            echo "<td>" . $value["jam_selesai"] . "</td>";
                            echo "<td>" . $lama_sewa . " Jam</td>";
                            echo "<td>" . $harga * $lama_sewa . "</td>";
                            echo "<td>" . $value["status_booking"] . "</td>";
                            echo "<td>
                            <button type='button' class='btn btn-sm btn-outline-secondary mb-1 btn-cancel-booking' data-notrans=" . $value["no_transaksi"] . "><i class='bi bi-x-circle-fill'></i></button>
                            <button type='button' class='btn btn-sm btn-outline-secondary mb-1 btn-detail-booking' data-bs-toggle='modal' data-bs-target='#detail' data-notrans=" . $value["no_transaksi"] . " data-lamasewa=" . $lama_sewa . "><i class='bi bi-file-text'></i></button>
                            <button type='button' class='btn btn-sm btn-outline-secondary mb-1 btn-confirm-booking' data-bs-toggle='modal' data-bs-target='#konfirmasi' data-notrans='" . $value["no_transaksi"] . "'><i class='bi bi-check-square-fill'></i></button>
                        </td>";
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
<div class="modal fade" id="detail" tabindex="-1" aria-labelledby="detailModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="detailModalLabel">Detail Data Booking</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col p-3">
                        <h6 class="mb-4">Detail Data</h6>
                        <div class="row">
                            <div class="col-4">
                                <p>No. Transaksi</p>
                            </div>
                            <div class="col-1">
                                <p>:</p>
                            </div>
                            <div class="col-7">
                                <p id="detail-no-trans"></p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-4">
                                <p>Kode Booking</p>
                            </div>
                            <div class="col-1">
                                <p>:</p>
                            </div>
                            <div class="col-7">
                                <p id="detail-no-book"></p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-4">
                                <p>Nama</p>
                            </div>
                            <div class="col-1">
                                <p>:</p>
                            </div>
                            <div class="col-7">
                                <p id="detail-nama"></p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-4">
                                <p>Status</p>
                            </div>
                            <div class="col-1">
                                <p>:</p>
                            </div>
                            <div class="col-7">
                                <p id="detail-status"></p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-4">
                                <p>Lapangan</p>
                            </div>
                            <div class="col-1">
                                <p>:</p>
                            </div>
                            <div class="col-7">
                                <p id="detail-lapangan"></p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-4">
                                <p>Tanggal</p>
                            </div>
                            <div class="col-1">
                                <p>:</p>
                            </div>
                            <div class="col-7">
                                <p id="detail-tanggal"></p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-4">
                                <p>Jadwal</p>
                            </div>
                            <div class="col-1">
                                <p>:</p>
                            </div>
                            <div class="col-7">
                                <p id="detail-jadwal"></p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-4">
                                <p>Jam</p>
                            </div>
                            <div class="col-1">
                                <p>:</p>
                            </div>
                            <div class="col-7">
                                <p id="detail-jam"></p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-4">
                                <p>Lama Sewa</p>
                            </div>
                            <div class="col-1">
                                <p>:</p>
                            </div>
                            <div class="col-7">
                                <p id="detail-lama"></p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-4">
                                <p>Harga</p>
                            </div>
                            <div class="col-1">
                                <p>:</p>
                            </div>
                            <div class="col-7">
                                <p id="detail-harga"></p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-4">
                                <p>Konfirmasi</p>
                            </div>
                            <div class="col-1">
                                <p>:</p>
                            </div>
                            <div class="col-7">
                                <p id="detail-confirm"></p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-4">
                                <p>Keterangan</p>
                            </div>
                            <div class="col-1">
                                <p>:</p>
                            </div>
                            <div class="col-7">
                                <p id="detail-keterangan"></p>
                            </div>
                        </div>
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
<div class="modal fade" id="konfirmasi" tabindex="-1" data-bs-backdrop="static" data-bs-keyboard="false" aria-labelledby="konfirmasiModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="konfirmasiModalLabel">Konfirmasi Data Booking</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row mb-4">
                    <div class="col border rounded p-3">
                        <form action="<?= BASEURL ?>/admin/dashboard/confirmdatabooking" method="post" autocomplete="off">
                            <input type="hidden" name="no_transaksi" id="no_transaksi">
                            <div class="row">
                                <div class="col">
                                    <label for="keterangan" class="form-label">Keterangan</label>
                                </div>
                            </div>
                            <div class="row mb-4">
                                <div class="col">
                                    <select id="keterangan" name="keterangan" class="form-select">
                                        <option value="Menunggu">-</option>
                                        <option value="Sedang Dicek">Sedang Dicek</option>
                                        <option value="Aktif">Aktif</option>
                                        <option value="Selesai">Selesai</option>
                                    </select>
                                </div>
                                <div class="col">
                                    <button type="submit" class="btn btn-primary w-100">Konfirmasi</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="row border rounded mb-4">
                    <div class="row mb-4">
                        <div class="col">
                            <p class="m-0">Nama</p>
                            <p class="m-0 confirm-name"></p>
                        </div>
                        <div class="col">
                            <p class="m-0">Email</p>
                            <p class="m-0 confirm-email"></p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <p class="m-0">No. Telepon / WA</p>
                            <p class="m-0 confirm-no-telp"></p>
                        </div>
                        <div class="col">
                            <p class="m-0">Jenis Kelamin</p>
                            <p class="confirm-jenis-kelamin"></p>
                        </div>
                    </div>
                </div>
                <div class="row mb-4">
                    <div class="col">
                        <h6>Bukti Pembayaran</h6>
                    </div>
                    <div class="col border rounded evidence-area">
                        <img src="" class="img-fluid img-zoom img-zoom-book-evidence" alt="Bukti Bayar Belum Ada" data-bs-toggle="modal" data-bs-target="#buktiBayar">
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
<div class="modal fade" id="buktiBayar" tabindex="-1" data-bs-backdrop="static" data-bs-keyboard="false" aria-labelledby="evidenceModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header modal-header-evidence">
                <h1 class="modal-title fs-5" id="evidenceModalLabel">Bukti Pembayaran</h1>
            </div>
            <div class="modal-body text-center modal-body-evidence">
                <img src="" class="img-fluid w-100" alt="Bukti Bayar Belum Ada">
            </div>
            <div class="modal-footer modal-footer-evidence">
                <button type="button" class="btn btn-secondary" data-bs-target="#konfirmasi" data-bs-toggle="modal">Kembali</button>
            </div>
        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="buktiBayarDua" tabindex="-1" aria-labelledby="evidenceDuaModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header modal-header-evidence-dua">
                <h1 class="modal-title fs-5" id="evidenceDuaModalLabel">Bukti Pembayaran</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body text-center modal-body-evidence-dua">
                <img src="" class="img-fluid w-100" alt="bukti bayar">
            </div>
            <div class="modal-footer modal-footer-evidence">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
            </div>
        </div>
    </div>
</div>