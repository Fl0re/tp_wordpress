<?php 
/*
    Template Name: Home template
*/

get_header();
get_custom_styles();
?>

    <div id="home-page">

        <div class="left-side">

            <?php

                while(have_posts()){

                    the_post();

                    $title = get_the_title();
                    $content = get_the_content();

                    $tech_posts = new WP_Query(array(
                        "cat" => get_option("home_category"),
                        "order" => "ASC",
                        "orderby" => "date"
                    ));
                    echo get_the_post_thumbnail( $page->ID, 'thumbnail' );
                    ?>
                    
                    <h1 class="home-title"> <?= $title ?> </h1>

                    <div class="home-content">

                        <?= apply_filters("the_content", $content)?>

                    </div>

                    <div class="posts-displayer flex">

                        <?php while( $tech_posts->have_posts() ){ 
                            
                            $tech_posts->the_post();

                            $post_title = get_the_title();
                            $post_thumb = get_the_post_thumbnail( null, "thumbnail" );
                            $link = get_the_permalink();
                         

                        ?>
                            <a href="<?= $link ?>">
                                <div class="post-item">

                                    <h5> <?= $post_title ?> </h5>
                                    <div> <?= $post_thumb ?> </div>

                                </div>
                            </a>
                        
                        <?php } ?>

                    </div>
                    
                    <?php

                }

            ?>

        </div>

        <div class="right-side">

            <?php dynamic_sidebar( "right_sidebar" ); ?>

        </div>

    </div>


<?php
get_footer();