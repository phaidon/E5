<?php

/**
 * Copyright E5 Team 2011
 *
 * @license GNU/LGPLv3 (or at your option, any later version).
 * @package E5
 * @link http://code.zikula.org/E5
 *
 * Please see the NOTICE file distributed with this source code for further
 * information regarding copyright and licensing.
 */


class E5_Version extends Zikula_AbstractVersion
{
    public function getMetaData()
    {
        $meta = array();
        $meta['description']    = __('A HTML5 WYSIWYG editor');
        $meta['displayname']    = __('E5');
        //!url must be different to displayname
        $meta['url']            = __('e5');
        $meta['version']        = '5.0.1';
        $meta['author']         = 'Fabian Wuertz';
        $meta['contact']        = 'fabian.wuertz.org';
        // recommended and required modules
        $meta['core_min'] = '1.3.0'; // requires minimum 1.3.0 or later
        $meta['dependencies'] = array();
        $meta['capabilities'] = array(HookUtil::PROVIDER_CAPABLE => array('enabled' => true));

        return $meta;
    }
    
    protected function setupHookBundles()
    {
        $bundle = new Zikula_HookManager_ProviderBundle($this->name, 'provider.E5.ui_hooks.ed', 'ui_hooks', __('E5 editor'));
        $bundle->addServiceHandler('display_view', 'E5_HookHandler_ed', 'ui_view', 'E5.ed');
        $this->registerHookProviderBundle($bundle);    

        
        $bundle = new Zikula_HookManager_ProviderBundle($this->name, 'provider.E5.filter_hooks.ed', 'filter_hooks', __('E5 transform'));
        $bundle->addStaticHandler('filter', 'E5_HookHandler_ed', 'filter', 'E5.ed');
        $this->registerHookProviderBundle($bundle);    
    }
}