# Translation library

## Usage

```php
<?php

use Bubu\Lang\Lang;

// Setup new translation
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

// Change default lang
Lang::setLang(Lang::FR);

// Get translation
echo Lang::get('hello');

```
