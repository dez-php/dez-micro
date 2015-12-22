<?php

    namespace Dez\Micro;


    use Dez\DependencyInjection\Container;
    use Dez\DependencyInjection\ContainerInterface;
    use Dez\DependencyInjection\InjectableInterface;

    use Dez\Http\Response;
    use Dez\Router\Route;

    /**
     * Class Application
     * @package Dez\Micro
     */
    class Application implements InjectableInterface, ApplicationInterface {

        const HANDLER_NOT_FOUND = 'not_found';

        const HANDLER_ERROR     = 'error';

        /**
         * @var ContainerInterface
         */
        protected $dependencyInjection;

        /**
         * @var \Closure[]
         */
        protected $handlers     = [];

        /**
         * @var Route
         */
        protected $foundedRoute;

        /**
         * Constructor
         */
        public function __construct()
        {
            $this->setDi( FactoryContainer::instance() );
        }

        public function __get( $name )
        {
            return $this->getDi()->get( $name );
        }

        /**
         * @param $requestUri
         * @param \Closure $handler
         * @return Route
         */
        public function any($requestUri, \Closure $handler )
        {
            $route  = $this->router->add( $requestUri );
            $this->setHandler( $route->getRouteId(), $handler );
            return $route;
        }

        /**
         * @param $requestUri
         * @param \Closure $handler
         * @return Route
         */
        public function get($requestUri, \Closure $handler )
        {
            return $this->any( $requestUri, $handler )->via( [ 'get' ] );
        }

        /**
         * @param $requestUri
         * @param \Closure $handler
         * @return Route
         */
        public function post($requestUri, \Closure $handler )
        {
            return $this->any( $requestUri, $handler )->via( [ 'post' ] );
        }

        /**
         * @param $requestUri
         * @param \Closure $handler
         * @return Route
         */
        public function put($requestUri, \Closure $handler )
        {
            return $this->any( $requestUri, $handler )->via( [ 'put' ] );
        }

        /**
         * @param $requestUri
         * @param \Closure $handler
         * @return Route
         */
        public function delete($requestUri, \Closure $handler )
        {
            return $this->any( $requestUri, $handler )->via( [ 'delete' ] );
        }

        /**
         * @return bool
         */
        public function hasErrorHandler()
        {
            return $this->hasHandler( self::HANDLER_ERROR );
        }

        /**
         * @return bool
         */
        public function hasNotFoundHandler()
        {
            return $this->hasHandler( self::HANDLER_NOT_FOUND );
        }

        /**
         * @return \Closure
         */
        public function getErrorHandler()
        {
            return $this->handlers[ self::HANDLER_ERROR ];
        }

        /**
         * @return \Closure
         */
        public function getNotFoundHandler()
        {
            return $this->handlers[ self::HANDLER_NOT_FOUND ];
        }

        /**
         * @param callable $handler
         * @return $this
         */
        public function error(callable $handler )
        {
            $this->setHandler( self::HANDLER_ERROR, $handler );
            return $this;
        }

        /**
         * @param callable $handler
         * @return $this
         */
        public function notFound(callable $handler )
        {
            $this->setHandler( self::HANDLER_NOT_FOUND, $handler );
            return $this;
        }

        /**
         * @return $this
         */
        public function execute()
        {

            $response   = null;

            try {
                if( $this->router->handle()->isFounded() ) {
                    $route  = $this->router->getMatchedRoute();

                    if( $this->hasHandler( $route->getRouteId() ) ) {
                        $response   = call_user_func_array( $this->getHandler( $route->getRouteId() ), $route->getMatches() );
                    } else {
                        throw new ApplicationException( 'Route was founded but something wrong with it handler' );
                    }

                } else {
                    if( $this->hasNotFoundHandler() ) {
                        $handler    = $this->getNotFoundHandler();
                        $response   = call_user_func_array( $handler, [ $this ] );
                    }
                }
            } catch ( \Exception $e ) {
                if( $this->hasErrorHandler() ) {
                    $handler        = $this->getErrorHandler();
                    $response       = call_user_func_array( $handler, [ get_class( $e ) . ": {$e->getMessage()}" ] );
                }
            }

            if( ! ( $response instanceof Response ) ) {
                $this->response->setContent( $response );
            }

            $this->response->send();

            return $this;

        }

        /**
         * @param $uniqueId
         * @return bool
         */
        public function hasHandler($uniqueId )
        {
            return isset( $this->handlers[ $uniqueId ] );
        }

        /**
         * @param $uniqueId
         * @return bool|\Closure
         */
        public function getHandler($uniqueId )
        {
            return $this->hasHandler( $uniqueId ) ? $this->handlers[ $uniqueId ] : false;
        }

        /**
         * @param $uniqueId
         * @param \Closure $handler
         * @return $this
         */
        public function setHandler($uniqueId, \Closure $handler )
        {
            $this->handlers[$uniqueId] = \Closure::bind( $handler, $this );

            return $this;
        }

        /**
         * @param ContainerInterface $dependencyInjector
         * @return $this
         */
        public function setDi(ContainerInterface $dependencyInjector )
        {
            $this->dependencyInjection  = $dependencyInjector;

            return $this;
        }

        /**
         * @return ContainerInterface
         */
        public function getDi()
        {
            return $this->dependencyInjection;
        }

        /**
         * @param mixed $offset
         * @return bool
         */
        public function offsetExists($offset )
        {
            return $this->getDi()->has( $offset );
        }

        /**
         * @param mixed $offset
         * @return mixed|null
         */
        public function offsetGet($offset )
        {
            return $this->offsetExists( $offset ) ? $this->getDi()->get( $offset ) : null;
        }

        /**
         * @param mixed $offset
         * @param mixed $value
         * @return $this
         */
        public function offsetSet($offset, $value )
        {
            return $this->getDi()->set( $offset, $value );
        }

        /**
         * @param mixed $offset
         * @return bool
         */
        public function offsetUnset($offset )
        {
            return true;
        }

        /**
         * @return int
         */
        public function count()
        {
            return $this->getDi()->count();
        }


    }