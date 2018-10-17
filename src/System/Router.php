<?php

namespace Phpbook\System;

use Exception;

class Router
{
    private $addresses = [
        '/'      => 'MainController@index',
        '/chap1' => 'BookController@chap1',
        '/chap2' => 'BookController@chap2',
    ];
    private $baseURI = 'phpbook/exec.php/';

    public function __construct()
    {
        $this->route();
    }

    /**
     * Redirects to controller, basing on the URI
     * @throws \Exception
     */
    private function route()
    {
        $URI = $this->formatURI();
        foreach ($this->addresses as $key => $value) {
            if ($this->matchUri($URI, $key)) {

                $atPosition     = $this->defineAtPosition($value);
                $controllerName = $this->decodeControllerName($value);
                $method         = $this->decodeControllerMethod($value);

                $controllerPath = "Phpbook\Controllers\\".$controllerName;

                $controller = new $controllerPath;
                $controller->{$method}();
                return true;
            }
        }
        throw new Exception('Nie znaleziono podanego adresu', 404);
    }

    /**
     * Formats URI so that the router can operate on it
     * @return bool|string
     */
    private function formatURI()
    {
        $URI            = $_SERVER['REQUEST_URI'];
        $baseLength     = strlen($this->baseURI);
        $basePosition   = strpos($URI, $this->baseURI);
        return substr($URI, $basePosition + $baseLength);
    }

    /**
     * Checks if given string is equal to URI
     * @param string $URI
     * @param string $matching
     * @return bool
     */
    private function matchUri(string $URI, string $matching)
    {
        var_dump($URI[0]);
        die();
        if($URI[0] == '/')
            $URI = substr($URI, 1);
        if($matching[0] == '/')
            $matching = substr($matching, 1);

        return $URI == $matching;
    }

    /**
     * Define position of a sign "@"
     * @param string $value
     * @return bool|int
     */
    private function defineAtPosition(string $value)
    {
        return  strpos($value, '@');
    }

    /**
     * Get controller name from given value
     * @param string $value
     * @return bool|string
     */
    private function decodeControllerName(string $value)
    {
        $atPosition = $this->defineAtPosition($value);
        return substr($value, 0, $atPosition);
    }

    /**
     * Get Controller's method name from a given value
     * @param string $value
     * @return bool|string
     */
    private function decodeControllerMethod(string $value)
    {
        $atPosition = $this->defineAtPosition($value);
        return substr($value, $atPosition + 1);
    }
}