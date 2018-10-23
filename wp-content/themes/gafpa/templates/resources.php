<?php /* Template Name: Resources */

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
                        'international'
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
   for ($count = 0; $count < 15; $count++) {
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
      "International",
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

      /*
       * TODO: id = concat region + resource type, expand when respective radio input = "checked"
       */
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

   <section style="background: white; padding: 50px 0 0 0;">
      <form style="display: flex; flex-direction: column; margin: 0 100px;">
         <?php foreach ($queries as $query) :
            $regionId;     // store region
            $mediaTypeId;  // store resource type

            // print respective region name every fifth cycle (one for each of the media types)
            if ($count % 5 == 0 && $count < 15) :
               $regionId = explode( " ", $region[$regionCount] )[0]; // use only the first word to avoid spaces in value/ID ?>
               <h2 id="<?php echo $regionId ?>" style="text-align: center; padding-top: 25px; color: #142945;"><?php echo $region[$regionCount]; ?></h2>
               <?php $regionCount++;
            endif;
            
            // if there are posts for this specific region & media type, print media type header (input selection)
            if ($query->have_posts()) :
               $mediaTypeId = explode( " ", $media[$count % 5] )[0]; // use only the first word to avoid spaces in value/ID
               $mediaTypeText = $media[$count % 5]; ?>
               <button  class="btn btn-default btn-light" style="margin: 5px 0;" type="button" name="resource" value="<?php echo $regionId.'-'.$mediaTypeId; ?>"><?php echo $mediaTypeText; ?><br></button>
            <?php endif;

            // increment cycle counter
            $count++; ?>

            <section id="<?php echo $regionId.'-'.$mediaTypeId; ?>" style="display: none; justify-content: center;">

               <?php // print post (The Loop)
               while ($query->have_posts()) :
                  $query->the_post();

                  $image_id = get_the_ID();
                  $alt_text = get_post_meta($image_id, '_wp_attachment_image_alt', true);   // holds the link for PDF media files

                  $image_attributes = wp_get_attachment_image_src($image_id, 'medium');

                  if (empty($alt_text)) : // if the alt text is empty, link to the file itself ?>

                     <article style="padding: 20px; display: flex; flex-direction: column; justify-content: center">
                        <p style="text-align: center;"><a style="color: #142945;" href="<?php echo the_permalink() ?>"><img src="<?php echo $image_attributes[0]; ?>" width="<?php echo $image_attributes[1]; ?>" height="<?php echo $image_attributes[2]; ?>" /></a></p>
                        <p style="text-align: center; max-width: 300px;"><a style="color: #142945;" href="<?php echo the_permalink() ?>"><?php echo the_title() ?></a></p>
                     </article>

                  <?php else : // else, link to the link pasted in alt text (for PDFs) ?>

                     <article style="padding: 20px; display: flex; flex-direction: column; justify-content: center">
                        <p style="text-align: center;"><a style="color: #142945;" href="<?php echo "http://".$alt_text ?>"><img src="<?php echo $image_attributes[0]; ?>" width="<?php echo $image_attributes[1]; ?>" height="<?php echo $image_attributes[2]; ?>" /></a></p>
                        <p style="text-align: center; max-width: 300px;"><a style="color: #142945;" href="<?php echo $alt_text ?>"><?php echo the_title() ?></a></p>
                     </article>

                  <?php endif;
               endwhile;
               wp_reset_postdata(); ?>

            </section>

         <?php endforeach; ?>
      </form>
   </section>

   <?php /* STATIC CONTENT */
   if (strpos(get_permalink($post->ID), 'event') !== false) :
      get_template_part('templates/partials/sc', 'event-list');
   endif;

   /* TODO: auto-generation of thumbnails for PDF media files
      $remote_image = file_get_contents($image_url);
      echo file_put_contents("remote_image.pdf", $remote_image);
      $im = new Imagick();
      $im->setResolution(300, 300);                               //set the resolution of the resulting jpg
      $im->readImage("remote_image.pdf[0]");                      //[0] for the first page
      $im->setImageFormat('jpg');
      header('Content-Type: image/jpeg');
      echo $im; 
   */

?>