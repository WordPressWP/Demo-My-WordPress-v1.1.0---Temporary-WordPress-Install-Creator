"use strict"; 
function myAction_dwp()
{
    var ajaxurl = dwpssettings.ajaxurl;
    var switch_theme = dwpssettings.switch_theme;
    var activate_plugins = dwpssettings.activate_plugins;
    document.getElementById("dwp_status").innerHTML = dwpssettings.fronttext;
    if(dwpssettings.sitenameon == '1')
    {
        var sitename = document.getElementById("dwp_sitename").value;
    }
    else
    {
        var sitename = '';
    }
    if(dwpssettings.captchaon == '1')
    {
        var captcha = document.getElementById("dwp_captcha").value;
    }
    else
    {
        var captcha = '';
    }
    if(dwpssettings.emailon == '1')
    {
        var email = document.getElementById("dwp_email").value;
    }
    else
    {
        var email = '';
    }
    if(dwpssettings.cloneidon == '1')
    {
        var siteid = document.getElementById("dwp_siteid").value;
    }
    else
    {
        var siteid = '';
    }
    var data = {
        action: 'dwp_my_action',
        sitename: sitename,
        email: email,
        siteid: siteid,
        captcha: captcha,
        activate_plugins: activate_plugins,
        switch_theme: switch_theme
    };
    document.getElementById("dwp_action").disabled = true;
    jQuery.post(ajaxurl, data, function(response) {
        document.getElementById("dwp_action").disabled = false;
        if(response.startsWith("<p>"))
        {
            document.getElementById("dwp_status").innerHTML = response;
        }
        else
        {
            var form = jQuery('<form action="' + response + '" method="post"></form>');
            jQuery('body').append(form);
            form.submit();
        }
    }).fail( function(xhr) 
    {
        document.getElementById("dwp_status").innerHTML = xhr.statusText;
    });
}