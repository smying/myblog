<?php

return [
    // 生成应用公共文件
    '__file__' => ['common.php', 'config.php', 'database.php'],

    // 定义demo模块的自动生成 （按照实际定义的文件名生成）
    'admin'     => [
        '__file__'   => ['common.php'],
        '__dir__'    => ['behavior', 'controller', 'model', 'view','validate'],
        'controller' => ['Index', 'Test', 'Admin','Basic','Login','Register'],
        'model'      => ['User', 'Login','Admin'],
        'view'       => ['index/index','admin/edit','login/login'],
    ],
    // 其他更多的模块定义
];
