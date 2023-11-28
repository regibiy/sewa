<div class="col-10 p-5">
    <div class="row row-cols-1 row-cols-sm-1 row-cols-md-4 justify-content-md-evenly">
        <div class="col-12 col-sm-12 col-md-2">
            <?php
            $count = 0;
            $book_exist = true;
            foreach ($data["current_book"] as $value) {
                if ($value["nama_lapangan"] === "Lapangan 1") {
                    if (strtotime($value["tanggal_sewa"]) >= strtotime(date("Y-m-d")) && !in_array($value["status_booking"], $data["status_booking"])) {
                        $count++;
                        echo "<div class='row p-4 mb-3 border shadow-sm rounded bg-primary-subtle text-center'>
                        <div class='col'>
                        <h4>" . $value["nama_lapangan"] . "</h4>
                        <p>" . $value["tanggal_sewa"] . "</p>
                        <p>" . $value["jam_mulai"] . " - " .  $value["jam_selesai"] . "</p>
                        <p>" . getLamaSewa($value["jam_mulai"], $value["jam_selesai"]) . " Jam</p>
                        </div>
                        </div>";
                    } else if ($value["no_transaksi"] === null || strtotime($value["tanggal_sewa"]) <= strtotime(date("Y-m-d")) || in_array($value["status_booking"], $data["status_booking"])) {
                        $book_exist = false;
                        $lapangan = $value["nama_lapangan"];
                    }
                }
            }
            if ($book_exist === false && $count === 0) {
                echo "<div class='row p-4 mb-3 border shadow-sm rounded bg-primary-subtle text-center'>
                <div class='col'>
                <h4>" . $lapangan . "</h4>
                <p>Belum Memiliki Jadwal Booking</p>
                </div>
                </div>";
            }
            ?>
        </div>
        <div class="col-12 col-sm-12 col-md-2">
            <?php
            $count = 0;
            $book_exist = true;
            foreach ($data["current_book"] as $value) {
                if ($value["nama_lapangan"] === "Lapangan 2") {
                    if (strtotime($value["tanggal_sewa"]) >= strtotime(date("Y-m-d")) && !in_array($value["status_booking"], $data["status_booking"])) {
                        $count++;
                        echo "<div class='row p-4 mb-3 border shadow-sm rounded bg-primary-subtle text-center'>
                        <div class='col'>
                        <h4>" . $value["nama_lapangan"] . "</h4>
                        <p>" . $value["tanggal_sewa"] . "</p>
                        <p>" . $value["jam_mulai"] . " - " .  $value["jam_selesai"] . "</p>
                        <p>" . getLamaSewa($value["jam_mulai"], $value["jam_selesai"]) . " Jam</p>
                        </div>
                        </div>";
                    } else if ($value["no_transaksi"] === null || strtotime($value["tanggal_sewa"]) <= strtotime(date("Y-m-d")) || in_array($value["status_booking"], $data["status_booking"])) {
                        $book_exist = false;
                        $lapangan = $value["nama_lapangan"];
                    }
                }
            }
            if ($book_exist === false && $count === 0) {
                echo "<div class='row p-4 mb-3 border shadow-sm rounded bg-primary-subtle text-center'>
                <div class='col'>
                <h4>" . $lapangan . "</h4>
                <p>Belum Memiliki Jadwal Booking</p>
                </div>
                </div>";
            }
            ?>
        </div>
        <div class="col-12 col-sm-12 col-md-2">
            <?php
            $count = 0;
            $book_exist = true;
            foreach ($data["current_book"] as $value) {
                if ($value["nama_lapangan"] === "Lapangan 3") {
                    if (strtotime($value["tanggal_sewa"]) >= strtotime(date("Y-m-d")) && !in_array($value["status_booking"], $data["status_booking"])) {
                        $count++;
                        echo "<div class='row p-4 mb-3 border shadow-sm rounded bg-primary-subtle text-center'>
                        <div class='col'>
                        <h4>" . $value["nama_lapangan"] . "</h4>
                        <p>" . $value["tanggal_sewa"] . "</p>
                        <p>" . $value["jam_mulai"] . " - " .  $value["jam_selesai"] . "</p>
                        <p>" . getLamaSewa($value["jam_mulai"], $value["jam_selesai"]) . " Jam</p>
                        </div>
                        </div>";
                    } else if ($value["no_transaksi"] === null || strtotime($value["tanggal_sewa"]) <= strtotime(date("Y-m-d")) || in_array($value["status_booking"], $data["status_booking"])) {
                        $book_exist = false;
                        $lapangan = $value["nama_lapangan"];
                    }
                }
            }
            if ($book_exist === false && $count === 0) {
                echo "<div class='row p-4 mb-3 border shadow-sm rounded bg-primary-subtle text-center'>
                <div class='col'>
                <h4>" . $lapangan . "</h4>
                <p>Belum Memiliki Jadwal Booking</p>
                </div>
                </div>";
            }
            ?>
        </div>
        <div class="col-12 col-sm-12 col-md-2">
            <?php
            $count = 0;
            $book_exist = true;
            foreach ($data["current_book"] as $value) {
                if ($value["nama_lapangan"] === "Lapangan 4") {
                    if (strtotime($value["tanggal_sewa"]) >= strtotime(date("Y-m-d")) && !in_array($value["status_booking"], $data["status_booking"])) {
                        $count++;
                        echo "<div class='row p-4 mb-3 border shadow-sm rounded bg-primary-subtle text-center'>
                        <div class='col'>
                        <h4>" . $value["nama_lapangan"] . "</h4>
                        <p>" . $value["tanggal_sewa"] . "</p>
                        <p>" . $value["jam_mulai"] . " - " .  $value["jam_selesai"] . "</p>
                        <p>" . getLamaSewa($value["jam_mulai"], $value["jam_selesai"]) . " Jam</p>
                        </div>
                        </div>";
                    } else if ($value["no_transaksi"] === null || strtotime($value["tanggal_sewa"]) <= strtotime(date("Y-m-d")) || in_array($value["status_booking"], $data["status_booking"])) {
                        $book_exist = false;
                        $lapangan = $value["nama_lapangan"];
                    }
                }
            }
            if ($book_exist === false && $count === 0) {
                echo "<div class='row p-4 mb-3 border shadow-sm rounded bg-primary-subtle text-center'>
                <div class='col'>
                <h4>" . $lapangan . "</h4>
                <p>Belum Memiliki Jadwal Booking</p>
                </div>
                </div>";
            }
            ?>
        </div>
    </div>
</div>