<?php get_header() ?>
<div class="page-banner">
    <div class="page-banner__bg-image" style="background-image: url(<?php echo get_theme_file_uri('images/ocean.jpg') ?>)"></div>
    <div class="page-banner__content container container--narrow">
        <h1 class="page-banner__title"><?php the_title(); ?></h1>
        <div class="page-banner__intro">
            <p>Learn how the school of your dreams got started.</p>
        </div>
    </div>
</div>

<div class="container container--narrow page-section">
    <?php if (wp_get_post_parent_id(get_the_ID())) { ?>
        <div class="metabox metabox--position-up metabox--with-home-link">
            <p>
                <a class="metabox__blog-home-link" href="<?php echo site_url('/about-us') ?>">
                    <i class="fa fa-home" aria-hidden="true"></i> Back to About Us</a>
                <span class="metabox__main">Our History</span>
            </p>
        </div>
    <?php } ?>
</div>
<div class="container">
    <div class="row">
        <div class="col-md-8">
            <?php
            while (have_posts()) {
                the_post();
            ?>
                <?php the_content(); ?>
            <?php } ?>
        </div>
        <div class="col-md-4 list-unstyled">
            <?php
            $theParent = wp_get_post_parent_id(get_the_ID());
            if ($theParent) {
                $parentTitle = get_the_title($theParent);
                echo '<div class="page-links">';
                echo '<h2 class="page-links__title"><a href="' . get_permalink($theParent) . '">' . $parentTitle . '</a></h2>';
                echo '<ul class="min-list">';
                wp_list_pages(array(
                    'child_id' => 12,
                    'title_li' => '',
                ));
                echo '</ul>';
                echo '</div>';
            } else {
                echo '<div class="page-links">';
                echo '<ul class="min-list">';
                wp_list_pages(array(
                    'child_id' => 12,
                    'title_li' => '',
                ));
                echo '</ul>';
                echo '</div>';
            }
            ?>
        </div>
    </div>
</div>
<?php get_footer() ?>