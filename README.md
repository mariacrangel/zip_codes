<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400"></a></p>

<p align="center">
Search a Zip code from Mexico, This Api had been developed with Laravel 8.*
All the required services for running are in docker container.
</p>

## About Aplication
In order to make the application scalable it has been created a relational database model like

<p align="center"><img src="https://github.com/mariacrangel/zip_codes/blob/main/model.png"></a></p>

For Queries I use Eloquent, the database runs in other container as the data was in xls format
it has been nedded to convert this file to csv and then import all this data to a temporal table, then this table was used for filling the relational database.

It had required to build a helper function for remove Accents of the text.

if you would like to run this container application, please create .env or email to me for sending the .env example, then execute 

docker-compose up -d 

once the comtainer is done:

docker ps #to see container and execute

docker exec -it <container_id_of_laravel_application> bash

then execute 

composer update

domposer dump-autoload

php artisan migrate

docker cp entities/ <container_id_of_database>:/docker-entrypoint-initdb.d/ # put files to import into database container
then you can enter into the database container
docker exec -it <container_id_of_database> bash
upload files to the temporal table
and then execute some queries to fill tables from converted data.
files are contained into entities directory
