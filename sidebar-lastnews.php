<?php
/**
 * The last posts sidebar displayed before footer
 *
 * @package startheme
 */

$exclude = is_front_page() ? get_option('sticky_posts') : get_the_ID();

$lastnews = get_posts(array(
    'numberposts' => 5,
    'category_name' => 'actualites',
    'exclude' => $exclude
));
?>

<section class="sidebar-lastnews bg-light py-5">

    <div class="container">

        <header class="sidebar-header d-flex flex-wrap justify-content-between align-items-start">
            <h2 class="sidebar-title"><?php _e('Dernières actualités', 'startheme') ?></h2>
            <a href="<?= esc_url(get_category_link(1)) ?>"
               class="btn btn-outline-primary"><?php _e('Toutes les actualités', 'startheme') ?></a>
        </header>

        <?php if ($lastnews) : ?>

            <div class="carousel-news owl-carousel mt-5 mt-sm-4">

                <?php foreach ($lastnews as $post) :
                    setup_postdata($post); ?>

                    <article <?php post_class('card border-0'); ?>>

                        <figure class="card-figure mb-0">
                            <a href="<?php the_permalink(); ?>" title="<?php _e('Lire la suite', 'startheme') ?>">
                                <?php the_post_thumbnail('thumb-medium', array('class' => 'img-fluid')); ?>
                            </a>
                        </figure>

                        <div class="card-body">
                            <h3 class="card-title h4"><a href="<?php the_permalink(); ?>"
                                                         title="<?php _e('Lire la suite', 'startheme') ?>"><?php the_title(); ?></a>
                            </h3>
                            <?php the_excerpt(); ?>
                        </div>

                    </article>

                <?php endforeach;
                wp_reset_postdata(); ?>

            </div>

        <?php endif; ?>

    </div>

</section>