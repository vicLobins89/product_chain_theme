<?php
/*
 Template Name: Quiz
 */
?>

<?php get_header(); ?>
<?php $options = get_option('rh_settings'); ?>

			<div id="content">

				<div id="inner-content" class="cf">

						<div id="main" class="cf" role="main" itemscope itemprop="mainContentOfPage" itemtype="http://schema.org/Blog">

							<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
							
							<article id="post-<?php the_ID(); ?>" <?php post_class( 'cf' ); ?> role="article" itemscope itemtype="http://schema.org/BlogPosting">
								
								<?php if( get_the_content() ) : ?>
									<section class="entry-content cf quiz-start active" itemprop="articleBody">
										<?php echo '<div class="q-mark">' . file_get_contents(get_template_directory_uri() . '/library/images/svg/question-mark.svg') . '</div>'; ?>
										<div class="col-12">
											<?php the_content(); ?>
											<button class="quiz-next alt-btn">Start</button>
										</div>
									</section>
									
									<?php
									$count = 0;
									if( have_rows('questions') ) : 
									while( have_rows('questions') ): the_row();
									$count += 1;
									?>
										<section class="entry-content cf quiz quiz-q<?php echo $count; ?>">
											<div class="col-12">
												<h2>
													<?php
														echo '<span>Question '.$count.' of '.count( get_field('questions') ).'</span>';
														the_sub_field('question');
													?>
												</h2>
												<div class="quiz-options">
													<button class="quiz-option quiz-option__a alt2-btn" data-option="a"><?php the_sub_field('option_a'); ?></button>
													<button class="quiz-option quiz-option__b alt2-btn" data-option="b"><?php the_sub_field('option_b'); ?></button>
													<button class="quiz-option quiz-option__c alt2-btn" data-option="c"><?php the_sub_field('option_c'); ?></button>
												</div>
												<button class="quiz-next">Next</button>
											</div>
										</section>
									<?php endwhile; endif; ?>
									
									<section class="entry-content cf quiz-end" itemprop="articleBody">
										<div class="wrap col-12">
											<ul class="outcomes">
												<li class="outcome-a">
													<h3>Mostly As</h3>
													<p><?php the_field('outcome_a'); ?></p>
												</li>
												<li class="outcome-b">
													<h3>Mostly Bs</h3>
													<p><?php the_field('outcome_b'); ?></p>
												</li>
												<li class="outcome-c">
													<h3>Mostly Cs</h3>
													<p><?php the_field('outcome_c'); ?></p>
												</li>
											</ul>
											
											<a href="/product-chain/contact-us/" class="btn alt1-btn">Contact us today</a>
											
											<div class="social">
												<p>Share this Test with your colleagues</p>
												<a href="https://www.linkedin.com/shareArticle?mini=true&url=<?php echo home_url( $wp->request ); ?>&title=Are%20we%20right%20for%20you?&summary=<?php echo home_url( $wp->request ); ?>&source=<?php echo home_url( $wp->request ); ?>" target="_blank"><i class="fab fa-linkedin-in"></i></a>
												<a href="https://twitter.com/home?status=<?php echo home_url( $wp->request ); ?>" target="_blank"><i class="fab fa-twitter"></i></a>
											</div>
										</div>
									</section>
								
									<div class="progress-bar"><div class="fill"></div></div>
								<?php endif; ?>

							</article>

							<?php endwhile; endif; ?>

						</div>

				</div>

			</div>

<?php get_footer(); ?>
