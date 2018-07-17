<?php
/*
 * CUSTOM POST TYPE ARCHIVE
*/
?>

<?php get_header(); ?>

			<div id="content">

				<div id="inner-content" class="wrap cf">

					<div id="main" class="cf" role="main" itemscope itemprop="mainContentOfPage" itemtype="http://schema.org/Blog">

						<h1 class="archive-title h2"><?php post_type_archive_title(); ?></h1>
						
							<?php							
							$cat_desc = category_description(5);
							if( $cat_desc != null ) : ?>
							<header class="entry-header article-header">
								<div class="wrap">
									<?php
										echo '<p>' . $cat_desc . '</p>';
									?>
								</div>
							</header>
							<?php endif;
						
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
						
								<section class="cf case-studies">
									<?php while ( $case_studies_f->have_posts() ) : $case_studies_f->the_post(); ?>
										<div class="post-item col-12">
											<p><a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>" class="post-thumb">
												<?php the_post_thumbnail('rectangle-thumb-s'); ?>
											</a></p>

											<h3>
												<a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>" class="post-title">
													<?php the_title(); ?>
												</a>
											</h3>

											<?php the_excerpt(); ?>
										</div>
									<?php endwhile; ?>
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
						
								<section class="cf case-studies">
									<?php while ( $case_studies->have_posts() ) : $case_studies->the_post(); ?>
										<div class="post-item col-12">
											<p><a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>" class="post-thumb">
												<?php the_post_thumbnail('rectangle-thumb-s'); ?>
											</a></p>

											<h3>
												<a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>" class="post-title">
													<?php the_title(); ?>
												</a>
											</h3>

											<?php the_excerpt(); ?>
										</div>
									<?php endwhile; ?>
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
