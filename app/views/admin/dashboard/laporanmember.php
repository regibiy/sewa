<div class="col-10 p-5">
    <h2>Laporan Member</h2>
    <div class="row mb-4">
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
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $no = 0;
                        $pendapatan = 0;
                        foreach ($data["member_data"] as $value) {
                            $pendapatan += $value["harga"];
                            $no++;
                            echo "<tr>";
                            echo "<td>" . $no . "</td>";
                            echo "<td>" . $value["no_transaksi"] . "</td>";
                            echo "<td>" . $value["nama"] . "</td>";
                            echo "<td>" . $value["tanggal_transaksi"] . "</td>";
                            echo "<td>" . $value["nama_paket"] . "</td>";
                            echo "<td>" . $value["hari"] . " - " . $value["jadwal"] . "</td>";
                            echo "<td>" . $value["harga"] . "</td>";
                            echo "</tr>";
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col">
            <h5>Total Pendapatan : <?= $pendapatan ?></h5>
        </div>
        <div class="col text-end">
            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#setPeriode">
                Cetak Laporan
            </button>
        </div>
    </div>
</div>
</div>

<!-- Modal -->
<div class="modal fade" id="setPeriode" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true" data-bs-backdrop="static" data-bs-keyboard="false">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <form action="<?= BASEURL ?>/admin/dashboard/cetakmember" method="post" autocomplete="off">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Periode Laporan Member</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-4">
                        <label for="tanggalAwal" class="form-label">Tanggal Awal</label>
                        <input type="date" id="tanggalAwal" class="form-control" name="tanggal_awal" required>
                    </div>
                    <div class="mb-4">
                        <label for="tanggalAkhir" class="form-label">Tanggal Akhir</label>
                        <input type="date" id="tanggalAkhir" class="form-control" name="tanggal_akhir" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                    <button type="submit" class="btn btn-primary">Cetak</button>
                </div>
            </form>
        </div>
    </div>
</div>