### example 01 - not vulnerable
```bash
$ docker build --tag host.example_01 --file Dockerfile .
$ docker run -p 8040:3000 -d -t --name example_01 host.example_01

# from another terminal
$ curl -X GET http://127.0.0.1:8040/status
Everything seems fine # <--- pwned file does not exist

$ curl -X POST http://127.0.0.1:8040/vuln?evilCode="\"touch%20pwned\""
I didn't do it

$ curl -X GET http://127.0.0.1:8040/status
Everything seems fine # <--- pwned file was *not* created
```