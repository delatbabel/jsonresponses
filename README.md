# jsonresponses
Common JSON responses for an API built with Laravel 5.1. 

## Preface

Many APIs have generic response formats for returning a success/fail response, a
response code, a message, and some data.  There are a few packages out there including
Syndra (Mario Basic), which do similar things but I gone back to this, which was my
original implementation as a trait, because it does all of what I what I need to do.

This provides generic JSON responses for when a resource is created, updated, destroyed,
indexed, etc, as well as a generic error format.
 
## Features

This trait does the following:

* It returns generic *(predefined)* JSON responses for common API actions like creating,
  updating, destroying, indexing and showing a resource.
* It can be easily extended and modified
* It can be used anywhere in your application *(controllers, routes etc...)*

## Installation

```
composer require delatbabel/jsonresponses
```

In your class do this:

```php
use Delatbabel\JsonResponses\JsonResponses;

class MyController
{
    use JsonResponses;
    // ...
}
```

## Examples

### Success Response With Data

```php
return $this->respondSuccess('OK', ['time' => gmtime()]);
```

### Failure Response

```php
return $this->respondInternalError();
```

### Failure Response With Message and Data

```php
return $this->respondNotAcceptable(
    'Mugwumps are not found in swamps',
    ['location' => 'desert']);
```

## Choosing a Status Code

See https://httpstatuses.com/ and http://racksburg.com/choosing-an-http-status-code/

