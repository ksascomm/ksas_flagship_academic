<?php get_header(); ?>
<style>
.incsub_wiki_tabs, .incsub_wiki-subscribe {display: none; }
</style>
<div class="row wrapper radius10" id="page" role="main">
	<div class="twelve columns radius-left offset-topgutter">	
		<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
		<section class="content news">
			<h2><?php the_title(); ?></h2>
			<?php the_content(); ?>
		</section>
		<?php endwhile; endif; ?>
	</div>	<!-- End main content (left) section -->
</div> <!-- End #page -->
<?php get_footer(); ?>