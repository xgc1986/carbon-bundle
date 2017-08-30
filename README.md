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

        new Xgc\CarbonBundle\CarbonBundle(),

        // ...
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

## WIP

* Add configuration for locale with symfony
* Create "carbon_date" type
* Build a stable version
