<!DOCTYPE html>

<!-- paulirish.com/2008/conditional-stylesheets-vs-css-hacks-answer-neither/ -->
<!--[if lt IE 7]> <html class="no-js lt-ie9 lt-ie8 lt-ie7" lang="en"> <![endif]-->
<!--[if IE 7]>    <html class="no-js lt-ie9 lt-ie8" lang="en"> <![endif]-->
<!--[if IE 8]>    <html class="no-js lt-ie9" lang="en"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js" lang="en"> <!--<![endif]-->

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width" />
  <title></title>
  
  <!-- CSS Files: All pages -->
  <script type="text/javascript" src="http://fast.fonts.com/jsapi/c5f514c7-d786-4bfb-9484-ea6c8fbd263f.js"></script>
  <link rel="stylesheet" href="<?php echo get_template_directory_uri() ?>/assets/stylesheets/foundation.css">
  <link rel="stylesheet" href="<?php echo get_template_directory_uri() ?>/assets/stylesheets/flagship.css">
  <!-- CSS Files: Conditionals -->
  
  <!-- Modernizr and Jquery Script -->
  <script src="<?php echo get_template_directory_uri() ?>/assets/javascripts/modernizr.foundation.js"></script>
  <?php wp_enqueue_script('jquery'); ?> 
  <?php wp_head(); ?>

  <!-- IE Fix for HTML5 Tags -->
  <!--[if lt IE 9]>
    <script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
  <![endif]-->

</head>

<body <?php body_class(); ?>>
	<header>
		<div class="row show-for-small">
			<div class="four columns centered blue_bg">
			<div class="mobile-logo centered"><a href="<?php echo network_site_url(); ?>">Home</a></div>
			<h2 class="white" align="center"><?php echo get_bloginfo( 'title' ); ?></h2>
			</div>
		</div>
	
		<div class="row hide-for-print">
			<div id="search-bar" class="offset-by-eight four columns">
				<div class="row">
					<div class="six columns">
					<?php $theme_option = flagship_sub_get_global_options(); 
							$collection_name = $theme_option['flagship_sub_search_collection'];
					?>

					<form method="GET" action="<?php echo site_url('/search'); ?>">
						<input type="submit" class="icon-search" value="&#xe004;" />
						<input type="text" name="q" placeholder="Search this site" />
						<input type="hidden" name="site" value="<?php echo $collection_name; ?>" />
					</form>
					</div>
						<?php wp_nav_menu( array( 
							'theme_location' => 'search_bar', 
							'menu_class' => '', 
							'fallback_cb' => 'foundation_page_menu', 
							'container' => 'div',
							'container_id' => 'search_links', 
							'container_class' => 'six columns links inline hide-for-small',
							'depth' => 1,
							'items_wrap' => '%3$s', )); ?> 
				</div>	
			</div>	<!-- End #search-bar	 -->
		</div>
		<div class="row">
			<div class="twelve columns hide-for-small" id="logo_nav">
				<a href="<?php echo network_home_url(); ?>" title="Krieger School of Arts & Sciences">
					<img src="<?php echo get_template_directory_uri() ?>/assets/images/logo.png" class="floatleft" />
				</a>
				
				<a href="<?php echo site_url(); ?>"><h1 class="white"><span class="small"><?php echo get_bloginfo ( 'description' ); ?></span></br>
					<?php echo get_bloginfo( 'title' ); ?></h1></a>
			
			</div>
		</div>
		<div class="row hide-for-print">
			<?php wp_nav_menu( array( 
				'theme_location' => 'main_nav', 
				'menu_class' => '', 
				'container' => 'nav',
				'container_id' => 'main_nav', 
				'container_class' => 'twelve columns',
				'depth' => 2,
				'walker'=> new page_id_classes )); ?> 
		</div>
		<div class="row show-for-small black_bg radius10" id="mobile_nav_container">

			<?php wp_nav_menu( array( 
				'theme_location' => 'main_nav', 
				'menu_class' => '', 
				'fallback_cb' => 'foundation_page_menu', 
				'container' => 'div',
				'container_id' => 'mobile_nav', 
				'container_class' => 'twelve columns',
				'depth' => 2,
				'walker' => new mobile_select_menu(),
				'items_wrap' => '<select onchange="window.open(this.options[this.selectedIndex].value,\'_top\')">%3$s</select>', )); ?> 
		</div>	
		</header>