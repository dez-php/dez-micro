<?php

    namespace Dez\Micro;

    use Dez\DependencyInjection\Container;
    use Dez\DependencyInjection\ContainerInterface;
    use Dez\DependencyInjection\InjectableInterface;

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


    }