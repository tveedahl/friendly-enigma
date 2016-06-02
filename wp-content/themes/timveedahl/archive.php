<?php
    /**
     * The template for displaying archive pages.
     *
     * @link https://codex.wordpress.org/Template_Hierarchy
     *
     * @package timVeedahl
     */

    ?>

    <?php get_header(); ?>
    <?php echo '<div class="container">'; ?>
    <?php
    /**
     * Checks if portfolio category exists, and creates it otherwise
     */
    $term = term_exists('Blog', 'category');
    if ($term !== 0 && $term !== null) {
        if (get_category($term["term_id"])->category_count > 0) {
            /**
             * Loop through posts in Blog category
             */
            echo '<h1 class="text-center">Blog</h1>';
            echo '<div class="container">';
                $new_query = new WP_Query();
                $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
                $new_query->query('category_name=Blog&showposts=5&paged='. $paged);
                while ($new_query->have_posts()) : $new_query->the_post();
                    echo '<div class="row blogTitle">';
                        echo '<div class="col-lg-8 col-lg-offset-2">';
                            echo '<h2>';
                                the_title();
                            echo '</h2>';
                        echo '</div>';
                    echo '</div>';
                    echo '<div class="row blogTime">';
                        echo '<div class="col-lg-8 col-lg-offset-2">';
                            the_time('M, d, Y');
                        echo '</div>';
                    echo '</div>';
                    echo '<div class="row blogContent">';
                        echo '<div class="col-lg-8 col-lg-offset-2">';
                            the_content();
                        echo '</div>';
                    echo '</div>';
                    echo '<div class="row blogTags">';
                        echo '<div class="col-lg-8 col-lg-offset-2">';
                            the_tags();
                        echo '</div>';
                    echo '</div>';
                endwhile;
                echo '<div class="row">';
                    echo '<div class="text-center">';
                        the_posts_pagination( array(
                            'mid_size'  => 2,
                            'prev_text' => __('Previous'),
                            'next_text' => __('Next'),
                        ));
                    echo '</div>';
                echo '</div>';
            echo '</div>';
        } else {
            /**
             * Create dummy posts if none exist
             */
            $posts_json_path = get_template_directory_uri() . "/data/blog.json";
            $posts_contents = file_get_contents($posts_json_path);
            $posts = json_decode($posts_contents);
            $portfolio_id = get_cat_id("Blog");
            foreach ($posts as $post_data) {
                foreach ($post_data as $post) {
                    /**
                     * Create post object
                     */
                    $my_post = array(
                        "post_title" => $post->post_title,
                        "post_content" => $post->post_content,
                        "post_status" => "publish",
                        "post_category" => array($portfolio_id)
                    );
                    wp_insert_post($my_post);
                }
            }
            /**
             * Refresh current page content
             */
            echo '<script type="text/javascript">';
            echo 'location.reload()';
            echo '</script>';
        }
    }
?>
<?php echo '</div>'; ?>
<?php get_footer(); ?>
