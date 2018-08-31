<header>
  <?php $isSubscribe = false; // used to determine if on subscribe page ?>
   <nav class="navbar navbar-inverse navbar-fixed-top">
     <div class="container-fluid navbar-wrapper header-primary-container">
       <div class="navbar-header">
         <?php do_action('wpml_add_language_selector'); ?>

         <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
           <span class="sr-only">Toggle navigation</span>
           <span class="icon-bar"></span>
           <span class="icon-bar"></span>
           <span class="icon-bar"></span>
           <i class="fa fa-times" aria-hidden="true"></i>
         </button>
         <a class="navbar-brand" href="<?php echo get_option('home'); ?>"><img src="/wp-content/themes/gafpa/assets/images/logo2.png"></a>
       </div>
       <div id="navbar" class="collapse navbar-collapse">
          <?php
          if (has_nav_menu('primary_navigation')) :
             wp_nav_menu(array('theme_location' => 'primary_navigation', 'menu_class' => 'nav navbar-nav', 'walker' => new wp_bootstrap_navwalker()));
          endif;
          ?>
       </div>
     </div>
   </nav>
</header>
