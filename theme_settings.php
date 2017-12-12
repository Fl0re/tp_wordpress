<?php
/** Dev **/
function dd( $target ){
    echo "<pre>";
    var_dump( $target );
    echo "</pre>";
    die();
}

/** Themes  **/

// On va déclencher une action au moment ou le menu admin se charge
add_action("admin_menu", "generate_theme_menu");
add_action("admin_init", "add_option_customs");

// Ajoute des scripts coté admin
add_action("admin_enqueue_scripts", "load_scripts");
function load_scripts(){
    wp_enqueue_script( "jscolor", get_template_directory_uri()."/js/jscolor.min.js" );
}

function add_option_customs(){

    // On créer une option dans la bdd pour le choix de la categorie
    add_option("home_category", "");

    //On ajoute les options de couleur
    add_option("custom_colors", []);

}
function generate_theme_menu(){
    add_menu_page(
        "tp Theme",
        "tp Theme",
        "administrator",
        "tp_theme_menu", // Slug : un nom tout accroché sans charactere special en minuscule
        "generate_theme_menu_page", // Fonction appelé pour afficher la page
        "dashicons-welcome-widgets-menus",
        60
    );
}

function generate_theme_menu_page(){

    if( isset( $_POST["home_category"] ) ){
        update_option( "home_category", $_POST["home_category"] );
    }

    if( isset( $_POST["color_h"] ) 
        && isset( $_POST["color_c"] ) 
        && isset( $_POST["color_f"] ) 
    ){

        $colors = [
            "headers"   => $_POST["color_h"],
            "body"      => $_POST["color_c"],
            "background"=> $_POST["color_f"]
        ];

        update_option("custom_colors", $colors );

    }

    //
    $option_val = get_option("home_category");

    //
    $colors_val = [
        "headers"   => [],
        "body"      => "",
        "background"=> ""
    ];
    if( get_option("custom_colors") ) {
        $colors_val = get_option("custom_colors");
    }

    //
    $categories = get_categories();

    ?> 

    <h1> Administration de tp Theme </h1>

    <h2> Page d'accueil </h2> 

    <form method="post">

        <label>

            <span> Choix de la catégorie a afficher: </span>
            <select name="home_category">

                <?php foreach( $categories as $category ){ ?> 
                        
                    <option value="<?= $category->cat_ID ?>" <?php isSelected($category->cat_ID) ?> > 

                        <?= $category->name ?> 

                    </option>

                <?php } ?>

            </select>

        </label><br>

        <!-- Gestion couleur des titres -->

        <?php for( $i=0; $i < 6; $i++ ){ ?>

            <label> 
                <span> Couleur h<?= $i+1 ?> </span> 
                <input class="jscolor" type="text" name="color_h[]" value="<?= $colors_val["headers"][$i] ?>" />
            </label><br>

        <?php } ?>

        <label> 
            <span> Couleur corps </span> 
            <input class="jscolor" type="text" name="color_c" value="<?= $colors_val["body"] ?>" />
        </label><br>

        <label> 
            <span> Couleur fond<?= $i+1 ?> </span> 
            <input class="jscolor" type="text" name="color_f" value="<?= $colors_val["background"] ?>" />
        </label><br>

        <!-- Soumission formulaire -->
        <input type="submit" value="Valider">

    </form>

    <?php 
}

function isSelected( $value ){
    if( $value == get_option("home_category") ){
        echo "selected";
    }
}



add_action("wp_enqueue_scripts", "scriptJS");
function scriptJS(){
    wp_enqueue_script('my_custom_script', get_template_directory_uri() . '/js/script.js', array('jquery'));
}

add_action( "init", "slide_post_type");

function slide_post_type(){
    register_post_type("slide", [
        "label" => "Slide",
        "description" => "Slide",
        "show_in_menu" => true,
        "public" => true,
        "menu_position" => 2,
        "supports" => [
            "thumbnail"
        ]
    ]);
}

add_shortcode("slider", "display_slider");

function display_slider($atts){
  
    $slide = new WP_Query( [
        "post_type" => "slide"
    ]);
  
    $slide_html = "<div id='slide'>";
    if($slide->have_posts()){
      
        while($slide->have_posts()){

            $slide->the_post();

         
            $thumbnail = get_the_post_thumbnail_url(null, "medium");
           
            $slide_html .= "<div class='all_slide'><img src='" . $thumbnail . "' />";
          
            $slide_html .= "</div>";
            
        }
    }
    $slide_html .= "</div>";
    return $slide_html;
}