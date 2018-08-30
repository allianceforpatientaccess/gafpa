<?php
   $columns = 6;
   if ($layout_style == 2 && $side == 'left') {
      $columns = $left_side_width;
   } elseif ($layout_style == 2 && $side == 'right') {
      $columns = 12 - $left_side_width;
   }

   $contentToShow = get_sub_field($side . '_side_content');
   $icon = get_sub_field($side . '_icon');
   $text = get_sub_field($side . '_text');
   $button = get_sub_field($side . '_button');
 ?>

<div class="text-side col-lg-<?php echo $columns ?> col-md-<?php echo $columns ?>">

   <?php
   $posts = get_sub_field('left_icon');
   if( $posts ): ?>
      <?php foreach( $posts as $post): // variable must be called $post (IMPORTANT) ?>
         <?php setup_postdata($post); ?>
         <?php $svg = get_field('svg'); ?>
            <div class="icon" style="text-align: <?= $heading_alignment ?>">
               <?php echo file_get_contents($svg); ?>
            </div>
         <?php endforeach; ?>
      <?php wp_reset_postdata(); // IMPORTANT - reset the $post object so the rest of the page works correctly ?>
   <?php endif; ?>

   <?php
   $posts = get_sub_field('right_icon');
   if( $posts ): ?>
      <?php foreach( $posts as $post): // variable must be called $post (IMPORTANT) ?>
         <?php setup_postdata($post); ?>
         <?php $svg = get_field('svg'); ?>
            <div class="icon" style="text-align: <?= $heading_alignment ?>">
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
         <a style="float: <?= $heading_alignment ?> href="<?php echo $button['url']; ?>" class="btn btn-default btn-light" <?php echo $button['target']; ?>><?php echo $button['text']; ?></a>
      </div>
   <?php endif; ?>
</div>
