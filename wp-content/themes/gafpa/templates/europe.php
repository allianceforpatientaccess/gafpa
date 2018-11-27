<?php /*Template Name: Europe*/

//error_reporting(E_ALL & ~E_NOTICE); // ignore the offset notices (used in the below syntax)

   /* FLEXIBLE CONTENT */
   if( have_rows('fc_panels') ):
      while ( have_rows('fc_panels') ) : the_row();
         if( get_row_layout() == 'fc_hero' ):
            get_template_part('templates/partials/fc', 'hero');
         elseif( get_row_layout() == 'fc_list' ):
            get_template_part('templates/partials/fc', 'list');
         elseif( get_row_layout() == 'fc_page_title' ):
            get_template_part('templates/partials/fc', 'page-title');
         elseif( get_row_layout() == 'fc_slider' ):
            get_template_part('templates/partials/fc', 'slider');
         elseif( get_row_layout() == 'fc_two_up' ):
            get_template_part('templates/partials/fc', 'two-up');
         elseif( get_row_layout() == 'fc_heading' ):
            get_template_part('templates/partials/fc', 'heading');
         endif;
      endwhile;
	 endif;
?>

<script>
// years display
// TODO: insert jquery in footer, rather than header
jQuery(document).ready(function( $ ) {

	// Display/hide years
	$('.clickable').on('click', function() {
			var itemClassYear = $(this).attr('itemYear');
			var itemClassType = $(this).attr('itemType'); // used to distinguish b/w diff types of policy papers

			// reset display
			$('.years.' + itemClassType).children().css({"color":"#B5B5B5"}); // color everything as unfocused (gray)
			$('.split-page-no-thumbnail.' + itemClassType).children().css({"display":"none"}) // hide all articles

			// color this year
			$(this).css({"color":"#282f5d"});

			// woot woot! display selected year's posts
			$('.' + itemClassType + '.' + itemClassYear).css({"display":"flex"});
	});
});
</script>

<?php /* RESOURCE QUERY LOGIC */

	// TAXONOMY (TAG) ARRAYS
	$media_queries = array(
		'reports',
		'posters',
		'fast-facts',
		'policy-papers',
		'infographics'
	);

	// the static part of the taxonomy queries
	$tax_query_slug = array(
		'taxonomy'  => 'attachment_tag',
		'field'     => 'slug',
		'operator'  => 'AND',
	);

	$tax_arrays = array();

	// generates an array of the specific taxonomy for each query
	for ($count = 0; $count < 5; $count++) {
		array_push( $tax_arrays, array_merge( $tax_query_slug, array( 'terms' => array( 'europe', $media_queries[$count % 5] ) ) ) );
	}

	// ARGUMENT ARRAYS
	// the static "resources" query
	$resources_tax_query = array(
				'taxonomy'  => 'attachment_category',
				'field'     => 'slug',
				'terms'     => 'resources',
		);

	// the static parts of the WP_Query argument arrays
	$arg_array_slug = array(
		'post_type'       => 'attachment',  // media queries
		'posts_per_page'  => -1,            // all posts
		'post_status'     => 'inherit',     // WP Query defaults to post_status = 'default', whereas attachments are 'inherit'
	);

	$thumbnail_arg_array_slug = array(
		'post_type'       => 'attachment',  // media queries
		'posts_per_page'  => 2,            	// only two posts display on the left-hand side (thumbnail)
		'post_status'     => 'inherit',     // WP Query defaults to post_status = 'default', whereas attachments are 'inherit'
	);

	$year_arg_array_slug = array(
		'post_type'       => 'attachment',  // media queries
		'posts_per_page'  => 2,            	// only two posts display on the left-hand side (thumbnail)
		'post_status'     => 'inherit',     // WP Query defaults to post_status = 'default', whereas attachments are 'inherit'
	);

	// the argument arrays that will be used to generate WP queries
	$arg_arrays 					= array();
	$thumbnail_arg_arrays = array();

	// the actual WP queries
	$queries    					= array();
	$thumbnail_queries		= array();

	// generates an array of complete argument arrays w/ all posts (for generating years & archive arrays)
	foreach ($tax_arrays as $tax_array) {
		array_push( $arg_arrays, array_merge( $arg_array_slug, array( 'tax_query' => array( $resources_tax_query, $tax_array ) ) ) );
	}

	// generates an array of complete argument arrays for the thumbnail display (only 2 posts)
	foreach ($tax_arrays as $tax_array) {
		array_push( $thumbnail_arg_arrays, array_merge( $thumbnail_arg_array_slug, array( 'tax_query' => array( $resources_tax_query, $tax_array ) ) ) );
	}

	// generates an array of the WP_Query objects
	foreach ($arg_arrays as $args) {
		array_push( $queries, new WP_Query( $args ) );
	}

	// generates an array of the WP_Query objects
	foreach ($thumbnail_arg_arrays as $args) {
		array_push( $thumbnail_queries, new WP_Query( $args ) );
	}

?>

<main role="main">

	<div id="split-page-main">
		<div id="split-page-multi-container">

			<!-- REPORTS -->
			<div id="split-page-container">

				<!-- recent reports -->
				<section id="split-page-left">
					<h1 class="page-header"><?php echo str_replace( '-', ' ', $media_queries[0] ) // replace the dashes used in the query args ?></h1>
					<section id="split-page-with-thumbnail">
						<?php
							$recent_posts = $thumbnail_queries[0]; // 'reports' query
							while($recent_posts->have_posts()) : $recent_posts->the_post();
								$image_id = get_the_ID();
                $alt_text = get_post_meta($image_id, '_wp_attachment_image_alt', true);   // holds the link for PDF media files
								$image_attributes = wp_get_attachment_image_src($image_id, 'medium');
						?>
							<section class="split-page-with-thumbnail-article">
								<a href="<?php the_permalink(); ?>"><img src="<?php echo $image_attributes[0]; ?>" width="<?php echo $image_attributes[1]; ?>" height="<?php echo $image_attributes[2]; ?>" /></a>
								<a class="thumbnail-article-title" href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
								<p class="thumbnail-article-date" href="<?php the_permalink(); ?>"><?php the_time('F Y'); ?></p>
							</section>
						<?php
							endwhile;
							wp_reset_postdata();	
						?>
					</section>
				</section>
				<!-- /recent reports -->

				<div class="divider divider-horizontal" style="margin: 100px 0 20px 0; width:1px; height: auto;"></div>

				<!-- reports archive -->
				<section id="split-page-right">
					<div style="width: inherit; height: 100px"></div>

					<!-- years -->
					<section class="years reports">
						<?php
							$years = array();
							$recent_posts = $queries[0]; // TODO: replace with the correct WP query

							while($recent_posts->have_posts()) {
								$recent_posts->the_post();

								if(!in_array(get_the_date('Y'), $years)) {
									array_push($years, get_the_date('Y'));
								}
							}
							wp_reset_postdata();

							//print years
							foreach ($years as $year) :
						?>
								<h1 class="clickable year" id="reports-<?php echo $year ?>" itemYear="<?php echo $year ?>" itemType="reports"><?php echo $year ?></h1>

							<?php endforeach; ?>

							<script type="text/javascript">
								// set resource type year to most recent year (to activate on page load — see script at bottom)
								var reportsYear = "<?php echo $years[0] ?>";
							</script>

					</section>
					<!-- /years -->
					
					<!-- archive -->
					<section class="split-page-no-thumbnail reports">
						<?php
							foreach ($years as $year) :
								$recent_posts = new WP_Query( array_merge( $arg_arrays[0], array( 'year='.$year ) ) ); // generate a WP Query with the additional arg of the dynamically generated years
								while($recent_posts->have_posts()) :
									$recent_posts->the_post();
						?>
									<section class="split-page-no-thumbnail-article reports <?php echo $year ?>">

										<a class="no-thumbnail-article-title" href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
										
										<p class="no-thumbnail-article-date" href="<?php the_permalink(); ?>" style="font-size: .7em; text-transform: uppercase;"><?php the_time('F Y'); ?></p>

									</section>
						<?php
									$count++;
								endwhile;
							endforeach;
							wp_reset_postdata();	
						?>
					</section>
					<!-- /archive -->
				</section>
				<!-- /reports archive -->
			</div>
			<!-- /reports -->

			<div class="divider" style="margin: 2em auto 0 auto; width: 1000px; height: 1px;"></div>

			<!-- posters -->
			<div id="split-page-container">

				<!-- recent posters -->
				<section id="split-page-left">
					<h1 class="page-header"><?php echo str_replace( '-', ' ', $media_queries[1] ) // replace the dashes used in the query args ?></h1>
					<section id="split-page-with-thumbnail">
						<?php
							$recent_posts = $thumbnail_queries[1]; // 'posters' query
							while($recent_posts->have_posts()) : $recent_posts->the_post();
								$image_id = get_the_ID();
                $alt_text = get_post_meta($image_id, '_wp_attachment_image_alt', true);   // holds the link for PDF media files
								$image_attributes = wp_get_attachment_image_src($image_id, 'medium');
						?>
							<section class="split-page-with-thumbnail-article">
								<a href="<?php the_permalink(); ?>"><img src="<?php echo $image_attributes[0]; ?>" width="<?php echo $image_attributes[1]; ?>" height="<?php echo $image_attributes[2]; ?>" /></a>
								<a class="thumbnail-article-title" href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
								<p class="thumbnail-article-date" href="<?php the_permalink(); ?>"><?php the_time('F Y'); ?></p>
							</section>
						<?php
							endwhile;
							wp_reset_postdata();	
						?>
					</section>
				</section>
				<!-- /recent posters -->

				<div class="divider divider-horizontal" style="margin: 100px 0 20px 0; width:1px; height: auto;"></div>

				<!-- posters archive -->
				<section id="split-page-right">
					<div style="width: inherit; height: 100px"></div>

					<!-- years -->
					<section class="years posters">
						<?php
							$years = array();
							$recent_posts = $queries[1]; // TODO: replace with the correct WP query

							while($recent_posts->have_posts()) {
								$recent_posts->the_post();

								if(!in_array(get_the_date('Y'), $years)) {
									array_push($years, get_the_date('Y'));
								}
							}
							wp_reset_postdata();

							//print years
							foreach ($years as $year) :
						?>
								<h1 class="clickable year" id="posters-<?php echo $year ?>" itemYear="<?php echo $year ?>" itemType="posters"><?php echo $year ?></h1>

							<?php endforeach; ?>

							<script type="text/javascript">
								// set resource type year to most recent year (to activate on page load — see script at bottom)
								var postersYear = "<?php echo $years[0] ?>";
							</script>

					</section>
					<!-- /years -->
					
					<!-- archive -->
					<section class="split-page-no-thumbnail posters">
						<?php
							foreach ($years as $year) :
								$recent_posts = new WP_Query( array_merge( $arg_arrays[1], array( 'year='.$year ) ) ); // generate a WP Query with the additional arg of the dynamically generated years
								while($recent_posts->have_posts()) :
									$recent_posts->the_post();
						?>
									<section class="split-page-no-thumbnail-article posters <?php echo $year ?>">

										<a class="no-thumbnail-article-title" href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
										
										<p class="no-thumbnail-article-date" href="<?php the_permalink(); ?>" style="font-size: .7em; text-transform: uppercase;"><?php the_time('F Y'); ?></p>

									</section>
						<?php
									$count++;
								endwhile;
							endforeach;
							wp_reset_postdata();	
						?>
					</section>
					<!-- /archive -->
				</section>
				<!-- /posters archive -->
			</div>
			<!-- /posters -->

			<div class="divider" style="margin: 2em auto 0 auto; width: 1000px; height: 1px;"></div>

			<!-- fast-facts -->
			<div id="split-page-container">

				<!-- recent fast-facts -->
				<section id="split-page-left">
					<h1 class="page-header"><?php echo str_replace( '-', ' ', $media_queries[2] ) // replace the dashes used in the query args ?></h1>
					<section id="split-page-with-thumbnail">
						<?php
							$recent_posts = $thumbnail_queries[2]; // 'fast-facts' query
							while($recent_posts->have_posts()) : $recent_posts->the_post();
								$image_id = get_the_ID();
                $alt_text = get_post_meta($image_id, '_wp_attachment_image_alt', true);   // holds the link for PDF media files
								$image_attributes = wp_get_attachment_image_src($image_id, 'medium');
						?>
							<section class="split-page-with-thumbnail-article">
								<a href="<?php the_permalink(); ?>"><img src="<?php echo $image_attributes[0]; ?>" width="<?php echo $image_attributes[1]; ?>" height="<?php echo $image_attributes[2]; ?>" /></a>
								<a class="thumbnail-article-title" href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
								<p class="thumbnail-article-date" href="<?php the_permalink(); ?>"><?php the_time('F Y'); ?></p>
							</section>
						<?php
							endwhile;
							wp_reset_postdata();	
						?>
					</section>
				</section>
				<!-- /recent fast-facts -->

				<div class="divider divider-horizontal" style="margin: 100px 0 20px 0; width:1px; height: auto;"></div>

				<!-- fast-facts archive -->
				<section id="split-page-right">
					<div style="width: inherit; height: 100px"></div>

					<!-- years -->
					<section class="years fast-facts">
						<?php
							$years = array();
							$recent_posts = $queries[2]; // TODO: replace with the correct WP query

							while($recent_posts->have_posts()) {
								$recent_posts->the_post();

								if(!in_array(get_the_date('Y'), $years)) {
									array_push($years, get_the_date('Y'));
								}
							}
							wp_reset_postdata();

							//print years
							foreach ($years as $year) :
						?>
								<h1 class="clickable year" id="fastFacts-<?php echo $year ?>" itemYear="<?php echo $year ?>" itemType="fast-facts"><?php echo $year ?></h1>

							<?php endforeach; ?>

							<script type="text/javascript">
								// set resource type year to most recent year (to activate on page load — see script at bottom)
								var fastFactsYear = "<?php echo $years[0] ?>";
							</script>

					</section>
					<!-- /years -->
					
					<!-- archive -->
					<section class="split-page-no-thumbnail fast-facts">
						<?php
							foreach ($years as $year) :
								$recent_posts = new WP_Query( array_merge( $arg_arrays[2], array( 'year='.$year ) ) ); // generate a WP Query with the additional arg of the dynamically generated years
								while($recent_posts->have_posts()) :
									$recent_posts->the_post();
						?>
									<section class="split-page-no-thumbnail-article fast-facts <?php echo $year ?>">

										<a class="no-thumbnail-article-title" href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
										
										<p class="no-thumbnail-article-date" href="<?php the_permalink(); ?>" style="font-size: .7em; text-transform: uppercase;"><?php the_time('F Y'); ?></p>

									</section>
						<?php
									$count++;
								endwhile;
							endforeach;
							wp_reset_postdata();	
						?>
					</section>
					<!-- /archive -->
				</section>
				<!-- /fast-facts archive -->
			</div>
			<!-- /fast-facts -->

			<div class="divider" style="margin: 2em auto 0 auto; width: 1000px; height: 1px;"></div>

			<!-- policy-papers -->
			<div id="split-page-container">

				<!-- recent policy-papers -->
				<section id="split-page-left">
					<h1 class="page-header"><?php echo str_replace( '-', ' ', $media_queries[3] ) // replace the dashes used in the query args ?></h1>
					<section id="split-page-with-thumbnail">
						<?php
							$recent_posts = $thumbnail_queries[3]; // 'policy-papers' query
							while($recent_posts->have_posts()) : $recent_posts->the_post();
								$image_id = get_the_ID();
                $alt_text = get_post_meta($image_id, '_wp_attachment_image_alt', true);   // holds the link for PDF media files
								$image_attributes = wp_get_attachment_image_src($image_id, 'medium');
						?>
							<section class="split-page-with-thumbnail-article">
								<a href="<?php the_permalink(); ?>"><img src="<?php echo $image_attributes[0]; ?>" width="<?php echo $image_attributes[1]; ?>" height="<?php echo $image_attributes[2]; ?>" /></a>
								<a class="thumbnail-article-title" href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
								<p class="thumbnail-article-date" href="<?php the_permalink(); ?>"><?php the_time('F Y'); ?></p>
							</section>
						<?php
							endwhile;
							wp_reset_postdata();	
						?>
					</section>
				</section>
				<!-- /recent policy-papers -->

				<div class="divider divider-horizontal" style="margin: 100px 0 20px 0; width:1px; height: auto;"></div>

				<!-- policy-papers archive -->
				<section id="split-page-right">
					<div style="width: inherit; height: 100px"></div>

					<!-- years -->
					<section class="years policy-papers">
						<?php
							$years = array();
							$recent_posts = $queries[3]; // TODO: replace with the correct WP query

							while($recent_posts->have_posts()) {
								$recent_posts->the_post();

								if(!in_array(get_the_date('Y'), $years)) {
									array_push($years, get_the_date('Y'));
								}
							}
							wp_reset_postdata();

							//print years
							foreach ($years as $year) :
						?>
								<h1 class="clickable year" id="policyPapers-<?php echo $year ?>" itemYear="<?php echo $year ?>" itemType="policy-papers"><?php echo $year ?></h1>

							<?php endforeach; ?>

							<script type="text/javascript">
								// set resource type year to most recent year (to activate on page load — see script at bottom)
								var policyPapersYear = "<?php echo $years[0] ?>";
							</script>

					</section>
					<!-- /years -->
					
					<!-- archive -->
					<section class="split-page-no-thumbnail policy-papers">
						<?php
							foreach ($years as $year) :
								$recent_posts = new WP_Query( array_merge( $arg_arrays[3], array( 'year='.$year ) ) ); // generate a WP Query with the additional arg of the dynamically generated years
								while($recent_posts->have_posts()) :
									$recent_posts->the_post();
						?>
									<section class="split-page-no-thumbnail-article policy-papers <?php echo $year ?>">

										<a class="no-thumbnail-article-title" href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
										
										<p class="no-thumbnail-article-date" href="<?php the_permalink(); ?>" style="font-size: .7em; text-transform: uppercase;"><?php the_time('F Y'); ?></p>

									</section>
						<?php
									$count++;
								endwhile;
							endforeach;
							wp_reset_postdata();	
						?>
					</section>
					<!-- /archive -->
				</section>
				<!-- /policy-papers archive -->
			</div>
			<!-- /policy-papers -->

			<div class="divider" style="margin: 2em auto 0 auto; width: 1000px; height: 1px;"></div>

			<!-- infographics -->
			<div id="split-page-container">

				<!-- recent infographics -->
				<section id="split-page-left">
					<h1 class="page-header"><?php echo str_replace( '-', ' ', $media_queries[4] ) // replace the dashes used in the query args ?></h1>
					<section id="split-page-with-thumbnail">
						<?php
							$recent_posts = $thumbnail_queries[4]; // 'infographics' query
							while($recent_posts->have_posts()) : $recent_posts->the_post();
								$image_id = get_the_ID();
                $alt_text = get_post_meta($image_id, '_wp_attachment_image_alt', true);   // holds the link for PDF media files
								$image_attributes = wp_get_attachment_image_src($image_id, 'medium');
						?>
							<section class="split-page-with-thumbnail-article">
								<a href="<?php the_permalink(); ?>"><img src="<?php echo $image_attributes[0]; ?>" width="<?php echo $image_attributes[1]; ?>" height="<?php echo $image_attributes[2]; ?>" /></a>
								<a class="thumbnail-article-title" href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
								<p class="thumbnail-article-date" href="<?php the_permalink(); ?>"><?php the_time('F Y'); ?></p>
							</section>
						<?php
							endwhile;
							wp_reset_postdata();	
						?>
					</section>
				</section>
				<!-- /recent infographics -->

				<div class="divider divider-horizontal" style="margin: 100px 0 20px 0; width:1px; height: auto;"></div>

				<!-- infographics archive -->
				<section id="split-page-right">
					<div style="width: inherit; height: 100px"></div>

					<!-- years -->
					<section class="years infographics">
						<?php
							$years = array();
							$recent_posts = $queries[4]; // TODO: replace with the correct WP query

							while($recent_posts->have_posts()) {
								$recent_posts->the_post();

								if(!in_array(get_the_date('Y'), $years)) {
									array_push($years, get_the_date('Y'));
								}
							}
							wp_reset_postdata();

							//print years
							foreach ($years as $year) :
						?>
								<h1 class="clickable year" id="infographics-<?php echo $year ?>" itemYear="<?php echo $year ?>" itemType="infographics"><?php echo $year ?></h1>

							<?php endforeach; ?>

							<script type="text/javascript">
								// set resource type year to most recent year (to activate on page load — see script at bottom)
								var infographicsYear = "<?php echo $years[0] ?>";
							</script>

					</section>
					<!-- /years -->
					
					<!-- archive -->
					<section class="split-page-no-thumbnail infographics">
						<?php
							foreach ($years as $year) :
								$recent_posts = new WP_Query( array_merge( $arg_arrays[4], array( 'year='.$year ) ) ); // generate a WP Query with the additional arg of the dynamically generated years
								while($recent_posts->have_posts()) :
									$recent_posts->the_post();
						?>
									<section class="split-page-no-thumbnail-article infographics <?php echo $year ?>">

										<a class="no-thumbnail-article-title" href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
										
										<p class="no-thumbnail-article-date" href="<?php the_permalink(); ?>" style="font-size: .7em; text-transform: uppercase;"><?php the_time('F Y'); ?></p>

									</section>
						<?php
									$count++;
								endwhile;
							endforeach;
							wp_reset_postdata();	
						?>
					</section>
					<!-- /archive -->
				</section>
				<!-- /infographics archive -->
			</div>
			<!-- /infographics -->

			<div class="divider" style="margin: 2em auto 0 auto; width: 1000px; height: 1px;"></div>

		</div>
	</div>
</main>

<?php get_template_part('recent-posts'); ?>

<script type="text/javascript">
	// activate (click) the most recent year on load
	jQuery(document).ready(function( $ ) {
		  $("#reports-"+reportsYear).click();
			$("#posters-"+postersYear).click();
			$("#fastFacts-"+fastFactsYear).click();
			$("#policyPapers-"+policyPapersYear).click();
			$("#infographics-"+infographicsYear).click();
	});
</script>