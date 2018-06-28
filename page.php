<?php get_header(); ?>

			<div id="content">

				<div id="inner-content" class="cf">

						<div id="main" class="cf" role="main" itemscope itemprop="mainContentOfPage" itemtype="http://schema.org/Blog">

							<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
							
							<article id="post-<?php the_ID(); ?>" <?php post_class( 'cf' ); ?> role="article" itemscope itemtype="http://schema.org/BlogPosting">
								
								<?php // MAIN CONTENT ?>
								<?php if( !empty(get_the_content()) ) : ?>
									<section class="entry-content wrap cf" itemprop="articleBody">
										<?php the_content(); ?>
									</section>
								<?php endif; ?>

							</article>

							<?php endwhile; endif; ?>

						</div>

				</div>

			</div>

<?php get_footer(); ?>
