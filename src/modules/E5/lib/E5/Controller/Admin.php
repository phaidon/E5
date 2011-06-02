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

class E5_Controller_Admin extends Zikula_AbstractController
{
    /**
     * Post initialise.
     *
     * Run after construction.
     *
     * @return void
     */
    
    protected function postInitialize()
    {
        // Disable caching by default.
        $this->view->setCaching(Zikula_View::CACHE_DISABLED);
    }
    
    
    public function main()
    {
        return $this->modules();
    }
    
       
    
    public function modifyconfig()
    {
        $form = FormUtil::newForm($this->name, $this);
        return $form->execute('admin/modifyconfig.tpl', new E5_Handler_ModifyConfig());
    }
    
    
    
    /**
     * Edit E5 module settings.
     *
     * Parameters passed via GET:
     * --------------------------
     * id     string    modname
     *
     * Parameters passed via POST:
     * ---------------------------
     * None.
     *
     * @return string HTML string containing the rendered template.
     *
     * @throws Zikula_Exception_Forbidden Thrown if the current user does not have moderate access, or if the method of accessing this function is improper.
     */
    
    public function modify()
    {
        $form = FormUtil::newForm($this->name, $this);
        return $form->execute('admin/modify.tpl', new E5_Handler_Modify());
    }
    
    /**
     * Shows all modules, which are related to E5.
     *
     * Parameters passed via GET:
     * --------------------------
     * None
     *
     * Parameters passed via POST:
     * ---------------------------
     * None.
     *
     * @return string HTML string containing the rendered template.
     *
     * @throws Zikula_Exception_Forbidden Thrown if the current user does not have moderate access, or if the method of accessing this function is improper.
     */
    
     public function modules()
     {
        if (!SecurityUtil::checkPermission('E5::', '::', ACCESS_ADMIN)) {
            throw new Zikula_Exception_Forbidden();
        }
    
       $all_elements = ModUtil::apiFunc($this->name, 'user', 'elements');        
       $all_module_settings = Doctrine_Core::getTable('E5_Model_E5')->findAll();
       $all_module_settings = $all_module_settings->toArray();
        
        // add all elements data icon, title, ...
        foreach($all_module_settings as $key1 => $module_settings) {
            $elements = array();
            foreach( $module_settings['elements'] as $key2 => $active) {
                if($active) {
                    $elements[$key2] = $all_elements[$key2];
                }
            }
            $all_module_settings[$key1]['elements'] = $elements;
        }
        
       
        return $this->view->assign('mods', $all_module_settings)
                          ->fetch('admin/modules.tpl');
       
     }
     
}
