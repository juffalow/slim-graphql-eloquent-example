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
      'debug' => 0,
      'maxDepth' => 15,
      'introspection' => true,
    ],
    'displayErrorDetails' => true,
    'db' => [
      'driver' => 'mysql',
      'host' => 'localhost',
      'port' => 3306,
      'database' => 'test',
      'username' => 'user',
      'password' => 'password',
      'charset'   => 'utf8',
      'collation' => 'utf8_unicode_ci',
      'prefix'    => '',
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
         * EMERGENCY (600)
         */
        'level' => 100,
        'file' => __DIR__ . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . 'logs' . DIRECTORY_SEPARATOR . 'graphql.log',
      ]
    ],
  ]
];
