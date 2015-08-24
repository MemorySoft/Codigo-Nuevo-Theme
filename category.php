<?php get_header(); ?>

<?php include('globalwidget.php'); ?>

<!-- CONTENEDOR -->
<div id="contenedor" class="row categoria">
  
  <!-- COLUMNA PRINCIPAL -->
  <div id="contenido" class="large-8 medium-8 columns">

    <div class="row">
      <div class="post-titulo-contenedor large-12 medium-12 columns">
        <?php ?>
          <?php if (is_category()) { ?>
            <h3 class="post-titulo"><?php single_cat_title(); ?></h3>
          <?php } elseif( is_tag() ) { ?>
            <h3 class="post-titulo"><?php single_tag_title(); ?></h3>
          <?php } elseif (is_day()) { ?>
            <h3 class="post-titulo"><?php the_time('F jS, Y'); ?></h3>
          <?php } elseif (is_month()) { ?>
            <h3 class="post-titulo"><?php the_time('F, Y'); ?></h3>
          <?php } elseif (is_year()) { ?>
            <h3 class="post-titulo"><?php the_time('Y'); ?></h3>
          <?php } elseif (is_author()) { ?>
            <h3 class="post-titulo"><?php get_the_author();?></h3>
          <?php } elseif (isset($_GET['paged']) && !empty($_GET['paged'])) { ?>
            <h3 class="post-titulo">Archivo de Código Nuevo</h3>
        <?php } ?>
      </div>

      
      <hr/>
    </div>

    <div id="loop" class="row">
      <!-- POSTS -->
      <?php if(have_posts()) : ?>
        <?php while(have_posts()) : the_post(); ?>

          <div class="caja-post columns">
            <div class="extracto-post">
              <div class="extracto-imagen-caja">
                <?php edit_post_link('Editar', ''); ?>
                <a title="<?php the_title(); ?>" href="<?php the_permalink(); ?>">
                  <div width="700" class="extracto-imagen">
                    <?php the_post_thumbnail('post'); ?>
                  </div>
                </a>
              </div>
              <div class="extracto-info">
                <div class="extracto-categoria"><?php $cat_list = get_my_category_list(); echo $cat_list; ?></div>
                <div class="extracto-autor"><?php the_author_posts_link(); ?></div>
                <div class="extracto-fecha"><?php the_time('j \d\e\ F'); ?></div>
              </div>
              <h3 class="extracto-titulo">
                <a title="Ver <?php the_title(); ?>" href="<?php the_permalink(); ?>" >
                  <?php the_title(); ?>
                </a>
              </h3>
              <p class="extracto-texto">
                <?php echo get_the_excerpt(); ?>
              </p>
            </div>
          </div>

        <?php endwhile; else: ?>
        <div class="large-12 medium-12 columns">
          <p>Vaya, parece que aún no hay artículos publicados en esta categoria.<br>
          Prueba a buscar otra cosa.</p>  
        </div>

        <!-- BUSQUEDA -->
          <div class="large-12 medium-12 columns show-for-large-up">
            <hr>
            <form method="get" id="buscador-extra" action="<?php bloginfo('url'); ?>/">
              <div class="row collapse">
                <div class="large-10 small-12 columns"> 
                  <input id="buscador-texto-extra" type="text" placeholder="Buscar en Código Nuevo" name="s" value="<?php the_search_query(); ?>"> 
                </div> 
                <div class="large-2 small-12 columns"> 
                  <button class="button postfix" type="submit" id="buscador-boton-extra"><i class="fa fa-search fa-lg"></i> Buscar</button>
                </div>
              </div>
            </form>
          </div>
        <!-- /BUSQUEDA -->
      <?php endif; ?>
      <!-- /POSTS -->

    </div>  

  </div>   
  <!-- /COLUMNA PRINCIPAL -->  

  <!-- SIDEBAR -->
  <div id="sidebar" class="large-4 medium-4 columns">
    <div class="row">
      <?php include('sidebar-simple.php'); ?>
    </div>  
  </div>
  <!-- /SIDEBAR -->

</div>
<!-- /CONTENEDOR -->

<?php get_footer();?>