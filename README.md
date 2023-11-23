# Strategic browser game</br>

Real - time strategy browser game. The gameplay is about managing a medieval city. The player acquires materials from which he builds buildings. Each building has a specific function in the city. In-game events take place in real time.</br>

<img  src="https://i.postimg.cc/4dkhJQqB/zdj1.png" alt="Strategic browser game photo"/></br></br></br>
<img  src="https://i.postimg.cc/T2cW6m9J/zdj2.png" alt="Strategic browser game photo"/></br></br></br>
<img  src="https://i.postimg.cc/bNWnCPg7/zdj01.png" alt="Buildings list"/>
<img  src="https://i.postimg.cc/DwGXRNY8/zjd02.png" alt="Buildings list"/>
<img  src="https://i.postimg.cc/vmdVyvpX/zdj03.png" alt="Buildings list"/></br></br></br>
<img  src="https://i.postimg.cc/RF7Jqnz9/zdj5.png" alt="Strategic browser game photo"/></br></br></br>
<img  src="https://i.postimg.cc/brqDnNzn/zdj6.png" alt="Strategic browser game photo"/></br></br></br>

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
