<?php
defined('_DA') or exit('Restricted Access');

$appfolder = array_diff(explode('/', __DIR__), explode('/', $_SERVER['DOCUMENT_ROOT']), ['cms']);

return [
    'env'       => 'dev',
    'url'       => 'dev.aulamayo.com',
    'db'        => [
        'host'            => 'localhost',
        'user'            => 'newAulaM2020',
        'pass'            => 's0o1Yh8~',
        'database'        => 'new_aulamayo'
    ],
    'appinfo'  => [
        'appname'         => 'Aulamayo',
        'appfolder'       => !empty($appfolder) ? '/' . implode('/', $appfolder) : '',
        'approot'         => $_SERVER['DOCUMENT_ROOT'] . '/' . implode('/', $appfolder),
        'sitefolder'      => '/site',
        'resfolder'       => '/public/autoincludes',
        'libfolder'       => '/public/libraries',
        'imgfolder'       => '/public/img',
        'contfolder'      => '/controller',
        'incfolder'       => '/include',
        'tempfolder'      => '/templates',
        'hooksfolder'     => '/include/hooks',
        'langfolder'      => '/lang',
        'pagesfolders'    => ['/dev.aulamayo.com', '/manager', '/configuracion', '/subscripciones'],
        'url_notrights'   => '/login',
        'url_home'        => '/manager/usuarios',
        'url_login'       => '/login',
        'default_lang'    => 'es'
    ],
    'mailservice' => [
        // 'mailuser'        => 'jordi@visitelmaresme.com',
        'mailuser'        => 'visitelmaresme@gmail.com',
        'mailpass'        => 'MAYO2021',
        'smtp'            => 'smtp.gmail.com',
        'port'            => 587
    ],
    'emails' => [
        'mailfrom'        => 'jordi@visitelmaresme.com',
        'mailreply'       => 'jjuvilla@edicionesmayo.es',
        'mailcc1'         => 'jjuvilla@edicionesmayo.es',
        'mailcc2'         => 'jjuvilla@edicionesmayo.es',
    ]
];
