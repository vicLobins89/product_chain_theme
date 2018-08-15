<?php get_header(); ?>

			<div id="content">

				<div id="inner-content" class="wrap cf">

						<div id="main" class="cf" role="main" itemscope itemprop="mainContentOfPage" itemtype="http://schema.org/Blog">

							<?php if ( have_posts() ) :  ?>
							
							<div class="cat-filter">
								<?php
								if( is_category() ) {
									wp_list_categories(array(
										'hide_empty' => true,
										'style' => 'list',
										'title_li' => 'Categories'
									));
								} elseif( is_tag() ) {
									the_tags( '<li>Tags</li><ul><li>', '</li><li>', '</li></ul>' );
								}
								?>
							</div>
							
							<div class="posts-main grid cf">
								
								<div class="grid-sizer"></div>
								
								<?php while (have_posts()) : the_post(); ?>
									<article id="post-<?php the_ID(); ?>" <?php post_class( 'col-4 grid-item cf' ); ?> role="article">

										<div class="post-item">
											<a href="<?php the_permalink() ?>" title="<?php the_title_attribute(); ?>" class="image-thumb">
												<?php the_post_thumbnail('full'); ?>
											</a>

											<h3 class="h2">
												<a href="<?php the_permalink() ?>" rel="bookmark" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a>
											</h3>

											<p class="meta"><?php echo get_the_date( 'F Y' ); ?> | <?php $categories = get_the_category(); echo esc_html( $categories[0]->name ); ?></p>

											<?php the_excerpt(); ?>
										</div>

									</article>

								<?php endwhile; ?>
							</div>
							
							<?php bones_page_navi(); ?>
							
							<?php else : ?>
								<article id="post-not-found" class="hentry cf">
									<header class="article-header">
										<h1><?php _e( 'Oops, Post Not Found!', 'bonestheme' ); ?></h1>
									</header>
									
									<section class="entry-content">
										<p><?php _e( 'Uh Oh. Something is missing. Try double checking things.', 'bonestheme' ); ?></p>
									</section>
								</article>
							<?php endif; ?>
							<?php wp_reset_postdata(); ?>

						</div>

				</div>

			</div>


<?php get_footer(); ?>
