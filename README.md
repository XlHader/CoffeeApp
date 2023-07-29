# COFFEE APP
## Laravel API

## Installation

### 1. Clone the Git Repository

To get started with the installation of the application, you will first need to clone the Git repository. You can do this by running the following command in your terminal:

```bash
git clone https://github.com/XlHader/CoffeeApp
```

#### 2 .ENV

You will need to create a .env file in the root of the project, you can do this by copying the .env.example file and renaming it to .env. You will need to change the following variables:

```bash 
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=laravel
DB_USERNAME=superman
DB_PASSWORD=google123
```

### 3. PHP & Composer

You will need to have PHP (8.1+) installed on your machine. You can download PHP from the following link: https://www.php.net/downloads

Once you have PHP installed, you can install composer from the following link: https://getcomposer.org/download/

### 4. Install composer dependencies

You will need to install the composer dependencies. You can do this by running the following command in your terminal:

```bash
composer install
```

### 5. Install Sail

If you are using Docker, there is a dependency called Sail that allows you to run the project in a Docker container. When you install the composer dependencies, Sail will be installed as well. However, if it is not installed, you can install it with the following command:

```bash
composer require laravel/sail --dev
```

### 6. Run 

To run the application, you will need to run the following command in your terminal:

| Docker | Local |
| :-------- | :------- |
| `./vendor/bin/sail up -d` | `php artisan serve` |

This will start the project on the port configured in the .env file `APP_PORT=8080`, along with the database running on port `FORWARD_DB_PORT=3306`.

The project startup may take a little while, as Docker dependencies need to be installed. Once it's finished, you'll have a Docker container running with the project and a MySQL database.

#### 6.1 Docker

If you decided to run it using Docker, in the .env file, the host should be `DB_HOST=mysql`, and the port you entered in the .env file is `FORWARD_DB_PORT=3306`.

Note: You can connect to the database from an application like DBeaver or MySQL Workbench, using the host 'localhost' and the port you entered in the .env file `FORWARD_DB_PORT=3306`.

#### 6.2 Recommended

In this part, I recommend creating an alias for the `./vendor/bin/sail` command so that you don't have to type it every time you want to run a Sail command.

You can do this by adding the following line to your `.bashrc` or `.zshrc` file:

```bash
alias sail='./vendor/bin/sail'
```

## Process

### 1. Database 

#### 1.1 Local

You will need to create a database with the name you put in the .env file.

```sql
CREATE DATABASE laravel;
```

#### 1.2 Docker

In docker you don't need to create the database, it will be created automatically with the name you put in the .env file.

### 2. Migrations And Seeders

After the choice, you must run:

| Docker | Local |
| :-------- | :------- |
|`./vendor/bin/sail artisan migrate --seed` | `php artisan migrate --seed` |

### 3. Keys

#### Application Key

You will need to generate the application key. You can do this by running the following command in your terminal:

| Docker | Local |
| :-------- | :------- |
|`./vendor/bin/sail artisan key:generate` | `php artisan key:generate`

#### JWT Key

You will need to generate the JWT key. You can do this by running the following command in your terminal:

| Docker | Local |
| :-------- | :------- |
|`./vendor/bin/sail artisan jwt:secret` | `php artisan jwt:secret`

## API Documentation

Postman collection is available at the file `postman_collection.json`

### Auth

#### Login

```http
POST /api/auth/login
```

#### Body

| Parameter | Type | Description |
| :-------- | :------- | :------ |
| `email` | `string` | **Required**. |
| `password` | `string` | **Required**. |


### Authenticated Routes

#### Register

```http
POST /api/auth/register
```
#### Body

| Parameter | Type | Description |
| :-------- | :------- | :------ |
| `name` | `string` | **Required**. |
| `email` | `string` | **Required**. |
| `password` | `string` | **Required**. |
| `password_confirmation` | `string` | **Required**. |


#### Logout

```http
POST /api/auth/logout
```

#### Refresh

```http
GET /api/auth/refresh
```

### Categories

#### All Categories

```http
GET /api/categories
```

#### Specific Category

```http
GET /api/categories/{category}
```

#### Create Category

```http
POST /api/categories
```

#### Body

| Parameter | Type | Description |
| :-------- | :------- | :------ |
| `name` | `string` | **Required**. |


#### Update Category

```http
PUT /api/categories/{category}
```

#### Body

| Parameter | Type | Description |
| :-------- | :------- | :------ |
| `name` | `string` | **Required**. |

#### Delete Category

```http
DELETE /api/categories/{category}
```

### Products

#### All Products

```http
GET /api/products
```

#### Specific Product

```http
GET /api/products/{product}
```

#### Create Product

```http
POST /api/products
```

#### Body

| Parameter | Type | Description |
| :-------- | :------- | :------ |
| `name` | `string` | **Required**. |
| `reference` | `string` | **Required**. |
| `price` | `integer` | **Required**. |
| `weight` | `integer` | **Required**. |
| `stock` | `integer` | **Required**. |
| `category_id` | `integer` | **Required**. |

#### Update Product

```http
PUT /api/products/{product}
```

#### Body

| Parameter | Type | Description |
| :-------- | :------- | :------ |
| `name` | `string` | **Optional**. |
| `reference` | `string` | **Optional**. |
| `price` | `integer` | **Optional**. |
| `weight` | `integer` | **Optional**. |
| `stock` | `integer` | **Optional**. |
| `category_id` | `integer` | **Optional**. |

#### Delete Product

```http
DELETE /api/products/{product}
```

### Sales

#### All Sales

```http
GET /api/sales
```

#### Specific Sale

```http
GET /api/sales/{sale}
```

#### Create Sale

```http
POST /api/sales
```

#### Body

| Parameter | Type | Description |
| :-------- | :------- | :------ |
| `product_id` | `integer` | **Required**. |
| `amount` | `integer` | **Required**. |
