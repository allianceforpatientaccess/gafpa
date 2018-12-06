<?php /* Template Name: Front Page */

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

	/* RESOURCES */

	// TAXONOMY ARRAYS
	$region_queries = array(
												'europe',
												'latin-america',
										);

	$media_queries = array(
												'posters',
												'reports',
												'fast-facts',
												'policy-papers',
												'infographics'
										);

	// the static part of the taxonomy queries
	$tax_query_slug                  =  array(
																					'taxonomy'  => 'attachment_tag',
																					'field'     => 'slug',
																					'operator'  => 'AND',
																			);

	$tax_arrays          = array();
	$regionQueriesCount  = 0;

	// generates an array of the specific taxonomy for each query
	for ($count = 0; $count < 10; $count++) {
			array_push( $tax_arrays, array_merge( $tax_query_slug, array( 'terms' => array( $region_queries[$regionQueriesCount], $media_queries[$count % 5] ) ) ) );

			if($count % 5 == 4) {
				$regionQueriesCount++;  // only increment every 5 cycles (to cycle through each media type for each region)
			}
	}

	// ARGUMENT ARRAYS
	// the static "resources" query
	$resources_tax_query = array(
													'taxonomy'  => 'attachment_category',
													'field'     => 'slug',
													'terms'     => 'resources',
												);

	// the static part of the WP_Query argument arrays
	$arg_array_slug = array(
												'post_type'       => 'attachment',  // media queries
												'posts_per_page'  => -1,            // all posts
												'post_status'     => 'inherit',     // WP Query defaults to post_status = 'default', whereas attachments are 'inherit'
										);

	$arg_arrays = array();
	$queries    = array();

	// generates an array of complete argument arrays for each query
	foreach ($tax_arrays as $tax_array) {
			array_push( $arg_arrays, array_merge( $arg_array_slug, array( 'tax_query' => array( $resources_tax_query, $tax_array ) ) ) );
	}

	// generates an array of the WP_Query objects
	foreach ($arg_arrays as $args) {
			array_push( $queries, new WP_Query( $args ) );
	}

	/* DISPLAY */

	// each array contains the text that will be displayed above the resources for each region & media type
	$region = array(
			"Europe",
			"Latin America",
	);

	$media = array(
			"Posters",
			"Reports",
			"Fast Facts",
			"Policy Papers",
			"Infographics",
	);

	$count = 0;       // print the corresponding header text for each query
	$regionCount = 0; // print the region every 5 cycles (1 cycle of the media array) ?>

	<style>
			input:checked ~ .menu-content {
				max-height: 100%;
			}
	</style>

	<script>
			$(document).ready( function() {
				var val;

				// listener for input clicks
				$("button").click( function() {
						$("section#" + val).css({"display":"none"}); // hide last section
						val = $(this).val(); // save the value of the new button
						$("section#" + val).css({"display":"flex"}); // display respective section (section ID == button value)
				});

			});
	</script>

	<section id="resource-background" style="background: white; padding: 50px 0 0 0;">	
		<section id="resource-container" style="width: 1000px; margin: auto; display: flex; justify-content: space-around;">

			<section id="resource-europe" style="width: 500px; text-align: center;">
				<h2 style="font-family: Fira Sans !important; color: #142945;">Europe</h2>

				<form style="display: flex; flex-direction: column; margin: 0 100px;">
					<?php foreach ($queries as $query) :
						$regionId;     // store region
						$mediaTypeId;  // store resource type
						
						// if there are posts for this specific region & media type, print media type header (input selection)
						if ($query->have_posts() && $count < 5) :
							$mediaTypeId = explode( " ", $media[$count % 5] )[0]; // use only the first word to avoid spaces in value/ID
							$mediaTypeText = $media[$count % 5]; ?>
							<button  class="btn btn-default btn-light" style="margin: 5px 0;" type="button" name="resource" value="<?php echo $regionId.'-'.$mediaTypeId; ?>"><?php echo $mediaTypeText; ?><br></button>
						<?php endif;

						// increment cycle counter
						$count++; ?>
					<?php endforeach; ?>
				</form>
			</section>

			<div class="divider divider-horizontal" style="width: 1px; height: auto;"></div>

			<section id="resource-latin-america" style="width: 500px; text-align: center;">
				<h2 style="font-family: Fira Sans !important; color: #142945;">Latin America</h2>

				<form style="display: flex; flex-direction: column; margin: 0 100px;">
					<?php $count = 5;
					foreach ($queries as $query) :
						$regionId;     // store region
						$mediaTypeId;  // store resource type
						
						// if there are posts for this specific region & media type, print media type header (input selection)
						if ($query->have_posts() && $count >= 10) :
							$mediaTypeId = explode( " ", $media[$count % 5] )[0]; // use only the first word to avoid spaces in value/ID
							$mediaTypeText = $media[$count % 5]; ?>
							<button  class="btn btn-default btn-light" style="margin: 5px 0;" type="button" name="resource" value="<?php echo $regionId.'-'.$mediaTypeId; ?>"><?php echo $mediaTypeText; ?><br></button>
						<?php endif;

						// increment cycle counter
						$count++; ?>
					<?php endforeach; ?>
				</form>
			</section>
		</section>
	</section>

<?php /* STATIC CONTENT */
if (strpos(get_permalink($post->ID), 'event') !== false) :
		get_template_part('templates/partials/sc', 'event-list');
endif;
?>