# Book Me

## Requirement

- php version v8.2.17
- composer v2.5.5
- postgres v15.4
- nginx v1.24
- docker and docker-compose

## How to use

- clone from repo: 

    ``` git clone https://github.com/rzfhlv/bookme.git ```

- in your root project directory copy environment file:

    ``` cp env.example .env ```

- run the app:

    ``` make up ```

- check the app with curl:

    ``` curl -X GET http://localhost:8000 ```
