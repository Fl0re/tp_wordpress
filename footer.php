<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package tp_theme
 */

?>

	</div><!-- #content -->

	<footer>

        <?php
        // Vérifie que l'utilisateur à assigner le menu
        if ( has_nav_menu( "menu-2" ) ) {
            wp_nav_menu( array(
                "theme_location" => "menu-2"
            ) );
        }
        ?>

    </footer>
</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>
