<?php
/*
Template Name: Courses Undergrad
*/
?>	
<?php get_header(); ?>
 
<?php // Load Zebra Curl
	require_once TEMPLATEPATH . "/assets/functions/Zebra_cURL.php";
	
	//Set query sting variables
		$department = 'Philosophy';
		$fall = 'fall%202013';
		$spring = 'spring%202014';
		$key = 'oSj6cT1PEZMKytiQThK1P1KqH86pIpiw';
		
	//Create first Zebra Curl class
		$course_curl = new Zebra_cURL();
		$cache_dir = TEMPLATEPATH . "/assets/functions/cache/";
		$course_curl->cache($cache_dir, 3600);
 
	//Create API Url calls
		$courses_spring_url = 'https://isistest.isis.jhu.edu/api/classes?key=' . $key . '&School=Krieger%20School%20of%20Arts%20and%20Sciences&Term=' . $spring . '&Department=AS%20' . $department;
		$courses_fall_url = 'https://isistest.isis.jhu.edu/api/classes?key=' . $key . '&School=Krieger%20School%20of%20Arts%20and%20Sciences&Term=' . $fall . '&Department=AS%20' . $department;
		$courses_call = array($courses_spring_url, $courses_fall_url);
function display_courses($result) {
    $result->body = json_decode(html_entity_decode($result->body));
	$title = $result->body[0]->{'Title'};
	$term = $result->body[0]->{'Term'};
	$course_number = $result->body[0]->{'OfferingName'};
	$credits = $result->body[0]->{'Credits'};
	$instructor = $result->body[0]->{'InstructorsFullName'};
	$description = $result->body[0]->{'SectionDetails'}[0]->{'Description'};
    // show everything
    echo '<li class="' . $term . '"><div class="title"><h5><span class="course-number">' . $course_number . '</span> - ' . $title . '</h5></div>';
    echo '<div class="content"><p>' . $description . '</p>';
    echo '<p><b>Credits: </b>' . $credits . '<br><b>Instructor: </b>' . $instructor . '<br><b>Term: </b>' . $term . '</p>'; 
    echo '</div></li>';
 
}
		
		function parse_courses($result) {
			$key = 'oSj6cT1PEZMKytiQThK1P1KqH86pIpiw';
			
			$result->body = json_decode(html_entity_decode($result->body));
			$course_data = array();
				foreach($result->body as $course) {
					$section = $course->{'SectionName'};
					$level = $course->{'Level'};
					if($section === '01' && strpos($level, 'Undergraduate') !== false) {
						$number = $course->{'OfferingName'};
						$term = $course->{'Term'};
						$clean_term = str_replace(' ', '%20', $term);
						$clean_number = preg_replace('/[^A-Za-z0-9\-]/', '', $number);
						$details_url = 'https://isistest.isis.jhu.edu/api/classes/' . $clean_number . '01/' . $clean_term . '?key=' . $key;
						$course_data[] = $details_url;					
					}
				}
			$curl = new Zebra_cURL();
			$curl->cache($cache_dir, 3600);
			$curl->get($course_data, 'display_courses');
 
		}
	
// instantiate the Zebra_cURL class
?>	
 
<div class="row sidebar_bg radius10" id="page">
	<div class="eight columns wrapper radius-left offset-topgutter">	
		<?php locate_template('parts-nav-breadcrumbs.php', true, false); ?>	
		<section class="content">
			<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
				<h2><?php the_title();?></h2>
				<?php the_content(); ?>
				
			<?php endwhile; endif;  ?>
					<div id="fields_search">
			<form action="#">
				<fieldset class="radius10">
							<div class="row filter option-set" data-filter-group="term">
									<div class="button radio"><a href="#" data-filter="" class="selected">View All</a></div>
									<div class="button radio"><a href="#" data-filter=".Fall">Fall Courses</a></div>
									<div class="button radio"><a href="#" data-filter=".Spring">Spring Courses</a></div>
							</div>
					<div class="row">		
						<input type="submit" class="icon-search" placeholder="Search by course number, title, and keyword" value="&#xe004;" />
						<input type="text" name="search" id="id_search"  /> 
					</div>
				</fieldset>
			</form>	
		</div>

			<ul class="expander accordion courses">
			<?php 
				  $course_curl->get($courses_call, 'parse_courses');
				  	?>
			</ul>
			
		</section>
	</div>	<!-- End main content (left) section -->
<?php locate_template('parts-sidebar.php', true, false); ?>
</div> <!-- End #landing -->
<?php get_footer(); ?>