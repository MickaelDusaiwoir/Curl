( function ( $ ) {
    "use strict";

    // -- globals
    
    // methodes
    
    var supprimer = function( e ) {
     
        var sLien;
     
        sLien= $(this).attr('rel');
     
        $(this).parent().parent().slideUp();
        $.ajax({
         
                url: "Curl/application/models/suppAjax.php",
                type: "POST",
                data:{
                        
                    lien: sLien
                        
                },
                    
                success: function(){}
            });
     
        e.preventDefault();
        e.stopImmediatePropagation();
     
    };
    
    
    $( function () {
        
        // -- onload routines
         
        $('.supprimer').on('click',supprimer);
         
         
    } );
    
}( jQuery ) );