<div id="post-<?php the_ID(); ?>" class="caja-post columns">
  <span <?php post_class(); ?>>
    <div class="extracto-post">
      <div class="extracto-imagen-caja">
        <?php edit_post_link('Editar', ''); ?>
        <a title="<?php the_title(); ?>" href="<?php the_permalink(); ?>">
          <div class="extracto-imagen">
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
  </span>
</div>