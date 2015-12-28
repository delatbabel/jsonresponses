# jsonresponses
Common JSON responses for an API built with Laravel 5.1. 

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

# Architecture

## Rationale

Many APIs have generic response formats for returning a success/fail response, a
response code, a message, and some data.  There are a few packages out there including
Syndra (Mario Basic), which do similar things but I gone back to this, which was my
original implementation as a trait, because it does all of what I what I need to do.

This provides generic JSON responses for when a resource is created, updated, destroyed,
indexed, etc, as well as a generic error format.

## To Trait Or Not To Trait?

Many developers have derided the use of PHP 5.4+ traits on the basis that they are
really just methods to hide simple cut/paste code.  Certainly they have their disadvantages,
not the least of which is difficulty in providing stand-alone tests for them.

In this case I decided to implement this as a trait anyway, because I wanted all of
my API controllers to return an identical response format, and this was a simple way
of doing it.

A lot of software designers have suggested that traits should not provide data, only
methods, which makes them look more exactly like Ruby's "mixins".  However PHP does
provide limited capability for traits to hold data and so I have implemented a simple
protected variable to store the response code between calls.

## Response Format

The response format emitted by this trait will look like this (in JSON):

response: {
    success: true,      // true or false
    message: message,   // arbitrary message goes here
    response_code: code // response code goes here
},
data: { ...
}                       // arbitrary data structure goes here

The HTTP response code is repeated inside the response hash for easy access.
