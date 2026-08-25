# Senior Web Developer Test

## Project Overview

This project is a PHP native web application developed as part of a Senior Web Developer practical test.

The application provides:

- A responsive public website
- Privacy and cookie consent modal
- Accept and Decline consent functionality
- Consent acceptance storage in MySQL
- Consent version management
- Consent cookies
- Secured admin authentication
- Admin dashboard for viewing submitted consent acceptances
- Responsive layouts for desktop, tablet and mobile devices
- Database access using PDO

The application is built using native PHP, MySQL, HTML, CSS and JavaScript.

---

## Requirements

Before running the project, make sure the following are installed:

- PHP 8.x or compatible version
- MySQL
- Web browser
- VS Code or another code editor

---

## How to setup (run it)

# 1. check tools available

- open terminal
- run `php -v`
- run `mysql --version`

# 2. create database

run `Get-Content database\*.sql | mysql -u root -p`

# 3. configure database credentials

edit `config/database.php` and set your DB host/name/user/password directly

# 4. run local server

- run `php -S localhost:8000`
- run `mysql -u root -p`

---

Then open:

- http://localhost:8000/ → homepage
- http://localhost:8000/admin/dashboard.php → admin dashboard
- http://localhost:8000/test_database_connection.php → testing DB connection

Why PDO? Prepared statements keep query text and input values separate, so it's safe from SQL injection — better than concatenating SQL strings, and standard enough for a practical test.

## Admin Login

There is currently no registration function for the admin account.

For testing purposes, a default admin account has been added through the database seed file.

You can find the seed file in the `database` folder and use the credentials provided in the seed file to access the admin dashboard.

> The password is stored as a bcrypt hash in the database.
