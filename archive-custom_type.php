<?php
/*
 * CUSTOM POST TYPE ARCHIVE
*/
?>

<?php get_header(); ?>

			<div id="content">

				<div id="inner-content" class="cf">

					<div id="main" class="cf" role="main" itemscope itemprop="mainContentOfPage" itemtype="http://schema.org/Blog">
						<header class="entry-content wrap cf">
							<h1 class="archive-title"><?php post_type_archive_title(); ?></h1>
							
							<?php
							$cat_desc = category_description(5);
							if( $cat_desc ) {
								echo '<p class="archive-description">' . $cat_desc . '</p>';
							}
							?>
						</header>
						
						<?php						
							$args = array(
								'post_type'   => 'custom_type',
								'post_status' => 'publish',
								'posts_per_page'  => '-1',
								'tax_query'   => array(
									array(
										'taxonomy' => 'custom_cat',
										'field'    => 'slug',
										'terms'    => 'featured'
									)
								)
							);

							$case_studies_f = new WP_Query( $args );
							if( $case_studies_f->have_posts() ) :
							?>
						
								<section class="row cf case-studies featured">
									<div class="max-width wrap">
										<?php while ( $case_studies_f->have_posts() ) : $case_studies_f->the_post();
											if( get_field('panel_colour') ) { $bgColour = get_field('panel_colour'); } ?>
											
											<div 
												class="case-study cf <?php echo $post->post_name; ?>"
												<?php if($bgColour) { echo ' style="background: '.$bgColour.';"'; } ?> 
												onclick="window.location='<?php the_permalink(); ?>';"
												>
												<a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>" class="post-thumb col-8">
													<?php the_post_thumbnail('rectangle-thumb-l'); ?>
												</a>
												
												<div class="post-description col-4">
													<?php
													if( get_field('cs_logo') ) {
														$csLogo = get_field('cs_logo');
														echo '<a href="'.get_the_permalink().'" class="cs-logo"><img src="'.$csLogo[url].'" alt="'.$csLogo[alt].'" /></a>';
													}
													the_excerpt();
													?>
													<a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>" class="read-more">See how we did it</a>
												</div>
											</div>
										<?php endwhile; ?>
										<?php get_sidebar('ribbon'); ?>
									</div>
								</section>
							<?php endif; ?>
							<?php wp_reset_postdata(); ?>

							<?php
							$args1 = array(
								'post_type'   => 'custom_type',
								'post_status' => 'publish',
								'posts_per_page'  => '-1',
								'tax_query'   => array(
									array(
										'taxonomy' => 'custom_cat',
										'field'    => 'slug',
										'terms'    => 'featured',
										'operator' => 'NOT IN'
									)
								)
							);

							$case_studies = new WP_Query( $args1 );
							if( $case_studies->have_posts() ) :
							?>
						
								<section class="row curved cf case-studies">
									<div class="max-width wrap cf">
										<h4 class="more">More case studies</h4>
										<div class="cf cs-thumbs">
										<?php while ( $case_studies->have_posts() ) : $case_studies->the_post(); ?>
											<div class="col-4">
												<div class="post-item" onclick="window.location='<?php the_permalink(); ?>';">
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
									</div>
								</section>
							<?php wp_reset_postdata(); ?>

									<?php bones_page_navi(); ?>

							<?php else : ?>

									<article id="post-not-found" class="hentry cf">
										<header class="article-header">
											<h1><?php _e( 'Oops, Post Not Found!', 'bonestheme' ); ?></h1>
										</header>
										<section class="entry-content">
											<p><?php _e( 'Uh Oh. Something is missing. Try double checking things.', 'bonestheme' ); ?></p>
										</section>
										<footer class="article-footer">
												<p><?php _e( 'This is the error message in the custom posty type archive template.', 'bonestheme' ); ?></p>
										</footer>
									</article>

							<?php endif; ?>

						</div>

				</div>

			</div>

<?php get_footer(); ?>
