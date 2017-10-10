# api_client
Simple PHP API Client using GuzzleHttp 6

### Overview
A RESTful API in PHP 7 and the new GuzzleHttp 6.
This is a conversion of an old project from version 4 of guzzle
to the latest version 6 [guzzlehttp/guzzle](https://github.com/guzzle/guzzle/)

Returns an API object of Guzzle. Create a class that understands the API commands for the given API server. Then use this API object to execute get, post, and etc.

### Installation
Require it in your project
```bash
php composer.phar require arikin/api_client
```

### Usage

Require the class and initialize it with the API server's base URL and the credentials.
```php
use Arikin\ApiClient;

$api = new ApiClient(array(
    'url' => 'http://api.server.net',
    'user' => 'api_username',
    'pass' => 'secret_password'
 ));

$user_list = $api->get('/user/list');

```



