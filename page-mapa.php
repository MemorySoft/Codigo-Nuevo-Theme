<?php get_header(); ?>

<?php
/*
Template Name: Página de mapa
*/
?>

<!-- POST -->
<?php if(have_posts()) : ?>
  <?php while(have_posts()) : the_post(); ?>
    
    <div class="post-cuerpo">
      <div class="post-texto">
        <?php the_content(); ?>
      </div>
    </div>
    <!-- /POST -->

  <?php endwhile; ?>
<?php endif; ?>

<?php get_footer(); ?>
