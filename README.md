# Slim, GraphQL and Eloquent example

[![License](https://img.shields.io/badge/License-MIT-blue.svg?maxAge=2592000)](https://github.com/juffalow/slim-graphql-eloquent-example/blob/master/LICENSE)
[![codecov](https://codecov.io/gh/juffalow/slim-graphql-eloquent-example/branch/master/graph/badge.svg)](https://codecov.io/gh/juffalow/slim-graphql-eloquent-example)

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

## Logging

There are multiple ways how to setup logging. The application now supports
rotating file logging and slack logging.

Logging levels:
* DEBUG (100)
* INFO (200)
* NOTICE(250)
* WARNING (300)
* ERROR (400)
* CRITICAL (500)
* ALERT(550)
* EMERGENCY (600)

Rotating file:

```php
  ...
  'log' => [
    'file' => [
      'level' => 100,
      'file' => 'path/to/file',
    ]
  ],
  ...
```

## Debug

GraphQL debug modes:
* INCLUDE_DEBUG_MESSAGE (1)
* INCLUDE_TRACE(2)
* RETHROW_INTERNAL_EXCEPTIONS (4)

```php
  ...
  'graphql' => [
    'debug' => INCLUDE_DEBUG_MESSAGE | INCLUDE_TRACE,
  ],
  ...
```

## Security

[Limiting Query Depth](https://webonyx.github.io/graphql-php/security/#limiting-query-depth):

```php
  ...
  'graphql' => [
    'maxDepth' => 10,
  ],
  ...
```

[Introspection](https://webonyx.github.io/graphql-php/security/#disabling-introspection):

```php
  ...
  'graphql' => [
    'introspection' => true,
  ],
  ...
```

## Examples

### Queries

#### Get list of authors

```graphql
query {
  authors {
    edges {
      node {
        id
        _id
        firstName
        lastName
      }
    }
  }
}
```

#### Filter authors by first name

```graphql
query {
  authors(firstName: "John") {
    edges {
      node {
        id
        _id
        firstName
        lastName
      }
    }
  }
}
```

#### Order authors by first name and last name:

```graphql
query {
  authors(orderBy:[
    {
      field:FIRST_NAME
      direction:ASC
    }
    {
      field:LAST_NAME
      direction:ASC
    }
  ]) {
    edges {
      cursor
      node {
        _id
        firstName
        lastName
      }
    }
  }
}
```

### Mutations

#### Create new author

```graphql
mutation {
  createAuthor(input:{firstName:"Fredrick", lastName:"Brooks"}) {
    id
    _id
    firstName
    lastName
  }
}
```

## Tests

Run PHPUnit:

```shell
./vendor/bin/phpunit

# or

./vendor/bin/phpunit --bootstrap ./vendor/autoload.php --testdox tests
```

Use PHP Stan to analyse php files for basic errors:

```shell
./vendor/bin/phpstan analyse src
```

## License

[MIT license](./LICENSE)