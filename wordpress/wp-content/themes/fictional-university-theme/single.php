<?php
get_header();

while (have_posts()) {
    the_post();
?>
    <div class="container" style="padding-top: 130px;">
        <h3><?php the_title(); ?></h3>
        <p><?php the_content(); ?></p>
    </div>
<?php }
get_footer();
