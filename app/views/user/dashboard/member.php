<div class="col-10 p-5">
    <div class="row row-cols-1 row-cols-sm-1 row-cols-md-4 justify-content-md-evenly mb-5">
        <?php
        foreach ($data["paket_member"] as $value) {
            echo "<div class='col-12 col-sm-12 col-md-2 p-3 text-center border bg-body-tertiary rounded'>";
            echo "<h5 class='mb-4'>" . $value["nama_paket"] . "</h5>";
            echo "<p class='m-0'>" . $value["hari"] . "</p>";
            echo "<p class='m-0'>" . ucfirst($value["jadwal"]) . "</p>";
            echo "<p class='m-4'>" . $value["harga"] . "</p>";
            echo "<button type='button' class='btn btn-primary w-100 btn-buy-package' data-id='" . $value["id"] . "' data-bs-toggle='modal' data-bs-target='#detailPembelian'>Beli</button>";
            echo "</div>";
        }
        ?>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="detailPembelian" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true" data-bs-backdrop="static" data-bs-keyboard="false">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Data Pembelian</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row justify-content-center">
                    <div class="col-12 p-3">
                        <div class="row">
                            <div class="col-3">
                                <p>No. Transaksi</p>
                            </div>
                            <div class="col-1">
                                <p>:</p>
                            </div>
                            <div class="col-8">
                                <p>lorem</p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-3">
                                <p>Nama</p>
                            </div>
                            <div class="col-1">
                                <p>:</p>
                            </div>
                            <div class="col-8">
                                <p>lorem</p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-3">
                                <p>Jenis Paket</p>
                            </div>
                            <div class="col-1">
                                <p>:</p>
                            </div>
                            <div class="col-8">
                                <p>Senin - Jumat, Pagi</p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-3">
                                <p>Harga</p>
                            </div>
                            <div class="col-1">
                                <p>:</p>
                            </div>
                            <div class="col-8">
                                <p>Rp. 300.000</p>
                            </div>
                        </div>
                        <div class="row mb-4">
                            <div class="col-3">
                                <label for="tanggal" class="form-label">Tanggal</label>
                            </div>
                            <div class="col-1">
                                <p>:</p>
                            </div>
                            <div class="col-8">
                                <input type="date" class="form-control w-50" id="tanggal" disabled>
                            </div>
                        </div>
                        <div class="row mb-4">
                            <h5 class="mb-3">Keterangan Paket</h5>
                            <p class="m-0">3 Jam, 4 Kali Pertemuan</p>
                            <p>Selama 1 Bulan</p>
                        </div>
                        <div class="row mb-4">
                            <h5 class="mb-3">Metode Pembayaran</h5>
                            <div class="col-4">
                                <p>Transfer Bank</p>
                            </div>
                            <div class="col-8">
                                <?php
                                foreach ($data["metode_bayar"] as $value) {
                                    echo "<p>" . $value["nama_bank"] . " - " . $value["nama_pemilik"] . " - " . $value["no_rekening"] . "</p>";
                                }
                                ?>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-auto">
                                <label for="buktiBayar" class="form-label">Upload Bukti Pembayaran</label>
                            </div>
                            <div class="col-auto">
                                <input type="file" class="form-control" id="buktiBayar">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                <a href="<?= BASEURL ?>/dashboard/membersuccess" class="btn btn-primary">Konfirmasi</a>
            </div>
        </div>
    </div>
</div>