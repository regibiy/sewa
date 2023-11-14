<div class="col-10 p-5">
    <div class="row">
        <div class="col">
            <h2>Jadwal Booking</h2>
        </div>
        <div class="col text-end">
            <button class="btn btn-primary btn-add-jadwal" data-bs-toggle="modal" data-bs-target="#modalJadwal">Tambah Jadwal</button>
        </div>
    </div>
    <div class="row">
        <div class="col">
            <div class="table-responsive border p-3 rounded">
                <table id="sewa" class="table table-striped table-bordered" style="width:100%">
                    <thead>
                        <tr>
                            <th class="fw-medium bg-info-subtle">No.</th>
                            <th class="fw-medium bg-info-subtle">Sesi</th>
                            <th class="fw-medium bg-info-subtle">Hari</th>
                            <th class="fw-medium bg-info-subtle">Harga</th>
                            <th class="fw-medium bg-info-subtle">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $no = 0;
                        foreach ($data["jadwal"] as $value) {
                            $no++;
                            echo "<tr>";
                            echo "<td>" . $no . "</td>";
                            echo "<td>" . ucfirst($value["sesi"]) . "</td>";
                            echo "<td>" .  $data["hari"][$value["hari"]] . "</td>";
                            echo "<td>" . $value["harga"] . "</td>";
                            echo "<td>
                            <button type='button' class='btn btn-sm btn-outline-secondary btn-edit-jadwal' data-bs-toggle='modal' data-bs-target='#modalJadwal' data-id='" . $value["id"] . "'><i class='bi bi-pencil-fill'></i></button>
                            <button type='button' class='btn btn-sm btn-outline-secondary btn-delete-jadwal' data-sesi='" . ucfirst($value["sesi"]) . "' data-hari='" . $data["hari"][$value["hari"]] . "' data-id='" . $value["id"] . "'><i class='bi bi-trash3-fill'></i></button>
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

<!-- Modal -->
<div class="modal fade" id="modalJadwal" tabindex="-1" aria-labelledby="jadwalModalLabel" aria-hidden="true" data-bs-backdrop="static" data-bs-keyboard="false">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content modal-content-jadwal">
            <form action="<?= BASEURL ?>/admin/dashboard/addjadwal" method="post" autocomplete="off">
                <input type="hidden" name="id" id="id">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="jadwalModalLabel">Tambah Jadwal</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="sesi" class="form-label">Sesi</label>
                        <select name="sesi" id="sesi" class="form-select select-jadwal" required>
                            <option value="pagi">Pagi</option>
                            <option value="siang">Siang</option>
                            <option value="malam">Malam</option>
                            <option value="semua">Semua Sesi</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="hari" class="form-label">Hari</label>
                        <select name="hari" id="hari" class="form-select select-jadwal" required>
                            <?php
                            foreach ($data["hari"] as $key => $value) {
                                echo "<option value='" . $key . "'>" . $value . "</option>";
                            }
                            ?>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="harga" class="form-label">Harga</label>
                        <input type="number" class="form-control input-jadwal" id="harga" name="harga" required min="0">
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