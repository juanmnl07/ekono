<?php
//kpr(get_defined_vars());
//kpr($theme_hook_suggestions);
//template naming
//page--[CONTENT TYPE].tpl.php
?>
<?php if( theme_get_setting('mothership_poorthemers_helper') ){ ?>
<!--page.tpl.php-->
<?php } ?>

<?php print $mothership_poorthemers_helper; ?>

<?php if ($page['toolbar_menu']): ?>
   <div class="col toolbar">
		<div class="grid">
			<?php print render($page['toolbar_menu']); ?>
		</div>
   </div>
<?php endif; ?>


<div class="grid">
	<header role="banner" class="col header">
	    	  
	  <div class="siteinfo">
	    <?php if ($logo): ?>
	      <figure>
	      <a href="<?php print $front_page; ?>" title="<?php print t('Home'); ?>" rel="home">
	        <img src="<?php print $logo; ?>" alt="<?php print t('Home'); ?>" />
	      </a>
	      </figure>
	    <?php endif; ?>
	  </div>
	
	  <?php if($page['header']): ?>
	    <div class="header-region">
	      <?php print render($page['header']); ?>
	    </div>
	  <?php endif; ?>

	  <?php if($page['header_menu']): ?>
	    <div class="header-menu">
	      <?php print render($page['header_menu']); ?>
	    </div>
	  <?php endif; ?>
	
	</header>

	<div class="page-title">
		<?php print render($title_prefix); ?>
	  <?php 
      if ($is_front) {} 

      else if ( request_uri() == "/productos/oportunidades-del-mes"  ) {
        print "<h1>Oportunidades del mes</h1>";
      }
              
      else {
           if ($title && !empty($title)) {
		          print "<h1>$title</h1>";
            } // if title not empty.
            else {
                  $arg = arg();

  		            if (count($arg) >= 3 && $arg[0] == 'taxonomy' && $arg[1] == 'term') {

                    $tid = $arg[2];
		                $term = taxonomy_term_load($tid);
                    $vocabulary = taxonomy_vocabulary_machine_name_load('product_category');

                    if ($term->vid == $vocabulary->vid) {

                      $children = taxonomy_get_children($tid, $vocabulary->vid);
                      $parents = taxonomy_get_parents($tid);

                      // Estamos en una hoja.
                      if (count($children) == 0) {

                        foreach($parents as $parent) {
                          $tid = $parent->tid;
                        }
                        $parent_1 = taxonomy_term_load($tid);

                        $parents = taxonomy_get_parents($parent_1->tid);
                        foreach($parents as $parent) {
                          $tid = $parent->tid;
                        }
                        $parent_2 = taxonomy_term_load($tid);

		                    print "<h1 class=\"nivel-3\">$parent_2->name</h1><h2 class=\"nivel-3-2\">$parent_1->name</h2>";
                      } // if children > 0

                      // Estamos en el nivel 2.
                      else if (count($parents) > 0) {
                        foreach($parents as $parent) {
                          $tid = $parent->tid;
                        }
                        $term = taxonomy_term_load($tid);
		                    print "<h1 class=\"nivel-2\">Departamentos</h1><h2 class=\"nivel-2-2\">$term->name</h2>";
                      } // else if parents > 0
                      else {
		                    print "<h1>Departamentos</h1>";
                      } // else print
                  } // else if parents > 0

                } // if taxonomy
                else {
                  $arg = arg();

                  if($arg[0] == 'node') {
                    $node = node_load(arg(1));

                    if ($node->type == 'zapatos' || $node->type == 'product_display' || $node->type == 'producto_art_1' || $node->type == 'producto_art_2' || $node->type == 'producto_art_3' || $node->type == 'producto_art_4' || $node->type == 'producto_art_5' || $node->type == 'producto_art_6' || $node->type == 'producto_art_7' || $node->type == 'producto_art_8' || $node->type == 'producto_art_9') {
                     if(isset($node->field_product_category['und'][0]['tid'])){
                     $tid = $node->field_product_category['und'][0]['tid'];
                     $parents = taxonomy_get_parents($tid);

                     foreach($parents as $parent) {
                          $tid = $parent->tid;
                        }
                        $parent_1 = taxonomy_term_load($tid);

                        $parents = taxonomy_get_parents($parent_1->tid);
                        foreach($parents as $parent) {
                          $tid = $parent->tid;
                        }
                        $parent_2 = taxonomy_term_load($tid);

		                    print "<h1 class=\"nivel-3\">$parent_2->name</h1><h2 class=\"nivel-3-2\">$parent_1->name</h2>";
                     }
		    }

                  } // if arg == node

                  /*else {
                    $current_url = 'http://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
                    dsm(drupal_lookup_path('source', $current_url));
                    dsm($current_url);
                  }*/

                } // else not taxonomy.
                
              } //  else title empty
            } // else not front

      ?>
	    <?php print render($title_suffix); ?>
	    
	    <?php print $breadcrumb; ?>
	</div>
	
	<div class="under-title"><?php print render($page['under_title']); ?></div>
	
	  <div role="main" class="col main-content">	
	
	    <?php if ($action_links): ?>
	      <ul class="action-links"><?php print render($action_links); ?></ul>
	    <?php endif; ?>
	
	    <?php if (isset($tabs['#primary'][0]) || isset($tabs['#secondary'][0])): ?>
	      <nav class="tabs"><?php print render($tabs); ?></nav>
	    <?php endif; ?>
	
	    <?php if($page['highlighted'] OR $messages){ ?>
	      <div class="drupal-messages">
	      <?php print render($page['highlighted']); ?>
	      <?php print $messages; ?>
	      </div>
	    <?php } ?>
	
	    <?php print render($page['content_pre']); ?>
	
	    <?php print render($page['content']); ?>
	
	    <!--/Fix para mostrar login block en user/register-->
	    <?php 
              if (current_path() == 'user/register') {
              print(drupal_render(drupal_get_form('user_login_block'))); 
              }
            ?>
	
	    <?php print render($page['content_post']); ?>
	
	  </div><!--/main-->
	
	  <?php if ($page['sidebar_first']): ?>
	    <div class="col sidebar-first">
	    <?php print render($page['sidebar_first']); ?>
	    </div>
	  <?php endif; ?>
	
	  <?php if ($page['sidebar_second']): ?>
	    <div class="col sidebar-second">
	      <?php print render($page['sidebar_second']); ?>
	    </div>
	  <?php endif; ?>
	
	<?php if ($page['under_content']): ?>
	<div class="under-content wide">
		<?php print render($page['under_content']); ?>
	</div> <!-- under-content -->
	<?php endif; ?>		
	
	<footer role="contentinfo" class="col footer">
	  <div class="footer-col "><?php print render($page['footer']); ?></div>
	  <div class="footer-col footer-second" ><?php print render($page['footer_second']); ?></div>
	  <div class="footer-col footer-third"><?php print render($page['footer_third']); ?></div>
	  <div class="footer-col footer-forth"><?php print render($page['footer_fourth']); ?></div>
	  <div class="footer-col footer-fifth"><?php print render($page['footer_fifth']); ?></div>
	</footer>
</div> <!-- grid -->

<script>

</script>
