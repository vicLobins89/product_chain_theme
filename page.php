<?php get_header(); ?>

			<div id="content">

				<div id="inner-content" class="cf">

						<div id="main" class="cf" role="main" itemscope itemprop="mainContentOfPage" itemtype="http://schema.org/Blog">

							<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
							
							<article id="post-<?php the_ID(); ?>" <?php post_class( 'cf' ); ?> role="article" itemscope itemtype="http://schema.org/BlogPosting">
								
								<?php // HERO AREA ?>
								<?php if ( has_post_thumbnail()) : ?>
								<div class="featured-image">
									<?php the_post_thumbnail('full'); ?>
									<?php
									if( get_field('hero_text') ) {
										echo '<div class="page-title">';
										the_field('hero_text');
										echo '</div>';
									} else {
										echo '<div class="page-title">
												<h1 itemprop="headline">'.get_the_title().'</h1>
											</div>';
									}
									?>
								</div>
								<?php endif; ?>
								
								
								<?php // MAIN CONTENT ?>
								<?php if( !empty(get_the_content()) ) : ?>
									<section class="entry-content wrap cf" itemprop="articleBody">
										<?php the_content(); ?>
									</section>
								<?php endif; ?>
								
								
								<?php // COLUMNS CONTENT ?>
								<?php if( have_rows('rows') ): ?>
									<?php while( have_rows('rows') ): the_row();
										if( get_sub_field('custom_class') ) {
											$customClasses = get_sub_field('custom_class');
											$customClasses = str_replace(',', '', $customClasses);
										}
									?>
										
										<section class="row cf <?php echo $customClasses; ?>">
											
										<?php if( get_sub_field('title') ) : ?>
											<h2><?php echo get_sub_field('title'); ?></h2>
										<?php endif; ?>

										<?php if( get_sub_field('column_size') == '1col' ) : ?>

											<div class="col-12"><?php the_sub_field('col1'); ?></div>

										<?php elseif( get_sub_field('column_size') == '2col' ) : ?>

											<div class="cf col-6">
												<?php the_sub_field('col2_a'); ?>
											</div>

											<div class="cf col-6">
												<?php the_sub_field('col2_b'); ?>
											</div>

										<?php elseif( get_sub_field('column_size') == '3col' ) : ?>

											<div class="col-4">
												<?php the_sub_field('col3_a'); ?>
											</div>

											<div class="col-4">
												<?php the_sub_field('col3_b'); ?>
											</div>

											<div class="col-4">
												<?php the_sub_field('col3_c'); ?>
											</div>

										<?php elseif( get_sub_field('column_size') == '4col' ) : ?>

											<div class="col-3">
												<?php the_sub_field('col4_a'); ?>
											</div>

											<div class="col-3">
												<?php the_sub_field('col4_b'); ?>
											</div>

											<div class="col-3">
												<?php the_sub_field('col4_c'); ?>
											</div>

											<div class="col-3">
												<?php the_sub_field('col4_d'); ?>
											</div>

										<?php endif; ?>
											
										</section>
									<?php endwhile; ?>
								<?php endif; ?>
								
								
								<?php // BLOG HIGHLIGHTS (IF HOME PAGE) ?>
								<?php if ( is_front_page() ) : ?>
									<?php query_posts( array(
										'category_name'  => 'featured',
										'posts_per_page' => 3
									) ); ?>
								
									<?php if ( have_posts() ) : ?>
										<div class="wrap">
											<h2>Blog</h2>
											<?php while ( have_posts() ) : the_post(); ?>
												<div class="post-item">
													<a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>" class="post-thumb">
														<?php the_post_thumbnail('rectangle-thumb-s'); ?>
													</a>
													<a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>" class="post-title">
														<?php the_title(); ?>
													</a>
													<?php the_excerpt(); ?>
												</div>
											<?php endwhile; ?>
										</div>
									<?php endif; ?>
									<?php wp_reset_query(); ?>
								<?php endif; ?>
								
								
								<?php // PRE-FOOTER ?>
								<?php if( !empty(get_field('pre_footer')) ) : ?>
									<section class="pre-footer wrap cf">
										<?php if( !empty(get_field('pre_footer_media')) ) : ?>
											<div class="col-6"><?php the_field('pre_footer_media') ?></div>
											<div class="col-6"><?php the_field('pre_footer') ?></div>
										<?php else : ?>
											<div class="col-12"><?php the_field('pre_footer') ?></div>
										<?php endif; ?>
									</section>
								<?php endif; ?>

							</article>

							<?php endwhile; endif; ?>

						</div>

				</div>

			</div>

<?php get_footer(); ?>
