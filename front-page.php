<?php
/**
 * The template file for front page
 *
 * ...
 *
 * @package WordPress
 * @subpackage Startheme
 * @since 1.0.0
 *
 */

$lastspots = get_posts(array(
    'post_type' => 'spot',
    'numberposts' => 5,
    'orderby' => 'rand'
));

$focusnews = get_posts(array(
    'numberposts' => 1,
    'post__in' => get_option('sticky_posts'),
    'ignore_sticky_posts' => 1
));

get_header();
?>

    <main>

        <?php if (have_posts()) : while (have_posts()) : the_post(); ?>

            <?php get_template_part('template-parts/content', 'front-page'); ?>

        <?php endwhile;
        endif; ?>

    </main>

    <section class="front-spots container">

        <?php if ($lastspots) : ?>

            <div class="front-spots_grid">

                <?php foreach ($lastspots as $post) :
                    setup_postdata($post); ?>

                    <?php get_template_part('template-parts/content-archive', 'spot'); ?>

                <?php endforeach;
                wp_reset_postdata(); ?>

            </div>

        <?php endif; ?>

        <div class="text-center">
            <a href="<?= get_post_type_archive_link('spot') ?>"
               class="btn btn-outline-primary my-5"><?php _e('Tous les spots', 'startheme') ?></a>
        </div>

    </section><!-- .front-spots -->

<?php if($focusnews) : ?>

    <section class="sticky-post container my-5 pb-5">

        <?php foreach($focusnews as $post) :
            setup_postdata($post); ?>

            <article <?php post_class('sticky-post_article row') ?>>

                <figure class="card-figure mb-0 col-sm-10 col-md-6 offset-sm-1">
                    <a href="<?php the_permalink(); ?>" title="<?php _e( 'Lire la suite', 'startheme' ) ?>">
                        <?php the_post_thumbnail('thumb-medium', array('class'=>'img-fluid')); ?>
                    </a>
                </figure>

                <div class="sticky-post_content bg-white py-4 col-sm-10 offset-sm-1 col-md-4 offset-md-0">
                    <h2><?php _e('À la une', 'startheme') ?></h2>
                    <h3 class="h4"><a href="<?php the_permalink() ?>"><?php the_title() ?></a></h3>
                    <?php the_excerpt() ?>
                </div>

            </article>

        <?php endforeach;
        wp_reset_postdata(); ?>

    </section><!-- .sticky-post -->

<?php endif; ?>

<?php get_sidebar('lastnews') ?>

<?php get_footer() ?>