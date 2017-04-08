P-API
=====

Welcome to the P-Platform API made with API-Platform.

Installation
------------

### PHP

The project requires PHP 7.1. To install the project:
Run the following command to check if your system meets the requirements:

```sh
./bin/symfony_requirements
```

Install composer by following the instructions here: https://getcomposer.org.

### Postgresql
Download and install it https://www.postgresql.org/download/

If want to use P-API default settings
```
sudo su - postgres
psql template1

template1=# CREATE USER postgres WITH PASSWORD 'postgres';
If postgres already exist :
template1=# ALTER USER postgres PASSWORD 'postgres';

template1=# GRANT ALL PRIVILEGES ON DATABASE "api" to postgres;
template1=# \q
```

Run the API
-----------

Run the reset script to create the database and load the fixtures:

```sh
./bin/reset
```

Start the API using the Symfony build-in server:

```sh
./bin/console server:run
```


## In production with docker

Fill the parameter.yml with default value :
```yaml
# This file is auto-generated during the composer install
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

You can't adapt this file, but you need to modify your docker-compose in consequence.

Build the image :

```sh
sudo docker-compose build
```

Run the docker compose :

```sh
sudo docker-compose up
```

In detached mode :

```sh
sudo docker-compose -d up
```

### Made a request to API with OAuth

The first thing you should do is to made a request on 

/oauth/v2/token?client_id=1_client_id&client_secret=client_secret&grant_type=password&redirect_uri=127.0.0.1&username=michel&password=password

Actually, you can't sign in so you should use this url.
This will return a json with different value. You should get the attribute `access_token`

When you have this attribute. You should put it in the header of your next requests. 
You should add the attribute "Authorization" with the value "Bearer " concatenate with the access_token. 

You should now be able to make requests on your api.



