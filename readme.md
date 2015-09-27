## Home library API.

API on Laravel 5 framework

## Install

$git clone https://github.com/mvggit/HomeLibraryAPI.git /folder_dest

or 

download zip from https://github.com/mvggit/HomeLibraryAPI/archive/master.zip & unpacking to /dest_folder

$cd /path/to/folder_dest

composer install


## Settings

You must open .env file & set self settings

For best your have set webserver settings go RootDirectory to dest_folder/public.
For example apache:
DocumentRoot /var/www/dest_folder/public

## Set DB

You must have library DB in your DB driver

If library DB exits run shell comands from dest_folder:

php artisan migrate

php artisan db:seed

## Phpdocumentor gen doc

doc/ folder contains html pages description API. Copy this folder to you virtual host on webserver & read documentation.

### License

The API home library is open-sourced software licensed under the [MIT license](http://opensource.org/licenses/MIT)