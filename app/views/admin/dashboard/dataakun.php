<div class="col-10 p-5">
    <div class="row">
        <div class="col">
            <h2>Akun Terdaftar</h2>
        </div>
    </div>
    <div class="row mb-4">
        <div class="col">
            <div class="table-responsive border p-3 rounded">
                <table id="sewa" class="table table-striped table-bordered" style="width:100%">
                    <thead>
                        <tr>
                            <th class="fw-medium bg-info-subtle">No.</th>
                            <th class="fw-medium bg-info-subtle">Nama</th>
                            <th class="fw-medium bg-info-subtle">Username</th>
                            <th class="fw-medium bg-info-subtle">Email</th>
                            <th class="fw-medium bg-info-subtle">Jenis Kelamin</th>
                            <th class="fw-medium bg-info-subtle">No. Telp / WA</th>
                            <th class="fw-medium bg-info-subtle">Status Member</th>
                            <th class="fw-medium bg-info-subtle">Status Akun</th>
                            <th class="fw-medium bg-info-subtle">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $no = 0;
                        foreach ($data["akun_pengguna"] as $value) {
                            $no++;
                            echo "<tr>";
                            echo "<td>" . $no . "</td>";
                            echo "<td>" . $value["nama"] . "</td>";
                            echo "<td>" . $value["username"] . "</td>";
                            echo "<td>" . $value["email"] . "</td>";
                            echo "<td>" . $value["jenis_kelamin"] . "</td>";
                            echo "<td>" . $value["no_telp"] . "</td>";
                            echo "<td>" . $value["status_member"] . "</td>";
                            echo "<td>" . $value["status_akun"] . "</td>";
                            echo "<td>
                            <button type='button' class='btn btn-sm btn-outline-secondary btn-edit-akun-pengguna' data-bs-toggle='modal' data-bs-target='#modalAkun' data-username=" . $value["username"] . "><i class='bi bi-pencil-fill'></i></button>
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
<div class="modal fade" id="modalAkun" tabindex="-1" aria-labelledby="akunModalLabel" aria-hidden="true" data-bs-backdrop="static" data-bs-keyboard="false">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <form action="<?= BASEURL ?>/admin/dashboard/editdataakun" method="post" autocomplete="off">
                <input type="hidden" name="id" id="id">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="akunModalLabel"></h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="status" class="form-label">Status</label>
                        <select name="status_akun" id="statusAkun" class="form-select">
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