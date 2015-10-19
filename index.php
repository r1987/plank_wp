<?php get_header(); ?>

<main role="main">

	<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>

	<article class="post">
		
		<h2><?php the_title();?></h2>
		
		<div class="post-entry">
			<?php the_content();?>
		</div>
			
	</article>

	<?php endwhile; else: ?>
		<h2><?php _e('Sorry, no posts matched your criteria.'); ?></h2>
	<?php endif; ?>

</main>

<?php get_footer(); ?>