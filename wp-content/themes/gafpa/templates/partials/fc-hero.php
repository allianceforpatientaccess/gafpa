<?php
   $image_x = get_sub_field('image_x');
   $image = get_sub_field('image');
   $overlay = get_sub_field('overlay');
   $background_style = 'background-style-' . get_sub_field('content_background');
   $unique_class = get_sub_field('unique_class_name');
   $unique_id = get_sub_field('unique_id');

   // heading positioning
   $large_x = get_sub_field('large_x');
   $large_y = get_sub_field('large_y');
   $desktop_x = get_sub_field('desktop_x');
   $desktop_y = get_sub_field('desktop_y');
   $tablet_x = get_sub_field('tablet_x');
   $tablet_y = get_sub_field('tablet_y');
   $phone_x = get_sub_field('phone_x');
   $phone_y = get_sub_field('phone_y');

   $contentToShow = get_sub_field('content');
   $icon = get_sub_field('icon');
   $text = get_sub_field('text');
   $button = get_sub_field('button');

   echo "<div id='$unique_id' class='$unique_class $background_style fc-hero container-fluid' image-x='$image_x' style='background-image: url($image)'>";
   if($overlay) {
      echo "<div class='hero-content' large-x='$large_x' large-y='$large_y' desktop-x='$desktop_x' desktop-y='$desktop_y' tablet-x='$tablet_x' tablet-y='$tablet_y' phone-x='$phone_x' phone-y='$phone_y'>";

?>

      <?php
      $posts = get_sub_field('icon');
      if( $posts ): ?>
         <?php foreach( $posts as $post): // variable must be called $post (IMPORTANT) ?>
            <?php setup_postdata($post); ?>
            <?php $svg = get_field('svg'); ?>
               <div class="icon" style="text-align: center;">
                  <?php echo file_get_contents($svg); ?>
               </div>
            <?php endforeach; ?>
         <?php wp_reset_postdata(); // IMPORTANT - reset the $post object so the rest of the page works correctly ?>
      <?php endif; ?>


      <?php if(in_array('image/heading/text', $contentToShow) && $text) : ?>
         <div class="text">
            <?= $text ?>
         </div>
      <?php endif; ?>

      <?php if(in_array('button', $contentToShow) && $button) : ?>
         <div class="btn-wrapper">
            <a href="<?php echo $button['url']; ?>" class="btn btn-default btn-light" <?php echo $button['target']; ?>><?php echo $button['text']; ?></a>
         </div>
      <?php endif; ?>
      </div>
<?php } ?>
</div>
