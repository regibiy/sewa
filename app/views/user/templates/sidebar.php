<div class="container-fluid">
    <div class="row">
        <div class="col-2 p-3 border-end bg-body-tertiary height-100">
            <div class="mb-3">
                <a href="<?= BASEURL ?>/dashboard/profil/0" class="text-decoration-none text-dark">
                    <h4><?= $_SESSION["nama_user"] ?></h4>
                </a>
                <p>Status : <span class="fw-medium status-user"><?= $_SESSION["status_member"] ?></span></p> <!-- dinamyc data -->
            </div>
            <div class="mb-5 text-center">
                <ul class="list-group mb-3">
                    <a href="<?= BASEURL ?>/dashboard" class="text-decoration-none text-white border border-bottom-0 rounded-top">
                        <li class="list-group-item <?= $data["marker"][0] ?>">Beranda</li>
                    </a>
                    <a href="<?= BASEURL ?>/dashboard/booking" class="text-decoration-none text-white border-start border-end">
                        <li class="list-group-item <?= $data["marker"][1] ?>">Booking</li>
                    </a>
                    <a href="<?= BASEURL ?>/dashboard/member" class="text-decoration-none text-white border-start border-end">
                        <li class="list-group-item <?= $data["marker"][2] ?>">Member</li>
                    </a>
                    <a href="<?= BASEURL ?>/dashboard/databooking" class="text-decoration-none text-white border-start border-end">
                        <li class="list-group-item <?= $data["marker"][3] ?>">Jadwal Aktif</li>
                    </a>
                    <a href="<?= BASEURL ?>/dashboard/datasewa" class="text-decoration-none text-white border-start border-end">
                        <li class="list-group-item <?= $data["marker"][4] ?>">Data Booking</li>
                    </a>
                    <a href="<?= BASEURL ?>/dashboard/informasi" class="text-decoration-none text-white border border-top-0 rounded-bottom">
                        <li class="list-group-item <?= $data["marker"][5] ?>">Informasi</li>
                    </a>
                </ul>
            </div>
            <div class="text-center">
                <ul class="list-group">
                    <a href="<?= BASEURL ?>/dashboard/logout" class="text-decoration-none text-white border rounded">
                        <li class="list-group-item bg-danger text-white">Logout</li>
                    </a>
                </ul>
            </div>
        </div>