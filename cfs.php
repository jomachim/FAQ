<?php
/**
 * Plugin Name: Administration_FAQ
 * Plugin URI: http://www.pour-le-web.com/
 * Description: Plugin permettant de personnaliser l'administration de votre site wordpress: barre des tâches, page de login, footer de l'administration, message personnalisé dans le tableau de bord, etc.
 * Version: 0.1
 * Author: kaiboo84
 * Author URI:  http://www.pour-le-web.com
 * License: GPL2 license
 */
defined('ABSPATH') or die("No script kiddies please!");

function override_template( $page_template )
{

if (is_page( 'faq-questions-frequentes' )) {
$page_template = dirname( __FILE__ ) . '/page-faq.php';
}

}

// AJOUT DU CUSTOM POST TYPE FAQ
add_action('init', 'my_custom_post_init');

// Définition des FAQ
function my_custom_post_init()
{
$labels = array(
   'name' => _x('FAQs', 'post type general name'),
   'singular_name' => _x('FAQ', 'post type singular name'),
   'add_new' => _x('Ajouter', 'FAQ'),
   'add_new_item' => __('Ajouter une FAQ'),
   'edit_item' => __('Editer la FAQ'),
   'new_item' => __('Nouvelle FAQ'),
   'view_item' => __('Voir FAQ'),
   'search_items' => __('Chercher FAQs'),
   'not_found' =>  __('Aucune FAQ Trouvée'),
   'not_found_in_trash' => __('pas de FAQs dans la corbeille'),
   'parent_item_colon' => ''
 );
$args = array(
    'labels' => $labels,
    'public' => false,
    'publicly_queryable' => true,
    'show_ui' => true,
    'query_var' => true,
    'rewrite' => true,
    'capability_type' => 'post',
    'hierarchical' => false,
    'menu_position' => 5,
    'supports' => array('title','editor','thumbnail','custom-fields')
  );
register_post_type('faq_an',$args);
}

//Remplacer le "Saisissez votre titre ici"
function my_custom_enter_title_here($title){
  $screen = get_current_screen();
 
  switch ($screen->post_type) {
    case 'recette':
      $title = __('Saisissez le nom de la recette ici', 'TEXT_DOMAIN');
      break;
    case 'post':
      $title = __('Saisissez votre titre ici', 'TEXT_DOMAIN');
      break;
    case 'faq_an':
      $title = __('Saisissez la question ici', 'TEXT_DOMAIN');
      break;
   }
   return $title;
}
add_filter('enter_title_here', 'my_custom_enter_title_here');


function faq_shortcode( $atts, $content = null) {
 
  extract( shortcode_atts( array(
        'taxi' => '',
        'trie' => 'ASC'
      ), $atts 
    ) 
  );
  if($content==null || $content==''){
    $content='<h2><div>Aucune FAQ à afficher</div>';
  }
  
// magic comes here

  $type = 'faq_an';
  $args=array(
    'post_type' => $type,
    'post_status' => 'publish',
    'posts_per_page' => -1,
    'caller_get_posts'=> 1,
    'orderby' => 'date',
    'order'   => $trie
    );
  $my_query = null;
  $my_query = new WP_Query($args);
  if( $my_query->have_posts() ) {
    while ($my_query->have_posts()) : $my_query->the_post(); ?>
      <p><a href="<?php the_permalink() ?>" rel="bookmark" title="Permanent Link to <?php the_title_attribute(); ?>"><?php the_title(); ?></a>
        <div class="reponse_faq_an"><?php the_content();?></div></p>
      <?php
    endwhile;
  }
  wp_reset_query();  // Restore global post data stomped by the_post().


}
add_shortcode('faq_vue', 'faq_shortcode');


?>