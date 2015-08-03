
jQuery(document).ready(function(){
    jQuery("#reset").unbind("click").click(function(){
        uri = jQuery(this).attr("href")
        
        jQuery("#health").load(uri)
        return false;
    })
    
    reload = function () { 
        jQuery("#health").load("/wp-content/plugins/icarus/reload.php");
        window.setTimeout(reload, 10000)
    }
    
    window.setTimeout(reload, 10000)
    
    
})