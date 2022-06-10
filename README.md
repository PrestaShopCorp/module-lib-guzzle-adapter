# PrestaShop module library for Guzzle clients

Plug modules to the Guzzle client available on a running shop.
This library is compatible with PHP 7.2 and above.

## Installation

```
composer require prestashop/module-lib-guzzle-adapter
```

## Usage

```php
# Getting a client (Psr\Http\Client\ClientInterface)
$options = ['base_url' => 'http://some-url/'];
$client = (new Prestashop\ModuleLibGuzzleAdapter\ClientFactory())->getClient($options);

# Sending requests and receive response (Psr\Http\Message\ResponseInterface)
$response = $this->client->sendRequest(
    new GuzzleHttp\Psr7\Request('POST', 'some-uri')
);
```

In this example, `base_url` is known to be a option for Guzzle 5 that has been replaced for `base_uri` on Guzzle 6+. Any of this two keys can be set, as it will be automatically modified for the other client if needed.

The automatically changed properties are:

| Guzzle 5 property | | Guzzle 7 property |
| ------------- | -- | ------------- |
| base_url  | <=> | base_url  |
| defaults.authorization | <=> | authorization  |
| defaults.exceptions | <=> | http_errors  |
| defaults.timeout | <=> | timeout  |

## Why this library?

Making HTTP requests in a PrestaShop module can be done in several ways. With `file_get_contents()`, cURL or Guzzle when provided by the core.

Depending on the running version of PrestaShop, the bundled version of Guzzle can be different:
* PrestaShop 1.7: Guzzle 5
* PrestaShop 8: Guzzle 7

Having a module compatible for these two major PrestaShop versions can be tricky. The classes provided by the two Guzzle version are named the same, but their methods are different.

It is not possible for a module contributor to require its own Guzzle dependency either, because PHP cannot load different versions of a same class and he would never know which one would be loaded first.

## Implementation notes

This library reuses the idea behind [PHP-HTTP](https://docs.php-http.org), where the implementation of HTTP requests should be the same (PSR) whatever the client chosen.

The client files from [php-http/guzzle5-adapter](https://github.com/php-http/guzzle5-adapter) and [php-http/guzzle7-adapter](https://github.com/php-http/guzzle7-adapter) have been copied in this repository because these libraries both require a different version Guzzle in their dependencies to work. Requiring them together would conflict, so we duplicated the client adapters to be safe.
