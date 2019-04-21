<?php while (have_posts()) : the_post(); ?>
  <article <?php post_class(); ?>>
    <header>
      <h1 class="entry-title"><?php the_title(); ?></h1>
      <?php get_template_part('templates/entry-meta'); ?>
    </header>
    <div class="entry-content">
	    <!--?php the_post_thumbnail('large');    ?-->
      <?php the_content(); ?>
    </div>
    <div class="article-footer">
		<div class="row">
			<div class="col-xs-6 previous">
				<?php previous_post_link(); ?>
			</div>
			<div class="col-xs-6 next">
				<?php next_post_link(); ?>
			</div>
		</div>
    </div>
    <?php // comments_template('/templates/comments.php'); ?>
  </article>
<?php endwhile; ?>
