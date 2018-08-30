<select class="color-style-dropdown">
   <?php
   if( have_rows('color_styles', 'option') ) {
      $count = 0;
       while( have_rows('color_styles', 'option') ) {
          $count++;
           the_row();
           if ($count == $color_style) {
             ?>
            <option value="<?php echo $count ?>" selected>color-style-<?php echo $count ?></option>
            <?php
          } else {
           ?>
           <option value="<?php echo $count ?>">color-style-<?php echo $count ?></option>
           <?php
        }
       }
   }
   ?>
</select>