(function ($) { 
  // Function to prevent select more than 3 markets
  Drupal.behaviors.ekono_taxonomy_menu = {
    attach: function(context, settings) {

      // If change the number total post field and the fields link value or links per post is not empty and number total post is
      // not empty set seo total posts field to number total posts value.
      $("#edit-nivel-uno").bind("change", function(event, ui) {
        $('#views-exposed-form-Descuentos-page').submit();
      });
      
      $("#edit-nivel-dos").bind("change", function(event, ui) {
        $('#views-exposed-form-Descuentos-page').submit();
      });
      
       $("#edit-nivel-tres").bind("change", function(event, ui) {
        $('#views-exposed-form-Descuentos-page').submit();
      });
     
     $("#edit-field-product-und-entities-0-form-field-porcentaje-de-descuento").bind("change", function(event, ui) {
       if($("#edit-field-product-und-entities-0-form-field-porcentaje-de-descuento-und").val() != '_none' ) {
       $("#edit-field-product-und-entities-0-form-field-con-descuento-und").attr('checked','checked');
     
       }//if
       else { 
	    $("#edit-field-product-und-entities-0-form-field-con-descuento-und").attr('checked','');
	}//else
      });
      
      
    } // attach
  } // behaviours

})(jQuery);

