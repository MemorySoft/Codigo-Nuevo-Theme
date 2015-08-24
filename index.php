<?php get_header(); ?>

<!-- WIDGETS TOP -->
<div id="superbanner">
  <?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('superbanner') ) : ?>
  <?php endif; ?>
</div>

<?php include('globalwidget.php'); ?>
<!-- /WIDGETS TOP -->

<!-- CONTENEDOR -->
<div id="contenedor" class="row">

  <!-- COLUMNA PRINCIPAL -->
  <div id="contenido" class="large-8 medium-8 columns">

    <!-- BLOG ROLL -->
    <!-- Aquí insertamos el contenido que viene de scrollinfinito.php -->
    <div id="loop" class="row">
        
      <?php if(have_posts()) : ?>

        <?php while(have_posts()) : the_post(); ?>
        <?php get_template_part( 'content', get_post_format() ); ?>
        <?php endwhile; ?>

        <?php else: ?>

        <div class="large-12 medium-12 columns">
          <h2>Ups</h2>
          <p>Vaya, parece que aún no hay artículos publicados aquí...</p>
        </div>

      <?php endif; ?>    
    </div>
    <!-- /BLOG ROLL -->

    <!-- PAGINADOR -->
    <div id="post-navegacion" class="row">
      <hr/>
      <div class="large-12 medium-12 columns">
        <div class="post-recientes"><i class="fa fa-chevron-left"></i> <?php previous_posts_link( 'Recientes' ); ?></div>
        <div class="post-antiguos"><?php next_posts_link( 'Antiguos' ); ?> <i class="fa fa-chevron-right"></i></div>
      </div>
    </div>
    <!-- /PAGINADOR -->

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
