<div id="formdialog-image_content" style="display: none;">
    <form enctype="application/x-www-form-urlencoded" method="post" class="z-form">
        <div>
            <fieldset>
                <div class="z-formrow">
                    <label for="e5_image_src">{gt text="Source"}</label>
                    <input type="text" value="" size="50" name="src" id="e5_image_src" />
                </div>
                <div class="z-formrow">
                    <label for="e5_image_title">{gt text="Title"}</label>
                    <input type="text" value="" size="50" name="title" id="e5_image_title" />
                </div>
            </fieldset>
        </div>
    </form>
</div>

<a id="formdialog-image" title="{$e.title}" href="#formdialog-image_content">
    {img modname='E5' src=$e.icon title=$e.title}
</a>

<script type="text/javascript">
    image = function(data) {
        if(data != false) {
            data = Object.toJSON(data);
            data = data.evalJSON(true);

            $('meinDiv').focus();

            restoreRange();
            document.execCommand(
            'inserthtml',
            false,
            '<img src='+data.src+' title='+data.title+' alt='+data.title+'>'
            );
        }
    }
    var formdialog = new Zikula.UI.FormDialog($('formdialog-image'), image);
</script>
