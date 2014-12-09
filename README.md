> Note that the content on the [live site](http://rasp.is) is still being updated, so don't panic if you see some lorem ipsum here and there ;)

#RasP.is
[RasP.is](http://rasp.is) is a URL shortener built on top of **Laravel 4**. It is not only a URL shortener but also a URL manager that allows the registered users to save and shorten their bookmarks with nice descriptions. Before we go ahead with the detail on how to use it, below is the overview of thee features that [RasP.is](http://rasp.is) provides.


#Overview
- It has a user's module that allows the users to register for an account, login and manage their profile
- Unregistered users may shorten their URLs from the homepage of the site.
- Registered users can not only shorten their URLs but also keep a record of their shortened URLs, save bookmarks.
- For the shortened URLs, the controller does a 301 redirect, which is the recommended type of redirect for maintaining maximum google juice to the original URL.
- A unique 6 character alphanumeric code is generated for each shortened link
- Registered users can check the number of times their URL was accessed through the shortened URL.

#How to setup
Follow the below steps to get it working locally

- Clone the repository
- Copy it where your webserver may be able to access it.
- Run the following command inside the project directory
```bash
composer install
```
- Now go to mysql and create the database named `raspis`
- Head to the `app/config/database.php` and enter your database settings
- Now go to `app/config/raspis.php` and for the `url` key provide the url that will be prefixed with the shortcode. Probably the URL through which you can access the project. I had virtual servers setup so I put `raspis.loc`, you may replace it with `localhost/raspis-url-shortener/` or whatever the name of the project directory is. However, don't forget the trailing slash.
- Head back to the project directory and perform the following command
```bash
php artisan migrate
```
- That's it, you are all set up ...start shortening your URLs.

#Contribute
You are welcome to contribute. You may do it so by following steps
- Clone the repository
- Add some features or improve the existing ones
- Open up a pull request

Also please do report the bugs that you may find by opening an issue or hit me by an email at kamranahmed.se@gmail.com
