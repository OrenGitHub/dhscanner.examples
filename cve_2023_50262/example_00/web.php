<?php

use Dompdf\Dompdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/token', function() { return csrf_token(); });

Route::post('/test', function(Request $request) {
    return "999 666 MMM";
});

Route::post('/ghsa_97m3', function (Request $request) {

    $file = $request->file('source');
    $content = file_get_contents($file);

    $dompdf = new Dompdf();
    $dompdf->loadHtml($content);
    $dompdf->setPaper('A4', 'landscape');
    $options = $dompdf->getOptions();
    $options->setAllowedProtocols([]);
    $dompdf->render();
    $dompdf->stream();

    return "DDD 444 111";
});

