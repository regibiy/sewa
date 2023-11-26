<?php
require_once '../vendor/autoload.php';

try {
    $mpdf = new \Mpdf\Mpdf(['tempDir' => __DIR__ . '/custom/temp/dir/path/mpdf', 'format' => 'Legal', 'default_font' => 'dejavusans', 'orientation' => 'L']);
    $html = '
    <h1 style="text-align:center"><b>GOR UNIPOL</b></h1>
    <p style="text-align:center">Jalan Patikrama, Kec. Nanga Pinoh, Kab. Melawi, Kalimantan Barat</p>
    <hr>
    <h2 style="text-align:center">Laporan Booking</h2>
    <p style="text-align:center">Periode ' . $data["tanggal_awal"] . ' Sampai ' . $data["tanggal_akhir"] . '</p>
    <table width="100%" border="1" style="border-collapse: collapse;">
        <tr>
            <th style="padding:8px">No.</th>
            <th style="padding:8px">No. Transaksi</th>
            <th style="padding:8px">Status</th>
            <th style="padding:8px">Lapangan</th>
            <th style="padding:8px">Tanggal</th>
            <th style="padding:8px">Harga</th>
            <th style="padding:8px">Jam Mulai</th>
            <th style="padding:8px">Jam Selesai</th>
            <th style="padding:8px">Lama Sewa</th>
            <th style="padding:8px">Total</th>
        </tr>';

    $no  = 0;
    $pendapatan = 0;
    foreach ($data["booking_data"] as $value) {
        $no++;
        $value["status_member_when_book"] === "Member" ? $harga = 0 : $harga = $value["harga"];
        $lama_sewa = getLamaSewa($value["jam_mulai"], $value["jam_selesai"]);
        $pendapatan += $harga * $lama_sewa;
        $html .=
            '<tr>
            <td style="padding:8px; width:10%">' . $no . '</td>
            <td style="padding:8px; width:10%">' . $value["no_transaksi"] . '</td>
            <td style="padding:8px; width:10%">' . $value["status_member_when_book"] . '</td>
            <td style="padding:8px; width:10%">' . $value["nama_lapangan"] . '</td>
            <td style="padding:8px; width:10%">' . $value["tanggal_sewa"] . '</td>
            <td style="padding:8px; width:10%">' . $harga . '</td>
            <td style="padding:8px; width:10%">' . $value["jam_mulai"] . '</td>
            <td style="padding:8px; width:10%">' . $value["jam_selesai"] . '</td>
            <td style="padding:8px; width:10%">' . $lama_sewa . ' Jam</td>
            <td style="padding:8px; width:10%">' . $harga * $lama_sewa . '</td>
            </tr>';
    }
    $html .= '
    </table>
    <h3 style="text-align:right">Total Pendapatan : ' . $pendapatan . '</h3>';
    $mpdf->SetHTMLFooter('
    <table width="100%" style="font-size:12px; font-weight:bold">
        <tr>
            <td width="33%">{DATE j-m-Y}</td>
            <td width="33%" align="center">{PAGENO}/{nbpg}</td>
            <td width="33%" style="text-align: right;">' . $data["user"] . '</td>
        </tr>
    </table>');
    $mpdf->WriteHTML($html);
    $file_name = "Laporan Booking Periode " . $data["tanggal_awal"] . " Sampai " . $data["tanggal_akhir"] . ".pdf";
    $mpdf->Output($file_name, \Mpdf\Output\Destination::INLINE);
} catch (\Mpdf\MpdfException $e) { // Note: safer fully qualified exception name used for catch
    // Process the exception, log, print etc.
    echo $e->getMessage();
}
