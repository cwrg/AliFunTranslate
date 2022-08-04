<?php
return [
    'debug' => \Core\Env::get('baidu.debug', false),
    'baidu' => [
        'appid' => \Core\Env::get('baidu.appid'),
        'key' => \Core\Env::get('baidu.key')
    ]
];
