{include file="admin/header.tpl"}

<div class="z-adminpageicon">{icon type="config" size="large"}</div>

<h2>{$templatetitle}</h2>


{form cssClass="z-form"}
{formvalidationsummary}


<fieldset>
    <legend>Elements</legend><br />


    <table class="z-admintable">
        {assign var='i' value=0}
        {foreach from=$elements item='element' key='key'}
        {if $i == 0}
        <tr class="{cycle values="z-odd,z-even"}">
        {/if}
        <td>{formcheckbox id="$key"}</td>
        <td>{img modname='E5' src=$element.icon' title=$element.title}</td>
        <td nowrap>{$element.title}</td>
        {assign var='i' value=$i+1}
        {if $i == 4}
        </tr>
        {assign var='i' value=0}
        {/if}
        {/foreach}

        {if $i == 0}
        <tr class="{cycle values="z-odd,z-even"}">
        {/if}       
        <td>{formcheckbox id='smilies'}</td>
        <td>{img modname='E5' src='smiley.png' __title='Smilies'}</td>
        <td>{gt text='Smilies'}</td
        </tr>


    </tr></table>

</fieldset>

<div class="z-formbuttons z-buttons">
    {formbutton class="z-bt-ok" commandName="save" __text="Save"}
    {formbutton class="z-bt-cancel" commandName="cancel" __text="Cancel"}
</div>

{/form}

{modgetinfo info=all}
<p class="z-center"><a href="http://code.zikula.org/E5/" title="{gt text="Visit the E5 project site"}">{$modinfo.displayname} {$modinfo.version}</a></p>
</div>