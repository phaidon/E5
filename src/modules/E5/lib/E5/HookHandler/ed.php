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

class E5_HookHandler_ed extends Zikula_Hook_AbstractHandler
{
    /**
     * Zikula_View instance
     *
     * @var Zikula_View
     */
    private $view;

    /**
     * Post constructor hook.
     *
     * @return void
     */
    public function setup()
    {
        $this->view = Zikula_View::getInstance("E5");
        $this->name = 'E5';
    }

    /**
     * Display hook for view.
     *
     * Subject is the object being viewed that we're attaching to.
     * args[id] is the id of the object.
     * args[caller] the module who notified of this event.
     *
     * @param Zikula_Hook $hook
     *
     * @return void
     */
    public function ui_view(Zikula_DisplayHook $hook)
    {
        $modname = $hook->getCaller();
        $textfieldname = $hook->getId();
        
        if(empty($textfieldname)) {
           $textfieldname = 'textfield';
        }
        
        $colors = ModUtil::apiFunc($this->name, 'user', 'colors');

        $elements = ModUtil::apiFunc($this->name, 'user', 'elements', $modname);

        if($elements['smilies']) {
            $smilies = ModUtil::apiFunc($this->name, 'smilies', 'smilies');
        } else {
            $smilies = null;
        }
        unset($elements['smilies']);
        
        $this->view->assign('textarea', $textfieldname)
                   ->assign('elements', $elements)
                   ->assign('smilies', $smilies)
                   ->assign('colors', $colors);
        
        $response = new Zikula_Response_DisplayHook('provider_area.ui.E5.ed', $this->view, 'editor.tpl');
        $hook->setResponse($response);
    }

    /**
     * Filter hook for view
     *
     * Subject is the object being viewed that we're attaching to.
     * args[id] is the id of the object.
     * args[caller] the module who notified of this event.
     *
     * @param Zikula_Hook $hook
     *
     * @return void
     */
    public static function filter(Zikula_FilterHook $hook)
    {
                
        $text = $hook->getData();
        $text = ModUtil::apiFunc('E5', 'transform', 'transform', array(
            'text'   => $text,
            'modname' => $hook->getCaller())
        );
        $hook->setData($text);
    }



}