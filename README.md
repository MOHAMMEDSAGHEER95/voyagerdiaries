# voyagerdiaries

## to create database and add tables
## enter postgres terminal
## execute
## create role voyageradmin with password '<your_password>'
## create database voyager_db with owner voyageradmin
## psql -U voyageradmin -d voyager_db -f includes/create_tables.sql

## this will create the table for the project
## change the db config at config/db_config.php

## run the project using php -S localhost:8000
