jQuery(document).ready(function($){
    
    $("a.folder").click(function(event){
        event.preventDefault();
        var id = jQuery(this).attr("id");
        console.log(id);
        $('.under-'+ id).toggle();
    });
    
    var aVisible = $('.building').css('display');
    if (aVisible == 'block') {
        $('#display-form').css('display','none');
        $('#second-heading').css('display','none');
        $('div#logout').css('display','block');
    }
    
    });