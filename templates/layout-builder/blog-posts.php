<?php 

include( CHILD_DIR . '/templates/partials/additional-classes.php' );

// Arguments for WP_Query
$args = array(

	'post_type'		=>	'post',
	'status'		=>	'publish',

);

if ( $curated = get_sub_field('blog_posts_display') == 'Curated' ) {

	$blog_posts = get_sub_field('choose_blog_posts');

	$args['post__in'] = $blog_posts;
	$args['orderby'] = 'post__in';


} elseif ( $latest = get_sub_field('blog_posts_display') == 'Latest' ) {

	$posts_per_page = get_sub_field('number_of_posts') != NULL ? get_sub_field('number_of_posts') : 2;

	$args['posts_per_page'] = $posts_per_page;

}

?>

<section <?php echo $html_id != NULL ? 'id="' . $html_id . '"' : ''; ?> class="content-block blog-posts row-<?php echo $cb_i; ?> row-<?php echo $even_odd; ?><?php echo $html_classes != NULL ? ' ' . $html_classes : ''; ?>">

	<div class="wrap">

		<?php if ( get_sub_field('headline') || get_sub_field('subheadline') ) { ?>

		<header class="section-header small-12 column">		

			<?php if ( $headline = get_sub_field('headline') ) { ?>

			<h1 class="section-title"><?php echo $headline; ?></h1>

			<?php } ?>

			<?php if ( $subheadline = get_sub_field('subheadline') ) { ?>

			<h2 class="section-subtitle"><?php echo $subheadline; ?></h2>

			<?php } ?>

		</header>

		<?php } ?>

		<?php $post_query = new WP_Query($args); ?>

		<?php if ( $post_query->have_posts() ) { ?>

			<div class="row" data-equalizer data-options="equalize_on_stack: true">

			<?php do_action( 'genesis_before_while' ); ?>

				<?php while ( $post_query->have_posts() ) { ?>

				<?php $post_query->the_post(); ?>

				<?php $classes = array('small-12', 'medium-6', 'column'); ?> 

				<?php do_action( 'genesis_before_entry' ); ?>

				<article <?php post_class($classes); ?> itemscope="itemscope" itemtype="http://schema.org/BlogPosting" itemprop="blogPost" data-equalizer-watch>

					<header class="entry-header">

						<h2 class="entry-title">

							<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>

						</h2>

						<?php genesis_post_info(); ?>

					</header>

					<?php do_action( 'genesis_before_entry_content' ); ?>

					<?php printf( '<div %s>', genesis_attr( 'entry-content' ) ); ?>
					<?php do_action( 'genesis_entry_content' ); ?>
					<?php echo '</div>'; ?>

					<?php do_action( 'genesis_after_entry_content' ); ?>

					<?php do_action( 'genesis_entry_footer' ); ?>

				</article>

				<?php } // endwhile $post_query->have_posts() ?>

			</div>
			<!-- end .row -->

		<?php } // endif $post_query->have_posts() ?>

		<?php wp_reset_postdata(); ?>

	</div>
	<!-- end .wrap -->

</section>
<!-- end .blog-posts -->