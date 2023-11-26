<div class="col-10 p-5">
    <h1 class="mb-5">Dashboard Admin</h1>
    <div class="row row-cols-1 row-cols-sm-1 row-cols-md-2 row-cols-lg-4 justify-content-evenly text-center fw-medium">
        <div class="col-12 col-sm-12 col-md-5 col-lg-2 border rounded bg-body-tertiary">
            <a href="<?= BASEURL ?>/admin/dashboard/databooking" class="text-decoration-none d-block p-5 text-dark fs-5">
                Data <span class="badge text-bg-info"><?= $data["notif"] ?></span>
            </a>
        </div>
        <div class="col-12 col-sm-12 col-md-5 col-lg-3 border rounded bg-body-tertiary">
            <a href="<?= BASEURL ?>/admin/dashboard/metodepembayaran" class="text-decoration-none d-block p-5 text-dark fs-5">Kode Pembayaran</a>
        </div>
        <div class="col-12 col-sm-12 col-md-5 col-lg-3 border rounded bg-body-tertiary">
            <a href="<?= BASEURL ?>/admin/dashboard/laporanbooking" class="text-decoration-none d-block p-5 text-dark fs-5">Laporan</a>
        </div>
        <div class="col-12 col-sm-12 col-md-5 col-lg-3  border rounded bg-body-tertiary">
            <a href="<?= BASEURL ?>/admin/dashboard/informasi" class="text-decoration-none d-block p-5 text-dark fs-5">Informasi</a>
        </div>
    </div>
</div>
</div>