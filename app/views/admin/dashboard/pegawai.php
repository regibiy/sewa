<div class="col-10 p-5">
    <div class="row">
        <div class="col">
            <h2>Pegawai Gor Unipol</h2>
        </div>
        <div class="col text-end">
            <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalMetode">Tambah Pegawai</button>
        </div>
    </div>
    <div class="row mb-4">
        <div class="col">
            <div class="table-responsive border p-3 rounded">
                <table id="sewa" class="table table-striped table-bordered" style="width:100%">
                    <thead>
                        <tr>
                            <th class="fw-medium bg-info-subtle">Username</th>
                            <th class="fw-medium bg-info-subtle">Nama</th>
                            <th class="fw-medium bg-info-subtle">Password</th>
                            <th class="fw-medium bg-info-subtle">Status Pegawai</th>
                            <th class="fw-medium bg-info-subtle">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>lorem</td>
                            <td>lorem</td>
                            <td>lorem</td>
                            <td>lorem</td>
                            <td>
                                <button type="button" class="btn btn-sm btn-outline-secondary" data-bs-toggle="modal" data-bs-target="#modalMetode"><i class="bi bi-x-circle-fill"></i></button>
                                <button type="button" class="btn btn-sm btn-outline-secondary" data-bs-toggle="modal" data-bs-target="#modalMetode"><i class="bi bi-trash-fill"></i></button>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
</div>

<!-- Modal -->
<div class="modal fade" id="modalMetode" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true" data-bs-backdrop="static" data-bs-keyboard="false">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Tambah Pegawai</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="mb-3">
                    <label for="username" class="form-label">Username</label>
                    <input type="text" class="form-control" id="username">
                </div>
                <div class="mb-3">
                    <label for="nama" class="form-label">Nama</label>
                    <input type="text" class="form-control" id="nama">
                </div>
                <div class="mb-3">
                    <label for="passwordPegawai" class="form-label">Password</label>
                    <input type="password" class="form-control" id="passwordPegawai">
                </div>
                <div class="mb-3">
                    <label for="statusPegawai" class="form-label">Status Pegawai</label>
                    <select name="" id="statusPegawai" class="form-select">
                        <option value="Aktif">Aktif</option>
                        <option value="Non-Aktif">Non-Aktif</option>
                    </select>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                <button type="button" class="btn btn-primary">Simpan</button>
            </div>
        </div>
    </div>
</div>