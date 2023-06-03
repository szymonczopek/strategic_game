# Strategic browser game</br>

<img  src="https://imageupload.io/ib/qjuHbjDSOUhwz3t_1685779478.png" alt="graaa.png"/>
<img  src="https://imageupload.io/ib/YLikknbEtSOJ75Y_1685618458.png" alt="ratusz.png"/>
<img  src="https://imageupload.io/ib/9LLqbrfba80Bqda_1685619106.png" alt="kamieniarz.png"/>
<img  src="https://imageupload.io/ib/5pCX1oVsgx1p480_1685619193.png" alt="buduj.png"/>

## To run this program:</br>

### 1. Make sure you have the following tools installed on your computer:</br>

PHP (recommended version 7.2 or newer)</br>
Composer (dependency management tool for PHP projects)</br>
Database MySql (recommended version 8.0 or newer)</br>
Web server (e.g., Apache, etc.)</br>

### 2. Download the code from GitHub:</br>

Using Git repository, you can use this command:

    git clone https://github.com/szymonczopek/strategic_game.git

### 3. Install dependencies:</br>

In the project directory, run the following command to install all the required dependencies:</br>

    composer install

### 4. Configure the environment:</br>

Copy the .env.example file and rename it as .env. You can do this by running the following Bash command:</br>

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

### Once the server is running, the application will be accessible at http://localhost:8000.</br>
