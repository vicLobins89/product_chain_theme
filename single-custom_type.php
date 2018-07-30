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
								
								<?php
								$rowCount;
								if( have_rows('cs_rows') ) : 
								while( have_rows('cs_rows') ) : 
								$rowCount += 1;
								the_row(); 
								?>
									<section class="row cs-row cf <?php echo ($rowCount % 2 == 0 ? 'even' : 'odd curved'); ?>">
										<div class="entry-content cf wrap">
											<div class="col-6"><?php the_sub_field('column_a'); ?></div>
											<div class="col-6"><?php the_sub_field('columns_b'); ?></div>
										</div>
									</section>
								<?php endwhile; endif; ?>
								
								
								<?php if( have_rows('extra_content') ): while( have_rows('extra_content') ): the_row(); ?>
									<section 
										 class="row cf<?php if( get_sub_field('curve') ) { echo ' curved'; } ?>"
										 <?php if( get_sub_field('bg_colour') ) { echo ' style="background: '.get_sub_field('bg_colour').';"'; } ?> >
										
										<div class="entry-content cf wrap">
											<div class="col-12"><?php the_sub_field('content'); ?></div>
										</div>
										
										<?php if( get_sub_field('cta') ) : ?>
											<div class="cf"></div>
											<a
											   href="<?php echo get_sub_field('cta_link'); ?>" 
											   class="btn primary-btn<?php if( get_sub_field('cta_reverse') ) { echo ' reverse-btn'; } ?>">
												<?php echo get_sub_field('cta_copy'); ?>
											</a>
										<?php endif; ?>
										
										<?php 
											if( get_sub_field('arrow_graphic') === 'arrow1' ) {
												echo '<div class="arrow arrow1">' . file_get_contents(get_template_directory_uri() . '/library/images/svg/arrow-outline-01.svg') . '</div>';
											} elseif( get_sub_field('arrow_graphic') === 'arrow2' ) {
												echo '<div class="arrow arrow2">' . file_get_contents(get_template_directory_uri() . '/library/images/svg/arrow-outline-02.svg') . '</div>';
											} elseif( get_sub_field('arrow_graphic') === 'arrow3' ) {
												echo '<div class="arrow arrow3">' . file_get_contents(get_template_directory_uri() . '/library/images/svg/arrow-outline-03.svg') . '</div>';
											} elseif( get_sub_field('arrow_graphic') === 'arrow4' ) {
												echo '<div class="arrow arrow4">' . file_get_contents(get_template_directory_uri() . '/library/images/svg/arrow-outline-04.svg') . '</div>';
											}
										?>
									</section>
								<?php endwhile; endif; ?>

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
