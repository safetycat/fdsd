
              <?php
                /*
                 * This is the default post format.
                 *
                 * So basically this is a regular post. if you don't want to use post formats,
                 * you can just copy ths stuff in here and replace the post format thing in
                 * single.php.
                 *
                 * The other formats are SUPER basic so you can style them as you like.
                 *
                 * Again, If you want to remove post formats, just delete the post-formats
                 * folder and replace the function below with the contents of the "format.php" file.
                */
              ?>

              <article id="post-<?php the_ID(); ?>" <?php post_class('cf'); ?> role="article" itemscope itemtype="http://schema.org/BlogPosting">

                <header class="article-header">

                   <?php 
                    
                    $publication_type = get_the_terms( $post->ID, 'publication_type'); 
                    if($publication_type != false){
                      $publication_type=(array_pop($publication_type));
                      echo ("<div class='pub-meta tax-pub_type'>" . $publication_type->name. "</div>");
                    } 

                    
                    ?>
                   
                  <h1 class="entry-title single-title" itemprop="headline"><?php the_title(); ?></h1>

                  <p class="byline vcard">
                    <?php 
                    
                    $years = get_the_term_list( $post->ID, 'pub_year', 'Published: ', ', ' ); 
                    echo ("<div class='pub-meta tax-years'>" . $years . "</div>");

                    $authors = get_the_term_list( $post->ID, 'authors', 'Author(s): ', ', ' ); 
                    echo ("<div class='pub-meta tax-authors'>" . $authors . "</div>");


                    ?>
                  
                  </p>

                </header> <?php // end article header ?>

                <section class="entry-content cf" itemprop="articleBody">
                  <?php

                    if('idea' == get_post_type()){
                      $title = get_post(get_post_thumbnail_id())->post_title; 
                      //the_post_thumbnail('large');
                       //$title = get_post(get_post_thumbnail_id())->post_title; 
                      //the_post_thumbnail( 'large', array('title' => the_title_attribute() ));
                  }the_post_thumbnail( 'large', array( 'title' => $title ) ); 


                    // the content (pretty self explanatory huh)
                    the_content();

                    /*
                     * Link Pages is used in case you have posts that are set to break into
                     * multiple pages. You can remove this if you don't plan on doing that.
                    */
                    wp_link_pages( array(
                      'before'      => '<div class="page-links"><span class="page-links-title">' . __( 'Pages:', 'bonestheme' ) . '</span>',
                      'after'       => '</div>',
                      'link_before' => '<span>',
                      'link_after'  => '</span>',
                    ) );


                    // Ideas in Action
                    // Links
                    if( have_rows('link') ):
                      while ( have_rows('link') ) : the_row();
                        echo ("<div class='link-btn'><i class='fa fa-external-link'></i><a href='" . get_sub_field('url') . "' >" . get_sub_field('url') . "</a></div>");
                        //the_sub_field('document');
                      endwhile;
                  endif;


                  //Publications
                  // Download - can be multiple
                  if( have_rows('download') ):
                      while ( have_rows('download') ) : the_row();
                        echo ("<div class='downl-btn'><a href='" . get_sub_field('document') . "' >Download</a></div>");
                        //the_sub_field('document');
                      endwhile;
                  endif;

                  ?>
                </section> <?php // end article section ?>

                <footer class="article-footer">

                  <?php 


                    $topics = get_the_term_list( $post->ID, 'topics', 'Topics: ', ', ' ); 
                    echo ("<div class='pub-meta tax-topics'>" . $topics . "</div>");

                    $themes = get_the_term_list( $post->ID, 'themes', 'Themes: ', ', ' ); 
                    echo ("<div class='pub-meta tax-themes'>" . $themes . "</div>");

                   ?>

                  <?php //the_tags( '<p class="tags"><span class="tags-title">' . __( 'Tags:', 'bonestheme' ) . '</span> ', ', ', '</p>' ); ?>

                </footer> <?php // end article footer ?>

                <?php if('idea' != get_post_type()){
                  comments_template();
                  }
                   ?>

              </article> <?php // end article ?>