# Installation

### Method 1

Using comand line
```bash
$ composer require xgc/carbon-bundle
```

### Method 2

Editing composer.json

```json
{
  "require": {
    "xgc/carbon-bundle": "^0.5"
  }
}
```

## Configuration

```yaml
# app/config.yml
imports:
    #...
    - { resource: '@XgcCarbonBundle/Resources/config/'}

```

```php
// app/AppKernel.php
public function registerBundles()
{
    $bundles = array(
        //...
        new Xgc\CarbonBundle(),
    );
}

```

[Usage >](./usage.md)
