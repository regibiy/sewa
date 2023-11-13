<?php

require_once '../vendor/autoload.php';

try {
    $mpdf = new \Mpdf\Mpdf(['tempDir' => __DIR__ . '/custom/temp/dir/path/mpdf']);
    $mpdf->WriteHTML('Hello World');
    // Other code
    $mpdf->Output();
} catch (\Mpdf\MpdfException $e) { // Note: safer fully qualified exception name used for catch
    // Process the exception, log, print etc.
    echo $e->getMessage();
}
