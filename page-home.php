<?php /* Page Name: Home */ get_header(); ?>

	<main role="main">
		<div class="contain">

			<section class="page-title-section">
				<h1 class="page-title"><?php the_title(); ?></h1>
			</section>

			<?php if (have_posts()): while (have_posts()) : the_post(); ?>
				<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
					<?php the_content(); ?>
				</article>

				<?php edit_post_link(); ?>
			<?php endwhile;

			else: ?>
				<article>
					<h2><?php _e( 'Sorry, nothing to display.' ); ?></h2>
				</article>
			<?php endif; ?>

		</div>
	</main>

<?php get_sidebar(); ?>

<?php get_footer(); ?>
