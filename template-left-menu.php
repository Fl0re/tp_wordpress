<?php 
/* 
    Template Name: Left Menu
*/
get_header();
get_custom_styles();
?>

    <div id="template-container">

        <div class="left-content">
            <!-- Afficher le menu -->
            <?php 
                if ( has_nav_menu( "menu-3" ) ) {
                    wp_nav_menu( array(
                        "theme_location" => "menu-3"
                    ) );
                }
            ?>
        </div>

        <div class="content"> 

            <?php 
            
            while(have_posts()) {

                the_post();

                the_title("<h1>", "</h1>");
                the_content();

            }

            ?>

        </div>

    </div>

<?php 
get_footer();