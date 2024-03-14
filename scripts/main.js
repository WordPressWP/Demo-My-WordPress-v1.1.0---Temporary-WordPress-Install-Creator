"use strict"; 
var initial = '';
    function mainChanged()
    {
        if(jQuery('.input-checkbox').is(":checked"))
        {            
            jQuery(".hideMain").show();
        }
        else
        {
            jQuery(".hideMain").hide();
        }
    }
    window.onload = mainChanged;
    var unsaved = false;
    jQuery(document).ready(function () {
        jQuery(":input").change(function(){
            if (this.id != 'PreventChromeAutocomplete')
                unsaved = true;
        });
        function unloadPage(){ 
            if(unsaved){
                return "You have unsaved changes on this page. Do you want to leave this page and discard your changes or stay on this page?";
            }
        }
        window.onbeforeunload = unloadPage;
    });
function revealRec(){document.getElementById("diviIdrec").innerHTML = '<br/>We recommend that you check <b><a href="https://github.com/WordPressWP/" target="_blank">WordPressWP</a></b>, by <b><a href="https://github.com/WordPressWP/" target="_blank">WordPressWP</a></b>! It is easy to configure and it looks gorgeous. Check it out now!<br/><br/><a href="https://github.com/WordPressWP/" target="_blank" rel="nofollow"><img style="border:0px" src="https://3.bp.blogspot.com/-h9TLQozNO6Q/W92Sk80zwjI/AAAAAAAAAjg/JC8sFWAUPzseR4nnjhVNbRQmCnr1ZMu4gCLcBGAs/s1600/divi.jpg" width="468" height="60" alt="Divi WordPress Theme"></a>';}
