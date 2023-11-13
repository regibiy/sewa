<div class="col-10 p-5">
    <div class="row">
        <div class="col">
            <h1>Form Penyewaan</h1>
        </div>
    </div>
    <form action="<?= BASEURL ?>/dashboard/bookingprocess" id="formBooking" method="post" autocomplete="off">
        <div class="row row-cols-1 row-cols-sm-1 row-cols-md-2 border p-3 rounded shadow-sm">
            <div class="col">
                <div class="mb-3">
                    <label for="noTrans" class="form-label">No. Transaksi</label>
                    <input type="text" class="form-control" id="noTrans" name="no_transaksi" required readonly>
                </div>
                <div class="mb-3">
                    <label for="kodeBooking" class="form-label">Kode Booking</label>
                    <input type="text" class="form-control" id="kodeBooking" name="kode_booking" required readonly>
                </div>
                <div class="mb-3">
                    <label for="namaPenyewa" class="form-label">Nama Penyewa</label>
                    <input type="text" class="form-control" id="namaPenyewa" name="nama_penyewa" value="<?= $_SESSION["nama_user"] ?>" required readonly>
                </div>
                <div class="mb-3">
                    <label for="status" class="form-label">Status</label>
                    <input type="text" class="form-control" id="status" name="status" value="<?= $_SESSION["status_member"] ?>" required readonly>
                </div>
            </div>
            <div class="col">
                <div class="row">
                    <div class="col">
                        <div class="mb-3">
                            <label for="lapangan" class="form-label">Lapangan</label>
                            <select name="lapangan" id="lapangan" class="form-select form-booking" required>
                                <option value="0" selected hidden>Silakan pilih lapangan</option>
                                <?php
                                foreach ($data["lapangan"] as $value) {
                                    echo "<option value='" . $value["id"] . "'>" . $value["nama_lapangan"] . "</option>";
                                }
                                ?>
                            </select>
                        </div>
                    </div>
                    <div class="col">
                        <div class="mb-3">
                            <label for="tanggalSewa" class="form-label">Tanggal Sewa</label>
                            <input type="date" class="form-control" id="tanggalSewa" name="tanggal_sewa" required>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                        <div class="mb-3">
                            <label for="jadwal" class="form-label">Pilih Jadwal</label>
                            <select name="jadwal" id="jadwal" class="form-select" required>
                                <option value="0" selected hidden>Silakan pilih jadwal</option>
                                <option value="pagi">Pagi</option>
                                <option value="siang">Siang</option>
                                <option value="malam">Malam</option>
                            </select>
                        </div>
                    </div>
                    <div class="col"></div> <!-- blank space -->
                </div>
                <div class="row">
                    <div class="col">
                        <div class="mb-3">
                            <label for="jamMulai" class="form-label">Jam Mulai</label>
                            <input type="time" class="form-control" id="jamMulai" name="jam_mulai" required>
                        </div>
                    </div>
                    <div class="col">
                        <div class="mb-3">
                            <label for="jamSelesai" class="form-label">Jam Selesai</label>
                            <input type="time" class="form-control" id="jamSelesai" name="jam_selesai" required>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                        <button type="submit" class="btn btn-primary w-100">Konfirmasi</button>
                    </div>
                    <div class="col">
                        <button type="button" class="btn btn-outline-primary w-100 btn-booking-reset">Reset</button>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>
</div>