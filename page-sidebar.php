<?php get_header(); ?>

<?php
/*
Template Name: Página con sidebar
*/
?>

<?php include('globalwidget.php'); ?>

<!-- CONTENEDOR -->
<div id="contenedor" class="row pagina">

  <!-- COLUMNA PRINCIPAL -->
  <div id="contenido" class="large-8 medium-8 columns">

    <!-- POST -->
    <?php if(have_posts()) : ?>
      <?php while(have_posts()) : the_post(); ?>
        <div class="post-titulo-contenedor">
          <h1 class="post-titulo"><?php the_title(); ?></h1>
        </div>

        <div class="post-cuerpo">
          <div class="post-imagen-caja">
            <span width="700" height="auto" class="extracto-imagen">
              <?php the_post_thumbnail('post'); ?>
            </span>
          </div>
          <div class="post-texto">
            <?php the_content(); ?>
          </div>
        </div>
        <!-- /POST -->

        <!-- BOTONES SOCIALES -->
        <div class="row botones-sociales">
          <div class="large-12 medium-12 columns">
            <h3>Compártenos</h3>
          </div>
          <hr/>
          <div class="large-4 medium-4 columns">
            <a href="http://www.facebook.com/share.php?u=<?php the_permalink(); ?>&title=<?php the_title(); ?>" class="boton-social boton-facebook">
              <i class="fa fa-facebook"></i>
              Facebook
            </a>
          </div>
          <div class="large-4 medium-4 columns">
            <a href="http://twitter.com/home?status=<?php the_title(); ?>+<?php the_permalink(); ?>" class="boton-social boton-twitter">
              <i class="fa fa-twitter"></i>
              Twitter
            </a>
          </div>
          <div class="large-4 medium-4 columns">
            <a href="https://plus.google.com/share?url=<?php the_permalink(); ?>" class="boton-social boton-google">
              <i class="fa fa-google-plus"></i>
              Google +
            </a>
          </div>
        </div>
        <!-- /BOTONES SOCIALES -->

      <?php endwhile; ?>
    <?php endif; ?>

  </div>
  <!-- /COLUMNA PRINCIPAL -->

  <!-- SIDEBAR -->
  <div id="sidebar" class="large-4 medium-4 columns">
    <div class="row">
      <?php include('sidebar.php'); ?>
    </div>
  </div>
  <!-- /SIDEBAR -->

</div>
<!-- /CONTENEDOR -->

<?php get_footer(); ?>
