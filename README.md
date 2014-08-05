mocking-method-invoker
=======================

Any methods invoker for Mock object.

[![Build Status](https://travis-ci.org/feedtailor/mocking-method-invoker.png?branch=master)](https://travis-ci.org/feedtailor/mocking-method-invoker)


Install
-----

Add `feedtailor/mocking-method-invoker` as a dependency in your project's composer.json file.

```json
{
  "require": {
    "feedtailor/mocking-method-invoker": "dev-master"
  }
}
```


Example
--------

```php
use Feedtailor\Mocking\MethodInvoker;

class ExampleClass
{
    protected function add($a, $b)
    {
        return $a + $b;
    }
}

$obj = new ExampleClass();

$result = MethodInvoker::create($obj)->invoke("getFoo", array(40, 2)) // got 42.
```



Methods
--------

### $invoker = new MethodInvoker($obj);

### $invoker = MethodInvoker::create($obj);

Create a new MethodInvoker instance.


### $invoker->invoke($name, $args);

invoke the `$name` method with `$args` array arguments.



License
--------

Licensed under the MIT License.
