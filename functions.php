<?php

///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//
//	SOPORTE
//
///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

/**
* SOPORTE PARA FONDO DE PÁGINA
* Recuerda poner los siguientes hooks:
* <?php wp_head(); ?> antes de </head> y
* <?php body_class(); ?> dentro de <body>
**********************************************************************************************************************/
add_theme_support('custom-background');


/**
* SOPORTE PARA IMÁGENES DESTACADAS
**********************************************************************************************************************/
if ( function_exists( 'add_theme_support' ) ) {
	add_theme_support( 'post-thumbnails', array('post') );
        set_post_thumbnail_size();
}


/**
* SOPORTE PARA POST FORMATS
**********************************************************************************************************************/

$newcode_post_formats = array( 'audio','gallery','video' );
add_theme_support( 'post-formats', $newcode_post_formats );


/**
* SOPORTE PARA JETPACK
**********************************************************************************************************************/

/* Controla los modulos disponibles */
function prefix_kill_all_the_jetpacks( $modules ) {
	$whitelist = array(
		// Comenta las lineas que no quieras que aparezcan
		// en la configuración de JetPack
		'after-the-deadline',
		'carousel',
		'comments',
		'contact-form',
		'custom-css',
		'enhanced-distribution',
		'gplus-authorship',
		'gravatar-hovercards',
		'infinite-scroll',
		'json-api',
		'latex',
		'likes',
		'minileven',
		'mobile-push',
		'monitor',
		'notes',
		'omnisearch',
		'photon',
		'post-by-email',
		'publicize',
		'sharedaddy',
		'shortcodes',
		'shortlinks',
		'sso',
		'stats',
		'subscriptions',
		'tiled-gallery',
		'vaultpress',
		'videopress',
		'widget-visibility',
		'widgets',
	);

	$modules = array_intersect_key( $modules, array_flip( $whitelist ) );
	return $modules;
}
add_filter( 'jetpack_get_available_modules', 'prefix_kill_all_the_jetpacks' );

/* Scroll Infinito */
function code_new_infinite_scroll() {
	add_theme_support( 'infinite-scroll', array(
	    'container'      => 'loop',
	    'footer' 		 => false,
	    'posts_per_page' => '10',
	    'wrapper'		 => 'infinite-posts'
	) );
}
add_action( 'init', 'code_new_infinite_scroll' );

/* Photon CDN */
if( function_exists( 'jetpack_photon_url' ) ) {
    add_filter( 'jetpack_photon_url', 'jetpack_photon_url', 10, 3 );
}


/**
* SOPORTE FACEBOOK OPEN GRAPH
**********************************************************************************************************************/
add_action('wp_head', 'add_fb_open_graph_tags');
function add_fb_open_graph_tags() {
	if (is_single()) {
		global $post;
		if(get_the_post_thumbnail($post->ID, 'thumbnail')) {
			$thumbnail_id = get_post_thumbnail_id($post->ID);
			$thumbnail_object = get_post($thumbnail_id);
			$image = $thumbnail_object->guid;
		} else {	
			$image = ''; // Change this to the URL of the logo you want beside your links shown on Facebook
		}
		//$description = get_bloginfo('description');
		$description = my_excerpt( $post->post_content, $post->post_excerpt );
		$description = strip_tags($description);
		$description = str_replace("\"", "'", $description);
?>
<meta property="og:title" content="<?php the_title(); ?>" />
<meta property="og:type" content="article" />
<meta property="og:image" content="<?php echo $image; ?>" />
<meta property="og:image:width" content="400" />
<meta property="og:image:height" content="400" />
<meta property="og:url" content="<?php the_permalink(); ?>" />
<meta property="og:description" content="<?php echo $description ?>" />
<meta property="og:site_name" content="<?php echo get_bloginfo('name'); ?>" />
<meta property="fb:app_id" content="521523557965875" />

<?php 	}
}

function my_excerpt($text, $excerpt){
	
    if ($excerpt) return $excerpt;

    $text = strip_shortcodes( $text );

    $text = apply_filters('the_content', $text);
    $text = str_replace(']]>', ']]&gt;', $text);
    $text = strip_tags($text);
    $excerpt_length = apply_filters('excerpt_length', 55);
    $excerpt_more = apply_filters('excerpt_more', ' ' . '[...]');
    $words = preg_split("/[\n
	 ]+/", $text, $excerpt_length + 1, PREG_SPLIT_NO_EMPTY);
    if ( count($words) > $excerpt_length ) {
            array_pop($words);
            $text = implode(' ', $words);
            $text = $text . $excerpt_more;
    } else {
            $text = implode(' ', $words);
    }

    return apply_filters('wp_trim_excerpt', $text, $excerpt);
}


///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//
//	FUNCIONES BÁSICAS
//
///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////


/**
* MEMORY MEGA MENÚ
* Imita el comportamiento del menú que hay en Elite Daily,
* que a su vez es una copia del que hay en
*
* http://codex.wordpress.org/Function_Reference/register_nav_menus#Examples
*
* Gracias a Awshout por el gist para el menú de Foundation:
* https://gist.github.com/awshout/3943026
**********************************************************************************************************************/

add_theme_support('menus');

register_nav_menus(array(
	'navegacion'	=> 'Navegación primaria',
	'footer-nav' 	=> 'Navegación secundaria',
));

function navegacion() {
wp_nav_menu( array(
	'theme_location' 	=> 'navegacion',
	'container'       	=> 'nav',
	'container_class'	=> 'menu',
	'menu_class' 		=> 'menu-seccion',
	'menu_id'         	=> 'menu-navegacion-primaria',
	'depth'				=> '2',
	'fallback_cb' => false,
	'walker' => new navegacion_walker()
	));
}

class navegacion_walker extends Walker_Nav_Menu {

	function display_element( $element, &$children_elements, $max_depth, $depth=0, $args, &$output ) {

		$element->has_children = !empty( $children_elements[$element->ID] );
		$element->classes[] = ( $element->current || $element->current_item_ancestor ) ? 'activo' : '';
		$element->classes[] = ( $element->has_children ) ? 'tiene-desplegable' : '';

		parent::display_element( $element, $children_elements, $max_depth, $depth, $args, $output );
	}

	function start_lvl( &$output, $depth = 0, $args = array() ) {
			$output .= "\n<ul class=\"menu-desplegable\"><div class=\"menu-desplegable-items\"><div class=\"menu-desplegable-items-etiqueta\">Secciones:</div>\n";
		}

	function start_el( &$output, $object, $depth = 0, $args = array(), $current_object_id = 0 ) {

 			$item_html = '';
			parent::start_el( $item_html, $object, $depth, $args );

			$classes = empty( $object->classes ) ? array() : (array) $object->classes;

			$output .= $item_html;

		}

}

function footer_nav() {
wp_nav_menu( array(
	'theme_location' => 'footer-nav',
	'menu_class' => 'subfooter-menu'
	));
}

function memory_mega_menu() {

  // Generamos la lista de categorias e iteramos a través de ella
  $args = array( 
    'orderby' => 'name',
    'order'   => 'ASC'
    );
  $categories = get_categories($args); 
  foreach ($categories as $category) {

    // Creamos contenedores separados para cada categoría que sean accesibles al leer el DOM
    echo '<div id="'.$category->slug.'-menu">';
    echo '<span class="nombre-categoria" style="display:none;">'.$category->slug.'</span>'; 

      // Creamos la query que recoje los posts de cada categoría
      $opt = array( 
        'category_name'   => $category->slug,
        'post_status'     => 'publish',
        'posts_per_page'  => 4
        );

      $submenu_item = new WP_Query($opt);    
      if($submenu_item->have_posts()) : while($submenu_item->have_posts()) : $submenu_item->the_post();

        // En cada iteración construimos el HTML a insertar
        echo '<div class="menu-desplegable-post">';
        echo '<span ';
        echo post_class();
        echo '>';
        echo '<div class="menu-desplegable-post-imagen">';
        echo '<a title="Ver ';
        echo the_title();
        echo '" href="';
        echo the_permalink();
        echo '">';
        echo the_post_thumbnail('portada');
        echo '</a>';
        echo '</div>';
        echo '<div class="menu-desplegable-post-titulo">';
        echo '<a class="menu-desplegable-post-enlace" title="Ver ';
        echo the_title();
        echo '" href="';
        echo the_permalink();
        echo '">';
        echo the_title();
        echo '</a>';
        echo '</div>';
        echo '</span>';
        echo '</div>';

      endwhile; endif;

    	echo '</div><br/>';

  }  
}

add_action('wp_ajax_mega_menu', 'memory_mega_menu');
add_action('wp_ajax_nopriv_mega_menu', 'memory_mega_menu');

/**
* SIDEBARS Y AREAS DE WIDGETS
**********************************************************************************************************************/ 
if ( function_exists('register_sidebar') ) {
	register_sidebar(array(
		'name' => 'superbanner',
		// 'id' => 'sidebar-1',
		'before_widget' => '<div id="%1$s" class="superbanner-contenedor %2$s">',
		'after_widget' => '</div>',
		'before_title' => '',
		'after_title' => '',
	));
	register_sidebar(array(
		'name' => 'globalbanner',
		// 'id' => 'sidebar-2',
		'before_widget' => '<div id="%1$s" class="globalbanner-contenedor %2$s">',
		'after_widget' => '</div>',
		'before_title' => '',
		'after_title' => '',
	));
	register_sidebar(array(
		'name' => 'lateral-arriba',
		// 'id' => 'sidebar-3',
		'before_widget' => '<div id="%1$s" class="bloque %2$s">',
		'after_widget' => '</div>',
		'before_title' => '<h3 class="bloque-titulo"><span>',
		'after_title' => '</span></h3>',
	));
	register_sidebar(array(
		'name' => 'lateral-medio',
		// 'id' => 'sidebar-4',
		'before_widget' => '<div id="%1$s" class="bloque %2$s">',
		'after_widget' => '</div>',
		'before_title' => '<h3 class="bloque-titulo"><span>',
		'after_title' => '</span></h3>',
	));
	register_sidebar(array(
		'name' => 'lateral-abajo',
		// 'id' => 'sidebar-5',
		'before_widget' => '<div id="%1$s" class="bloque %2$s">',
		'after_widget' => '</div>',
		'before_title' => '<h3 class="bloque-titulo"><span>',
		'after_title' => '</span></h3>',
	));
	register_sidebar(array(
		'name' => 'post',
		// 'id' => 'sidebar-6',
		'before_widget' => '<div id="%1$s" class="bloque %2$s">',
		'after_widget' => '</div>',
		'before_title' => '<h3 class="bloque-titulo"><span>',
		'after_title' => '</span></h3>',
	));
	register_sidebar(array(
		'name' => 'footer-uno',
		// 'id' => 'sidebar-7',
		'before_widget' => '<div id="%1$s" class="bloque %2$s">',
		'after_widget' => '</div>',
		'before_title' => '<h3 class="bloque-titulo"><span>',
		'after_title' => '</span></h3>',
	));
	register_sidebar(array(
		'name' => 'footer-dos',
		// 'id' => 'sidebar-8',
		'before_widget' => '<div id="%1$s" class="bloque %2$s">',
		'after_widget' => '</div>',
		'before_title' => '<h3 class="bloque-titulo"><span>',
		'after_title' => '</span></h3>',
	));
	register_sidebar(array(
		'name' => 'footer-tres',
		// 'id' => 'sidebar-9',
		'before_widget' => '<div id="%1$s" class="bloque %2$s">',
		'after_widget' => '</div>',
		'before_title' => '<h3 class="bloque-titulo"><span>',
		'after_title' => '</span></h3>',
	));
}


/**
* AÑADIR LOGO DESDE EL DASHBOARD
* Por Kirk Wight
* http://kwight.ca/2012/12/02/adding-a-logo-uploader-to-your-wordpress-site-with-the-theme-customizer/
**********************************************************************************************************************/

function new_code_theme_customizer( $wp_customize ) {
	$wp_customize->add_section( 'new_code_logo_section' , array(
		'title' => __( 'Logo', 'new_code' ),
		'priority' => 30,
		'description' => 'Añade un logotipo para reemplazar el nombre del sitio y la descripción',
		) );
	$wp_customize->add_setting( 'new_code_logo' );
	$wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'new_code_logo', array(
		'label' => __( 'Logo', 'new_code' ),
		'section' => 'new_code_logo_section',
		'settings' => 'new_code_logo',
		) ) );
	}
add_action('customize_register', 'new_code_theme_customizer');


/**
* CONTROLAMOS LOS EXCERPTS
**********************************************************************************************************************/

function custom_excerpt_length( $length ) {
	global $customLength;

	if($customLength) {
		return $customLength;
	} else {
		return 30;
	}
	// De esta manera podemos personalizar la salida usando
	// $customLength=30; echo get_the_excerpt(); $customLength=0;
	// entre etiquetas php estandar
}
function new_excerpt_more( $more ) {
	return ' <a class="leer-mas" href="'. get_permalink( get_the_ID() ) . '">' . __(' ... ', '') . '</a>';
}
add_filter( 'excerpt_more', 'new_excerpt_more' );
add_filter( 'excerpt_length', 'custom_excerpt_length', 999 );

/**
* DASHBOARD PERSOLNALIZADO
**********************************************************************************************************************/

// Login logo
function custom_login_logo() {
        echo '<style type="text/css">
        h1 a { 
        	background-image: url('.get_bloginfo('template_directory').'/img/logo_solo.png) !important;
			background-size: 300px !important;
			width: 300px !important;
			height: 33px !important;
        }

        </style>';
}
add_action('login_head', 'custom_login_logo');

// Pie de pagina del panel de Administración
function change_footer_admin() {  
    echo '&copy;2015 Copyright CÓDIGO NUEVO. Todos los derechos reservados - Creado por <a href="http://memorysoft.es">Memory Soft</a>';  
}  
add_filter('admin_footer_text', 'change_footer_admin');

// Borrar opciones de admin
function remove_menus() {
    remove_menu_page('edit.php?post_type=map'); // MapifyPro
}
add_action('admin_menu', 'remove_menus');

///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//
//	FUNCIONES AVANZADAS
//
///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

/**
* RESTRINGE LOS RESULTADOS DE LAS BÚSQUEDAS A LOS POSTS
**********************************************************************************************************************/

function filter_search($query) {
     if ($query->is_search) {
          $query->set('post_type', 'post');
     }
     return $query;
}
add_filter('pre_get_posts', 'filter_search');


/**
* CAMPOS DE CONTACTO EN EL PERFIL DE USUARIO
* Por TutPlus:
* http://code.tutsplus.com/articles/show-yourself-off-with-a-custom-author-box--wp-30009
**********************************************************************************************************************/

function contactos_usuario( $contactmethods ) {

    // Quitamos campos obsoletos de la ficha de usuario
    unset( $contactmethods[ 'aim' ] );
    unset( $contactmethods[ 'yim' ] );
    unset( $contactmethods[ 'jabber' ] );
    // Añadimos nuestros campos personalizados
    $contactmethods[ 'email_alt' ] 	= 'Email público';
    $contactmethods[ 'twitter' ] 	= 'Perfil de Twitter';
    $contactmethods[ 'facebook' ] 	= 'Perfil de Facebook';
    $contactmethods[ 'linkedin' ] 	= 'Perfil público de LinkedIn';
    $contactmethods[ 'googleplus' ] = 'Perfil de Google+';
    $contactmethods[ 'pinterest' ] 	= 'Perfil de Pinterest';
    $contactmethods[ 'flickr' ] 	= 'Perfil de Flickr';
    $contactmethods[ 'instagram' ] 	= 'Perfil de Instagram';
    $contactmethods[ 'youtube' ] 	= 'Perfil de Youtube';
    $contactmethods[ 'vimeo' ] 		= 'Perfil de Vimeo';
    $contactmethods[ 'tumblr' ] 	= 'Perfil de Tumblr';
    return $contactmethods;
}
add_filter( 'user_contactmethods', 'contactos_usuario' );


/**
* CONTADOR DE LECTURAS DE POSTS
* Por Boutros AbiChedid
* http://bacsoftwareconsulting.com/blog/index.php/wordpress-cat/how-to-track-and-display-post-views-count-in-wordpress-without-a-plugin/
*
* Lo renderizamos usando:
* <?php echo '(' . get_PostViews(get_the_ID()) .')'; ?>
**********************************************************************************************************************/

function PostViews($post_ID) {
    $count_key = 'post_views_count';
    $count = get_post_meta($post_ID, $count_key, true);

    if($count == ''){
        $count = 0;
        delete_post_meta($post_ID, $count_key);
        add_post_meta($post_ID, $count_key, '0');
        return $count . ' Visualizaciones';
    }else{
        $count++;
        update_post_meta($post_ID, $count_key, $count);

        if($count == '1'){
        return $count . ' lectura';
        }
        else {
        return $count . ' lecturas';
        }
    }
}

// Añadimos una columna con el número de lecturas de cada post en el Dashboard
// OCULTO PARA FUTURAS IMPLEMENTACIONES
// function get_PostViews($post_ID){
//     $count_key = 'post_views_count';
//     $count = get_post_meta($post_ID, $count_key, true);
//     return $count;
// }
// function post_column_views($newcolumn){
//     $newcolumn['post_views'] = __('Visualizaciones');
//     return $newcolumn;
// }
// function post_custom_column_views($column_name, $id){
//     if($column_name === 'post_views'){
//         echo get_PostViews(get_the_ID());
//     }
// }
// add_filter('manage_posts_columns', 'post_column_views');
// add_action('manage_posts_custom_column', 'post_custom_column_views',10,2);


/**
* LISTA PERSONALIZADA DE CATEGORIAS
**********************************************************************************************************************/

function get_my_category_list( $separator = '', $parents='', $post_id = false ) {

	global $wp_rewrite;
	$categories = get_the_category( $post_id );
	if ( !is_object_in_taxonomy( get_post_type( $post_id ), 'category' ) )
		return apply_filters( 'the_category', '', $separator, $parents );
	if ( empty( $categories ) )
		return apply_filters( 'the_category', __( 'Uncategorized' ), $separator, $parents );
	$rel = ( is_object( $wp_rewrite ) && $wp_rewrite->using_permalinks() ) ? 'rel="category tag"' : 'rel="category"';
	$thelist = '';
	if ( '' == $separator ) {
		$thelist .= '<ul class="post-categories">';
		foreach ( $categories as $category ) {
			$thelist .= "\n\t<li>";
			switch ( strtolower( $parents ) ) {
				case 'multiple':
					if ( $category->parent )
						$thelist .= get_category_parents( $category->parent, true, $separator );
						$thelist .= '<a class="category-'.$category->category_nicename.'" href="' . get_category_link( $category->term_id ) . '" title="' . esc_attr( sprintf( __( "View all posts in %s" ), $category->name ) ) . '" ' . $rel . '>' . $category->name.'</a></li>';
					break;
				case 'single':
					$thelist .= '<a class="category-'.$category->category_nicename.'" href="' . get_category_link( $category->term_id ) . '" title="' . esc_attr( sprintf( __( "View all posts in %s" ), $category->name ) ) . '" ' . $rel . '>';
					if ( $category->parent )
						$thelist .= get_category_parents( $category->parent, false, $separator );
					$thelist .= $category->name.'</a></li>';
					break;
				case '':
				default:
					$thelist .= '<a class="category-'.$category->category_nicename.'" href="' . get_category_link( $category->term_id ) . '" title="' . esc_attr( sprintf( __( "View all posts in %s" ), $category->name ) ) . '" ' . $rel . '>' . $category->name.'</a></li>';
			}
		}
		$thelist .= '</ul>';
	} else {
		$i = 0;
		foreach ( $categories as $category ) {
			if ( 0 < $i )
				$thelist .= $separator;
			switch ( strtolower( $parents ) ) {
				case 'multiple':
					if ( $category->parent )
						$thelist .= get_category_parents( $category->parent, true, $separator );
						$thelist .= '<a class="category-'.$category->category_nicename.'" href="' . get_category_link( $category->term_id ) . '" title="' . esc_attr( sprintf( __( "View all posts in %s" ), $category->name ) ) . '" ' . $rel . '>' . $category->name.'</a>';
					break;
				case 'single':
					$thelist .= '<a class="category-'.$category->category_nicename.'" href="' . get_category_link( $category->term_id ) . '" title="' . esc_attr( sprintf( __( "View all posts in %s" ), $category->name ) ) . '" ' . $rel . '>';
					if ( $category->parent )
						$thelist .= get_category_parents( $category->parent, false, $separator );
						$thelist .= "$category->name</a>";

					break;
				case '':
				default:
					$thelist .= '<a class="category-'.$category->category_nicename.'" href="' . get_category_link( $category->term_id ) . '" title="' . esc_attr( sprintf( __( "View all posts in %s" ), $category->name ) ) . '" ' . $rel . '>' . $category->name.'</a>';
			}
			++$i;
		}
	}
	return apply_filters( 'the_category', $thelist, $separator, $parents );
}


///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//
//	PLUGINS & WIDGETS
//
///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

/**
* LISTADO DE AUTORES
* Basado en la plantilla de Pippins:
* http://pippinsplugins.com/simple-wordpress-widget-template/
* 
* TODO: Remaquetar este widget. Documentar. 
**********************************************************************************************************************/

/* Lista los autores */
function autores() {
global $wpdb;

$authors = $wpdb->get_results("SELECT ID, user_nicename from $wpdb->users ORDER BY display_name");

foreach($authors as $author) {
	echo '<li>';
	// echo '<a class="autor-imagen" href="'.get_bloginfo('url').'/?author=';
	// echo $author->ID;
	// echo '">';
	// echo get_avatar($author->ID);
	// echo '</a>';
	echo '<a class="autor-nombre" href="'.get_bloginfo('url').'/?author=';
	echo $author->ID;
	echo '">';
	the_author_meta('display_name', $author->ID);
	echo '</a>';
	echo '</li>';
	}
}

class lista_autores extends WP_Widget {

    /** Constructor */
    function lista_autores() {
        parent::WP_Widget(false, $name = 'Listado de autores');
    }

 	/** Form */
    function form($instance) {

        $title 		= esc_attr($instance['title']);
        ?>

        <p>
          <label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:'); ?></label>
          <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $title; ?>" />
        </p>

        <?php
    }

    /** Update */
    function update($new_instance, $old_instance) {
		$instance = $old_instance;
		$instance['title'] = strip_tags($new_instance['title']);
        return $instance;
    }


    /** Output */
    function widget($args, $instance) {
        extract( $args );
        $title 		= apply_filters('widget_title', $instance['title']);
        ?>
          <?php echo $before_widget; ?>
            <?php if ( $title ) echo $before_title . $title . $after_title; ?>
						<ul class="autor-listado">
							<?php echo autores(); ?>
						</ul>
          <?php echo $after_widget; ?>
        <?php
    }
}

add_action('widgets_init', create_function('', 'return register_widget("lista_autores");'));


/**
* POSTS POR CATEGORIA
* Plugin Name: Category Widget
* Plugin URI: http://buffercode.com/plugin-display-post-titles-category-selection/
* Description: Easy way to display the number of post in that particular category by selecting from admin dashboard widget.
* Version: 1.5.1.1
* Author: vinoth06
* Author URI: http://buffercode.com/
* License: GPLv2
* License URI: http://www.gnu.org/licenses/gpl-2.0.html
**********************************************************************************************************************/

add_action('widgets_init', 'memory_category_widget');

function memory_category_widget() {
    register_widget('post_categorias');
}

class post_categorias extends WP_Widget {

	/** Constructor */
    function post_categorias() {
        $this->WP_Widget('post_categorias', 'Posts por categoría', 'Muestra los posts de una categoría');
    }

    public function form($instance) {
        if (isset($instance['memory_no_post']) && isset($instance['memory_category']) && isset($instance['memory_name']) && isset($instance['memory_bullet']) && isset($instance['memory_title_count']) && isset($instance['memory_combo_list']) && isset($instance['memory_please_select']) && isset($instance['memory_orderby']) && isset($instance['memory_header_link'])) {
            $memory_no_post_value = $instance['memory_no_post'];
            $memory_category_value = $instance['memory_category'];
            $memory_name_value = $instance['memory_name'];
            $memory_bullet_value = $instance['memory_bullet'];
            $memory_title_count_value = $instance['memory_title_count'];
            $memory_combo_list_value = $instance['memory_combo_list'];
            $memory_please_select_value = $instance['memory_please_select'];
            $memory_orderby_value = $instance['memory_orderby'];
            $memory_header_link_value = $instance['memory_header_link'];
        } else {//Setting Default Values
            $memory_no_post_value = 4;
            $memory_category_value = 2;
            $memory_name_value = 'Mi categoría';
            $memory_bullet_value = 2;
            $memory_title_count_value = 40;
            $memory_combo_list_value = 2;
            $memory_orderby_value = 4;
            $memory_please_select_value = 'Selecciona';
            $memory_header_link_value = 2;
        }
        ?>

        <!-- Formulario -->
        <p>Título: <input class="widefat" name="<?php echo $this->get_field_name('memory_name'); ?>" type="text" value="<?php echo esc_attr($memory_name_value); ?>" /></p>

        <p>Selecciona la categoría: <?php wp_dropdown_categories(array('name' => $this->get_field_name('memory_category'), 'selected' => $memory_category_value, 'id' => $this->get_field_id('memory_category'), 'class' => 'widefat')); ?> </p>

        <p>Número de posts:
            <select name="<?php echo $this->get_field_name('memory_no_post'); ?>" id="<?php echo $this->get_field_id('memory_no_post'); ?>" class="widefat">
                <?php
                $options = array('1' => '1', '2' => '2', '3' => '3', '4' => '4', '5' => '5', '6' => '6', '7' => '7', '8' => '8', '9' => '9', '10' => '10', 'All' => '11');
                foreach ($options as $langu => $code) {
                    echo '<option value="' . $code . '" id="' . $code . '"', $memory_no_post_value == $code ? ' selected="selected"' : '', '>', $langu, '</option>';
                }
                ?>
            </select></p>

        <p>Lista o desplegable:
            <select name="<?php echo $this->get_field_name('memory_combo_list'); ?>" id="<?php echo $this->get_field_id('memory_combo_list'); ?>" class="widefat">
                <?php
                $cl_options = array('Combo Box' => '1', 'Lista' => '2');
                foreach ($cl_options as $cl_langu => $cl_code) {
                    echo '<option value="' . $cl_code . '" id="' . $cl_code . '"', $memory_combo_list_value == $cl_code ? ' selected="selected"' : '', '>', $cl_langu, '</option>';
                }
                ?>
            </select></p>

        <p>Estilo de lista:
            <select name="<?php echo $this->get_field_name('memory_bullet'); ?>" id="<?php echo $this->get_field_id('memory_bullet'); ?>" class="widefat">
                <?php
                $bullet_options = array('Sí' => '1', 'No' => '2');
                foreach ($bullet_options as $bullet_value => $bullet_code) {
                    echo '<option value="' . $bullet_code . '" id="' . $bullet_code . '"', $memory_bullet_value == $bullet_code ? ' selected="selected"' : '', '>', $bullet_value, '</option>';
                }
                ?>
            </select></p>

        <p>Texto del desplegable:<input class="widefat" name="<?php echo $this->get_field_name('memory_please_select'); ?>" type="text" value="<?php echo esc_attr($memory_please_select_value); ?>" /></p>

        <p>Orden:
            <select name="<?php echo $this->get_field_name('memory_orderby'); ?>" id="<?php echo $this->get_field_id('memory_orderby'); ?>" class="widefat">
                <?php
                $orderby_options = array('Aleatorio' => '1', 'Ascendente' => '2', 'Descendente' => '3', 'Recientes' => '4', 'Modificados' => '5');
                foreach ($orderby_options as $orderby_value => $orderby_code) {
                    echo '<option value="' . $orderby_code . '" id="' . $orderby_code . '"', $memory_orderby_value == $orderby_code ? ' selected="selected"' : '', '>', $orderby_value, '</option>';
                }
                ?>
            </select></p>

        <?php
    }

    /** Update */
    function update($new_instance, $old_instance) {
        $instance = $old_instance;
        $instance['memory_no_post'] = (!empty($new_instance['memory_no_post']) ) ? strip_tags($new_instance['memory_no_post']) : '';

        $instance['memory_category'] = (!empty($new_instance['memory_category']) ) ? strip_tags($new_instance['memory_category']) : '';

        $instance['memory_name'] = (!empty($new_instance['memory_name']) ) ? strip_tags($new_instance['memory_name']) : '';

        $instance['memory_bullet'] = (!empty($new_instance['memory_bullet']) ) ? strip_tags($new_instance['memory_bullet']) : '';

        $instance['memory_title_count'] = (!empty($new_instance['memory_title_count']) ) ? strip_tags($new_instance['memory_title_count']) : '';

        $instance['memory_combo_list'] = (!empty($new_instance['memory_combo_list']) ) ? strip_tags($new_instance['memory_combo_list']) : '';

        $instance['memory_orderby'] = (!empty($new_instance['memory_orderby']) ) ? strip_tags($new_instance['memory_orderby']) : '';

        $instance['memory_header_link'] = (!empty($new_instance['memory_header_link']) ) ? strip_tags($new_instance['memory_header_link']) : '';

        $instance['memory_please_select'] = (!empty($new_instance['memory_please_select']) ) ? strip_tags($new_instance['memory_please_select']) : '';
        return $instance;
    }


    /** Output */
    function widget($args, $instance) {
        extract($args);
        echo $before_widget;
        $memory_name_value = apply_filters('widget_title', $instance['memory_name']);
        $memory_category_value = empty($instance['memory_category']) ? '&nbsp;' :
                $instance['memory_category'];
        $memory_no_post_value = empty($instance['memory_no_post']) ? '&nbsp;' :
                $instance['memory_no_post'];
        $memory_bullet_value = empty($instance['memory_bullet']) ? '&nbsp;' :
                $instance['memory_bullet'];
        $memory_title_count_value = empty($instance['memory_title_count']) ? '&nbsp;' :
                $instance['memory_title_count'];
        $memory_combo_list_value = empty($instance['memory_combo_list']) ? '&nbsp;' :
                $instance['memory_combo_list'];
        $memory_please_select_value = empty($instance['memory_please_select']) ? 'Please Select' :
                $instance['memory_please_select'];
        $memory_orderby_value = empty($instance['memory_orderby']) ? '&nbsp;' :
                $instance['memory_orderby'];
        $memory_header_link_value = empty($instance['memory_header_link']) ? '&nbsp;' :
                $instance['memory_header_link'];

        $memory_cat_site_url = get_site_url();
        $memory_category_id = get_the_category_by_ID($memory_category_value);
        $category_id_str_replaced = strtolower(str_replace(" ", "-", $memory_category_id));

        if ($memory_header_link_value == 1)
            $memory_header_link_t_f = '<a href="' . $memory_cat_site_url . '/category/' . $category_id_str_replaced . '">' . $memory_name_value . '</a>';
        else
            $memory_header_link_t_f = $memory_name_value;

        if (!empty($name)) {
            echo $before_title . $memory_header_link_t_f . $after_title;
        }
        if ($memory_no_post_value == 11) {
            $memory_no_post_values = -1;
        } else {
            $memory_no_post_values = $memory_no_post_value;
        }

        if ($memory_orderby_value == 3) {
            $args = array('category' => $memory_category_value, 'posts_per_page' => $memory_no_post_values, 'order' => 'DESC', 'orderby' => 'title');
        } else if ($memory_orderby_value == 2) {
            $args = array('category' => $memory_category_value, 'posts_per_page' => $memory_no_post_values, 'order' => 'ASC', 'orderby' => 'title');
        } else if ($memory_orderby_value == 1) {
            $args = array('category' => $memory_category_value, 'posts_per_page' => $memory_no_post_values, 'orderby' => 'rand');
        }  else if ($memory_orderby_value == 5) {
            $args = array('category' => $memory_category_value, 'posts_per_page' => $memory_no_post_values, 'orderby' => 'modified');
        } else {
            $args = array('category' => $memory_category_value, 'posts_per_page' => $memory_no_post_values, 'orderby' => 'ID');
        }

        $myposts = get_posts($args);
        global $post;
        if ($memory_combo_list_value == 2) {
            foreach ($myposts as $post) : setup_postdata($post);
                ?>
                <li class="bloque bloque-medio" <?php if ($memory_bullet_value == 2) { ?> style="list-style-type:none;"<?php } ?>>
                	<div class="extracto-post">
		              <span <?php post_class(); ?>>
		                <div class="extracto-imagen-caja">
		                  <a class="extracto-imagen" title="Ver <?php the_title(); ?>" href="<?php the_permalink(); ?>">
		                    <?php the_post_thumbnail('portada'); ?>
		                  </a>
		                </div>
		                <h3 class="extracto-titulo">
		                  <a title="Ver <?php the_title(); ?>" href="<?php the_permalink(); ?>">
		                    <?php the_title(); ?>
		                  </a>
		                </h3>
		              </span>
		            </div>
                </li>
            <?php endforeach;
        } else { ?>

            <select onchange="window.location.href = this.options[this.selectedIndex].value">
                <option value="" selected ><?php echo $memory_please_select_value; ?></option>
                <?php
                foreach ($myposts as $post) : setup_postdata($post);

                    $check_title = get_the_title();
                    $title_count = strlen($check_title);
                    if ($title_count > $memory_title_count_value) {
                        $substr_title = substr($check_title, 0, $memory_title_count_value) . '...';
                    } else {
                        $substr_title = $check_title;
                    }
                    ?>
                    <!-- memory Category Link Start -->
                    <option value="<?php echo the_permalink(); ?>"><?php echo $substr_title ?></option>
                    <!-- memory Category Link Ends -->

            <?php endforeach; ?>
            </select>

            <?php
        }
        wp_reset_postdata();
        echo $after_widget;
    }

}

/**
* REESCRIBE LAS URLS DE CATEGORÍAS
* Plugin Name: WP No Category Base
* Plugin URI: http://blinger.org/wordpress-plugins/no-category-base/
* Description: Removes '/category' from your category permalinks.
* Version: 1.1.1
* Author: iDope
* Author URI: http://efextra.com/
*
* Copyright 2008  Saurabh Gupta  (email : saurabh0@gmail.com)
*
* This program is free software; you can redistribute it and/or modify
* it under the terms of the GNU General Public License as published by
* the Free Software Foundation; either version 2 of the License, or
* (at your option) any later version.
*
* This program is distributed in the hope that it will be useful,
* but WITHOUT ANY WARRANTY; without even the implied warranty of
* MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
* GNU General Public License for more details.
*
* You should have received a copy of the GNU General Public License
* along with this program; if not, write to the Free Software
* Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
**********************************************************************************************************************/

// Refresh rules on activation/deactivation/category changes
register_activation_hook(__FILE__, 'no_category_base_refresh_rules');
add_action('created_category', 'no_category_base_refresh_rules');
add_action('edited_category', 'no_category_base_refresh_rules');
add_action('delete_category', 'no_category_base_refresh_rules');
function no_category_base_refresh_rules() {
	global $wp_rewrite;
	$wp_rewrite -> flush_rules();
}

register_deactivation_hook(__FILE__, 'no_category_base_deactivate');
function no_category_base_deactivate() {
	remove_filter('category_rewrite_rules', 'no_category_base_rewrite_rules');
	// We don't want to insert our custom rules again
	no_category_base_refresh_rules();
}

// Remove category base
add_action('init', 'no_category_base_permastruct');
function no_category_base_permastruct() {
	global $wp_rewrite, $wp_version;
	if (version_compare($wp_version, '3.4', '<')) {
		// For pre-3.4 support
		$wp_rewrite -> extra_permastructs['category'][0] = '%category%';
	} else {
		$wp_rewrite -> extra_permastructs['category']['struct'] = '%category%';
	}
}

// Add our custom category rewrite rules
add_filter('category_rewrite_rules', 'no_category_base_rewrite_rules');
function no_category_base_rewrite_rules($category_rewrite) {
	//var_dump($category_rewrite); // For Debugging

	$category_rewrite = array();
	$categories = get_categories(array('hide_empty' => false));
	foreach ($categories as $category) {
		$category_nicename = $category -> slug;
		if ($category -> parent == $category -> cat_ID)// recursive recursion
			$category -> parent = 0;
		elseif ($category -> parent != 0)
			$category_nicename = get_category_parents($category -> parent, false, '/', true) . $category_nicename;
		$category_rewrite['(' . $category_nicename . ')/(?:feed/)?(feed|rdf|rss|rss2|atom)/?$'] = 'index.php?category_name=$matches[1]&feed=$matches[2]';
		$category_rewrite['(' . $category_nicename . ')/page/?([0-9]{1,})/?$'] = 'index.php?category_name=$matches[1]&paged=$matches[2]';
		$category_rewrite['(' . $category_nicename . ')/?$'] = 'index.php?category_name=$matches[1]';
	}
	// Redirect support from Old Category Base
	global $wp_rewrite;
	$old_category_base = get_option('category_base') ? get_option('category_base') : 'category';
	$old_category_base = trim($old_category_base, '/');
	$category_rewrite[$old_category_base . '/(.*)$'] = 'index.php?category_redirect=$matches[1]';

	//var_dump($category_rewrite); // For Debugging
	return $category_rewrite;
}

// For Debugging
//add_filter('rewrite_rules_array', 'no_category_base_rewrite_rules_array');
//function no_category_base_rewrite_rules_array($category_rewrite) {
//	var_dump($category_rewrite); // For Debugging
//}

// Add 'category_redirect' query variable
add_filter('query_vars', 'no_category_base_query_vars');
function no_category_base_query_vars($public_query_vars) {
	$public_query_vars[] = 'category_redirect';
	return $public_query_vars;
}

// Redirect if 'category_redirect' is set
add_filter('request', 'no_category_base_request');
function no_category_base_request($query_vars) {
	//print_r($query_vars); // For Debugging
	if (isset($query_vars['category_redirect'])) {
		$catlink = trailingslashit(get_option('home')) . user_trailingslashit($query_vars['category_redirect'], 'category');
		status_header(301);
		header("Location: $catlink");
		exit();
	}
	return $query_vars;
}


/**
* EXCLUYE CATEGORIAS DE LA HOME
* Name: Remove Posts in Category From Homepage
* Description: Hides certain categories from apearing on the main loop using a checkbox on edit/create category page.
* Author: David Walsh
* Author URI: http://davidwalsh.name/wordpress-plugin-homepage
* Version: 1.1
*/

$RCFH_LOOP_LABEL = 'Ocultar en la home';
$RCFH_LOOP_DESCRIPTION = 'Activa esta opción si quieres que esta categoría sea excluida de la página principal.';
$RCFH_LOOP_OPTION_KEY = 'remove-loop-cats';

// Add the extra field to the EDIT category page
	add_action('category_edit_form_fields', 'rcfh_loop_field_edit');
	function rcfh_loop_field_edit($term) {
		global $RCFH_LOOP_LABEL, $RCFH_LOOP_DESCRIPTION, $RCFH_LOOP_OPTION_KEY;

		$value = get_option($RCFH_LOOP_OPTION_KEY);
		if(!$value) {
			$value = array();
		}

		$checked = in_array($term->term_id, $value);
?>

	<tr class="form-field">
		<th scope="row" valign="top"><?php _e($RCFH_LOOP_LABEL); ?></label></th>
		<td>
			<label for="removeMainLoop"><input type="checkbox" style="width:1%;float:left;" name="remove-loop" id="removeMainLoop"<?php echo $checked ? ' checked="checked"' : ''; ?> value="1" /><span class="description"><?php _e($RCFH_LOOP_DESCRIPTION); ?></span>
		</td>
	</tr>

<?php }

	// Add the extra field to the ADD category page
	add_action('category_add_form_fields', 'rcfh_loop_field_create');
	function rcfh_loop_field_create() {
		global $RCFH_LOOP_LABEL, $RCFH_LOOP_DESCRIPTION;
?>

	<div class="form-field">
		<label for="removeMainLoop"><input type="checkbox" style="width:5%;float:left;" name="remove-loop" id="removeMainLoop" value="1" /><?php _e($RCFH_LOOP_LABEL); ?></label>
		<p><?php _e($RCFH_LOOP_DESCRIPTION); ?></p>
	</div>

<?php }

// Add action for saving extra category information
add_action('edit_category', 'rcfh_save_loop_value');
add_action('create_category', 'rcfh_save_loop_value');
function rcfh_save_loop_value($id) {
	global $RCFH_LOOP_OPTION_KEY;

	$value = get_option($RCFH_LOOP_OPTION_KEY);
	if(!$value) {
		$value = array();
	}

	// Add or remove the value
	if(isset($_POST['remove-loop'])) {
		array_push($value, $id);
	}
	else {
		$value = array_diff($value, array($id));
	}

	// Ensure no duplicates, just for cleanliness
	$value = array_unique(array_values($value));

	// Save
	update_option($RCFH_LOOP_OPTION_KEY, $value);
}

// Filter for removing said category posts from main loop
add_action('pre_get_posts', 'rcfh_prevent_posts');
function rcfh_prevent_posts($query) {
	global $RCFH_LOOP_OPTION_KEY;

	// Only remove categories if it's the main query/homepage
	if($query->is_home() && $query->is_main_query()) {
		$value = get_option($RCFH_LOOP_OPTION_KEY);

		// Modify query to remove posts which shouldn't be shown
		if(count($value)) {
			$query->set('cat', '-'.implode(',-', $value));
		}
	}
}

?>
