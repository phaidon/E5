<div id="formdialog-link_content" style="display: none;">
    <form enctype="application/x-www-form-urlencoded" method="post" class="z-form">
        <div>
            <fieldset>
                <div class="z-formrow">
                    <label for="src">{gt text="Hyperlink"}</label>
                    <input type="text" value="http://" size="50" name="href" id="link_href">
                </div>
                <div class="z-formrow">
                    <label for="src">{gt text="Title"}</label>
                    <input type="text" value="" size="50" name="title" id="link_title">
                </div>
            </fieldset>
        </div>
    </form>
</div>

<a id="formdialog-link" title="{$e.title}" href="#formdialog-link_content">
    {img modname='E5' src=$e.icon title=$e.title}
</a>

<script type="text/javascript">
    Event.observe('formdialog-link', 'click', function(event) {
        var selection = getSel();
        var node =  selection.anchorNode;
        if (node) {
            node = (node.nodeName == "#text" ? node.parentNode : node);
            if( node != '[object HTMLElement]' ) {
                $('link_href').value = node;
            }
            
        }
        $('link_title').value = getSelRange();

        
          
          


    }); 


    link = function(data) {
        if(data != false) {
            data = Object.toJSON(data);
            data = data.evalJSON(true);
            title = data.title;
            if(title == '') {
                title = data.href;
            }
            $('meinDiv').focus();

            restoreRange();

            $('link_href').value  = 'http://';
            $('link_title').value = '';

            document.execCommand(
                'inserthtml',
                false,
                '<a href='+data.href+'>'+title+'</a>'
            );
        }
    }

    var formdialog = new Zikula.UI.FormDialog($('formdialog-link'), link);
</script>
