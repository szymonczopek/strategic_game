Strategic browser game

To run this program:

1. Make sure you have the following tools installed on your computer:

PHP (recommended version 7.2 or newer)
Composer (dependency management tool for PHP projects)
Database MySql
Web server (e.g., Apache, Nginx, etc.)

2. Download the code from GitHub:

git clone szymonczopek/strategic_game

3. Install dependencies:

In the project directory, run the following command to install all the required dependencies:

composer install

4. Configure the environment:

Copy the .env.example file and rename it as .env. You can do this by running the following command:

(bash)
cp .env.example .env

In the .env file, configure the database settings such as database name, username, password, etc.

5. Generate an application key:

In the project directory, run the following command to generate a unique Laravel application key:

php artisan key:generate

6. Run database migrations:

Execute migrations to create the required database tables and seeder:

php artisan migrate:refresh --seed

7. Start the server:

Run the built-in Laravel development server by executing the following command:

php artisan serve

Once the server is running, the Laravel application will be accessible at http://localhost:8000.
