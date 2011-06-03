{pageaddvar name='javascript' value='javascript/helpers/Zikula.UI.js'}
{include file="admin/header.tpl"}
<div class="z-adminpageicon">{icon type="view" size="large"}</div>
<h2>{gt text='Modules preferences'}</h2>

<p><a style="margin:1em 0;" class="z-icon-es-new" href="{modurl modname=E5 type=admin func=modify}">{gt text="Add module"}</a></p>

<table class="z-admintable">
    <thead>
        <tr>
            <th class="z-w15">{gt text='Modules'}</th>
            <th>{gt text='Elements'}</th>
            <th class="z-w10 z-right">{gt text='Actions'}</th>
        </tr>
    </thead>
    <tbody>
        {foreach from=$mods item="mod"}
        <tr class="{cycle values="z-odd,z-even"}">
            <td>{$mod.modname}</td>
            <td>
                {foreach from=$mod.elements item='element'}
                {img modname='E5' src=$element.icon title=$element.title}
                {/foreach}
            </td>
            <td class="z-right">
                {* remove id=$mod.modname *}
                {* I don't know this smarty plugin - Carsten *}
                <a href="{modurl modname='E5' func='modify' type='admin' id=$mod.modname}">{img modname=core set=icons/extrasmall src=xedit.png alt="Edit"}</a>
            </td>
        </tr>
        {/foreach}
    </tbody>
</table>

{include file="admin/footer.tpl"}