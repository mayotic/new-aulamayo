<?php
defined('_DA') or exit('Restricted Access');

$appfolder = array_diff(explode('/', __DIR__), explode('/', realpath($_SERVER['DOCUMENT_ROOT'])), ['cms']);
$appfolder = !empty($appfolder) ? '/' . implode('/', $appfolder) : '';

return [
    'env'       => 'dev',
    'url'       => 'dev.aulamayo.com',
    'db'        => [
        'host'            => 'localhost',
        'user'            => 'newAulaM2020',
        'pass'            => 's0o1Yh8~',
        'database'        => 'new_aulamayo'
    ],
    'app'  => [
        'name'            => 'Aula Mayo',
        'folder'          => $appfolder,
        'root'            => $_SERVER['DOCUMENT_ROOT'] . $appfolder,
        'resources'       => '/public/autoincludes',
        'libraries'       => '/public/libraries',
        'images'          => '/public/img',
        'controllers'     => '/controller',
        'includes'        => '/include',
        'templates'       => '/templates',
        'hooks'           => '/include/hooks',
        'languages'       => '/lang',
        'pages'           => ['/dev.aulamayo.com', '/manager', '/configuracion', '/subscripciones'],
        'url_notrights'   => '/login',
        'url_home'        => '/perfil',
        'url_login'       => '/login',
        'default_lang'    => 'es'
    ],
    'back' => [
        'url_notrights'   => '/manager/login',
    ],
    'mailservice' => [
        'mailuser'        => 'tic@edicionesmayo.es',
        'mailpass'        => 'MAYOtic123',
        'smtp'            => 'smtp.gmail.com',
        'port'            =>  587
    ],
    'emails' => [
        'mailfrom'        => 'tic@edicionesmayo.es',
        'mailreply'       => 'tic@edicionesmayo.es',
        'mailcc1'         => 'jjuvilla@edicionesmayo.es',
        'mailcc2'         => 'jjuvilla@edicionesmayo.es',
    ]
];
