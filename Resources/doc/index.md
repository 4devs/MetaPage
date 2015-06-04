Getting Started With Locale Library
===================================

## Installation and usage

Installation and usage is a quick:

1. Download Locale using composer
2. Use the library


### Step 1: Download Locale library using composer

Add Locale library in your composer.json:

```json
{
    "require": {
        "fdevs/meta-page": "*"
    }
}
```

Now tell composer to download the bundle by running the command:

``` bash
$ php composer.phar update fdevs/meta-page
```

Composer will install the bundle to your project's `vendor/fdevs` directory.


### Step 2: Use the library

####Basic setup:

```php
<?php

require DIR . '/../vendor/autoload.php';

use FDevs\MetaPage\Model\MetaConfig;

// The same text in different languages
$description = new MetaConfig('name', 'description', '4Devs Company');
$description->setFormType('textarea');//if use symfony form

$ogTitle = new MetaConfig('property', 'og:title', '4Devs Company');
$ogTitle->setFormType('text');//if use symfony form

$ogType = new MetaConfig('property', 'og:type', 'website');

$siteConfig = [$description, $ogTitle, $ogType];

$head = ['prefix'=>'og: http://ogp.me/ns#'];

```

####Use with twig:

```php
use FDevs\MetaPage\Twig\MetaExtension;
use FDevs\MetaPage\Twig\HeadExtension;

$twig = new Twig_Environment($loader);
$twig->addExtension(new MetaExtension($siteConfig));
$twig->addExtension(new HeadExtension($head));
```
in templates

```twig
{{ meta() }}
{#<meta name="description" content="4Devs Company"/><meta property="og:title" content="4devs company"/><meta property="og:type" content="website"/>#}

<html {{ head_attributes() }}>
{#<html prefix="og: http://ogp.me/ns#">#}
```

create page model

```php
<?php

namespace FDevs\PageBundle\Model;

use FDevs\MetaPage\MetaInterface;
use FDevs\MetaPage\Model\MetaData;

class Page implements MetaInterface
{
    public function getMetaData()
    {
        return [new MetaData('name', 'description', 'best page')];
    }
    
    public function getTitle()
    {
        return 'page title';
    }
}
```

in templates

```twig
{{ meta(page) }}
{#<meta name="description" content="best page"/><meta property="og:title" content="4devs company"/><meta property="og:type" content="website"/>#}
```

modify base config

```php
use FDevs\MetaPage\Model\MetaConfig;

// The same text in different languages
$description = new MetaConfig('name', 'description', '4Devs Company');
$description->setFormType('textarea');//if use symfony form

$ogTitle = new MetaConfig('property', 'og:title', '4Devs Company');
$ogTitle->setVariable('title');

$ogType = new MetaConfig('property', 'og:type', 'website');

$siteConfig = [$description, $ogTitle, $ogType];
```
in templates

```twig
{{ meta(page) }}
{#<meta name="description" content="best page"/><meta property="og:title" content="page title"/><meta property="og:type" content="website"/>#}
```


####Use with symfony form:
```php

use FDevs\MetaPage\Form\Type\MetaDataType;
use FDevs\MetaPage\Form\Type\MetaType;

$formFactory = Forms::createFormFactoryBuilder()
    ->addType(new MetaType($siteConfig))
    ->addType(new MetaDataType())
    ->getFormFactory();
    
$form = $formFactory->createBuilder()
    ->add('metaData', 'fdevs_meta')
    ->getForm();

echo $twig->render('new.html.twig', array(
    'form' => $form->createView(),
));
```
