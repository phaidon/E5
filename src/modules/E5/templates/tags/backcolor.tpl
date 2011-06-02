{foreach from=$colors item="name" key="hex"}
<div style="background-color:{$hex}" class="{$tag}_class e5_colors">
    {img modname='E5' src="spacer.png" title=$name width=13 height=13 
    onclick="document.execCommand('$tag', false, '$hex')"}
</div>
{/foreach}
<div style="clear:left;"></div> 
