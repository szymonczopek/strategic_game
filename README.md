# Strategic browser game</br>

## To run this program:</br>

### 1. Make sure you have the following tools installed on your computer:</br>

PHP (recommended version 7.2 or newer)</br>
Composer (dependency management tool for PHP projects)</br>
Database MySql (recommended version 8.0 or newer)</br>
Web server (e.g., Apache, etc.)</br>

### 2. Download the code from GitHub:</br>

    git clone szymonczopek/strategic_game

### 3. Install dependencies:</br>

In the project directory, run the following command to install all the required dependencies:</br>

    composer install

### 4. Configure the environment:</br>

Copy the .env.example file and rename it as .env. You can do this by running the following command:</br>

    cp .env.example .env

In the .env file, configure the database settings such as database name, username, password, etc.</br>

### 5. Generate an application key:</br>

In the project directory, run the following command to generate a unique Laravel application key:</br>

    php artisan key:generate

### 6. Run database migrations:</br>

Execute migrations to create the required database tables and seeder:</br>

    php artisan migrate:refresh --seed

### 7. Start the server:</br>

Run the built-in Laravel development server by executing the following command:</br>

    php artisan serve

## Once the server is running, the application will be accessible at http://localhost:8000.</br>
