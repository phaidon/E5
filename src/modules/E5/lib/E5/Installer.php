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

class E5_Installer extends Zikula_AbstractInstaller
{
    /**
    * initialise the template module
    * This function is only ever called once during the lifetime of a particular
    * module instance
    */
    public function install()
    {
        try {
            DoctrineUtil::createTablesFromModels('E5');
        } catch (Exception $e) {
            LogUtil::registerError($e->__toString());
            return false;
        }

        $this->defaultdata();
        
        // create hook
        HookUtil::registerProviderBundles($this->version->getHookProviderBundles());

        // Initialisation successful
        return true;
    }
    
    
    /**
     * Provide default data.
     *
     * @return void
     */
    protected function defaultdata()
    {
        $d = new E5_Model_E5();
        $d->modname = 'Tasks';
        $d->elements = array('bold' => true);
        $d->save();

        $this->setVar('imageViewer', true);
        
    }

    /**
    * Upgrade the errors module from an old version
    *
    * This function must consider all the released versions of the module!
    * If the upgrade fails at some point, it returns the last upgraded version.
    *
    * @param        string   $oldVersion   version number string to upgrade from
    * @return       mixed    true on success, last valid version string or false if fails
    */
    public function upgrade($oldversion)
    {
        // Update successful
        return true;
    }

    /**
    * delete the errors module
    * This function is only ever called once during the lifetime of a particular
    * module instance
    */
    public function uninstall()
    {
        DoctrineUtil::dropTable('E5');
        // Delete any module variables
        $this->delVars();
        HookUtil::unregisterProviderBundles($this->version->getHookProviderBundles());

        // Deletion successful
        return true;

    }
}

