<?php

require_once '../vendor/autoload.php';

try {
    $mpdf = new \Mpdf\Mpdf(['tempDir' => __DIR__ . '/custom/temp/dir/path/mpdf', 'format' => 'A4', 'default_font' => 'dejavusans']);
    $html = '
    <h1 style="text-align:center">GOR UNIPOL</h1>
    <p style="text-align:center">Jalan Patikrama, Kec. Nanga Pinoh, Kab. Melawi, Kalimantan Barat</p>
    <hr>
    <table style="width:100%">
    <tr>
    <td style="width:20%; padding:16px">Nama</td>
    <td style="width:5%">:</td>
    <td><b>' . $data["nama"] . '</b></td>
    <tr>
    <tr>
    <td style="width:20%; padding:16px">Status</td>
    <td style="width:5%">:</td>
    <td><b>' . $data["status"] . '</b></td>
    <tr>
    <tr>
    <td style="width:20%; padding:16px">Lapangan</td>
    <td style="width:5%">:</td>
    <td><b>' . $data["detail_booking"]["nama_lapangan"] . '</b></td>
    <tr>
    <tr>
    <td style="width:20%; padding:16px">Tanggal</td>
    <td style="width:5%">:</td>
    <td><b>' . $data["detail_booking"]["tanggal_sewa"] . '</b></td>
    <tr>
    <tr>
    <td style="width:20%; padding:16px">Sesi</td>
    <td style="width:5%">:</td>
    <td><b>' . $data["detail_booking"]["jadwal"] . '</b></td>
    <tr>
    <tr>
    <td style="width:20%; padding:16px">Jam</td>
    <td style="width:5%">:</td>
    <td><b>' . $data["detail_booking"]["jam_mulai"] . ' - ' . $data["detail_booking"]["jam_selesai"] . '</b></td>
    <tr>
    <tr>
    <td style="width:20%; padding:16px">Lama Sewa</td>
    <td style="width:5%">:</td>
    <td><b>' . getLamaSewa($data["detail_booking"]["jam_mulai"], $data["detail_booking"]["jam_selesai"]) . ' Jam</b></td>
    <tr>
    <tr>
    <td style="width:20%; padding:16px">Harga</td>
    <td style="width:5%">:</td>
    <td><b>' . $data["detail_booking"]["harga"] * getLamaSewa($data["detail_booking"]["jam_mulai"], $data["detail_booking"]["jam_selesai"]) . '</b></td>
    <tr>
    <tr>
    <td colspan="3" style="text-align:center; padding:16px"><h3>Kode Booking :</h3></td>
    <tr>
    <tr>
    <td colspan="3" style="text-align:center; padding:16px; text-decoration:underline"><h2>' . $data["detail_booking"]["kode_booking"] . '</h2></td>
    <tr>
    </table>
    <hr style="margin-bottom:24px">
    <p style="text-align:center"><b>Terima Kasih</b></p>
    <p style="text-align:center">Telah Melakukan Booking Lapangan Bulutangkis di Gor Unipol</p>';
    $mpdf->WriteHTML($html);
    $file_name = "Bukti Booking " . $data["detail_booking"]["no_transaksi"] . ".pdf";
    $mpdf->Output($file_name, \Mpdf\Output\Destination::DOWNLOAD);
} catch (\Mpdf\MpdfException $e) { // Note: safer fully qualified exception name used for catch
    // Process the exception, log, print etc.
    echo $e->getMessage();
}
