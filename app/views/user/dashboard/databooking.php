<div class="col-10 p-5">
    <?php
    foreach ($data["current_book"] as $value) {
        if ($value["nama_lapangan"] === "Lapangan 1") {
            echo "<div class='row row-cols-1 row-cols-sm-1 row-cols-md-4 justify-content-md-evenly'>
            <div class='col-12 col-sm-12 col-md-2 p-4 border shadow-sm rounded bg-body-tertiary text-center'>
            <h3>" . $value["nama_lapangan"] . "</h3>
            <p>23 November 2023</p>
            <p>09:00 - 10:00</p>
            <p>Lama Sewa : 1 Jam</p>
            </div>
            </div>";
        }
    }
    ?>
</div>
</div>