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


class E5_Model_E5 extends Doctrine_Record
{
    /**
     * Set table definition.
     *
     * @return void
     */
    public function setTableDefinition()
    {
        $this->setTableName('e5');
        $this->hasColumn('modname', 'string', 64, array(
            'unique'  => true,
            'primary' => true,
            'notnull' => true,
        ));
        $this->hasColumn('elements', 'array', array(
            'default' => null
        ));
        $this->hasColumn('smilies', 'bool');

    }

}