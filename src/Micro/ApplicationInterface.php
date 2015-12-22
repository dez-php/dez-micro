<?php

    namespace Dez\Micro;

    use Dez\Auth\Auth;
    use Dez\Config\ConfigInterface;
    use Dez\Db\ConnectionInterface;
    use Dez\EventDispatcher\DispatcherInterface;
    use Dez\Http\Cookies;
    use Dez\Http\Request;
    use Dez\Http\Response;
    use Dez\Loader\Loader;
    use Dez\Router\Router;
    use Dez\Session\AdapterInterface;
    use Dez\View\View;


    /**
     * Interface ApplicationInterface
     * @package Dez\Micro
     * @property Loader loader
     * @property ConfigInterface config
     * @property DispatcherInterface eventDispatcher
     * @property DispatcherInterface event
     * @property Request request
     * @property Cookies cookies
     * @property Response response
     * @property AdapterInterface session
     * @property Router router
     * @property View view
     * @property ConnectionInterface db
     * @property Auth auth
     */
    interface ApplicationInterface extends \Countable, \ArrayAccess {



    }