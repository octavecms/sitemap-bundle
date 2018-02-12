VideInfraSitemapBundle
========================

## Installation

### Step 1: Download VideInfraSitemapBundle using composer

Add a custom git repository to your composer.json

```json
"repositories": [
        {
            "type": "git",
            "url": "https://git.videinfra.net/vig-bundles/sitemap-bundle.git"
        }
    ]
```

Require the bundle

```json
"require": {
    ... some repositories
    "vig/sitemap-bundle": "^1.0.0"
}
```

And run `composer update`.

### Step 2: Enable the bundle

Enable the bundle in the kernel:

```php
<?php
// app/AppKernel.php

public function registerBundles()
{
    $bundles = array(
        // ...
        new VideInfra\SitemapBundle\VideInfraSitemapBundle(),
        // ...
    );
}
```

### Step 3: Implement your sitemap source

```php
<?php

namespace AppBundle\Service;

use VideInfra\SitemapBundle\Service\SourceInterface;
use VideInfra\SitemapBundle\Model\Item;

class AppSitemapSource implements SourceInterface
{
    public function getItems()
    {
        return [
            new Item('http://mysite.com/', new \DateTime(), Item::FREQ_ALWAYS, 1.0)    
        ];
    }
}
```

### Step 4: Configure source service

```yaml
# app/config/services.yml

services:
    
    app.sitemap.source:
        class: AppBundle\Service\AppSitemapSource
        tags:
            - { name: 'vig.sitemap.source' }
```