<?php get_header(); ?>
<?php $options = get_option('rh_settings'); ?>

			<div id="content">

				<div id="inner-content" class="cf">

						<div id="main" class="cf" role="main" itemscope itemprop="mainContentOfPage" itemtype="http://schema.org/Blog">

							<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
							
							<article id="post-<?php the_ID(); ?>" <?php post_class( 'cf' ); ?> role="article" itemscope itemtype="http://schema.org/BlogPosting">
								
								<?php // HERO AREA ?>
								<?php
								if( !has_post_thumbnail() && is_front_page() ){
									echo do_shortcode('[slide-anything id="6"]');
								}
								?>
								
								<?php if( has_post_thumbnail() ) : ?>
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
								<?php if( get_the_content() ) : ?>
									<section class="entry-content wrap cf top-row" itemprop="articleBody">
										<div class="col-12"><?php the_content(); ?></div>
									</section>
								<?php endif; ?>
								
								
								<?php // COLUMNS CONTENT ?>
								<?php if( have_rows('rows') ): ?>
									<?php while( have_rows('rows') ): the_row(); ?>
										
										<section 
												 class="row cf<?php if( get_sub_field('curve') ) { echo ' curved'; } ?>"
												 <?php
												 $bgColor = get_sub_field('bg_color');
												 $paddingTop = get_sub_field('padding_top');
												 $paddingBottom = get_sub_field('padding_bottom');
												 if( $bgColor || $paddingTop || $paddingBottom ) { 
													 $styles = ' style="';
													 if( $bgColor ) { $styles .= 'background: '.$bgColor.';'; }
													 if( $paddingTop == '0' ) { $styles .= ' padding-top: '.$paddingTop.';'; }
													 if( $paddingBottom == '0' ) { $styles .= ' padding-bottom: '.$paddingBottom.';'; }
													 $styles .= '"';
													 echo $styles;
												 }
												 ?>
												 >
										<?php
											if( get_sub_field('wrap') ) { 
												echo '<div class="cf wrap entry-content">';
											} else {
												echo '<div class="max-width cf entry-content">';
											}
										?>
											
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
											
										<?php if( get_sub_field('cta') ) : ?>
											<div class="cf"></div>
											<a
											   href="<?php echo get_sub_field('cta_link'); ?>" 
											   class="btn primary-btn<?php if( get_sub_field('cta_reverse') ) { echo ' alt1-btn'; } ?>">
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
											} elseif( get_sub_field('arrow_graphic') === 'arrow5' ) {
												echo '<div class="arrow arrow5">' . file_get_contents(get_template_directory_uri() . '/library/images/svg/arrow-outline-05.svg') . '</div>';
											}
										?>
											
										</div>
										</section>
									<?php endwhile; ?>
								<?php endif; ?>
								
								
								<?php // BLOG HIGHLIGHTS (IF HOME PAGE) ?>
								<?php if( is_front_page() ) : ?>
									<?php query_posts( array(
										'posts_per_page' => 3
									) ); ?>
								
									<?php if ( have_posts() ) : ?>
										<section class="row blog-highlights cf">
											<div class="wrap entry-content">
												<h2>Blog</h2>
												<?php while ( have_posts() ) : the_post(); ?>
													<div class="post-item cf">
														<a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>" class="post-thumb">
															<?php the_post_thumbnail('rectangle-thumb-s'); ?>
														</a>
														
														<div class="post-details">
															<a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>" class="post-title">
																<?php the_title(); ?>
															</a>
															<?php echo '<p class="date">'.get_the_date().'</p>'; the_excerpt(); ?>
														</div>
													</div>
												<?php endwhile; ?>
												
												<a href="blog" class="btn primary-btn">Check out more insights</a>
											</div>
										</section>
									<?php endif; ?>
									<?php wp_reset_query(); ?>
								<?php endif; ?>
								
								
								<?php // CASTE STUDIES (IF HOME PAGE) ?>
								<?php if( is_front_page() && ($options['case_studies_switch']) ) : ?>
									<?php
									$args = array(
										'post_type'   => 'custom_type',
										'post_status' => 'publish',
										'posts_per_page'  => '3',
										'tax_query'   => array(
											array(
												'taxonomy' => 'custom_cat',
												'field'    => 'slug',
												'terms'    => 'featured'
											)
										)
									);

									$case_studies = new WP_Query( $args );
									if( $case_studies->have_posts() ) :
									?>
										<section class="row case-highlights case-studies cf">
											<div class="cf wrap entry-content">
												<h2>Case Studies</h2>
												<?php while ( $case_studies->have_posts() ) : $case_studies->the_post(); ?>
													<div class="col-4">
														<div class="post-item">
															<a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>" class="post-thumb">
																<?php the_post_thumbnail('rectangle-thumb-s'); ?>
															</a>

															<h3>
																<a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>" class="post-title">
																	<?php the_title(); ?>
																</a>
															</h3>

															<?php the_excerpt(); ?>
														</div>
													</div>
												<?php endwhile; ?>
											</div>
										</section>
									<?php endif; ?>
									<?php wp_reset_postdata(); ?>
								<?php endif; ?>
								
								
								<?php // CONTACT US ?>
								<?php if( get_field('details') || get_field('map_image') ) : ?>
									<section class="contact-us curved row cf">
										<div class="col-8">
											<?php
											/*if( get_field('map_image') ) {
												echo '<div class="map-image"><img src="'.get_field('map_image').'" alt="Map Image"></div>';
											}*/
											
											$location = get_field('google_maps');

											if( $location ): ?>
												<div class="acf-map">
													<div class="marker" data-lat="<?php echo $location['lat']; ?>" data-lng="<?php echo $location['lng']; ?>">
														<p class="address"><?php echo $location['address']; ?></p>
													</div>
												</div>
											<?php endif; ?>
										</div>
										
										<div class="col-4">
											<?php the_field('details'); ?>
										</div>
									</section>
								<?php endif; ?>
								
								
								<?php // PRE-FOOTER ?>
								<?php if( get_field('pre_footer') ) : ?>
									<section class="pre-footer row cf">
										<div class="max-width cf wrap">
											<?php if( !empty(get_field('pre_footer_media')) ) : ?>
												<div class="col-6"><?php the_field('pre_footer_media') ?></div>
												<div class="col-6"><?php the_field('pre_footer') ?></div>
											<?php else : ?>
												<div class="col-12"><?php the_field('pre_footer') ?></div>
											<?php endif; ?>
										</div>
										
										<?php 
											if( get_field('arrow_graphic') === 'arrow1' ) {
												echo '<div class="arrow arrow1">' . file_get_contents(get_template_directory_uri() . '/library/images/svg/arrow-outline-01.svg') . '</div>';
											} elseif( get_field('arrow_graphic') === 'arrow2' ) {
												echo '<div class="arrow arrow2">' . file_get_contents(get_template_directory_uri() . '/library/images/svg/arrow-outline-02.svg') . '</div>';
											} elseif( get_field('arrow_graphic') === 'arrow3' ) {
												echo '<div class="arrow arrow3">' . file_get_contents(get_template_directory_uri() . '/library/images/svg/arrow-outline-03.svg') . '</div>';
											}
										?>
									</section>
								<?php endif; ?>

							</article>

							<?php endwhile; endif; ?>

						</div>

				</div>

			</div>

<?php get_footer(); ?>
