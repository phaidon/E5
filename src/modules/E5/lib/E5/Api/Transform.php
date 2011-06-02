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

class E5_Api_Transform extends Zikula_AbstractApi 
{

    public function replaces()
    {
        return array(
            'code' => array(
                'begin'     => '<code>',
                'end'       => '</code>',
            ),
            'nomarkup' => array(
                'begin'     => '<tt>',
                'end'       => '</tt>',
            ),
            'list' => array(
                'begin'     => '<li>',
                'end'       => '</li>',
            ),
            'link' => array(
                'begin'     => '<a>',
                'end'       => '</a>',
            ),
            'hr' => array(
                'begin'     => '<hr>',
                'end'       => '',
            ),
            'img' => array(
                'begin'     => '<img src="..." title="..." alt="...">',
                'end'       => '',
            ),
            'bold' => array(
                'begin' => '<strong>',
                'end'   => '</strong>',
            ),
            'italic' => array(
                'begin' => '<em>',
                'end'   => '</em>',
            ),
            'underline' => array(
                'begin' => '<u>',
                'end'   => '</u>',
            ),
            'strikethrough' => array(
                'begin' => '<del>',
                'end'   => '</del>',
            ),
            'mark' => array(
                'begin' => '<strong style="background-color:#ffee33;">',
                'end'   => '</strong>',
            ),
            'table' => array(
                'begin' => '<table><tr><td>',
                'end'   => '</td></tr></table>',
            ),
            'monospace' => array(
                'begin' => '<tt>',
                'end'   => '</tt>',
            ),
           'center' => array(
                'begin' => '<center>',
                'end'   => '</center>',
            ),
            'size'  => array(
                'begin' => '<span style="font-size:VALUE">',
                'end'   => '</span>',
             ),
            'color'  => array(
                'begin' => '<span style="color:VALUE">',
                'end'   => '</span>',
             ),            
            'key' => array(
                'begin' => '<kbd class="keys">',
                'end'   => '</kbd>',
            ),
            'box' => array(
                'begin' => '<div class="floatl">',
                'end'   => '</div>',
            ),
            'clear' => array(
                'begin' => '<div class="clear">&nbsp;</div>',
                'end'   => '',
            ),
            'indent' => array(
                'begin' => '<div class="indent">',
                'end'   => '</div>',
            ),
           'subscript'   => array(
                'begin'      => '<sub>',
                'end'        =>  '</sub>',
            ),
            'superscript'=> array(
                'begin'      => '<sup>',
                'end'        =>  '</sup>',
            ),
            'headings' => array(
                'h5' => array(
                    'begin' => '<h6>',
                    'end'   => '</h6>',
                ),
                'h4' => array(
                    'begin' => '<h5>',
                    'end'   => '</h5>',
                ),
                'h3' => array(
                    'begin' => '<h4>',
                    'end'   => '</h4>',
                ),
                'h2' => array(
                    'begin' => '<h3>',
                    'end'   => '</h3>',
                ),
                'h1' => array(
                    'begin' => '<h2>',
                    'end'   => '</h2>',
                ),
             ),
            'youtube' => array(
                'begin' => '<iframe class="youtube-player" type="text/html" width="640" height="385" src="http://www.youtube.com/embed/',
                'end'   => '" frameborder="0">'
            )
        );
    }
    
    
    
   /**
    * Wiki formater wrapper
    *
    * @param string $args['text'] text to wiki-format
    * @return wiki-formatted text
    */

    private $_lml;
    private $_codeblocks;
    private $_nomarkups;


    
    public function transform($args)
    { 
        extract($args);
        if(empty($modname) or empty($text)) {
            return $text;
        }
        PageUtil::addVar('stylesheet', "modules/E5/style/transform.css"); 
        
        $text = $this->imageViewer($text);

        
        $text = $this->transform_smilies($text);       

   
        $text = str_replace('<meta http-equiv="content-type" content="text/html; charset=utf-8">', '', $text);
        
        $text = preg_replace_callback(
            $expression =  "#\[code(.*?)\[\/code\]#si",
            array($this, 'code_callback'),
            $text
        );
        
        return $text;
        
    }
    
    
    protected function code_callback($matches)
    {
        
        $code = $matches[1];
        

        
        $code = str_replace('</div><div>',   "\n", $code);
        $code = str_replace('<div>',  '', $code);
        $code = str_replace('</div>', '', $code);
        $code = str_replace('<br>',   "\n", $code);
        
        $language = '';
        if($code[0] == '=') {
            $code = explode(']', $code);
            $language = substr($code[0],1);
            unset($code[0]);
            $code = implode(']', $code);

        } else {
            $code = substr($code, 1);
        }
              
        if($code[0] == "\n") {
            $code = substr($code, 1);
        }
        if($code[strlen($code)-1] == "\n") {
            $code = substr($code, 0, -1);
        }
       
        
        $args = array(
            'text'     => $code,
            'language' => $language
        );
        $code = $this->highlight($args);
                
        return $code;
    } 
    
    protected function transform_smilies($message)
    {   
        $alternative_smilies = ModUtil::apiFunc($this->name, 'Smilies', 'alternative_smilies');
        foreach($alternative_smilies as $tag1 => $tag2) {
            $message = str_replace($tag1, $tag2, $message);
        }
        $smilies = ModUtil::apiFunc($this->name, 'Smilies', 'smilies');
        foreach($smilies as $tag => $icon) {
            $message = str_replace($tag, '<img src="modules/E5/images/smilies/'.$icon.'" title="'.$tag.'" alt="'.$tag.'">', $message);
        }
        return $message;
    }
    
    
     public function highlight($args)
    {
        extract($args);
        if(empty($language)) {
            $language = 'php';
        }
        if(empty($text)) {
            return '';
        }
        $highlighter = $this->getVar('syntaxHighlighter');
           
        switch ($highlighter) {
            case 'geshi':
                include_once('modules/E5/lib/vendor/geshi/geshi.php');                        
                $geshi = new GeSHi($text, $language);
                $geshi->enable_line_numbers(GESHI_FANCY_LINE_NUMBERS);
                $geshi->set_header_type(GESHI_HEADER_PRE);
                $text = $geshi->parse_code(); 
                break;
            case 'prettify':
                $path = 'modules/E5/lib/vendor/prettify/';
                PageUtil::addVar('javascript', $path.'prettify.js');
                PageUtil::addVar('stylesheet', $path.'prettify.css');
                PageUtil::addVar('header', '<script type="text/javascript">Event.observe(window, \'load\', prettyPrint);</script>');
                $text = str_replace("\n", '<br />', $text);
                $text = '<code class="prettyprint linenums:1">'.$text.'</code>';
                break;
            case 'syntaxhighlighter':
                $path = 'modules/E5/lib/vendor/syntaxhighlighter/';
                PageUtil::addVar('javascript', $path.'scripts/shCore.js');
                PageUtil::addVar('javascript', $path.'scripts/shBrushJScript.js');
                PageUtil::addVar('stylesheet', $path.'styles/shCoreDefault.css');
                PageUtil::addVar('header', '<script type="text/javascript">SyntaxHighlighter.all()</script>');                
                $text = '<pre class="brush: js;">'.$text.'</pre>';
                break;
        }
        
        return $text;
    } 


    public function imageViewer($text) {
        if( $this->getVar('imageViewer') ) {
            PageUtil::addVar('javascript', "javascript/ajax/prototype.js");
            PageUtil::addVar('javascript', "javascript/helpers/Zikula.ImageViewer.js");
            $footer = '<script type="text/javascript">'.
                      'Zikula.ImageViewer.setup({'. 
                      '     caption: true,'.
                      '     modal: true,'.
                      '     langLabels: {'.
                      "         close: 'Close this box',". 
                      '     }'. 
                      '});'.
                      '</script>';
            PageUtil::addVar('footer', $footer);
            $text = preg_replace(
                    "/<img src=\"(.*?)\"(.*?)>/si",
                    "<a rel=\"imageviewer\" href=\"\\1\"><img width=\"250\" src=\"\\1\" \\2></a>",
                    $text
                );
            
            
            
            /*$text = str_replace(
                    '<img src=', 
                    '<a href="'.$src.'" rel="imageviewer"><img rel="imageviewer" width="250" src=', $text);*/
        }
        return $text;
    }
    
    
}  