<?php
/**
 * The template part for displaying results in search pages.
 *
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package motohero
 */
$inwave_theme_option = Inwave_Helper::getConfig('smof');
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<header class="entry-header">
		<?php the_title( sprintf( '<h3><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h3>' ); ?>

		<?php if ( 'post' == get_post_type() ) : ?>
		<div class="entry-meta">
			<?php inwave_posted_on(); ?>
		</div><!-- .entry-meta -->
		<?php endif; ?>
	</header><!-- .entry-header -->

	<div class="entry-summary">
		<?php the_excerpt(); ?>
	</div><!-- .entry-summary -->
    <?php if ($inwave_theme_option['entry_footer_category']): ?>
        <footer class="entry-footer">
            <?php inwave_entry_footer(); ?>
        </footer><!-- .entry-footer -->
    <?php endif ?>

</article><!-- #post-## -->
