<?php
namespace Feedtailor\Mocking;

class MethodInvoker
{
    protected $obj;

    /**
     * @param $obj
     * @return MethodInvoker
     */
    static public function create($obj)
    {
        return new MethodInvoker($obj);
    }

    /**
     * @param $obj
     */
    public function __construct($obj)
    {
        $this->obj = $obj;
    }

    /**
     * @param $methodName
     * @param array $args
     * @return mixed
     */
    public function invoke($methodName, array $args = array())
    {
        $refClass = new \ReflectionClass(get_class($this->obj));

        if (!$refClass->hasMethod($methodName)) {
            throw new \InvalidArgumentException("unknown method {$methodName}.");
        }

        $refMethod = $refClass->getMethod($methodName);

        if ($refMethod->isStatic()) {
            throw new \InvalidArgumentException("cannot invoke static method {$methodName}.");
        }

        if ($refMethod->isPublic()) {
            $results = $refMethod->invokeArgs($this->obj, $args);
        } else {
            $refMethod->setAccessible(true);
            $results = $refMethod->invokeArgs($this->obj, $args);
            $refMethod->setAccessible(false);
        }

        return $results;
    }
}
