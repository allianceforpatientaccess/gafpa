<?php while (have_posts()) : the_post(); ?>
   <div class="event-detail-wrapper">
      <div class="event-description container-fluid">
         <div class="container">
            <div class="col-sm-12">
               <h3><?php the_title(); ?></h3>
            </div>
            <div class="col-sm-11 col-sm-push-1 text description">
               <?php the_field('description'); ?>
            </div>
         </div>
      </div>
      <div id="" class="event-details fc-two-up container-fluid layout-style-1 " style="padding-top: 100px; padding-bottom: 100px;">
         <div class="container">
            <div class="image-side col-lg-6 col-md-6">
               <img class="img-responsive" src="<?php the_field('image'); ?>">
            </div>
            <div class="text-side col-lg-6 col-md-6">
               <p class="location"><?php the_field('location'); ?></p>
               <p class="dates"><?php the_field('start_date'); ?> - <?php the_field('end_date'); ?></p>
               <p class="address"><?= get_field('address_line_1') . '<br>' . get_field('address_line_2'); ?></p>
               <div class="btn-wrapper">
                  <a href="<?php the_field('map_link'); ?>" target="_blank" class="btn btn-default">VIEW MAP</a>
               </div>
               <!-- <div class="links">
                  <a class="link" href="<?php the_field('calendar_link'); ?>">Add to my calendar</a><span> | </span><a class="link" href="<?php the_field('ics_link'); ?>">Download ICS</a>
               </div> -->
            </div>
         </div>
      </div>
      <?php if(get_field('form_text_and_form')) : ?>
         <div class="event-form fc-list container-fluid color-style-2">
            <div class="container">
               <div class="row">
                  <div class="col-sm-12">
                     <h3><?php the_field('form_heading'); ?></h3>
                     <div class="text">
                        <?php the_field('form_text_and_form'); ?>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      <?php endif; ?>

   </div>
<?php endwhile; ?>
