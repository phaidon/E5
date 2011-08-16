{ajaxheader modname='E5' filename='smilies.js' ui=true}
{pageaddvar name="stylesheet" value="modules/E5/style/editor.css"}
{pageaddvar name="stylesheet" value="modules/E5/style/transform.css"}
{pageaddvar name="javascript" value="modules/E5/javascript/editor.js"}

<script type='text/javascript'>
    document.getElementById("description").style.display = 'none';
</script>

<div id="myeditor">

    <div id='buttons' class="z-clearfix e5_bar">
        {foreach from=$elements item="e" key="tag"}
        {if $e.type == 'html5'}
        {img modname='E5' src=$e.icon title=$e.title onclick="document.execCommand('$tag',false,null);"}
        {elseif $e.type == 'inserthtml'}
        {assign var='begin'   value=$e.begin}
        {assign var='inner'   value=$e.inner}
        {assign var='end'     value=$e.end}
        {img modname='E5' src=$e.icon title=$e.title onclick="insertAtCursor('$begin', '$inner', '$end');"}
        {elseif $e.type == 'html5selection'}
        <select id='{$tag}' style="height:22px;vertical-align:middle;margin-top:-15px" onchange="insertAtCursor2(this.id, this.value);this.selectedIndex=0;return false">
            {foreach from=$e.options item='option' key='key'}
            <option value="{$key}">{$option}</option>
            {/foreach}
        </select>
        {elseif $e.type == 'zikula.ui'}
        {include file="tags/$tag.tpl"}
        {elseif $e.type == 'bar'}
        {img modname='E5' src=$e.icon title=$e.title onclick="toggle_additional_bar(this.id) id=$tag}
        {/if}
        {/foreach}

        {if count($smilies) > 0}
        {img modname='E5' src='smiley.png' __title='Smiley' onclick="toggle_additional_bar(this.id)" id='smiley'}
        {/if}
    </div>

    {if count($smilies) > 0}
    <div id="smiley_bar" class="z-clearfix e5_bar2" style="display: none;">
        {foreach from=$smilies item="icon" key="tag"}
        {img modname='E5' src="smilies/$icon" title=$tag onclick="document.execCommand('inserthtml', false, '$tag');return false" class='smiley_class'}
        {/foreach}
    </div>
    {/if}

    {foreach from=$elements item="e" key="tag"}
    <div id="{$tag}_bar" class="z-clearfix e5_bar2" style="display:none;">
        {if $e.type == 'bar'}
        {include file="tags/$tag.tpl"}
        {/if}
    </div>
    {/foreach}

    <div id="meinDiv" contenteditable="true" class="e5_editarea" onblur="saveRange();"></div>

    <script type='text/javascript'>
        document.getElementById("meinDiv").innerHTML = document.getElementById("description").value;
    </script>

</div>