<div class="container-fluid">
    <div class="row">
        <div class="col-2 p-3 border-end bg-body-tertiary height-100">
            <div class="mb-3">
                <h4>Nama Admin</h4>
                <p>Admin</p>
            </div>
            <div class="mb-5 text-center">
                <ul class="list-group mb-3">
                    <a href="<?= BASEURL ?>/admin/dashboard" class="text-decoration-none text-white border border-bottom-0 rounded-top">
                        <li class="list-group-item <?= $data["marker"][0] ?>">Dashboard</li>
                    </a>
                    <a class="text-decoration-none text-white border-start border-end" data-bs-toggle="collapse" href="#data" role="button" aria-expanded="false" aria-controls="collapseExample">
                        <li class="list-group-item <?= isset($data["marker"][1]) || isset($data["marker"][2]) || isset($data["marker"][3]) || isset($data["marker"][4]) || isset($data["marker"][5]) || isset($data["marker"][6]) ? "active" : ""  ?>">
                            Data
                            <span class="position-absolute top-50 end-0 translate-middle-y pe-2"><i class="bi bi-caret-down-fill"></i></span>
                        </li>
                    </a>
                    <div class="collapse" id="data">
                        <div class="card card-body rounded-0">
                            <a href="<?= BASEURL ?>/admin/dashboard/dataakun" class="text-decoration-none text-white rounded-top">
                                <li class="list-group-item <?= $data["marker"][1] ?>">Data Akun</li>
                            </a>
                            <a href="<?= BASEURL ?>/admin/dashboard/databooking" class="text-decoration-none text-white rounded-top">
                                <li class="list-group-item <?= $data["marker"][2] ?>">Data Booking</li>
                            </a>
                            <a href="<?= BASEURL ?>/admin/dashboard/datajadwal" class="text-decoration-none text-white rounded-top">
                                <li class="list-group-item <?= $data["marker"][3] ?>">Data Jadwal</li>
                            </a>
                            <a href="<?= BASEURL ?>/admin/dashboard/datalapangan" class="text-decoration-none text-white rounded-top">
                                <li class="list-group-item <?= $data["marker"][4] ?>">Data Lapangan</li>
                            </a>
                            <a href="<?= BASEURL ?>/admin/dashboard/datamember" class="text-decoration-none text-white rounded-bottom">
                                <li class="list-group-item <?= $data["marker"][5] ?>">Data Member</li>
                            </a>
                            <a href="<?= BASEURL ?>/admin/dashboard/paketmember" class="text-decoration-none text-white rounded-bottom">
                                <li class="list-group-item <?= $data["marker"][6] ?>">Data Paket Member</li>
                            </a>
                        </div>
                    </div>
                    <a class="text-decoration-none text-white border-start border-end" data-bs-toggle="collapse" href="#laporan" role="button" aria-expanded="false" aria-controls="collapseExample">
                        <li class="list-group-item <?= isset($data["marker"][7]) || isset($data["marker"][8]) ? "active" : ""  ?>">
                            Laporan
                            <span class="position-absolute top-50 end-0 translate-middle-y pe-2"><i class="bi bi-caret-down-fill"></i></span>
                        </li>
                    </a>
                    <div class="collapse" id="laporan">
                        <div class="card card-body rounded-0">
                            <a href="<?= BASEURL ?>/admin/dashboard/laporanbooking" class="text-decoration-none text-white border-start rounded-top">
                                <li class="list-group-item <?= $data["marker"][7] ?>">Laporan Booking</li>
                            </a>
                            <a href="<?= BASEURL ?>/admin/dashboard/laporanmember" class="text-decoration-none text-white border-start rounded-bottom">
                                <li class="list-group-item <?= $data["marker"][8] ?>">Laporan Member</li>
                            </a>
                        </div>
                    </div>
                    <a href="<?= BASEURL ?>/admin/dashboard/informasi" class="text-decoration-none text-white border-start border-end">
                        <li class="list-group-item <?= $data["marker"][9] ?>">Informasi</li>
                    </a>
                    <a href="<?= BASEURL ?>/admin/dashboard/pegawai" class="text-decoration-none text-white border border-top-0 rounded-bottom">
                        <li class="list-group-item <?= $data["marker"][10] ?>">Pegawai</li>
                    </a>
                </ul>
            </div>
            <div class="text-center">
                <ul class="list-group">
                    <a href="<?= BASEURL ?>/admin/dashboard/logout" class="text-decoration-none text-white border rounded">
                        <li class="list-group-item bg-danger text-white">Logout</li>
                    </a>
                </ul>
            </div>
        </div>