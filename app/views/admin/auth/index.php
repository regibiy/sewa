<?php $value = Flasher::data_input() ?>
<div class="container-fluid">
    <div class="w-500 shadow-sm bg-body-tertiary rounded border p-4 position-absolute top-50 start-50 translate-middle">
        <h1 class="text-center">LOGIN PEGAWAI</h1>
        <form action="<?= BASEURL ?>/admin/auth/loginprocess" method="post" autocomplete="off">
            <div class="mb-3">
                <label for="username" class="form-label">Username</label>
                <input type="text" class="form-control" id="username" name="username" required value="<?= isset($value) ? $value["username"] : "" ?>">
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Password</label>
                <input type="password" class="form-control" id="password" name="password" required>
            </div>
            <div class="form-check mb-3">
                <input class="form-check-input" type="checkbox" id="showPassword">
                <label class="form-check-label" for="showPassword">
                    Lihat Password
                </label>
            </div>
            <div class="text-center mb-3">
                <button type="submit" class="btn btn-primary">Login</button>
            </div>
        </form>
    </div>
</div>