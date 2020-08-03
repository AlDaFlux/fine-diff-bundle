# FineDiffBundle

Original fine diff library:

- https://github.com/webtown-php/fine-diff-bundle
- https://github.com/gorhill/PHP-FineDiff
- http://www.raymondhill.net/finediff/viewdiff-ex.php

## Installation

### Add to composer

Run in command line:

```shell
$ composer require AlDaFlux/fine-diff-bundle
```

Or add with hand to composer.json:

```json
    "require": {
        "AlDaFlux/fine-diff-bundle": "~1.10"
    }
```

### Register the bundle

Add the app

```php
<?php
    // app/AppKernel.php
    
    public function registerBundles()
	{
		$bundles = array(
			// ...
			new AlDaFlux\FineDiffBundle\AlDaFluxPHPFineDiffBundle(),
		);
	}
```

### Configure

Optional. You can change the default granularity.

```yml
# app/config/config.yml

AlDaFlux_fine_diff:
    default_granularity: character # This is the default granularity. Alternatives: 'word', 'sentence' and 'paragraph'
```

## Usage

There are two twig function:

- `renderDiff()`: compare two strings
- `renderHtmlTextDiff()`: compare two strings which contain HTML tags. Remove tags with `strip_tags` before compare strings

```twig
{{ renderDiff(oldValue, newValue) }}
{{ renderDiff(oldValue, newValue, 'word') }}

{{ renderHtmlTextDiff(oldValue, newValue) }}
{{ renderHtmlTextDiff(oldValue, newValue, 'sentence') }}
```
