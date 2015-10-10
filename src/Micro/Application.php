<?php

    namespace Dez\Micro;

    use Dez\DependencyInjection\Container;
    use Dez\DependencyInjection\ContainerInterface;
    use Dez\DependencyInjection\InjectableInterface;
    use Traversable;

    /**
     * Class Application
     * @package Dez\Micro
     */
    class Application implements InjectableInterface, ApplicationInterface {

        /**
         * @var ContainerInterface
         */
        protected $dependencyInjection;

        /**
         * Constructor
         */
        public function __construct() {
            $this->setDi( Container::instance() );
        }

        public function __get( $name ) {
            return $this->getDi()->get( $name );
        }

        /**
         * @param ContainerInterface $dependencyInjector
         * @return $this
         */
        public function setDi( ContainerInterface $dependencyInjector ) {
            $this->dependencyInjection  = $dependencyInjector;
            return $this;
        }

        /**
         * @return ContainerInterface
         */
        public function getDi() {
            return $this->dependencyInjection;
        }

        /**
         * @param mixed $offset
         * @return bool
         */
        public function offsetExists( $offset ) {
            return $this->getDi()->has( $offset );
        }

        /**
         * @param mixed $offset
         * @return mixed
         */
        public function offsetGet( $offset ) {
            return $this->offsetExists( $offset ) ? $this->getDi()->get( $offset ) : null;
        }

        /**
         * @param mixed $offset
         * @param mixed $value
         * @return $this
         */
        public function offsetSet( $offset, $value ) {
            return $this->getDi()->set( $offset, $value );
        }

        /**
         * @param mixed $offset
         * @return bool
         */
        public function offsetUnset( $offset ) {
            return true;
        }

        /**
         * @return int
         */
        public function count() {
            return $this->getDi()->count();
        }


    }