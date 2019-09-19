# Requirements

In order to parse the PDF and build the flipbook feature:

- Imagick (if not already in your server `sudo apt-get install php-imagick`)
- Ghostscript (`sudo apt-get install ghostscript`)
- libgs-dev (`sudo apt-get install libgs-dev`)

# Installation

If you wanna use homestead, just edit your Homestead.yaml file in the root of the project and add your desired dev domain. Don't forget to edit your /etc/hosts file to point the IP

Run `composer install` to get all the packages.

Remember set the queue worker:
https://laravel.com/docs/5.4/queues

# Testing

Create a database/testing.sqlite file

Then run the migrations for that:

```shell
php artisan migrate --database sqlite_testing
```
