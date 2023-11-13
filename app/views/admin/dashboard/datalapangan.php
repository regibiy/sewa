<div class="col-10 p-5">
    <div class="row">
        <div class="col">
            <h2>Data Lapangan</h2>
        </div>
        <div class="col text-end">
            <button class="btn btn-primary btn-add-lapangan" data-bs-toggle="modal" data-bs-target="#modalLapangan">Tambah Lapangan</button>
        </div>
    </div>
    <div class="row mb-4">
        <div class="col">
            <div class="table-responsive border p-3 rounded">
                <table id="sewa" class="table table-striped table-bordered" style="width:100%">
                    <thead>
                        <tr>
                            <th class="fw-medium bg-info-subtle">No.</th>
                            <th class="fw-medium bg-info-subtle">Nama Lapangan</th>
                            <th class="fw-medium bg-info-subtle">Status Lapangan</th>
                            <th class="fw-medium bg-info-subtle">Status Booking</th>
                            <th class="fw-medium bg-info-subtle">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $no = 0;
                        foreach ($data["lapangan"] as $value) {
                            $no++;
                            echo "<tr>";
                            echo "<td>" . $no . "</td>";
                            echo "<td>" . $value["nama_lapangan"] . "</td>";
                            echo "<td>" . $value["status_lapangan"] . "</td>";
                            echo "<td>" . ($value["status_booking"] == null ? "Tersedia" : $value["status_booking"]) . "</td>";
                            echo "<td><button type='button' class='btn btn-sm btn-outline-secondary btn-edit-lapangan' data-bs-toggle='modal' data-bs-target='#modalLapangan' data-id='" . $value["id"] . "'><i class='bi bi-pencil-fill'></i></button></td>";
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

<!-- Modal -->
<div class="modal fade" id="modalLapangan" tabindex="-1" aria-labelledby="lapanganModalLabel" aria-hidden="true" data-bs-backdrop="static" data-bs-keyboard="false">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content modal-content-lapangan">
            <form action="<?= BASEURL ?>/admin/dashboard/addlapangan" method="post" autocomplete="off">
                <input type="hidden" name="id" id="id">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="lapanganModalLabel">Tambah Lapangan</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="namaLapangan" class="form-label">Nama Lapangan</label>
                        <input type="text" class="form-control input-lapangan" id="namaLapangan" name="nama_lapangan" required maxlength="30">
                    </div>

                    <div class="mb-3">
                        <label for="statusLapangan" class="form-label">Status Lapangan</label>
                        <select name="status_lapangan" id="statusLapangan" class="form-select select-lapangan" required>
                            <option value="Aktif">Aktif</option>
                            <option value="Non-Aktif">Non-Aktif</option>
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>