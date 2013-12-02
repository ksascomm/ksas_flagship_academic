<?php
/*
Template Name: People Directory
*/
?>	

<?php get_header(); 

if ( false === ( $faculty_people_query = get_transient( 'faculty_people_query' ) ) ) {
       // It wasn't there, so regenerate the data and save the transient
	$faculty_people_query = new WP_Query(array(
			'post_type' => 'people',
			'role' => 'faculty',
			'meta_key' => 'ecpt_people_alpha',
			'orderby' => 'meta_value',
			'order' => 'ASC',
			'posts_per_page' => '-1'));        	
	set_transient( 'faculty_people_query', $faculty_people_query, 2592000 );
} 	
		
if ( false === ( $research_people_query = get_transient( 'research_people_query' ) ) ) {
       // It wasn't there, so regenerate the data and save the transient
	$research_people_query = new WP_Query(array(
		'post_type' => 'people',
		'role' => 'research',
		'meta_key' => 'ecpt_people_alpha',
		'orderby' => 'meta_value',
		'order' => 'ASC',
		'posts_per_page' => '-1'));        	
	set_transient( 'research_people_query', $research_people_query, 2592000 );
} 			

if ( false === ( $staff_people_query = get_transient( 'staff_people_query' ) ) ) {
       // It wasn't there, so regenerate the data and save the transient
	$staff_people_query = new WP_Query(array(
		'post_type' => 'people',
		'role' => 'staff',
		'meta_key' => 'ecpt_people_alpha',
		'orderby' => 'meta_value',
		'order' => 'ASC',
		'posts_per_page' => '-1'));        	
	set_transient( 'staff_people_query', $staff_people_query, 2592000 );
} 	
	$staff_page_query = new WP_Query(array(
		'post_type' => 'page',
		'pagename' => 'staff',
	));
?>
<div class="row wrapper radius10">
<div class="twelve columns">
	<?php locate_template('parts-nav-breadcrumbs.php', true, false); ?>	
	<section class="row">
		<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
			<h2><?php the_title();?></h2>
		<?php endwhile; endif; ?>
		<?php $theme_option = flagship_sub_get_global_options();
				if ( $theme_option['flagship_sub_directory_search']  == '1' ) { locate_template('parts-directory-search.php', true); } ?>
	</section>



	<section class="row" id="fields_container">
		<ul class="twelve columns" id="directory">
		<?php if($faculty_people_query->have_posts()) : ?>
		<a name="faculty" id="faculty"></a>
		<?php while ($faculty_people_query->have_posts()) : $faculty_people_query->the_post(); 
		?>
				<li class="person <?php echo get_the_directory_filters($post);?> <?php echo get_the_roles($post); ?>">
					<div class="row">
						<div class="twelve columns">
							<a href="<?php the_permalink();?>" title="<?php the_title(); ?>" class="field">
							<?php if ( has_post_thumbnail()) { ?> 
								<?php the_post_thumbnail('directory', array('class' => 'padding-five floatleft hide-for-small')); ?>
							<?php } ?>			    
									<h4 class="no-margin"><?php the_title(); ?></h4></a>
									<?php if ( get_post_meta($post->ID, 'ecpt_position', true) ) : ?><h6><?php echo get_post_meta($post->ID, 'ecpt_position', true); ?></h6><?php endif; ?>
									<?php if ( get_post_meta($post->ID, 'ecpt_degrees', true) ) : ?><?php echo get_post_meta($post->ID, 'ecpt_degrees', true); ?><?php endif; ?>
									<p class="contact no-margin">
										<?php if ( get_post_meta($post->ID, 'ecpt_phone', true) ) : ?>
											<span class="icon-mobile"><?php echo get_post_meta($post->ID, 'ecpt_phone', true); ?></span>
										<?php endif; ?>
										<?php if ( get_post_meta($post->ID, 'ecpt_fax', true) ) : ?>
											<span class="icon-printer"><?php echo get_post_meta($post->ID, 'ecpt_fax', true); ?></span>
										<?php endif; ?>
										<?php if ( get_post_meta($post->ID, 'ecpt_email', true) ) : $email = get_post_meta($post->ID, 'ecpt_email', true); ?>
											<span class="icon-mail"><a href="mailto:<?php echo get_post_meta($post->ID, 'ecpt_email', true); ?>">
											
											<?php echo get_post_meta($post->ID, 'ecpt_email', true); ?> </a></span>
										<?php endif; ?>
										<?php if ( get_post_meta($post->ID, 'ecpt_office', true) ) : ?>
											<span class="icon-location"><?php echo get_post_meta($post->ID, 'ecpt_office', true); ?></span>
										<?php endif; ?>
									</p>
						<?php if ( get_post_meta($post->ID, 'ecpt_expertise', true) ) : ?><p><b>Research Interests:&nbsp;</b><?php echo get_post_meta($post->ID, 'ecpt_expertise', true); ?></p><?php endif; ?>
					</div>
				</li>		
		<?php endwhile; endif;?>
		
		<!-- Page Content -->
		<?php if ( have_posts() ) : while ( have_posts() ) : the_post();  the_content(); endwhile; endif; ?>
		
		<!-- Research Query -->
		<?php if($research_people_query->have_posts()) : ?>
		<a name="research" id="research"></a>
		<li class="person sub-head research quicksearch-match <?php foreach ( $filters as $filter ) { echo $filter->slug . ' '; } ?>"><h2 class="black">Research Staff</h2></li>
		<?php while ($research_people_query->have_posts()) : $research_people_query->the_post(); ?>
				<li class="person <?php echo get_the_directory_filters($post);?> <?php echo get_the_roles($post); ?>">
					<div class="row">
						<div class="twelve columns">
							<div class="row">
									<h4 class="no-margin"><?php the_title(); ?></h4>
									<?php if ( get_post_meta($post->ID, 'ecpt_position', true) ) : ?><h6><?php echo get_post_meta($post->ID, 'ecpt_position', true); ?></h6><?php endif; ?>
									<?php if ( get_post_meta($post->ID, 'ecpt_degrees', true) ) : ?><?php echo get_post_meta($post->ID, 'ecpt_degrees', true); ?><?php endif; ?>
									<p class="contact no-margin">
										<?php if ( get_post_meta($post->ID, 'ecpt_phone', true) ) : ?>
											<span class="icon-mobile"><?php echo get_post_meta($post->ID, 'ecpt_phone', true); ?></span>
										<?php endif; ?>
										<?php if ( get_post_meta($post->ID, 'ecpt_fax', true) ) : ?>
											<span class="icon-printer"><?php echo get_post_meta($post->ID, 'ecpt_fax', true); ?></span>
										<?php endif; ?>
										<?php if ( get_post_meta($post->ID, 'ecpt_email', true) ) : $email = get_post_meta($post->ID, 'ecpt_email', true); ?>
											<span class="icon-mail"><a href="mailto:<?php echo get_post_meta($post->ID, 'ecpt_email', true); ?>">
											
											<?php echo get_post_meta($post->ID, 'ecpt_email', true); ?> </a></span>
										<?php endif; ?>
										<?php if ( get_post_meta($post->ID, 'ecpt_office', true) ) : ?>
											<span class="icon-location"><?php echo get_post_meta($post->ID, 'ecpt_office', true); ?></span>
										<?php endif; ?>
										<?php if ( get_post_meta($post->ID, 'ecpt_website', true) ) : ?>
												<a href="<?php echo get_post_meta($post->ID, 'ecpt_website', true); ?>" target="_blank"><span class="icon-globe">Personal Website</a></span>
										<?php endif; ?>
									</p>
						<?php if ( get_post_meta($post->ID, 'ecpt_expertise', true) ) : ?><p><b>Research Interests:&nbsp;</b><?php echo get_post_meta($post->ID, 'ecpt_expertise', true); ?></p><?php endif; ?>
						</div>
					</div>
				</li>		
	<?php endwhile; endif;?>
		<!-- Staff Query -->
		<?php if($staff_people_query->have_posts()) : ?>
		<a name="staff" id="staff"></a>
		<li class="person sub-head staff quicksearch-match"><h2 class="black">Staff</h2></li>
		<?php while ($staff_people_query->have_posts()) : $staff_people_query->the_post(); ?>
				<li class="person <?php echo get_the_directory_filters($post);?> <?php echo get_the_roles($post); ?>">
					<div class="row">
						<div class="twelve columns">
							<div class="row">
									<h4 class="no-margin"><?php the_title(); ?></h4>
									<?php if ( get_post_meta($post->ID, 'ecpt_position', true) ) : ?><h6><?php echo get_post_meta($post->ID, 'ecpt_position', true); ?></h6><?php endif; ?>
									<?php if ( get_post_meta($post->ID, 'ecpt_degrees', true) ) : ?><?php echo get_post_meta($post->ID, 'ecpt_degrees', true); ?><?php endif; ?>
									<p class="contact no-margin">
										<?php if ( get_post_meta($post->ID, 'ecpt_phone', true) ) : ?>
											<span class="icon-mobile"><?php echo get_post_meta($post->ID, 'ecpt_phone', true); ?></span>
										<?php endif; ?>
										<?php if ( get_post_meta($post->ID, 'ecpt_fax', true) ) : ?>
											<span class="icon-printer"><?php echo get_post_meta($post->ID, 'ecpt_fax', true); ?></span>
										<?php endif; ?>
										<?php if ( get_post_meta($post->ID, 'ecpt_email', true) ) : $email = get_post_meta($post->ID, 'ecpt_email', true); ?>
											<span class="icon-mail"><a href="mailto<?php echo get_post_meta($post->ID, 'ecpt_email', true); ?>">
											
											<?php echo get_post_meta($post->ID, 'ecpt_email', true); ?> </a></span>
										<?php endif; ?>
										<?php if ( get_post_meta($post->ID, 'ecpt_office', true) ) : ?>
											<span class="icon-location"><?php echo get_post_meta($post->ID, 'ecpt_office', true); ?></span>
										<?php endif; ?>
										<?php if ( get_post_meta($post->ID, 'ecpt_website', true) ) : ?>
												<a href="<?php echo get_post_meta($post->ID, 'ecpt_website', true); ?>" target="_blank"><span class="icon-globe">Personal Website</a></span>
										<?php endif; ?>
									</p>
						<?php if ( get_post_meta($post->ID, 'ecpt_expertise', true) ) : ?><p><b>Research Interests:&nbsp;</b><?php echo get_post_meta($post->ID, 'ecpt_expertise', true); ?></p><?php endif; ?>
						</div>
					</div>
				</li>		
	<?php endwhile; endif;?>	
	<!-- Staff Page -->
		<?php if($staff_page_query->have_posts()) : ?>
		<a name="staff" id="staff"></a>
		<?php while ($staff_page_query->have_posts()) : $staff_page_query->the_post(); the_content(); endwhile; endif;?>
	<?php if ( $theme_option['flagship_sub_directory_search']  == '1' ) { ?>
	<div class="row" id="noresults">
		<div class="four columns centered">
			<h3>No matching results</h3>
		</div>
	</div>
	<?php } ?>
</ul>
</section>
</div>
</div> <!-- End content wrapper -->
<?php get_footer(); ?>