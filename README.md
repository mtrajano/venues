Configuring Application on your local machine:
1. Ensure php5.4 or higher is installed on host.
You'll also need php5-mcrypt, and mcrypt
2. Follow instructions found here: http://laravel.com/docs/4.2/quick#installation
3. Go to project root where composer.json is found
4. composer update
5. Run php artisan serve, and visit localhost:8000
6. Database is hosted remotely, but if you want to create a database / reconfigure a database, seeding scripts are located in the database/seeds folder, and php artisan migrate:refresh will run the scripts necessary to create the tables. You will also need to adjust the configuration file to point to your sql server. It currently points to a vps
7. url routes are contained in routes php file in  app/ directory

8. username and password to see admin stuff is: 
username: tomaszi@gmail.com
password: CS336Project