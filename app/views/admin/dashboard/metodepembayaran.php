<div class="col-10 p-5">
    <div class="row">
        <div class="col">
            <h2>Metode Pembayaran</h2>
        </div>
        <div class="col text-end">
            <button class="btn btn-primary btn-add-payment" data-bs-toggle="modal" data-bs-target="#modalMetode">Tambah Metode Pembayaran</button>
        </div>
    </div>
    <div class="row mb-4">
        <div class="col">
            <div class="table-responsive border p-3 rounded">
                <table id="sewa" class="table table-striped table-bordered" style="width:100%">
                    <thead>
                        <tr>
                            <th class="fw-medium bg-info-subtle">No.</th>
                            <th class="fw-medium bg-info-subtle">Nama Bank</th>
                            <th class="fw-medium bg-info-subtle">Atas Nama</th>
                            <th class="fw-medium bg-info-subtle">No Rekening</th>
                            <th class="fw-medium bg-info-subtle">Status</th>
                            <th class="fw-medium bg-info-subtle">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $no = 0;
                        foreach ($data["metode_bayar"] as $value) {
                            $no++;
                            echo "<tr>";
                            echo "<td>" . $no . "</td>";
                            echo "<td>" . $value["nama_bank"] . "</td>";
                            echo "<td>" . $value["nama_pemilik"] . "</td>";
                            echo "<td>" . $value["no_rekening"] . "</td>";
                            echo "<td>" . $value["status"] . "</td>";
                            echo "<td><button class='btn btn-sm btn-outline-secondary btn-edit-payment' data-bs-toggle='modal' data-bs-target='#modalMetode' data-id='" . $value["id"] . "'><i class='bi bi-pencil-fill'></i></button>
                            <button class='btn btn-sm btn-outline-secondary btn-delete-payment' data-id='" . $value["id"] . "' data-bank=" . $value["nama_bank"] . "><i class='bi bi-trash-fill'></i></button></td>";
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
<div class="modal fade" id="modalMetode" tabindex="-1" aria-labelledby="paymentModalLabel" aria-hidden="true" data-bs-backdrop="static" data-bs-keyboard="false">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content modal-content-payment">
            <form action="<?= BASEURL ?>/admin/dashboard/addpaymentmethod" method="post" autocomplete="off">
                <input type="hidden" name="id" id="id">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="paymentModalLabel">Metode Pembayaran</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="namaBank" class="form-label">Nama Bank</label>
                        <input type="text" class="form-control input-method" id="namaBank" name="nama_bank" maxlength="15" required>
                    </div>
                    <div class="mb-3">
                        <label for="namaPemilik" class="form-label">Nama Pemilik</label>
                        <input type="text" class="form-control input-method" id="namaPemilik" name="nama_pemilik" maxlength="60" required>
                    </div>
                    <div class="mb-3">
                        <label for="noRek" class="form-label">Nomor Rekening</label>
                        <input type="number" class="form-control input-method" id="noRek" name="no_rekening" maxlength="20" required>
                    </div>
                    <div class="mb-3">
                        <label for="status" class="form-label">Status</label>
                        <select name="status" id="status" class="form-select select-method" required>
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