# Instructions of the project #
|           #             |   **Instructions**      |
|-------------------------|-------------------------|
| Step-1                  |  [Setup Laravel project](#q1)<br>|

## Q1
# Backend API(Laravel) installations
Follow the steps mentioned below to install and run the project.

1. Clone or download the repository
2. Go to the project directory and run `composer install`
3. Create `.env` file by copying the `.env.example`. You may use the command to do that `cp .env.example .env`
4. Update the database name and credentials in `.env` file
5. Run the command `php artisan migrate --database=central --path=database/migrations/central` to migrate `central` database.
6. Run the command `php artisan migrate --database=central --path=database/migrations/central --seed` to migrate `central` database and `seed` two demo data
7. Run the command `php artisan tenants:migrate` to migrate two `tenant` database.
8. Run the command `php artisan tenants:migrate --seed` to migrate `tenant` database with seed some data for authentication.
9. Run the command `php artisan serve` to check api functionality

