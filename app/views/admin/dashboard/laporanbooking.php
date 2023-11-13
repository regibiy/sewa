<div class="col-10 p-5">
    <h2>Laporan Booking</h2>
    <div class="row mb-4">
        <div class="col">
            <div class="table-responsive border p-3 rounded">
                <table id="sewa" class="table table-striped table-bordered" style="width:100%">
                    <thead>
                        <tr>
                            <th class="fw-medium bg-info-subtle">No.</th>
                            <th class="fw-medium bg-info-subtle">No. Transaksi</th>
                            <th class="fw-medium bg-info-subtle">Status</th>
                            <th class="fw-medium bg-info-subtle">Lapangan</th>
                            <th class="fw-medium bg-info-subtle">Tanggal</th>
                            <th class="fw-medium bg-info-subtle">Harga</th>
                            <th class="fw-medium bg-info-subtle">Jam Mulai</th>
                            <th class="fw-medium bg-info-subtle">Jam Selesai</th>
                            <th class="fw-medium bg-info-subtle">Lama Sewa</th>
                            <th class="fw-medium bg-info-subtle">Total</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>lorem</td>
                            <td>lorem</td>
                            <td>lorem</td>
                            <td>lorem</td>
                            <td>lorem</td>
                            <td>lorem</td>
                            <td>lorem</td>
                            <td>lorem</td>
                            <td>lorem</td>
                            <td>lorem</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col">
            <h5>Total Pendapatan : Rp. 800.000,00</h5>
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
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Periode Laporan Booking</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="mb-4">
                    <label for="tanggalAwal" class="form-label">Tanggal Awal</label>
                    <input type="date" id="tanggalAwal" class="form-control">
                </div>
                <div class="mb-4">
                    <label for="tanggalAkhir" class="form-label">Tanggal Akhir</label>
                    <input type="date" id="tanggalAkhir" class="form-control">
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                <a href="<?= BASEURL ?>/admin/dashboard/cetakbooking" class="btn btn-primary">Cetak</a>
            </div>
        </div>
    </div>
</div>