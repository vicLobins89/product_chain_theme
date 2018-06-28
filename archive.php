<?php get_header(); ?>

			<div id="content">

				<div id="inner-content" class="cf">

						<div id="main" class="cf" role="main" itemscope itemprop="mainContentOfPage" itemtype="http://schema.org/Blog">

							<?php get_sidebar('sidebar2'); ?>

							<?php if ( have_posts() ) :  ?>
							
							<div class="team-carousel cf">
							<?php
							$featuredQuery = new WP_Query( array(
								'category_name'  => 'featured',
								'posts_per_page' => -1
							) );	
							?>
							<?php while ( $featuredQuery->have_posts() ) : $featuredQuery->the_post(); ?>
								<div class="carousel-item">
									<a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>" class="post-thumb">
										<?php the_post_thumbnail('rectangle-thumb-s'); ?>
									</a>
									<a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>" class="post-title">
										<?php the_title(); ?>
									</a>
									<?php the_excerpt(); ?>
								</div>
							<?php endwhile; ?>
							<?php wp_reset_postdata(); ?>
							</div>
							
							<div class="wrap posts-main cf">
								<div class="cat-filter">
									<?php
									if( is_category() ) {
										wp_list_categories(array(
											'exclude' => 17,
											'hide_empty' => true,
											'style' => 'list',
											'title_li' => 'Categories'
										));
									} elseif( is_tag() ) {
										the_tags( '<li>Tags</li><ul><li>', '</li><li>', '</li></ul>' );
									}
									?>
									<hr style="margin: 0.75rem 0;">
								</div>
								
								<?php while (have_posts()) : the_post(); ?>
									<article id="post-<?php the_ID(); ?>" <?php post_class( 'col-4 cf' ); ?> role="article">

										<a href="<?php the_permalink() ?>" title="<?php the_title_attribute(); ?>" class="image-thumb">
											<?php the_post_thumbnail('rectangle-thumb-s'); ?>
										</a>

										<h2 class="h2 entry-title">
											<a href="<?php the_permalink() ?>" rel="bookmark" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a>
										</h2>

										<?php the_excerpt(); ?>

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
