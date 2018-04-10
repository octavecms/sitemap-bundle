OctaveSitemapBundle
========================

## Installation

### Step 1: Download OctaveSitemapBundle using composer

Add a custom git repository to your composer.json

```json
"repositories": [
        {
            "type": "git",
            "url": "https://git.Octave.net/vig-bundles/sitemap-bundle.git"
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
        new Octave\SitemapBundle\OctaveSitemapBundle(),
        // ...
    );
}
```

### Step 3: Implement your sitemap source

```php
<?php

namespace AppBundle\Service;

use Octave\SitemapBundle\Service\SourceInterface;
use Octave\SitemapBundle\Model\Item;

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
            - { name: 'octave.sitemap.source' }
```