<?php
/*
Template Name: Hub
*/

$large_image_url = '';
if ( has_post_thumbnail() ) {
  $large_image_url = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'hub_header' );
}

get_header(); ?>

<div id="container">

  <div class="hub" role="main">

    <div class="hub__header" style="background-image: url(<?php echo $large_image_url[0]; ?>)">
      <div class="hub__header__overlay">
        <div class="hub__header__text">
          <h1 class="hub__header__title"><?php echo $post->post_title ?></h1>
          <?php if(isset($post->post_excerpt) && $post->post_excerpt != ""): ?>
          <p class="hub__header__teaser"><?php echo $post->post_excerpt ?></p>
          <?php endif; ?>
        </div>
      </div>
    </div>

    <div class="hub__body">
      <p>this is body text</p>
    </div>

    <?php the_post(); ?>

    <div class="entry-content">
      <?php the_content(); ?>
    </div>

  </div>
</div>

<?php get_footer(); ?>
