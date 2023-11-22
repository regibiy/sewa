<div class="col-10 p-5">
    <div class="row">
        <div class="col">
            <h1>Informasi</h1>
        </div>
    </div>
    <div class="row row-cols-2">
        <?php
        foreach ($data["informations"] as $value) {
            echo "<div class='col border rounded p-3 shadow-sm'>
            <h4 class='text-center mb-5'>" . $value["judul"] . "</h4>
            <p>" . $value["isi"] . "</p>
            </div>
            ";
        }
        ?>
    </div>
</div>