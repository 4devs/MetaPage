Meta Page Library
==================

Documentation
-------------


Installation
------------

Download the library by running the command:

``` bash
$ php composer.phar require fdevs/meta-page
```

Composer will install the bundle to your project's `vendor/fdevs` directory.


Usage
-----

```php

use FDevs\MetaPage\Type\NameType;
use FDevs\MetaPage\Type\PropertyType;
use FDevs\MetaPage\Renderer\PhpRenderer;
use FDevs\MetaPage\MetaFactory;
use FDevs\MetaPage\Type\ImageType;
use FDevs\MetaPage\Type\ListType;


$metaFactory = new MetaFactory();
$description = $metaFactory
    ->createBuilder(ListType::class)
    ->add(NameType::class, ['name' => 'description', 'content' => 'description'])
    ->add(NameType::class, ['name' => 'keywords', 'content' => 'keywords'])
    ->add(PropertyType::class, ['name' => 'locale', 'content' => 'ru'])
    ->getMeta()
;

$ogImage = $metaFactory->create(ImageType::class, [
    'content' => 'http://example.com/rock.jpg',
    'image_type' => 'image/jpg',
    'width' => 300,
    'height' => 300,
]);

$view = $metaFactory->createView($description);
$image = $metaFactory->createView($ogImage);

$renderer = new PhpRenderer();

echo $renderer->render($view); //<meta name="description" content="description"/><meta name="keywords" content="keywords"/><meta property="locale" content="ru"/>
echo $renderer->render($image); //<meta property="og:image" content="http://example.com/rock.jpg"/><meta property="og:image:type" content="image/jpg"/><meta property="og:image:width" content="300"/><meta property="og:image:height" content="300"/>
```

License
-------

This library is under the MIT license. See the complete license in the Library:

    LICENSE

Reporting an issue or a feature request
---------------------------------------

Issues and feature requests are tracked in the [Github issue tracker](https://github.com/4devs/meta-page/issues).
