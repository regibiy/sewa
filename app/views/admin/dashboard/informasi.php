<div class="col-10 p-5">
    <div class="row">
        <div class="col">
            <h2>Informasi</h2>
        </div>
        <div class="col text-end">
            <button class="btn btn-primary btn-add-inform" data-bs-toggle="modal" data-bs-target="#modalInform">Tambah Informasi</button>
        </div>
    </div>
    <div class="row">
        <div class="col">
            <div class="table-responsive border p-3 rounded">
                <table id="sewa" class="table table-striped table-bordered" style="width:100%">
                    <thead>
                        <tr>
                            <th class="fw-medium bg-info-subtle">No.</th>
                            <th class="fw-medium bg-info-subtle">Judul</th>
                            <th class="fw-medium bg-info-subtle">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $no = 0;
                        foreach ($data["informations"] as $value) {
                            $no++;
                            echo "<tr>";
                            echo "<td>" . $no . "</td>";
                            echo "<td>" . $value["judul"] . "</td>";
                            echo "<td>
                            <button type='button' class='btn btn-sm btn-outline-secondary btn-edit-inform' data-id=" . $value["id"] . " data-bs-toggle='modal' data-bs-target='#modalInform'><i class='bi bi-pencil-fill'></i></button>
                            <button type='button' class='btn btn-sm btn-outline-secondary btn-delete-inform' data-id=" . $value["id"] . " data-judul=" . $value["judul"] . "><i class='bi bi-trash3-fill'></i></button>
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
<div class="modal fade" id="modalInform" tabindex="-1" aria-labelledby="informModalLabel" aria-hidden="true" data-bs-backdrop="static" data-bs-keyboard="false">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrolled modal-lg">
        <div class="modal-content modal-content-inform">
            <form action="<?= BASEURL ?>/admin/dashboard/addinform" method="post" autocomplete="off">
                <input type="hidden" name="id" id="id">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="informModalLabel">Tambah Informasi</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="judul" class="form-label">Judul</label>
                        <input type="text" class="form-control input-inform" id="judul" name="judul" required>
                    </div>
                    <div class="mb-3">
                        <label for="isi" class="form-label">Isi</label>
                        <textarea class="form-control textarea-inform" cols="3" rows="10" id="isi" name="isi" required></textarea>
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