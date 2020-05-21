<?php
    if (!defined('_PS_VERSION_')) {
        exit;
    }

    class MyModule extends Module
    {
        public function __construct()
        {
            $this->name = 'mymodule';
            $this->tab = 'front_office_features';
            $this->version = '0.0.1';
            $this->author = 'Your Name';
            $this->need_instance = 0;
            $this->ps_versions_compliancy = [
                'min' => '1.6',
                'max' => _PS_VERSION_
            ];
            $this->bootstrap = true;

            parent::__construct();

            $this->displayName = $this->l('My Module Name');
            $this->description = $this->l('My Module Description');

            $this->confirmUninstall = $this->l('Are you sure you want to uninstall?');

            $this->type_array = ['product', 'module'];
        }

        public function install()
        {
            if (Shop::isFeatureActive()) {
                Shop::setContext(Shop::CONTEXT_ALL);
            }

            if (!parent::install() || !$this->registerHook('header')) {
                return false;
            }

            return true;
        }

        public function uninstall()
        {
            if (!parent::uninstall()) {
                return false;
            }

            return true;
        }

        public function hookDisplayHeader($params)
        {
            $this->context->controller->registerStylesheet(
                'mymodule-style',
                $this->_path.'views/css/mymodule.css',
                [
                    'media' => 'all',
                    'priority' => 1000,
                ]
            );

            $this->context->controller->registerJavascript(
                'mymodule-javascript',
                $this->_path.'views/js/mymodule.js',
                [
                    'position' => 'bottom',
                    'priority' => 1000,
                ]
            );

//            return $this->display(__FILE__, 'mymodule.tpl');
        }

    }
