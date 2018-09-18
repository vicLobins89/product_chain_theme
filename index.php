<?php get_header(); ?>

			<div id="content">

				<div id="inner-content" class="wrap cf">

						<div id="main" class="cf" role="main" itemscope itemprop="mainContentOfPage" itemtype="http://schema.org/Blog">

							<?php
							$argsFeat = array(
								'post_type' => 'post',
								'category_name' => 'featured'
							);
							$queryFeat = new WP_query ( $argsFeat );
							if ( $queryFeat->have_posts() ) : 
							?>
							
							<div class="posts-featured cf">
								
								<?php while ($queryFeat->have_posts()) : $queryFeat->the_post(); ?>
									<article id="post-<?php the_ID(); ?>" <?php post_class( 'col-8 cf' ); ?> role="article">
										
										<h1 class="h4">Blog</h1>

										<div class="post-item">
											<a href="<?php the_permalink() ?>" title="<?php the_title_attribute(); ?>" class="image-thumb">
												<?php the_post_thumbnail('rectangle-thumb-l'); ?>
											</a>

											<h2 class="h2">
												<a href="<?php the_permalink() ?>" rel="bookmark" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a>
											</h2>
											
											<p class="meta"><?php echo get_the_date( 'F Y' ); ?></p>
											
											<?php the_excerpt(); ?>
										</div>

									</article>

								<?php endwhile; ?>
								
								<?php get_sidebar(); ?>
							</div>
							<?php endif; ?>
							<?php wp_reset_postdata(); ?>
							
							<?php
							$args = array(
								'post_type' => 'post',
								'category__not_in' => 11
							);
							$query = new WP_query ( $args );
							if ( $query->have_posts() ) : ?>
							
							<ul class="filter-wrapper">
								<?php
								wp_list_categories(array(
									'hide_empty' => true,
									'title_li' => '',
									'exclude' => 11,
									'order' => 'DESC'
								));
								?>
								<div class="lds-ellipsis"><div></div><div></div><div></div><div></div></div>
							</ul>
							
							<div class="posts-main grid cf">
								
								<div class="grid-sizer"></div>
								
								<?php while ($query->have_posts()) : $query->the_post(); ?>
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
								<!--<article id="post-not-found" class="hentry cf">
									<header class="article-header">
										<h1><?php// _e( 'Oops, Post Not Found!', 'bonestheme' ); ?></h1>
									</header>
									
									<section class="entry-content">
										<p><?php// _e( 'Uh Oh. Something is missing. Try double checking things.', 'bonestheme' ); ?></p>
									</section>
								</article>-->
							<?php endif; ?>
							<?php wp_reset_postdata(); ?>

						</div>

				</div>

			</div>


<?php get_footer(); ?>
