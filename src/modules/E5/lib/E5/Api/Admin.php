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

class E5_Api_Admin extends Zikula_AbstractApi
{

    /**
    *  get available admin panel links
    *
    * @return array array of admin links
    */
    public function getlinks($args)
    {
        $links = array();
        if( SecurityUtil::checkPermission('E5::', '::', ACCESS_ADMIN) ) {
            $links[] = array(
                'url'   => ModUtil::url($this->name, 'admin', 'modules'),
                'text'  => $this->__('Module preferences'),
                'class' => 'z-icon-es-view'
             );
            $links[] = array(
                'url'   => ModUtil::url($this->name, 'admin', 'modifyconfig'),
                'text'  => $this->__('Settings'),
                'class' => 'z-icon-es-config'
            );
        }
        return $links;
    }
}