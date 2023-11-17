<div class="col-10 p-5">
    <div class="row row-cols-1 row-cols-sm-1 row-cols-md-4 justify-content-md-evenly mb-5">
        <?php
        foreach ($data["paket_member"] as $value) {
            echo "<div class='col-12 col-sm-12 col-md-2 p-3 text-center border bg-body-tertiary rounded'>";
            echo "<h5 class='mb-4'>" . $value["nama_paket"] . "</h5>";
            echo "<p class='m-0'>" . $value["hari"] . "</p>";
            echo "<p class='m-0'>" . ucfirst($value["jadwal"]) . "</p>";
            echo "<p class='m-4'>" . $value["harga"] . "</p>";
            echo "<button type='button' class='btn btn-primary w-100 btn-buy-package' data-id='" . $value["id"] . "' data-statusmember='" . $data["status_member"] . "'>Beli</button>";
            echo "</div>";
        }
        ?>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="detailPembelian" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true" data-bs-backdrop="static" data-bs-keyboard="false">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content">
            <form action="<?= BASEURL ?>/dashboard/memberprocess" enctype="multipart/form-data" method="post" autocomplete="off">
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
                                    <p class="p-no-transaksi"></p>
                                    <input type="hidden" class="input-no-transaksi" name="no_transaksi">
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
                                    <p><?= $_SESSION["nama_user"] ?></p>
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
                                    <p class="p-jenis-paket"></p>
                                    <input type="hidden" name="jenis_paket" id="jenisPaket" class="input-jenis-paket">
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
                                    <p class="p-harga"></p>
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
                                    <input type="date" class="form-control w-50 input-tanggal-beli" name="tanggal" id="tanggal" readonly>
                                    <input type="hidden" class="input-berlaku-sampai" name="berlaku_sampai" id="berlakuSampai">
                                </div>
                            </div>
                            <div class="row mb-4">
                                <h5 class="mb-3">Keterangan Paket</h5>
                                <p class="p-keterangan-paket"></p>
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
                                    <input type="file" class="form-control" id="buktiBayar" name="bukti_bayar" required>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary">Konfirmasi</button>
                </div>
            </form>
        </div>
    </div>
</div>