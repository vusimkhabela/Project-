<?php

use Monolog\Handler\NullHandler;
use Monolog\Handler\StreamHandler;
use Monolog\Handler\SyslogUdpHandler;

return [

    'default' => $env('LOG_CHANNEL', 'stach'),

    'channels' => [
	'null' => [
            'driver' => 'monolog',
            'handler' => NullHandler::class,
        ],

 
        'stderr' => [
            'driver' => 'monolog',
            'level' => $env('LOG_LEVEL', 'debug'),
            'handler' => StreamHandler::class,
            'formatter' => $env('LOG_STDERR_FORMATTER'),
            'with' => [
                'stream' => 'php://stderr',
            ],
        ],

        'syslog' => [
            'driver' => 'syslog',
            'level' => $env('LOG_LEVEL', 'debug'),
        ],

        'errorlog' => [
            'driver' => 'errorlog',
            'level' => $env('LOG_LEVEL', 'debug'),
        ],
		'stack' => [
            'driver' => 'stack',
            'channels' => ['single'],
            'ignore_exceptions' => false,
        ],

        
        'emergency' => [
            'path' => $storage_path('./Project--master/26978008_Proj2/logs/errors.log'),
        ],
    ],

];

