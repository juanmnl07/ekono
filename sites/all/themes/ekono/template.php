<?php
/*
  Preprocess
*/

function ekono_preprocess_page(&$vars) {
    
    global $user;
    
     /*Title*/
     if(isset($vars['page']['#views_contextual_links_info']['views_ui']['view']->name) == 'galeria_de_video'){
      
    $test = $vars['page']['content']['system_main']['main']['#markup'];
    $partetext = explode('class="field field-type-text">' , $test);
    $titulos = array();
    
    $i = 0;
    //if (isset($partetext[1])) {
    foreach($partetext as $titulo) {
         array_push($titulos, stristr(trim($partetext[$i]), '</div>', true));
        $i += 1;
    }
    $vars['page']['content']['titulos'] = $titulos;
    
    $e=0;
    $titulosVar="";
    $cuentatitulos = count($titulos)-1;
    
    foreach($titulos as $cuenta) {
        if($e == 0){ 
            $e = 0;
        }
        else{
         if($e == $cuentatitulos)
          $titulosVar .= "'" . trim($titulos[$e]) ."'";
         else
          $titulosVar .= "'" . trim($titulos[$e]) ."'". ',';
        }
        $e += 1;
       
    }
    $vars['page']['content']['cadena_titulos'] = $titulosVar;
   
    /*Body*/
    
    $testbody = $vars['page']['content']['system_main']['main']['#markup'];
    $textbody = explode('class="field field-type-text-long">' , $testbody);
    $bodys = array();
   
    $g = 0;
    //if (isset($partetext[1])) {
    foreach($textbody as $cuerpo) {
         array_push($bodys, stristr(trim($textbody[$g]), '</div>', true));
        $g += 1;
    }
    $vars['page']['content']['bodys'] = $bodys;
    
    $h=0;
    $bodysVar="";
    $cuentabody = count($bodys)-1;
    foreach($bodys as $cuenta2) {
        
        if($h == 0){ 
            $h = 0;
        }
        else{
         if($h == $cuentabody)
          $bodysVar .= "'" . trim($bodys[$h]) ."'";
         else
          $bodysVar .= "'" . trim($bodys[$h]) ."'" . ',';
        }
        $h += 1;
        
     }
     $vars['page']['content']['cadena_bodys'] = $bodysVar;
    
    }
   
    
    //meter el alias de la página
	if(drupal_get_path_alias() == 'usuarios/registro')
		$vars['title'] = 'Mi cuenta';
    else if (isset($user->name) && drupal_get_path_alias() == "users/" . $user->name)
        $vars['title'] = 'Bienvenido al sitio de Tiendas Ekono Costa Rica.';
  
  // Sustituir el título Inicio de Sesión por Usuarios Registrados.
  if (arg(0) == 'user' && arg(1) == 'login') {
    $vars['page']['content']['system_main']['name']['#prefix'] = str_replace('Inicio de sesión', t('Usuarios Registrados'), $vars['page']['content']['system_main']['name']['#prefix']); 
  } 
}

function ekono_preprocess_search_result(&$vars) {
  // Add node object to result, so we can display imagefield images in results.
  $node = node_load($vars['result']['node']->entity_id);
  $node && ($vars['node'] = $node);
}




/*
function NEWTHEME_preprocess_html(&$vars) {
  //  kpr($vars['content']);
}

function NEWTHEME_preprocess_page(&$vars,$hook) {
  //typekit
  //drupal_add_js('http://use.typekit.com/XXX.js', 'external');
  //drupal_add_js('try{Typekit.load();}catch(e){}', array('type' => 'inline'));

  //webfont
  //drupal_add_css('http://cloud.webtype.com/css/CXXXX.css','external');
  
  //googlefont 
  //  drupal_add_css('http://fonts.googleapis.com/css?family=Bree+Serif','external');
 
}

function NEWTHEME_preprocess_region(&$vars,$hook) {
  //  kpr($vars['content']);
}

function NEWTHEME_preprocess_block(&$vars, $hook) {
  //  kpr($vars['content']);

  //lets look for unique block in a region $region-$blockcreator-$delta
   $block =  
   $vars['elements']['#block']->region .'-'. 
   $vars['elements']['#block']->module .'-'. 
   $vars['elements']['#block']->delta;
   
  // print $block .' ';
   switch ($block) {
     case 'header-menu_block-2':
       $vars['classes_array'][] = '';
       break;
     case 'sidebar-system-navigation':
       $vars['classes_array'][] = '';
       break;
    default:
    
    break;

   }


  switch ($vars['elements']['#block']->region) {
    case 'header':
      $vars['classes_array'][] = '';
      break;
    case 'sidebar':
      $vars['classes_array'][] = '';
      $vars['classes_array'][] = '';
      break;
    default:

      break;
  }

}

function NEWTHEME_preprocess_node(&$vars,$hook) {
  //  kpr($vars['content']);
}

function NEWTHEME_preprocess_comment(&$vars,$hook) {
  //  kpr($vars['content']);
}

function NEWTHEME_preprocess_field(&$vars,$hook) {
  //  kpr($vars['content']);
  //add class to a specific field
  switch ($vars['element']['#field_name']) {
    case 'field_ROCK':
      $vars['classes_array'][] = 'classname1';
    case 'field_ROLL':
      $vars['classes_array'][] = 'classname1';
      $vars['classes_array'][] = 'classname2';
      $vars['classes_array'][] = 'classname1';
    case 'field_FOO':
      $vars['classes_array'][] = 'classname1';
    case 'field_BAR':
      $vars['classes_array'][] = 'classname1';    
    default:
      break;
  }

}

function NEWTHEME_preprocess_maintenance_page(){
  //  kpr($vars['content']);
}
*/
