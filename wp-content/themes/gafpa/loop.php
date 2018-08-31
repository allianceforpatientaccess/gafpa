<?php $articleCount = 0; ?>

<?php if (have_posts()): while (have_posts()) : the_post(); ?>

	<!-- article -->
	<article style="display: block; min-height: 100px;" id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

		<!-- post thumbnail -->
		<a class="loop-thumbnail" href="<?php the_permalink(); ?>" title="<?php the_title(); ?>">
			<?php the_post_thumbnail(); // Declare pixel size you need inside the array ?>
		</a>
		<!-- /post thumbnail -->

		<!-- post title -->
		<p style="display: flex; padding-left: 10px;">
			<a class="thumbnail-article-title" href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a>
		</p>
		<!-- /post title -->

		<!-- post date -->
		<p class="thumbnail-article-date" style="display: flex; padding: 5px 0 0 10px;">
			<?php the_time(get_option('date_format')); ?>
		</p>
		<!-- /post date -->
		
	</article>
	<!-- /article -->

	<!-- breaks between articles -->
	<?php $articleCount++; ?>
	<?php if($articleCount % get_option('posts_per_page') != 0 && $articleCount < $wp_query->found_posts): ?> 
		<div class="divider" style="margin-bottom: 20px; height: 1px; width: 100%;"></div>

	<?php endif; ?>
	<!-- /breaks between articles -->

<?php endwhile; ?>
<?php else: ?>

	<!-- article -->
	<article>
		<h1 style="text-align: center; color: #2AAD69; padding-bottom: 20px;"><?php _e( 'Sorry, nothing to display.		:(', 'html5blank' ); ?></h1>
	</article>
	<!-- /article -->
	
<?php endif; ?>