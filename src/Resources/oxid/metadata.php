<?php

/**
 * Metadata version
 */
$sMetadataVersion = '2.0';

/**
 * Module information
 */
$aModule = [
    'id' => 'SiowebOxidApi',
    'title' => '<i></i><b style="color: #005ba9">Sioweb</b> | Symfony API',
    'description' => '.',
    'version' => '1.0',
    'url' => 'https://www.sioweb.de',
    'email' => 'support@sioweb.com',
    'author' => 'Sascha Weidner',
    'extend' => [
        \OxidEsales\Eshop\Application\Model\Article::class =>
            Sioweb\Oxid\Api\Legacy\Model\Article::class,
    ],
    'events' => [
        // 'onActivate' => '\Sioweb\Oxid\Api\Legacy\Core\Events::onActivate',
        // 'onDeactivate' => '\Sioweb\Oxid\Api\Legacy\Core\Events::onDeactivate',
    ],
    // 'templates' => [
    //     'formbuilder_shop_main.tpl' => 'sioweb/Backend/views/admin/tpl/form/formbuilder_shop_main.tpl',
    // ],
    // 'blocks' => [
    //     [
    //         'template' => 'headitem.tpl',
    //         'block' => 'admin_headitem_inccss',
    //         'file' => 'admin_headitem_inccss.tpl',
    //     ],
    // ]
];
