
<h1> Guessing Game </h1>

<p>This project is built with laravel 9, PHP 8, mysql, and pusher ... here's how to run it:</p>

<ul>
    <li>Install Xampp (or any alternative for your OS), Composer, and Node (npm)</li>
    <li>Clone the repo into htdocs</li>
    <li>Cd into the repo then run "composer update"</li>
    <li>run "npm install"</li>
    <li>run "php artisan key:generate"</li>
    <li>Create the database named "guessing_game"</li>
    <li>.env file is included in the repo .. change the DB_USERNAME & DB_PASSWORD if needed</li>
    <li>run "php artisan migrate"</li>
    <li>run "php artisan db:seed" .. this will create 5 users with emails from "user0@mail.com" to "user4@mail.com" all
        with the password being "password"
    </li>
    <li>Finally .. run "php artisan serve", copy the link into the browser and enjoy</li>
</ul>

