<?php

declare(strict_types=1);

use Imi\App;
use Imi\AppContexts;

return [
    // 配置文件
    'configs'    => [
        'beans'        => __DIR__ . '/beans.php',
    ],

    // 主服务器配置
    'mainServer'    => [
        'namespace'     => 'ImiApp\MQTTServer',
        'type'          => 'MQTTServer',
        'host'          => '0.0.0.0',
        'port'          => 8081,
        'configs'       => [
            'worker_num'    => 1,
        ],
        'controller'    => \ImiApp\Module\Test\Controller\MQTTController::class,
    ],

    // 子服务器（端口监听）配置
    'subServers'        => [
        'MQTTSSL'   => [
            'namespace'     => 'ImiApp\MQTTSServer',
            'type'          => 'MQTTServer',
            'host'          => '0.0.0.0',
            'port'          => 8082,
            'sockType'      => \SWOOLE_SOCK_TCP | \SWOOLE_SSL, // SSL 需要设置一下 sockType
            'configs'       => [
                // 配置证书
                'ssl_cert_file'     => \dirname(__DIR__) . '/ssl/server.crt',
                'ssl_key_file'      => \dirname(__DIR__) . '/ssl/server.key',
            ],
            'controller'    => \ImiApp\Module\Test\Controller\MQTTController::class,
        ],
    ],

    // 连接池配置
    'pools'    => [
        'redis'    => [
            'pool'    => [
                'class'        => \Imi\Swoole\Redis\Pool\CoroutineRedisPool::class,
                'config'       => [
                    'maxResources'              => 32,
                    'minResources'              => 0,
                    'checkStateWhenGetResource' => false,
                    'heartbeatInterval'         => 60,
                ],
            ],
            'resource'    => [
                'host'      => '127.0.0.1',
                'port'      => 6379,
                'password'  => null,
            ],
        ],
    ],

    // 数据库配置
    'db'    => [
        // 数默认连接池名
        'defaultPool'    => 'maindb',
    ],

    // redis 配置
    'redis' => [
        // 数默认连接池名
        'defaultPool'   => 'redis',
    ],

    // 日志配置
    'logger' => [
        'channels' => [
            'imi' => [
                'handlers' => [
                    [
                        'env'       => ['cli', 'swoole', 'workerman'],
                        'class'     => \Imi\Log\Handler\ConsoleHandler::class,
                        'construct' => [
                            'level'  => \Imi\Log\MonoLogger::DEBUG, // 开发调试环境
                            // 'level'  => \Imi\Log\MonoLogger::INFO,  // 生产环境
                        ],
                        'formatter' => [
                            'class'     => \Imi\Log\Formatter\ConsoleLineFormatter::class,
                            'construct' => [
                                'format'                     => null,
                                'dateFormat'                 => 'Y-m-d H:i:s',
                                'allowInlineLineBreaks'      => true,
                                'ignoreEmptyContextAndExtra' => true,
                            ],
                        ],
                    ],
                    // RoadRunner worker 下日志
                    [
                        'env'       => ['roadrunner'],
                        'class'     => \Monolog\Handler\StreamHandler::class,
                        'construct' => [
                            'level'  => \Imi\Log\MonoLogger::DEBUG, // 开发调试环境
                            // 'level'  => \Imi\Log\MonoLogger::INFO,  // 生产环境
                            'stream'  => 'php://stderr',
                        ],
                        'formatter' => [
                            'class'     => \Monolog\Formatter\LineFormatter::class,
                            'construct' => [
                                'format'                     => null,
                                'dateFormat'                 => 'Y-m-d H:i:s',
                                'allowInlineLineBreaks'      => true,
                                'ignoreEmptyContextAndExtra' => true,
                            ],
                        ],
                    ],
                    [
                        'class'     => \Monolog\Handler\RotatingFileHandler::class,
                        'construct' => [
                            'level'  => \Imi\Log\MonoLogger::DEBUG, // 开发调试环境
                            // 'level'  => \Imi\Log\MonoLogger::INFO,  // 生产环境
                            'filename' => App::get(AppContexts::APP_PATH_PHYSICS) . '/.runtime/logs/log.log',
                        ],
                        'formatter' => [
                            'class'     => \Monolog\Formatter\LineFormatter::class,
                            'construct' => [
                                'dateFormat'                 => 'Y-m-d H:i:s',
                                'allowInlineLineBreaks'      => true,
                                'ignoreEmptyContextAndExtra' => true,
                            ],
                        ],
                    ],
                ],
            ],
        ],
    ],
];
