(function ($) {

Drupal.behaviors.nuestrasTiendas = {
  attach: function(context, settings) {
    var map_img = $('#nuestras-tiendas-img');
    if (map_img.length) {
      var map_img_base = map_img.attr('src').match(/(.*\/).*$/)[1];
      // Precarga de los mapas
      var mapas = ['base.jpg',
                   'sanjose.jpg',
                   'alajuela.jpg',
                   'cartago.jpg',
                   'heredia.jpg',
                   'guanacaste.jpg', 
                   'puntarenas.jpg',
                   'limon.jpg'];
      for (var i in mapas) {
        (new Image()).src = map_img_base + mapas[i];
      }
    }
    $('.mapa-provincia').once('nuestras-tiendas')
    .mouseenter(function() {
      var provincia = $(this).attr('id');
      map_img.attr('src', map_img_base + provincia + '.jpg');
    })
    .mouseleave(function() {
      map_img.attr('src', map_img_base + 'base.jpg');
    });
  }
};

})(jQuery);
