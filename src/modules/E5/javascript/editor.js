


Event.observe(window, 'load', init_editor, false);  

function init_editor() {;
    $('meinDiv').focus();
    


    $$('.z-form').each(function(item,index){
        if(item.id != '') {
            Event.observe(item.id, 'submit', function(event) {
                $('description').update($('meinDiv').innerHTML);
                //Event.stop(event);
            });
        }
    });
    

}

function insertAtCursor(begin, inner, end) {
    var selection = getSel();
    if(selection != '') {
        inner = selection; 
    }
    document.execCommand('inserthtml',false, begin+inner+end);
}

function insertAtCursor2(id, value) {
    document.execCommand(id, false, value);
}

var selObj;
var selRange;

function saveRange() {
    selObj = window.getSelection();
    selRange = selObj.getRangeAt(0);
}


function restoreRange() {
    var sel = window.getSelection();
    sel.removeAllRanges();
    sel.addRange(selRange);
}


function getSel() {
    return selObj;
}

function getSelRange() {
    return selObj.getRangeAt(0);
}


var itemsLength = new Array();
itemsLength[0] = new Object();


function toggle_additional_bar(id) {
    
    var bar  = $( id + '_bar');
    var lenght = itemsLength[0][id];
    
    $$('.e5_bar2').each(function(item,index){
        if(item.id != id + '_bar') {
            item.hide();
        }
    });
    bar.toggle();
    
    if(lenght == undefined) {
        var count = 1;
        var x_pos;
        $$('.'+id+'_class'). each(function(item,index) {
            if(index == 0) {
                x_pos = Position.cumulativeOffset(item)[0];
            } else if(index == 1) {
                lenght = Position.cumulativeOffset(item)[0] - x_pos;
            }
            count++;
        });
        lenght  = count * lenght;
        itemsLength[0][id] = lenght

    }

    var x_bar = Position.cumulativeOffset(bar)[0];    
    var x_icon      = Position.cumulativeOffset( $(id) )[0];
    var x = x_icon - x_bar - lenght / 2 ;
    
    if( x + lenght > bar.getWidth() ) {
        x = bar.getWidth() - lenght; 
    }
        
    $(id+'_spacer').setStyle({
        width:x + 'px'
    });


}