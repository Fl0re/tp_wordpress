<?php
/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package tp_theme
 */

get_header(); ?>


    <div id="article-container">

        <?php 
            // Ici on appelle la liste des articles (donc 1 seul pour cette page)
            while( have_posts() ) { 

                the_post(); // Sert a initialiser l'article en cours

                // the_title("<h1 class='title-article'>", "</h1>");

                // echo "<div class='content-article'>";
                //     the_content();
                // echo "</div>";

                // the_post_thumbnail('medium');
                
                $title = get_the_title();
                $categories = get_the_category();
                $tags = get_the_tags();
                ?>
                
                <h1 class="title-article"> <?= $title ?> </h1>
                
                            <?php echo get_the_post_thumbnail( $page->ID, 'thumbnail' ); ?>
                            
                                <?php get_template_part("template-parts/article") ?>>

                    <div class='relateds flex'>

                        <div class='related-cats cloud'>

                            <h3> Categories associées : </h3>

                            <ul>
                            <?php foreach( $categories as $category ){ ?>

                                <li> 

                                    <a href="<?= get_category_link( $category->cat_ID ) ?>"> 
                                        
                                        <?= $category->name ?> 

                                    </a> 

                                </li>
                            
                            <?php } ?>
                            </ul>

                        </div>

                        <?php if( $tags ) { ?>

                            <div class='related-tags cloud'>

                                <h3> Tags associées : </h3>
                            
                                <ul>

                                    <?php foreach( $tags as $tag ){ ?>

                                        <li> 

                                            <a href="<?= get_tag_link( $tag->term_id ) ?>"> 
                                                
                                                #<?= $tag->name ?> 

                                            </a>
                                    
                                        </li>

                                    <?php } ?>

                                </ul>

                            </div>

                        <?php } ?>

                    </div>

                <?php
            }
        ?>

    </div>


<?php
get_sidebar();
get_footer();
