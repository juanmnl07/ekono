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
	
	    <article class="node">
	
		   <div class="page-title"><h1>Parece que hay un error...</h1></div>
				
		    <h2>Lo lamentamos, pero la página que buscar no existe.</h2>
		    <p>Esto puede deberse a alguna de las siguientes razones:</p>
		    <ul>
		      <li>una dirección mal escrita</li>
		      <li>un enlace a una página que ha expirado</li>
		    </ul>
				
		  </article>
	
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