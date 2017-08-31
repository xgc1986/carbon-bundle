[![Latest Stable Version](https://poser.pugx.org/xgc/carbon-bundle/v/stable)](https://packagist.org/packages/xgc/carbon-bundle)
[![License](https://poser.pugx.org/xgc/carbon-bundle/license)](https://packagist.org/packages/xgc/carbon-bundle)
[![Build Status](https://travis-ci.org/xgc1986/carbon-bundle.svg?branch=master)](https://travis-ci.org/xgc1986/carbon-bundle)
[![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/xgc1986/carbon-bundle/badges/quality-score.png?b=master)](https://scrutinizer-ci.com/g/xgc1986/carbon-bundle/?branch=master)
[![Code Coverage](https://scrutinizer-ci.com/g/xgc1986/carbon-bundle/badges/coverage.png?b=master)](https://scrutinizer-ci.com/g/xgc1986/carbon-bundle/?branch=master)

# Xgc CarbonBundle

A doctrine custom mapping for <a href='https://github.com/briannesbitt/Carbon' target='_blank'>nesbot/carbon</a>

## Installation

```bash
$ composer require xgc/carbon-bundle
```

### With Symfony

```php
<?php
// app/AppKernel.php

public function registerBundles()
{
    return array(
        // ...

        new Sensio\Bundle\FrameworkExtraBundle\SensioFrameworkExtraBundle(),
        new Doctrine\Bundle\DoctrineBundle\DoctrineBundle(),
        
        new Xgc\CarbonBundle\CarbonBundle(),
    );
}
```

### With Doctrine only

```php
<?php
declare(strict_types=1);

use Doctrine\DBAL\Types\Type;
use Xgc\CarbonBundle\Type\CarbonType;

Type::addType('carbon', CarbonType::class);

```


## Usage

```php
<?php
declare(strict_types=1);
// src/AppBundle/Entity/MyEntity

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

class MyEntity {
//...
    /**
     * @ORM\Column(type="carbon") 
     */
    private $dateTime;
//...
}
```

Also can be used since version 0.2 as ParamConverter

```php
/**
 * @Route("/posts/{date}")
 */
public function listPostsAction(Carbon $date) {
    //...
}

// This will accept ATOM, COOKIE, RFC822, ISO8601, RFC850, RFC1036
// RFC1123, RFC2822, RFC3339, RFC3339_EXTENDED, RFC7231, RSS, W3C, 
// 'Y-m-d H:i:s', 'd-m-Y H:i:s', 'd-m-Y', 'Y-m-d', 'U'

// i.e: /posts/1504201518
```

If you use a different format for the list, for example 'Y-d-m', you can also add your format

```php
/**
 * @Route("/posts/{date}")
 * @ParamConverter("date", options={"format": "Y-d-m"})
 */
public function listPostsAction(Carbon $date) {
    //...
}

// This will accept ATOM, COOKIE, RFC822, ISO8601, RFC850, RFC1036
// RFC1123, RFC2822, RFC3339, RFC3339_EXTENDED, RFC7231, RSS, W3C, 
// 'Y-m-d H:i:s', 'd-m-Y H:i:s', 'd-m-Y', 'Y-m-d', 'U'

// i.e: /posts/2017-02-03
// Carbon will know that is 2nd March, if you didn't add the format then it would be
// 3rd February
```


## WIP

* Add configuration for locale with symfony
* Create "carbon_date" type
* ~~Build a stable version~~
* Add carbon for Symfony Forms
