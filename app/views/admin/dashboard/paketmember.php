<div class="col-10 p-5">
    <div class="row">
        <div class="col">
            <h2>Data Paket Member</h2>
        </div>
        <div class="col text-end">
            <button class="btn btn-primary btn-add-paket-member" data-bs-toggle="modal" data-bs-target="#modalMember">Tambah Paket Member</button>
        </div>
    </div>
    <div class="row">
        <div class="col">
            <div class="table-responsive border p-3 rounded">
                <table id="sewa" class="table table-striped table-bordered" style="width:100%">
                    <thead>
                        <tr>
                            <th class="fw-medium bg-info-subtle">No.</th>
                            <th class="fw-medium bg-info-subtle">Nama Paket</th>
                            <th class="fw-medium bg-info-subtle">Hari</th>
                            <th class="fw-medium bg-info-subtle">Jadwal</th>
                            <th class="fw-medium bg-info-subtle">keterangan</th>
                            <th class="fw-medium bg-info-subtle">Harga</th>
                            <th class="fw-medium bg-info-subtle">Status</th>
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
                            echo "<td>" . $value["nama_paket"] . "</td>";
                            echo "<td>" . $value["hari"] . "</td>";
                            echo "<td>" . $value["jadwal"] . "</td>";
                            echo "<td>" . $value["keterangan"] . "</td>";
                            echo "<td>" . $value["harga"] . "</td>";
                            echo "<td>" . $value["status"] . "</td>";
                            echo "<td>
                            <button type='button' class='btn btn-sm btn-outline-secondary btn-edit-paket-member mb-1' data-bs-toggle='modal' data-bs-target='#modalMember' data-id='" . $value["id"] . "'><i class='bi bi-pencil-fill'></i></button>
                            <button type='button' class='btn btn-sm btn-outline-secondary btn-delete-paket-member mb-1' data-id='" . $value["id"] . "' data-namapaket='" . $value["nama_paket"] . "'><i class='bi bi-trash3-fill'></i></button>
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
<div class="modal fade" id="modalMember" tabindex="-1" aria-labelledby="memberModalLabel" aria-hidden="true" data-bs-backdrop="static" data-bs-keyboard="false">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content modal-content-member">
            <form action="<?= BASEURL ?>/admin/dashboard/
            addpaketmember" method="post" autocomplete="off">
                <input type="hidden" name="id" id="id">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="memberModalLabel">Tambah Data Member</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="namaPaket" class="form-label">Nama Paket</label>
                        <input type="text" class="form-control input-paket-member" id="namaPaket" name="nama_paket" maxlength="30" required>
                    </div>
                    <div class="mb-3">
                        <label for="hari" class="form-label">Hari</label>
                        <input type="text" class="form-control input-paket-member" id="hari" name="hari" maxlength="30" placeholder="cth : Senin-Jumat" required>

                    </div>
                    <div class="mb-3">
                        <label for="sesi" class="form-label">Sesi</label>
                        <select name="sesi" id="sesi" class="form-select select-paket-member" required>
                            <option value="pagi">Pagi</option>
                            <option value="siang">Siang</option>
                            <option value="malam">Malam</option>
                            <option value="semua">Semua Sesi</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="keterangan" class="form-label">Keterangan</label>
                        <textarea class="form-control textarea-paket-member" cols="3" id="keterangan" name="keterangan" required></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="harga" class="form-label">Harga</label>
                        <input type="number" class="form-control input-paket-member" id="harga" name="harga" required min="0">
                    </div>
                    <div class="mb-3">
                        <label for="status" class="form-label">Status</label>
                        <select name="status" id="status" class="form-select select-paket-member" required>
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