<div id="formdialog_content" style="display: none;">
    <form enctype="application/x-www-form-urlencoded" method="post" class="z-form">
        <div>
            <fieldset>
                <div class="z-formrow">
                    <label for="e5_table_rows">{gt text="Rows"}</label>
                    <input type="text" value="3" size="50" name="rows" id="e5_table_rows" />
                </div>
                <div class="z-formrow">
                    <label for="e5_table_cols">{gt text="Cols"}</label>
                    <input type="text" value="3" size="50" name="cols" id="e5_table_cols" />
                </div>
            </fieldset>
        </div>
    </form>
</div>

<a id="formdialog" title="{$e.title}" href="#formdialog_content">
    {img modname='E5' src=$e.icon title=$e.title}
</a>

<script type="text/javascript">
    table = function(data) {
        if(data != false) {
            data = Object.toJSON(data);
            data = data.evalJSON(true);
            var rows = parseInt(data.rows);
            var cols = parseInt(data.cols);
            var k = 0;
            if ((rows > 0) && (cols > 0)) {
                var output = '<table cellpadding=2 cellspacing=2 border=1>';
                for (var i=0; i < rows; i++) {
                    output += '<tr>';
                    for (var j=0; j < cols; j++) {
                        k++;
                        output += '<td>'+k+'</td>';
                    }
                    output += '</tr>';
                }
                output += '</table>';
            }

            $('meinDiv').focus();

            restoreRange();
            document.execCommand('inserthtml', false, output);
        }
    }
    var formdialog = new Zikula.UI.FormDialog($('formdialog'), table);
</script>
