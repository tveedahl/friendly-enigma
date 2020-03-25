<?php
/**
 * The template for displaying all pages.
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site may use a
 * different template.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Rockit
 */

?>

<?php get_header(); ?>
<?php echo '<div class="container">'; ?>
    <?php
        if (is_page('About')) {
            get_template_part( 'template-parts/content-about', 'page' );
        } elseif (is_page('Portfolio')) {
            get_template_part( 'template-parts/content-portfolio', 'page' );
        } elseif (is_page('Contact')) {
            get_template_part( 'template-parts/content-contact', 'page' );
        }
    ?>
<?php echo '</div>'; ?>
<?php get_footer(); ?>
