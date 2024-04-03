### example 02 - not vulnerable
```bash
$ docker build --tag host.example_02 --file Dockerfile .
$ docker run -p 8050:3000 -d -t --name example_02 host.example_02

# from another terminal
$ curl -X GET http://127.0.0.1:8050/status
Everything seems fine # <--- pwned file does not exist

$ curl -X POST http://127.0.0.1:8050/vuln?evilCode="\"touch%20pwned\""
I didn't do it

# Unsurprising ! vm2 is not imported at all ...
$ curl -X GET http://127.0.0.1:8050/status
Everything seems fine # <--- pwned file was *not* created
```