<!***********FOUNDATION SCRIPTS**************>
  <script src="<?php echo get_template_directory_uri() ?>/assets/javascripts/jquery.foundation.mediaQueryToggle.js"></script>
  <script src="<?php echo get_template_directory_uri() ?>/assets/javascripts/jquery.foundation.forms.js"></script>
  <script src="<?php echo get_template_directory_uri() ?>/assets/javascripts/jquery.foundation.reveal.js"></script> <!-- ALL -->
  <script src="<?php echo get_template_directory_uri() ?>/assets/javascripts/jquery.foundation.navigation.js"></script> <!-- ALL -->
  <script src="<?php echo get_template_directory_uri() ?>/assets/javascripts/jquery.foundation.buttons.js"></script>
  <script src="<?php echo get_template_directory_uri() ?>/assets/javascripts/jquery.foundation.tabs.js"></script>
  <script src="<?php echo get_template_directory_uri() ?>/assets/javascripts/jquery.foundation.tooltips.js"></script>
  <script src="<?php echo get_template_directory_uri() ?>/assets/javascripts/jquery.foundation.accordion.js"></script>
  <script src="<?php echo get_template_directory_uri() ?>/assets/javascripts/jquery.placeholder.js"></script>
  <script src="<?php echo get_template_directory_uri() ?>/assets/javascripts/jquery.foundation.alerts.js"></script>
  <script src="<?php echo get_template_directory_uri() ?>/assets/javascripts/jquery.foundation.topbar.js"></script>
  <script src="<?php echo get_template_directory_uri() ?>/assets/javascripts/jquery.foundation.joyride.js"></script>
  <script src="<?php echo get_template_directory_uri() ?>/assets/javascripts/jquery.foundation.clearing.js"></script> <!-- Photo Index -->
  <script src="<?php echo get_template_directory_uri() ?>/assets/javascripts/jquery.foundation.magellan.js"></script>
  
<!***********ALL PAGES**************>
  <script src="<?php echo get_template_directory_uri() ?>/assets/javascripts/app.js"></script>
  <!-- Add "external" class to hyperlinks not on the krieger.jhu.edu domain -->
  <script>
	  jQuery('a').filter(function() {
		  return this.hostname && this.hostname !== location.hostname;
	  }).addClass("external_link");
  </script>
    
<!***********DIRECTORY**************>
<?php if ( is_page_template( 'template-people-directory.php' ))  { ?>
  	<script src="<?php echo get_template_directory_uri() ?>/assets/javascripts/jquery.isotope.js"></script>
  	<script src="<?php echo get_template_directory_uri() ?>/assets/javascripts/jquery.quicksearch.js"></script>  	
  	<script src="<?php echo get_template_directory_uri() ?>/assets/javascripts/page.directory.js"></script>
  	<script>
	    var $j = jQuery.noConflict();
	    $j(window).load(function() {
	        var filterFromQuerystring = getParameterByName('filter');
	        $j('.filter a[data-filter=".' + filterFromQuerystring  + '"]').click();
	    });
	</script>

<?php } ?>


<!***********SINGLE ITEMS (NEWS & PEOPLE_**************>
<?php 
	$about_id = ksas_get_page_id('about');
	$archive_id = ksas_get_page_id('archive');
	$people_id = ksas_get_page_id('people');
	$faculty_id = ksas_get_page_id('faculty');
?>
<?php if (  is_singular('post') ) { ?>
	<script>
		var $j = jQuery.noConflict();
		$j(document).ready(function(){
			$j('li.page-id-<?php echo $about_id; ?>').addClass('current_page_ancestor');
			$j('li.page-id-<?php echo $archive_id; ?>').addClass('current_page_parent');
			});
	</script>
<?php } ?>

<?php if ( is_singular('people') ) { ?>
	<script>
		var $k = jQuery.noConflict();
		$k(document).ready(function(){
			$k('li.page-id-<?php echo $people_id; ?>').addClass('current_page_ancestor');
			$k('li.page-id-<?php echo $faculty_id; ?>').addClass('current_page_parent');
			});
	</script>
<?php } ?>

<!***********HOMEPAGE**************>
<?php if ( is_front_page()) { ?>
	<script src="<?php echo get_template_directory_uri() ?>/assets/javascripts/jquery.foundation.orbit.js"></script>
	<script>
		var $l = jQuery.noConflict();
		$l(window).load(function() {
        $l("#slider").orbit({
        	'animation' : 'horizontal-push',
        	'timer' : true,
        	'advanceSpeed' : 7000,
        	'directionalNav' : false,
	        'bullets' : false,		
        });
   });
   </script>
<?php } ?>
