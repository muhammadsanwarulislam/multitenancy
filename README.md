# Instructions of the project #
|           #             |   **Instructions**      |
|-------------------------|-------------------------|
| Installations           |  [Setup Laravel project](#q1)<br>|
|   Model                 |  [Model description](#q10)<br>   |

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

## Q10
# Define Models description with relations

# Tenant Model

The `Tenant` model is a crucial component of the multitenancy architecture in this Laravel application. It is responsible for managing and configuring tenant-specific database connections. This model extends Laravel's Eloquent ORM and includes methods to configure and switch between tenant databases dynamically.

## Features

### 1. Database Configuration

The `configure` method is used to dynamically configure the tenant-specific database connection. It leverages Laravel's database connection configuration and reconnects to the tenant database. The method also takes care of purging the cache if necessary.

# TenancyProvider

The `TenancyProvider` is a service provider in this Laravel application that plays a crucial role in handling tenancy-related configurations during the application's bootstrapping process. It integrates with the HTTP requests and queue processing to dynamically configure and switch between tenants based on the domain and job payload.

## Features

### 1. Request Configuration

The `configureRequests` method is responsible for dynamically configuring tenants based on the domain of the incoming HTTP requests. It checks the domain of the request, fetches the corresponding tenant, and configures and switches to that tenant using the `Tenant` model.



## User Model

The `User` model represents the application users.

### Attributes

- **id**: The unique identifier for the user.
- **username**: The user's username.
- **email**: The user's email address.
- **password**: The hashed password for user authentication.
- **created_at**: The timestamp when the user was created.
- **updated_at**: The timestamp when the user was last updated.
- **role_id**: The user's role define.

### Relationships

- **roles():** Defines a many-to-many relationship with the `roles` table.
- **permissions():** Defines a many-to-many relationship with the `permissions` table.
- **profile():** Defines a one-to-one relationship with the `profiles` table.

## Role Model

The `Role` model represents the roles that users can have in the application.

### Attributes

- **id**: The unique identifier for the role.
- **name**: The name of the role.

### Relationships

- **users():** Defines a many-to-many relationship with the `users` table.
- **permissions():** Defines a many-to-many relationship with the `permissions` table.

## Permissions Model

The `Permission` model represents the permissions that can be assigned to roles and users.

### Attributes

- **id**: The unique identifier for the permission.
- **name**: The name of the permission.


