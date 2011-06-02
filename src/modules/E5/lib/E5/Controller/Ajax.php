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


class E5_Controller_Ajax extends Zikula_AbstractController
{

    public function remove()
    {
        if(!SecurityUtil::checkPermission('E5::', '::', ACCESS_DELETE) ){
            return;
        }
        $modname = FormUtil::getPassedValue('id', -1, 'GET');
        $d = Doctrine_Core::getTable('E5_Model_E5')->find($modname);
        $d->delete();
    }
   
}
