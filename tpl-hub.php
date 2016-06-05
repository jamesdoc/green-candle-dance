<?php
/*
Template Name: Hub
*/

$large_image_url = '';
if ( has_post_thumbnail() ) {
  $large_image_url = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'hub_header' );
  $large_image_url = $large_image_url[0];
}
$children = gcd_get_subpages();

get_header(); ?>

<div id="container">

  <div class="hub hub--theme--<?php echo gcd__parent__slug($post->ID) ?>" role="main">

    <div class="hub__header" style="background-image: url(<?php echo $large_image_url; ?>)">
      <div class="hub__header__overlay">
        <div class="hub__header__nav">
          <?php gcd_parent_link($post->post_parent); ?>
        </div>
        <div class="hub__header__text">
          <h1 class="hub__header__title"><?php echo $post->post_title ?></h1>
          <?php if(isset($post->post_excerpt) && $post->post_excerpt != ""): ?>
            <p class="hub__header__teaser"><?php echo $post->post_excerpt ?></p>
          <?php endif; ?>
        </div>
      </div>
    </div>

    <?php if (!empty ($post->post_content)) : ?>
      <div class="hub__intro">
        <?php
          the_post();
          the_content();
        ?>
      </div>
    <?php endif; ?>

    <? if (count($children) > 0): ?>
    <div class="hub__body">

      <?php foreach ($children as $child): ?>

        <?php
          $excerpt = wp_kses_post( wp_trim_words( $child->post_content, 20 ) );
          if ( !empty( $child->post_excerpt ) ) {
            $excerpt = wp_kses_post( $child->post_excerpt );
          }

          if ( has_post_thumbnail() ) {
            $hub_image = wp_get_attachment_image_src( get_post_thumbnail_id( $child->ID ), 'hub_thumbnail' );
          }
        ?>

        <a href="<?php echo get_permalink($child->ID) ?>" class="hub__promobox">
          <img src="<?php echo $hub_image[0]; ?>" alt="" class="hub__promobox__image" />
          <h2 class="hub__promobox__title"><?php echo $child->post_title ?></h2>
          <p class="hub__promobox__teaser"><?php echo $excerpt ?></p>
          <span class="hub__promobox__read-more btn btn--point-right">Find out more</span>
        </a>
      <?php endforeach; ?>
    </div>
    <? endif; ?>

  </div>
</div>

<?php get_footer(); ?>
