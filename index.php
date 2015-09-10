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

      <!-- SLOT PARA NATIVEAD -->
      <div id="native-preload" style="display:none;">
        <div class="caja-post columns" id="nativeadHome">
          <span class="post-nativead post type-post status-publish format-standard has-post-thumbnail hentry category-humor">
            <div class="extracto-post">
              <div class="extracto-imagen-caja">
                <a title="" href="/nativead/">
                  <div class="extracto-imagen">
                    <img src="" class="attachment-post wp-post-image" alt="" height="450" width="600">
                  </div>
                </a>
              </div>
              <div class="extracto-info">
                <div class="extracto-categoria">
                  <ul class="post-categories">
                    <li><a class="category-nativead" href="/nativead/" title="" rel="category tag"></a></li>
                  </ul>
                </div>
                <div class="extracto-autor">
                  <a href="/nativead/" title="" rel="author"></a>
                </div>
                <div class="extracto-fecha">
                </div>
              </div>
              <h3 class="extracto-titulo"><a title="" href="/nativead/"></a></h3>
              <p class="extracto-texto"></p>
            </div>
          </span>
        </div>
      </div>
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
