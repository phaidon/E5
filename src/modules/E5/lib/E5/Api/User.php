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

class E5_Api_User extends Zikula_AbstractApi 
{
    
    /*

 $elements = array(
            'page'          => array(
                'icon'         => 'page.png',
                'title'        => $this->__('Page link'),
            ),
            'youtube'       => array(
                'icon'         => 'youtube.png',
                'title'        => $this->__('YouTube video'),
                'inner'        => 'ID',
                'preview'      => false,
            ),
            'box'            => array(
                'icon'         => 'box.png',
                'title'        => $this->__('box'),
                'inner'        => $this->__('boxed text'),
            ),
           
        );

*/
    
    public function elements($modname = null)
    {

        $elements =  array(
            'link'          => array(
                'icon'          => 'link.png',
                'title'         => $this->__('Web link'),
                'type'          => 'zikula.ui',
            ),
            'bold'          => array(
                'icon'          => 'bold.png',
                'title'         => $this->__('bolded text'),
                'type'          => 'html5'
            ),
            'italic'        => array(
                'icon'          => 'italic.png',
                'title'         => $this->__('italicized text'),
                'type'          => 'html5'
            ),
            'underline'     => array(
                'icon'          => 'underline.png',
                'title'         => $this->__('underlined text'),
                'inner'         => $this->__('underlined text'),
                'type'          => 'html5'
            ),
            'strikethrough' => array(
                'icon'          => 'strikethrough.png',
                'title'         => $this->__('strikethrough text'),
                'type'          => 'html5'
            ),
           'subscript'   => array(
                'icon'          => 'subscript.png',
                'title'         => $this->__('subscripted text'),
                'type'          => 'html5'
            ),
            'superscript'   => array(
                'icon'          => 'superscript.png',
                'title'         => $this->__('superscripted text'),
                'type'          => 'html5'
            ),
            'inserthorizontalrule' => array(
                'icon'          => 'hr.png',
                'title'         => $this->__('Horrizontal line'),
                'type'          => 'html5'
            ),
            'justifycenter' => array(
                'icon'          => 'center.png',
                'title'         => $this->__('centered text'),
                'type'          => 'html5'
            ),
            'justifyleft'    => array(
                'icon'          => 'left.png',
                'title'         => $this->__('centered text'),
                'type'          => 'html5'
            ),
            'justifyright'  => array(
                'icon'          => 'right.png',
                'title'         => $this->__('centered text'),
                'type'          => 'html5'
            ),
            'justifyfull' => array(
                'icon'          => 'justify.png',
                'title'         => $this->__('centered text'),
                'type'          => 'html5'
            ),
            'mark'          => array(
                'icon'          => 'mark.png',
                'title'         => $this->__('marked text'),
                'type'          => 'inserthtml',
                'begin'         => '<strong class=mark>',
                'inner'         => $this->__('marked text'),
                'end'           => '</strong> ',
            ),
            'table'           => array(
                'icon'          => 'table.png',
                'title'         => $this->__('Table'),
                'type'          => 'zikula.ui',
            ),
            'image'            => array(
                'icon'          => 'img.png',
                'title'         => $this->__('Image'),
                'type'          => 'zikula.ui',
            ),
            'indent'         => array(
                'icon'         => 'indent.png',
                'title'        => $this->__('indent'),
                'type'          => 'html5'
            ),
           'outdent'         => array(
                'icon'         => 'outdent.png',
                'title'        => $this->__('indent'),
                'type'          => 'html5'
            ),
            'monospace'     => array(
                'icon'          => 'monospace.png',
                'title'         => $this->__('Monospace'),
                'type'          => 'inserthtml',
                'begin'         => '<tt>',
                'inner'         => $this->__('Monospace'),
                'end'           => '</tt> ',
            ),
            'insertorderedlist'            => array(
                'icon'         => 'list-ordered.png',
                'title'        => $this->__('Ordered list'),
                'type'          => 'html5'
            ),
            'insertunorderedlist'            => array(
                'icon'         => 'list-unordered.png',
                'title'        => $this->__('Unordered list'),
                'type'          => 'html5'
            ),
            'keyboard-key'     => array(
                'icon'          => 'key.png',
                'title'         => $this->__('Key'),
                'type'          => 'inserthtml',
                'begin'         => '<kbd class=keys>',
                'inner'         => $this->__('ctr-c'),
                'end'           => '</kbd> ',
            ),
            'code'          => array(
                'icon'          => 'code.png',
                'title'         => $this->__('Code'),
                'type'          => 'inserthtml',
                'begin'         => '[code=php]',
                'inner'         => 'echo $test;',
                'end'           => '[/code]' 
            ),
            'undo'          => array(
                'icon'          => 'undo.png',
                'title'         => $this->__('Undo'),
                'type'          => 'html5',
            ),
            'redo'          => array(
                'icon'          => 'redo.png',
                'title'         => $this->__('Redo'),
                'type'          => 'html5',
            ),
            'formatblock'   => array(
                'icon'          => 'justify.png',
                'title'         => $this->__('Text format'),
                'type'          => 'html5selection',
                'options'       => array(
                    ''              => $this->__('Normal'),
                    '<p>'           => $this->__('Paragraph'),
                    '<h1>'          => $this->__('Heading 1'),
                    '<h2>'          => $this->__('Heading 2'),
                    '<h3>'          => $this->__('Heading 3'),
                    '<h4>'          => $this->__('Heading 4'),
                    '<h5>'          => $this->__('Heading 5'),
                    '<h6>'          => $this->__('Heading 6'),
                    '<address>'     => $this->__('Address'),
                    '<pre>'         => $this->__('Formatted'),
                ),
            ),
            'fontname'   => array(
                'icon'          => 'font.png',
                'title'         => $this->__('Font'),
                'type'          => 'html5selection',
                'options'       => array(
                    ''                => $this->__('Font'),
                    'Arial'           => $this->__('Arial'),
                    'Courier'         => $this->__('Courier'),
                    'Times New Roman' => $this->__('Times New Roman'),
                ),
            ),
            'fontsize'   => array(
                'icon'          => 'size.png',
                'title'         => $this->__('Font size'),
                'type'          => 'html5selection',
                'options'       => array(
                    ''              => $this->__('Size'),
                    '1'             => 1,
                    '2'             => 2,
                    '3'             => 3,
                    '4'             => 4,
                    '5'             => 5,
                    '6'             => 6,
                    '7'             => 7,
                ),
            ),
            'forecolor'   => array(
                'icon'          => 'forecolor.png',
                'title'         => $this->__('Text color'),
                'type'          => 'bar',
            ),
            'backcolor'   => array(
                'icon'          => 'backcolor.png',
                'title'         => $this->__('Background color'),
                'type'          => 'bar',
            ),
        );
        
        if(count($modname) == 0) {
            return $elements;
        }
       
        $module_settings  = Doctrine_Core::getTable('E5_Model_E5')
                           ->findOneBy('modname', $modname);
        $module_settings  = $module_settings->toArray();
        $enabled_elements = $module_settings['elements'];
        foreach ($enabled_elements as $tag => $enabled) {
            if($enabled and array_key_exists($tag, $elements)) {
                $enabled_elements[$tag] = $elements[$tag];
            } else {
                unset($enabled_elements[$tag]);
            }
        }
        $enabled_elements['smilies'] = $module_settings['smilies'];
        return $enabled_elements;
    }
 
    
    function colors() {
        return array(
            
            '#FFFFFF' => 'White',
            '#C0C0C0' => 'Silver',
            '#808080' => 'Gray',
            '#000000' => 'Black',
            '#FF0000' => 'Red',
            '#800000' => 'Maroon',
            '#FFFF00' => 'Yellow',
            '#808000' => 'Olive',
            '#00FF00' => 'Lime',
            '#008000' => 'Green',
            '#00FFFF' => 'Aqua',
            '#008080' => 'Teal',
            '#0000FF' => 'Blue',
            '#000080' => 'Navy',
            '#FF00FF' => 'Fuchsia',
            '#800080' => 'Purple',
        );

    }
}