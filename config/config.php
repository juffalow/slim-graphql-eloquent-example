<?php

return [
  'settings' => [
    'graphql' => [
      /* 
       * OFF (0)
       * INCLUDE_DEBUG_MESSAGE (1)
       * INCLUDE_TRACE(2)
       * RETHROW_INTERNAL_EXCEPTIONS (4)
       */
      'debug' => 4,
      'maxDepth' => 15,
      'introspection' => true,
    ],
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
    ],
    'log' => [
      'file' => [
        /* 
        * DEBUG (100)
        * INFO (200)
        * NOTICE(250)
        * WARNING (300)
        * ERROR (400)
        * CRITICAL (500)
        * ALERT(550)
        * EMERGANCY (600)
        */
        'level' => 100,
        'file' => __DIR__ . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . 'logs' . DIRECTORY_SEPARATOR . 'graphql.log',
      ]
    ],
  ]
];
