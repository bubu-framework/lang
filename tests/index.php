<?php

use Bubu\Lang\Lang;

require '../vendor/autoload.php';

$trad = [
    'hello' => [
        Lang::FR => 'Bonjour',
        Lang::EN => 'Hello'
    ],

    'how' => [
        Lang::FR => 'Comment'
    ]
];

Lang::registre($trad);


echo Lang::setLang(Lang::FR);
echo Lang::get('hello');


