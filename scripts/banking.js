

$(function(){

     	$( "#onglets" ).tabs({
        active :0,                 
        event: "click",      
        effect: "explode",    
        duration: 1000,
        hide:'fade', 
        show: { effect: "blind", duration: 800 }, //'fade'

    });


    $('[name="importer"]').click(function(){
       
    	 $('[name="fichier"]').trigger('click');

          $('[name="fichier"]').change(function(){

          	  var oData = new FormData(document.forms.namedItem("excel"));

              $.ajax({
                        url: "controleurs/corporate_excel.php",
                        type: "POST",
                        data: oData,
                        processData: false,  
                        contentType: false,   

                        success:function(data){
                            alert(data);
                                    
                         }               
                                       
                    });

          });
     });

});