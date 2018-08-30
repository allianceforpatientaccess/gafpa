<?php
// FONTS - GLOBAL
$g_font = get_field('font_body_family','option');
$g_font_variants = $g_font['variants'];
?>
@import url(https://fonts.googleapis.com/css?family=<?php echo $g_font['font'];?>:<?php echo implode(',',$g_font_variants); ?>);

<?php
// FONTS - HEADINGS PRIMARY
$h_font = get_field('font_headings_family','option');
$h_font_variants = $h_font['variants'];
?>
@import url(https://fonts.googleapis.com/css?family=<?php echo $h_font['font'];?>:<?php echo implode(',',$h_font_variants); ?>);

body {
   font-family: <?php echo $g_font['font'];?>;
   font-size: <?php the_field('font_body_size', 'option'); ?>px;
   font-weight: <?php the_field('font_body_weight', 'option'); ?>;
   line-height: <?php the_field('font_body_line', 'option'); ?>;
   letter-spacing: <?php the_field('font_body_spacing', 'option'); ?>px;
   text-transform: <?php the_field('font_body_transform', 'option'); ?>;
}
h1,h2,h3,h4, .slick-caption {
   font-family: <?php echo $h_font['font'];?>;
}

<?php
// FONTS - HEADINGS ALTERNATE
$h_font_alternate = get_field('font_headings_family_alternate','option');
$h_font_alternate_variants = $h_font_alternate['variants'];
?>
@import url(https://fonts.googleapis.com/css?family=<?php echo $h_font_alternate['font'];?>:<?php echo implode(',',$h_font_alternate_variants); ?>);

h1 {
   <?php if(get_field('font_h1_alternate') == 'yes'): ?>
      font-family: <?php echo $h_font_alternate['font'];?>;
   <?php endif; ?>
   font-size: <?php the_field('font_h1_size', 'option'); ?>px;
   font-weight: <?php the_field('font_h1_weight', 'option'); ?>;
   line-height: <?php the_field('font_h1_line', 'option'); ?>;
   letter-spacing: <?php the_field('font_h1_spacing', 'option'); ?>px;
   text-transform: <?php the_field('font_h1_transform', 'option'); ?>;
}
h2 {
   <?php if(get_field('font_h2_alternate') == 'yes'): ?>
      font-family: <?php echo $h_font_alternate['font'];?>;
   <?php endif; ?>
   font-family: <?php echo $h_font_alternate['font'];?>;
   font-size: <?php the_field('font_h2_size', 'option'); ?>px;
   font-weight: <?php the_field('font_h2_weight', 'option'); ?>;
   line-height: <?php the_field('font_h2_line', 'option'); ?>;
   letter-spacing: <?php the_field('font_h2_spacing', 'option'); ?>px;
   text-transform: <?php the_field('font_h2_transform', 'option'); ?>;
}
h3 {
   <?php if(get_field('font_h3_alternate') == 'yes'): ?>
      font-family: <?php echo $h_font_alternate['font'];?>;
   <?php endif; ?>
   font-size: <?php the_field('font_h3_size', 'option'); ?>px;
   font-weight: <?php the_field('font_h3_weight', 'option'); ?>;
   line-height: <?php the_field('font_h3_line', 'option'); ?>;
   letter-spacing: <?php the_field('font_h3_spacing', 'option'); ?>px;
   text-transform: <?php the_field('font_h3_transform', 'option'); ?>;
}
h4 {
   <?php if(get_field('font_h4_alternate') == 'yes'): ?>
      font-family: <?php echo $h_font_alternate['font'];?>;
   <?php endif; ?>
   font-size: <?php the_field('font_h4_size', 'option'); ?>px;
   font-weight: <?php the_field('font_h4_weight', 'option'); ?>;
   line-height: <?php the_field('font_h4_line', 'option'); ?>;
   letter-spacing: <?php the_field('font_h4_spacing', 'option'); ?>px;
   text-transform: <?php the_field('font_h4_transform', 'option'); ?>;
}

<?php
// COLORS
// Loops through all the color styles listed on the options page.
// Outputs selectors for each color style with the specified primary, secondary, tertiary, and accent colors.
if( have_rows('color_styles', 'option') ):
   $count = 0;
      while ( have_rows('color_styles', 'option') ) : the_row();
      $count++;
      $style_type = get_sub_field('style_type');
      $primary = get_sub_field('primary');
      $secondary = get_sub_field('secondary');
      $tertiary = get_sub_field('tertiary');
      $accent = get_sub_field('accent');
?>

/* FC-TWO-UP, FC-LIST */
.fc-two-up.color-style-<?php echo $count; ?>.layout-style-1,
.fc-two-up.color-style-<?php echo $count; ?>.layout-style-2,
.fc-list.color-style-<?php echo $count; ?>,
.fc-heading.color-style-<?php echo $count; ?>,
.fc-slider.color-style-<?php echo $count; ?> {
   background: <?php echo $primary ?>;
}

.fc-two-up.color-style-<?php echo $count; ?> h2,
.fc-two-up.color-style-<?php echo $count; ?> h3,
.fc-two-up.color-style-<?php echo $count; ?> h4 {
   color: <?php echo $secondary ?>;
}



.color-style-<?php echo $count; ?> .heading {
   color: <?php echo $secondary ?>;
}

.color-style-<?php echo $count; ?> .text,
.color-style-<?php echo $count; ?> .excerpt,
.color-style-<?php echo $count; ?> .dates {
   color: <?php echo $tertiary ?>;
}

.color-style-<?php echo $count; ?> a {
   color: <?php echo $tertiary ?>;
}

.color-style-<?php echo $count; ?> a:hover {
   color: <?php echo $secondary ?>;
}

.color-style-<?php echo $count; ?> .icon svg .cls-1,
.color-style-<?php echo $count; ?> .icon svg path,
.color-style-<?php echo $count; ?> .icon svg polygon,
.color-style-<?php echo $count; ?> .icon svg rect {
   fill: <?php echo $secondary ?>;
}

.color-style-<?php echo $count; ?>.scroll-arrow:after,
.color-style-<?php echo $count; ?> h5,
.color-style-<?php echo $count; ?> h5 a {
   color: <?php echo $secondary ?>;
}

.color-style-<?php echo $count; ?> .btn, .color-style-<?php echo $count; ?> .gform_button {
   background: <?php echo $primary ?>;
   color: <?php echo $secondary ?>;
   border-color: <?php echo $secondary ?>;
}

.color-style-<?php echo $count; ?> .btn:hover, .color-style-<?php echo $count; ?> .gform_button:hover {
   background: <?php echo $secondary ?>;
   color: <?php echo $primary ?>;
   border-color: <?php echo $secondary ?>;
}

.color-style-<?php echo $count; ?> .slick-caption {
   color: <?php echo $secondary ?>;
   background: <?php echo hex2rgba($primary, 0.5); ?>;
}

/* FC-CONTACT FORM */
.color-style-<?php echo $count; ?> label, .color-style-<?php echo $count; ?> .gfield_description  {
color: <?php the_sub_field('tertiary'); ?>; }
.color-style-<?php echo $count; ?> .gfield_select {
background-image: url('data:image/svg+xml;utf8,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 6.09 6.09"><defs><style>.cls-1{fill:<?php the_sub_field('secondary'); ?>;}</style></defs><g><path class="cls-1" d="M0,0H6.09L3,6.09Z"/></g></svg>'); }
.color-style-<?php echo $count; ?> .ginput_container input, .color-style-<?php echo $count; ?> .ginput_container textarea, .color-style-<?php echo $count; ?> .ginput_container .gfield_select, .color-style-<?php echo $count; ?> .ginput_container_radio, .color-style-<?php echo $count; ?> .ginput_container_checkbox {
border-color: <?php the_sub_field('tertiary'); ?>;}

<?php if(get_sub_field('style_type') == 'dark'):
   // dark style special conditions:
   // input bg 20 steps lighter than primary
   // input placeholder text 60 steps lighter than primary ?>
   .color-style-<?php echo $count; ?> .ginput_container input, .color-style-<?php echo $count; ?> .ginput_container textarea, .color-style-<?php echo $count; ?> .ginput_container .gfield_select, .color-style-<?php echo $count; ?> .ginput_container_radio, .color-style-<?php echo $count; ?> .ginput_container_checkbox {
   background-color: <?php echo adjustBrightness(get_sub_field('primary'), 20); ?> !important;
   color: <?php the_sub_field('secondary'); ?>; }
   .color-style-<?php echo $count; ?> .ginput_container input::-webkit-input-placeholder, .color-style-<?php echo $count; ?> .ginput_container textarea::-webkit-input-placeholder {
   color: <?php echo adjustBrightness(get_sub_field('primary'), 60); ?>; }
   .color-style-<?php echo $count; ?> .ginput_container input::-moz-placeholder, .color-style-<?php echo $count; ?> .ginput_container textarea::-moz-placeholder {
   color: <?php echo adjustBrightness(get_sub_field('primary'), 60); ?>; }
   .color-style-<?php echo $count; ?> .ginput_container input:-ms-input-placeholder, .color-style-<?php echo $count; ?> .ginput_container textarea:-ms-input-placeholder {
   color: <?php echo adjustBrightness(get_sub_field('primary'), 60); ?>; }
<?php endif; ?>
<?php if(get_sub_field('style_type') == 'medium'):
   // medium style special conditions:
   // input bg 20 steps darker than primary
   // input placeholder text 60 steps darker than primary ?>
   .color-style-<?php echo $count; ?> .ginput_container input, .color-style-<?php echo $count; ?> .ginput_container textarea, .color-style-<?php echo $count; ?> .ginput_container .gfield_select, .color-style-<?php echo $count; ?> .ginput_container_radio, .color-style-<?php echo $count; ?> .ginput_container_checkbox {
   background-color: <?php echo adjustBrightness(get_sub_field('primary'), -20); ?> !important;
   color: <?php the_sub_field('secondary'); ?>; }
   .color-style-<?php echo $count; ?> .ginput_container input::-webkit-input-placeholder, .color-style-<?php echo $count; ?> .ginput_container textarea::-webkit-input-placeholder {
   color: <?php echo adjustBrightness(get_sub_field('primary'), -60); ?>; }
   .color-style-<?php echo $count; ?> .ginput_container input::-moz-placeholder, .color-style-<?php echo $count; ?> .ginput_container textarea::-moz-placeholder {
   color: <?php echo adjustBrightness(get_sub_field('primary'), -60); ?>; }
   .color-style-<?php echo $count; ?> .ginput_container input:-ms-input-placeholder, .color-style-<?php echo $count; ?> .ginput_container textarea:-ms-input-placeholder {
   color: <?php echo adjustBrightness(get_sub_field('primary'), -60); ?>; }
<?php endif; ?>
<?php if(get_sub_field('style_type') == 'light'):
   // light style special conditions:
   // input bg primary
   // input placeholder text 60 steps lighter than tertiary ?>
   .color-style-<?php echo $count; ?> .ginput_container input, .color-style-<?php echo $count; ?> .ginput_container textarea, .color-style-<?php echo $count; ?> .ginput_container .gfield_select, .color-style-<?php echo $count; ?> .ginput_container_radio, .color-style-<?php echo $count; ?> .ginput_container_checkbox {
   background-color: <?php the_sub_field('primary'); ?> !important;
   color: <?php the_sub_field('secondary'); ?>; }
   .color-style-<?php echo $count; ?> .ginput_container input::-webkit-input-placeholder, .color-style-<?php echo $count; ?> .ginput_container textarea::-webkit-input-placeholder {
   color: <?php echo adjustBrightness(get_sub_field('tertiary'), 60); ?>; }
   .color-style-<?php echo $count; ?> .ginput_container input::-moz-placeholder, .color-style-<?php echo $count; ?> .ginput_container textarea::-moz-placeholder {
   color: <?php echo adjustBrightness(get_sub_field('tertiary'), 60); ?>; }
   .color-style-<?php echo $count; ?> .ginput_container input:-ms-input-placeholder, .color-style-<?php echo $count; ?> .ginput_container textarea:-ms-input-placeholder {
   color: <?php echo adjustBrightness(get_sub_field('tertiary'), 60); ?>; }
<?php endif; ?>

<?php
   endwhile;
endif;
?>
