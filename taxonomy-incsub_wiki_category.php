<?php get_header(); ?>
<div class="row sidebar_bg radius10" id="page">
	<div class="eight columns wrapper radius-left offset-topgutter">	
		<section class="content">
			<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
				<h5><?php the_title();?></h5>
				<?php the_excerpt(); ?>
				<hr>
			<?php endwhile; endif; ?>	
		</section>
	</div>	<!-- End main content (left) section -->
</div> <!-- End #landing -->
<?php get_footer(); ?>