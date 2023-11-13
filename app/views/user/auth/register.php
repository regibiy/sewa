<?php $value = Flasher::data_input() ?>
<div class="container-fluid d-flex justify-content-center my-5">
    <div class="w-500 shadow-sm bg-body-tertiary rounded border p-4">
        <h1 class="text-center">Register</h1>
        <form action="<?= BASEURL ?>/auth/registrationprocess" method="post" autocomplete="off">
            <div class="mb-3">
                <label for="nama" class="form-label">Nama</label>
                <input type="text" class="form-control" id="nama" name="nama" required maxlength="100" value="<?= isset($value) ? $value["nama"] : "" ?>">
            </div>
            <div class="mb-3">
                <label for="username" class="form-label">Username</label>
                <input type="text" class="form-control" id="username" name="username" required maxlength="60">
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Password</label>
                <input type="password" class="form-control" id="password" name="password" required maxlength="100">
            </div>
            <div class="form-check mb-3">
                <input class="form-check-input" type="checkbox" id="showPassword">
                <label class="form-check-label" for="showPassword">
                    Lihat Password
                </label>
            </div>
            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" class="form-control" id="email" name="email" required maxlength="60" value="<?= isset($value) ? $value["email"] : "" ?>">
            </div>
            <div class="mb-3">
                <label for="gender" class="form-label">Jenis Kelamin</label>
                <select id="gender" class="form-select" name="jenis_kelamin" required>
                    <option value="0" <?= isset($value) ? "" : "selected" ?> hidden>Silakan pilih jenis kelamin</option>
                    <option value="Laki-Laki" <?= isset($value) && $value["jenis_kelamin"] == "Laki-Laki" ? "selected" : "" ?>>Laki-Laki</option>
                    <option value="Perempuan" <?= isset($value) && $value["jenis_kelamin"] == "Perempuan" ? "selected" : "" ?>>Perempuan</option>
                </select>
            </div>
            <div class="mb-3">
                <label for="noTelp" class="form-label">No Telp / WA</label>
                <input type="number" class="form-control" id="noTelp" name="no_telp" required maxlength="15" value="<?= isset($value) ? $value["no_telp"] : "" ?>">
            </div>
            <div class="text-center mb-3">
                <button type="submit" class="btn btn-primary">Register</button>
            </div>
            <div class="text-center">
                <p class="m-0 p-0">Sudah memiliki akun? Silakan <a href="<?= BASEURL ?>/auth/login">Login</a></p>
            </div>
        </form>
    </div>
</div>