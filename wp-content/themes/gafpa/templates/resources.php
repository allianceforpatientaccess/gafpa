<?php 
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
         /*elseif( get_row_layout() == 'fc_two_up' ): // commented out so as not to duplicate the custom field display at the bottom of the page (videos)
            get_template_part('templates/partials/fc', 'two-up');*/
         elseif( get_row_layout() == 'fc_heading' ):
            get_template_part('templates/partials/fc', 'heading');
         endif;
      endwhile;
	 endif;
?>

<script> // years display
jQuery(document).ready(function( $ ) {

	// Display/hide years
	$('.clickable').on('click', function() {
			var itemClassYear = $(this).attr('itemYear'); // the activated (clicked) year
			var itemClassType = $(this).attr('itemType'); // resource type
			console.log(itemClassType+'.'+itemClassYear);

			// reset display
			$('.years.' + itemClassType).children().css({"color":"#B5B5B5"}); // color everything as unfocused (gray)
			$('.split-page-no-thumbnail.' + itemClassType).children().css({"display":"none"}) // hide all articles

			// color this year
			$(this).css({"color":"#282f5d"});

			// display selected year's posts
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
		array_push( $tax_arrays, array_merge( $tax_query_slug, array( 'terms' => array( get_query_var( 'region' ), $media_queries[$count % 5] ) ) ) );
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

	$count = 0; // reset for the below loop
?>

<main role="main">

	<div class="split-page-main">
		<div class="split-page-multi-container">

			<?php foreach ($queries as $query) :
				$mediaTypeId;  // store resource type
				
				// only display section if there are resources of the specific media type
				if ($query->have_posts()) :
					$mediaTypeId = $media_queries[$count]; ?>
					
					<!-- RESOURCE DISPLAY -->
					<div class="split-page-container" id="<?php echo $mediaTypeId; ?>">
						<section class="split-page-left">
							<h2 class="page-header"><?php echo str_replace( '-', ' ', $media_queries[$count] ) // replace the dashes used in the query args ?></h2>
							<section class="split-page-with-thumbnail">
								<?php
									$recent_posts = $thumbnail_queries[$count];
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
						<!-- /recent -->

						<div class="divider divider-horizontal" style="margin: 100px 0 20px 0; width:1px; height: auto;"></div>

						<!-- archive -->
						<section class="split-page-right">
							<div style="width: inherit; height: 100px"></div>

							<!-- years -->
							<section class="years <?php echo $mediaTypeId; ?>">
								<?php
								$years = array();
								$recent_posts = $queries[$count];

								while($recent_posts->have_posts()) {
									$recent_posts->the_post();

									if(!in_array(get_the_date('Y'), $years)) {
										array_push($years, get_the_date('Y'));
									}
								}
								wp_reset_postdata();

								//print years
								foreach ($years as $year) : ?>
									<h1 class="clickable year" id="<?php echo $mediaTypeId; ?>-<?php echo $year ?>" itemYear="<?php echo $year ?>" itemType="<?php echo $mediaTypeId; ?>"><?php echo $year ?></h1>
								<?php endforeach; ?>

									<script type="text/javascript">
										// set resource type year to most recent year (to activate on page load — see script at bottom)
										var <?php echo str_replace( '-', '', $mediaTypeId); ?>Year = "<?php echo $years[0] ?>";
									</script>

							</section>
							<!-- /years -->
							
							<!-- archive articls -->
							<section class="split-page-no-thumbnail reports">
								<?php foreach ($years as $year) :
									$recent_posts = new WP_Query( array_merge( $arg_arrays[$count], array( 'year' => $year ) ) ); // generate a WP Query with the additional param of 'year'
									while($recent_posts->have_posts()) :
										$recent_posts->the_post(); ?>

										<section class="split-page-no-thumbnail-article reports <?php echo $year ?>">
											<a class="no-thumbnail-article-title" href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
											<p class="no-thumbnail-article-date" href="<?php the_permalink(); ?>" style="font-size: .7em; text-transform: uppercase;"><?php the_time('F Y'); ?></p>
										</section>

									<?php endwhile;
								endforeach;
								wp_reset_postdata(); ?>
							</section>
							<!-- /archive articles -->
						</section>
						<!-- /archive -->
					</div>
					<!-- /RESOURCE DISPLAY -->

					<div class="divider" style="margin: 2em auto 0 auto; width: 1000px; height: 1px;"></div>

				<?php endif;
				$count++;	// increment counter
			endforeach; ?>

			<!-- VIDEOS -->
			<div id="videos-container" style="margin: auto; max-width: 1000px !important;">
				<div style="width: 65%;">
					<h2 class="page-header">Videos</h2>
				</div>

				<?php /* FLEXIBLE CONTENT: VIDEO SECTION */
				// checks to see if two-up is in use, works under the assumption that two-up won't be in use at the top of the page
					if( have_rows('fc_panels') ):
						while ( have_rows('fc_panels') ) : the_row();
								if( get_row_layout() == 'fc_two_up' ):
									get_template_part('templates/partials/fc', 'two-up');
								endif;
						endwhile;
					endif; 
				?>

			</div>
			<!-- /videos -->
			
		</div>
	</div>
</main>

<script type="text/javascript">
	// activate (click) the most recent year on load
	// try/catch used to avoid console errors (incase the section wasn't displayed)
	// TODO: move this into the foreach loop
	jQuery(document).ready(function( $ ) {
		  try { $("#reports-"+reportsYear).click(); } catch(e) {}
			try { $("#posters-"+postersYear).click(); } catch(e) {}
			try { $("#fast-facts-"+fastfactsYear).click(); } catch(e) {}
			try { $("#policy-papers-"+policypapersYear).click(); } catch(e) {}
			try { $("#infographics-"+infographicsYear).click(); } catch(e) {}
	});
</script>