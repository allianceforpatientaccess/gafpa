<div class="container-fluid event-list">
      <?php
         $posts = get_posts(array(
            'post_type'      => 'events',
            'posts_per_page' => -1,
            'meta_key'			=> 'end_date',
            'meta_compare' => '>=', // hide old events
            'meta_value' => date("Ymd"), // hide old events
         	'orderby'			=> 'meta_value_num',
         	'order'				=> 'ASC'
         ));
      ?>
      <?php if( $posts ) { ?>
         <?php foreach( $posts as $post) { ?>
            <?php setup_postdata($post); ?>
            <div class="event-wrapper">
               <h3><a href="<?php echo get_permalink( $post->ID ); ?>"><?php echo get_the_title( $post->ID ); ?></a></h3>
               <p><?= get_field('start_date') . '-' . get_field('end_date') . '<br>' . get_field('address_line_2') ?></p>
               <div class="btn-wrapper">
                  <a href="<?php echo get_permalink( $post->ID ); ?>" class="btn btn-default">READ MORE</a>
               </div>
               <?php if(get_field('sponsored')) { echo '<div class="sponsored">SPONSORED BY: <img src=/wp-content/themes/gafpa/assets/images/logo1.png></div>'; }?>
            </div>
         <?php } ?>
         <?php wp_reset_postdata(); ?>
      <?php } ?>
</div>
