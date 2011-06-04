{include file="admin/header.tpl"}
<div class="z-adminpageicon">{icon type="config" size="large"}</div>
<h2>{$templatetitle}</h2>

{form cssClass="z-form"}
{formvalidationsummary}

<fieldset>
    <legend>{gt text='Module'}</legend>
    <div class="z-formrow">
        <label>{gt text='Module name'}</label>
        <span class="z-bold">{$modname}</span>
    </div>
</fieldset>

<fieldset>
    <legend>{gt text='Elements'}</legend>

    <table class="z-admintable">
        {assign var='i' value=0}
        {foreach from=$elements item='element' key='key'}

        {if $i == 0}
        <tr class="{cycle values="z-odd,z-even"}">
        {/if}

        <td>{formcheckbox id=$key}</td>
        <td>{img modname='E5' src=$element.icon' title=$element.title}</td>
        <td class="z-nowrap"><label for="{$key}">{$element.title}</label></td>
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
        <td><label for="smilies">{gt text='Smilies'}</label></td>
        </tr>
    </table>
</fieldset>

<div class="z-formbuttons z-buttons">
    {formbutton class="z-bt-ok" commandName="save" __text="Save"}
    {formbutton class="z-bt-cancel" commandName="cancel" __text="Cancel"}
</div>

{/form}

{include file="admin/footer.tpl"}