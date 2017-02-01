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
