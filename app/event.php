<?php
// 事件定义文件
return [
    'bind'      => [
    ],

    'listen'    => [
        'AppInit'  => [],
        'HttpRun'  => [],
        'HttpEnd'  => [],
        'LogLevel' => [],
        'LogWrite' => [],
        'StoreProductUserOperationConfirmAfter' => [], //ProductSubscribe 用户操作产品添加事件 用户收藏产品 Models模块 store.StoreProductRelation Model
        'StoreProductUserOperationCancelAfter' => [],
    ],

    'subscribe' => [
        fox\subscribes\ProductSubscribe::class,
    ],
];
