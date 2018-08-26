# Slim, GraphQL and Eloquent example

[![License](https://img.shields.io/badge/License-MIT-blue.svg?maxAge=2592000)](https://github.com/juffalow/slim-graphql-eloquent-example/blob/master/LICENSE)


## How to run the project

Install dependencies :

```shell
composer install
```

Create database for the project by importing *eloquent_example.sql* and update the *config/config.php*:

```php
<?php

return [
  'settings' => [
    'displayErrorDetails' => true,
    'db' => [
      'driver' => 'mysql',
      'host' => 'localhost',
      'database' => 'eloquent_example',
      'username' => 'root',
      'password' => '',
      'charset'   => 'utf8',
      'collation' => 'utf8_unicode_ci',
      'prefix'    => '',
      'unix_socket' => '/Applications/XAMPP/xamppfiles/var/mysql/mysql.sock',
    ]
  ],
];

```

Run the project :

```shell
php -S localhost:8088
```

Open GraphiQL in your browser [http://localhost:8088/graphql](http://localhost:8088/graphql)

## Examples

#### Get list of authors:

```graphql
query {
	authors {
  	id
    name
    last_name
  }
}
```

*This will return only first 10 authors because of pagination!*

#### Get another page of authors:

```graphql
query {
	authors(page: 2) {
  	id
    name
    last_name
  }
}
```

#### Get just name of the author with ID = 4

```graphql
query {
	author(id: 4) {
    name
  }
}
```

## License

[MIT license](./LICENSE)