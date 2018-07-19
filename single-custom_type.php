<?php
/*
 * CUSTOM POST TYPE
*/
?>

<?php get_header(); ?>

			<div id="content">

				<div id="inner-content" class="cf">

						<div id="main" class="cf" role="main" itemscope itemprop="mainContentOfPage" itemtype="http://schema.org/Blog">

							<?php if (have_posts()) : while (have_posts()) : the_post(); ?>

							<article id="post-<?php the_ID(); ?>" <?php post_class('cf'); ?> role="article">
								
								<section class="entry-content wrap cf">
									<h1 class="single-title title"><?php the_title(); ?></h1>
									
									<?php the_content(); ?>
								</section> <!-- end article section -->
								
								<?php if( have_rows('cs_rows') ): while( have_rows('cs_rows') ): the_row(); ?>
									<section class="row cf">
										<div class="max-width cf wrap">
											<div class="col-6"><?php the_sub_field('column_a'); ?></div>
											<div class="col-6"><?php the_sub_field('columns_b'); ?></div>
										</div>
									</section>
								<?php endwhile; endif; ?>
								
								<?php if( !empty(get_field('extra_content')) ) : ?>
									<section class="row extra-content curved cf">
										<div class="max-width cf wrap">
											<?php the_field('extra_content') ?>
										</div>
										
										<?php if( get_field('cta_link') ) : ?>
											<div class="cf"></div>
											<a href="<?php echo get_field('cta_link'); ?>" class="btn alt-btn"><?php echo get_field('cta_text'); ?></a>
										<?php endif; ?>
										
										<?php echo '<div class="arrow arrow1">' . file_get_contents(get_template_directory_uri() . '/library/images/svg/arrow-outline-01.svg') . '</div>'; ?>
									</section>
								<?php endif; ?>

							</article>

							<?php endwhile; ?>

							<?php else : ?>

									<article id="post-not-found" class="hentry cf">
										<header class="article-header">
											<h1><?php _e( 'Oops, Post Not Found!', 'bonestheme' ); ?></h1>
										</header>
										<section class="entry-content">
											<p><?php _e( 'Uh Oh. Something is missing. Try double checking things.', 'bonestheme' ); ?></p>
										</section>
										<footer class="article-footer">
											<p><?php _e( 'This is the error message in the single-custom_type.php template.', 'bonestheme' ); ?></p>
										</footer>
									</article>

							<?php endif; ?>

						</div>

				</div>

			</div>

<?php get_footer(); ?>
