# P-API

Welcome to the P-Platform API made with [API-Platform](https://api-platform.com/).

## Installation

### PHP

The project requires PHP 7.0. To install the project, run the following command
to check if your system meets the default requirements:

```sh
./bin/symfony_requirements
```

Install [Composer](https://getcomposer.org) globally on your system.

### PostgreSQL

Download and install [PostgreSQL](https://www.postgresql.org/download/) on your
system.

If you want to use P-API default settings, you can create a `postgres` user
with a `postgres` password:

```
sudo su - postgres
psql template1

template1=# CREATE USER postgres WITH PASSWORD 'postgres';
If postgres already exist :
template1=# ALTER USER postgres PASSWORD 'postgres';

template1=# GRANT ALL PRIVILEGES ON DATABASE "api" to postgres;
template1=# \q
```

### Dependencies

Install the project and initialize the database by running at the root project
folder:

`./bin/reset`

## Run the API

### In development mode

Start the API using the Symfony PHP build-in server:

```sh
./bin/console server:run
```

### In production mode using Docker

Fill in the `app/config/parameters.yml` with the following values:

```yaml
parameters:
    database_host: db
    database_port: 5432
    database_name: p-api
    database_user: postgres
    database_password: postgres
    mailer_transport: smtp
    mailer_host: 127.0.0.1
    mailer_user: null
    mailer_password: null
    secret: ThisTokenIsNotSoSecretChangeIt
    cors_allow_origin:
        - 'http://localhost:3000'
        - 'http://localhost:9080'
```

Build the image:

```sh
docker-compose build
```

Run the docker-compose:

```sh
docker-compose -d up
```

## Using the API

### Authentication

Before being able to request the API, you must authenticate through the oAuth
server.

To do so in `development mode`, you must authenticate using the following url:

```
/oauth/v2/token?client_id=1_client_id&client_secret=client_secret&grant_type=password&redirect_uri=127.0.0.1&username=michel&password=password
```

You will be authenticated as `michel` (ask the API if you need more information
about this user).

In the Json response, you should get and use the attribute `access_token`. Put
it in the header of your next requests by adding an attribute `Authorization`
with the value `Bearer` followed with the `access_token`.

For example :

```
Bearer OWQ3ZGYzZmVhZDcxNTRmNDAwZGE3YjhjZWI1MmIwOWY1YzIzY2FmYjA0MmYxMGUwZDY5N2RiZTQ5NWM1NDA2Mw
```

