<div class="col-10 p-5">
    <div class="row">
        <div class="col">
            <h2>Pegawai Gor Unipol</h2>
        </div>
        <div class="col text-end">
            <button class="btn btn-primary btn-add-pegawai" data-bs-toggle="modal" data-bs-target="#modalPegawai">Tambah Pegawai</button>
        </div>
    </div>
    <div class="row mb-4">
        <div class="col">
            <div class="table-responsive border p-3 rounded">
                <table id="sewa" class="table table-striped table-bordered" style="width:100%">
                    <thead>
                        <tr>
                            <th class="fw-medium bg-info-subtle">No</th>
                            <th class="fw-medium bg-info-subtle">Username</th>
                            <th class="fw-medium bg-info-subtle">Nama</th>
                            <th class="fw-medium bg-info-subtle">Email</th>
                            <th class="fw-medium bg-info-subtle">Jenis Kelamin</th>
                            <th class="fw-medium bg-info-subtle">No. Telp</th>
                            <th class="fw-medium bg-info-subtle">Role</th>
                            <th class="fw-medium bg-info-subtle">Status Akun</th>
                            <th class="fw-medium bg-info-subtle">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $no = 0;
                        foreach ($data["employees"] as $value) {
                            $no++;
                            echo "<tr>";
                            echo "<td>" . $no . "</td>";
                            echo "<td>" . $value["username"] . "</td>";
                            echo "<td>" . $value["nama"] . "</td>";
                            echo "<td>" . $value["email"] . "</td>";
                            echo "<td>" . $value["jenis_kelamin"] . "</td>";
                            echo "<td>" . $value["no_telp"] . "</td>";
                            echo "<td>" . $value["role"] . "</td>";
                            echo "<td>" . $value["status_akun"] . "</td>";
                            echo "<td>
                            <button type='button' class='btn btn-sm btn-outline-secondary btn-edit-pegawai mb-1' data-username='" . $value["username"] . "' data-bs-toggle='modal' data-bs-target='#modalPegawai'><i class='bi bi-pencil-fill'></i></button>
                            <button type='button' class='btn btn-sm btn-outline-secondary mb-1 btn-delete-pegawai' data-id='" . $value["id"] . "' data-role='" . $value["role"] . "'><i class='bi bi-trash-fill'></i></button>
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
<form action="<?= BASEURL ?>/admin/dashboard/addpegawai" autocomplete="off" method="post" id="formPegawai">
    <input type="hidden" name="id" id="id">
    <div class="modal fade" id="modalPegawai" tabindex="-1" aria-labelledby="pegawaiModalLabel" aria-hidden="true" data-bs-backdrop="static" data-bs-keyboard="false">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
            <div class="modal-content modal-content-pegawai">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="pegawaiModalLabel">Tambah Pegawai</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="username" class="form-label">Username</label>
                        <input type="text" class="form-control" id="username" name="username" required>
                    </div>
                    <div class="mb-3">
                        <label for="nama" class="form-label">Nama</label>
                        <input type="text" class="form-control" id="nama" name="nama" required>
                    </div>
                    <div class="mb-3">
                        <label for="passwordPegawai" class="form-label">Password</label>
                        <input type="password" class="form-control" id="password" name="password_pegawai" required>
                    </div>
                    <div class="form-check mb-3">
                        <input class="form-check-input" type="checkbox" id="showPassword">
                        <label class="form-check-label" for="showPassword">
                            Lihat Password
                        </label>
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" class="form-control" id="email" name="email" required>
                    </div>
                    <div class="mb-3">
                        <label for="jenisKelamin" class="form-label">Jenis Kelamin</label>
                        <select name="jenis_kelamin" id="jenisKelamin" class="form-select" required>
                            <option value="Laki-Laki">Laki-Laki</option>
                            <option value="Perempuan">Perempuan</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="noTelp" class="form-label">Nomor Telepon</label>
                        <input type="number" class="form-control" id="noTelp" name="no_telp" min="0" required>
                    </div>
                    <div class="mb-3">
                        <label for="role" class="form-label">Role</label>
                        <select name="role" id="role" class="form-select" required>
                            <option value="Admin">Admin</option>
                            <option value="Owner">Owner</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="statusAkun" class="form-label">Status Pegawai</label>
                        <select name="status_akun" id="statusAkun" class="form-select" required>
                            <option value="Aktif">Aktif</option>
                            <option value="Non-Aktif">Non-Aktif</option>
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary btn-submit-pegawai">Simpan</button>
                </div>
            </div>
        </div>
    </div>
</form>