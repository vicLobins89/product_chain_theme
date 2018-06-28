<?php get_header(); ?>

			<div id="content">

				<div id="inner-content" class="wrap cf">

					<div id="main" class="cf" role="main" itemscope itemprop="mainContentOfPage" itemtype="http://schema.org/Blog">

						<article id="post-not-found" class="hentry cf">

							<section class="entry-content">
								
								<h1><strong><?php _e( 'Content Not Found', 'bonestheme' ); ?></strong></h1>

								<p><?php _e( 'The content you were looking for was not found, but maybe try looking again!', 'bonestheme' ); ?></p>
								
								<p><?php get_search_form(); ?></p>

							</section>

						</article>

					</div>

				</div>

			</div>

<?php get_footer(); ?>
