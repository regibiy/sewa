<div class="col-10 p-5">
    <div class="row">
        <div class="col">
            <h1>Data Anda</h1>
        </div>
    </div>
    <nav>
        <div class="nav nav-tabs" id="nav-tab" role="tablist">
            <button class="nav-link <?= $data["url"] == "0" ? "active" : "" ?>" id="nav-home-tab" data-bs-toggle="tab" data-bs-target="#nav-home" type="button" role="tab" aria-controls="nav-home" aria-selected="true">Profil</button>
            <button class="nav-link <?= $data["url"] == "1" ? "active" : "" ?>" id="nav-profile-tab" data-bs-toggle="tab" data-bs-target="#nav-profile" type="button" role="tab" aria-controls="nav-profile" aria-selected="false">Member</button>
        </div>
    </nav>
    <div class="tab-content" id="nav-tabContent">
        <div class="tab-pane fade <?= $data["url"] == "0" ? "show active" : "" ?>" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab" tabindex="0">
            <form action="<?= BASEURL ?>/dashboard/ubahprofil" method="post" autocomplete="off" id="formProfil">
                <div class="row row-cols-1 row-cols-sm-1 row-cols-md-2 p-3 rounded shadow-sm">
                    <div class="col">
                        <div class="mb-3">
                            <label for="nama" class="form-label">Nama</label>
                            <input type="text" class="form-control" id="nama" name="nama" disabled required value="<?= $data["data_user"]["nama"] ?>">
                        </div>
                        <div class="mb-3">
                            <label for="username" class="form-label">Username</label>
                            <input type="text" class="form-control" id="username" name="username" disabled required value="<?= $data["data_user"]["username"] ?>">
                        </div>
                        <div class=" mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" class="form-control" id="email" name="email" disabled required value="<?= $data["data_user"]["email"] ?>">
                        </div>
                        <div class=" mb-3">
                            <label for="jenisKelamin" class="form-label">Jenis Kelamin</label>
                            <select name="jenis_kelamin" id="jenisKelamin" class="form-select" disabled required>
                                <option value="Laki-Laki" <?= $data["data_user"]["jenis_kelamin"] == "Laki-Laki" ? "selected" : "" ?>>Laki-Laki</option>
                                <option value="Perempuan" <?= $data["data_user"]["jenis_kelamin"] == "Perempuan" ? "selected" : "" ?>>Perempuan</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="noTelp" class="form-label">No. Telp / WA</label>
                            <input type="number" class="form-control" id="noTelp" name="no_telp" disabled required value="<?= $data["data_user"]["no_telp"] ?>">
                        </div>
                    </div>
                    <div class=" col">
                        <div class="mb-4">
                            <button type="button" class="btn btn-primary" id="editProfil">Edit Profil</button>
                        </div>
                        <div class="mb-4">
                            <button type="button" class="btn btn-outline-primary ubahPassword d-none" data-bs-toggle="modal" data-bs-target="#ubahPassword">
                                Ubah Password
                            </button>
                        </div>
                        <div class="mb-4">
                            <button type="submit" class="btn btn-outline-primary simpanProfil d-none">Simpan</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
        <div class="tab-pane fade <?= $data["url"] == "1" ? "show active" : "" ?>" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab" tabindex="0">.b.</div>
    </div>
</div>
</div>

<!-- Modal -->
<div class="modal fade" id="ubahPassword" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true" data-bs-backdrop="static" data-bs-keyboard="false">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <form action="<?= BASEURL ?>/dashboard/ubahpassword" method="post" autocomplete="off">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Ubah Password</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-4">
                        <label for="oldPassword" class="form-label">Password Lama</label>
                        <input type="password" id="oldPassword" class="form-control" name="old_password" required>
                    </div>
                    <div class="mb-4">
                        <label for="newPassword" class="form-label">Password Baru</label>
                        <input type="password" id="newPassword" class="form-control" name="new_password" required>
                    </div>
                    <div class="mb-1">
                        <input class="form-check-input" type="checkbox" id="showOldNewPassword">
                        <label class="form-check-label user-select-none" for="showOldNewPassword">
                            Lihat Password
                        </label>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                    <button type="submit" class="btn btn-primary">Ganti Password</button>
                </div>
            </form>
        </div>
    </div>
</div>