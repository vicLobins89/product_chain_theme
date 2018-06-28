<?php get_header(); ?>

			<div id="content">

				<div id="inner-content" class="cf">

					<div id="main" class="cf wrap entry-content" role="main">
						<h1 class="archive-title"><strong><span><?php _e( 'Search Results for:', 'bonestheme' ); ?></span> <?php echo esc_attr(get_search_query()); ?></strong></h1>
						
						<p><?php get_search_form(); ?></p>

						<?php if (have_posts()) : while (have_posts()) : the_post(); ?>

							<article id="post-<?php the_ID(); ?>" <?php post_class('cf search-result'); ?> role="article">

								<h4 class="search-title entry-title"><a href="<?php the_permalink() ?>" rel="bookmark" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a></h4>

								<p class="byline entry-meta vcard">
										<?php printf( __( 'Posted %1$s', 'bonestheme' ),
										/* the time the post was published */
										'<time class="updated entry-time" datetime="' . get_the_time('Y-m-d') . '" itemprop="datePublished">' . get_the_time(get_option('date_format')) . '</time>'
										); ?>
								</p>

								<section>
										<?php the_excerpt( '<span class="read-more">' . __( 'Read more &raquo;', 'bonestheme' ) . '</span>' ); ?>
								</section>
								
								<hr>

							</article>

						<?php endwhile; ?>

								<?php bones_page_navi(); ?>

							<?php else : ?>

									<article id="post-not-found" class="hentry cf">
										<header class="article-header">
											<h1><?php _e( 'Sorry, No Results.', 'bonestheme' ); ?></h1>
										</header>
										<section class="entry-content">
											<p><?php _e( 'Try your search again.', 'bonestheme' ); ?></p>
										</section>
										<footer class="article-footer">
												<p><?php _e( 'This is the error message in the search.php template.', 'bonestheme' ); ?></p>
										</footer>
									</article>

							<?php endif; ?>

						</div>

					</div>

			</div>

<?php get_footer(); ?>
