## Overview

This is a library help you to handle the xml request. As we all know, [Yii2](https://github.com/yiisoft/yii2) provided an built-in request parser for `json` like requests, it's `yii\web\JsonParser`. Sometimes, we need to handle the request of xml, so this library is birthed.

## Install

Add `liwenyu/yii2-xmlparser` to composer.json, you can assign version as `*`:

```sh
$ composer install
//or run
$ composer update
```

also we can do like this:

```sh
$ composer require liwenyu/yii2-xmlparser=* --prefer-dist
```

## Usage

```
# file app/config/main.php [your configuration file]
<?php

return [
    'components' => [
    'request' => [
        'parsers' => [
	        	'application/xml' => 'liwenyu\yii2\XmlParser',
	        ],
        ],
    ],
];

```


## LICENSE

![MIT](https://img.shields.io/badge/license-MIT-blue.svg?style=flat-square)
