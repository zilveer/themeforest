<?php
if (!class_exists('ctTypeBase')) {


    /**
     * Base for all custom types
     */
    abstract class ctTypeBase
    {

        /**
         * Creates hook
         * @param $name
         * @param string $params
         */
        protected function callHook($name, $params = '')
        {
            do_action($this->getHookBaseName() . '.' . $name, $params);
        }

        /**
         * Creates filter
         * @param string $name
         * @param array $params
         * @return mixed|void
         */
        protected function callFilter($name, $params)
        {
            return apply_filters($this->getHookBaseName() . '.filter.' . $name, $params);
        }

        protected abstract function getHookBaseName();

        /**
         * Registers items
         * @return mixed
         */

        public abstract function init();

        /**
         * Inits
         */
        public function __construct()
        {
            add_action('init', array($this, 'init'), 10);
        }

    }
}