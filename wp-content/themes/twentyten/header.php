<?php
/**
 * The Header for our theme.
 *
 * Displays all of the <head> section and everything up till <div id="main">
 *
 * @package WordPress
 * @subpackage Twenty_Ten
 * @since Twenty Ten 1.0
 */
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
    <head>
        <meta charset="<?php bloginfo('charset'); ?>" />
        <title>
            <?php
            /*
             * Print the <title> tag based on what is being viewed.
             */
            global $page, $paged;

            wp_title('|', true, 'right');

            // Add the blog name.
            // Убрано bloginfo('name');.                                + v1.01 b01
            // Дублировалось название сайта в заголовке окна.   
            // bloginfo('name');
            // 
            // Add the blog description for the home/front page.
            // Убрано.                                                  + v1.01 b01
            // Дублировалось описание сайта в заголовке окна.
            // $site_description = get_bloginfo('description', 'display');
            // if ($site_description && ( is_home() || is_front_page() ))
            //   echo " | $site_description";
            //   
            // Add a page number if necessary:
            if ($paged >= 2 || $page >= 2)
                echo ' | ' . sprintf(__('Page %s', 'twentyten'), max($paged, $page));
            ?>
        </title>

        <link rel="profile" href="http://gmpg.org/xfn/11" />
        <link rel="stylesheet" type="text/css" media="all" href="<?php bloginfo('stylesheet_url'); ?>" />
        <link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" />
        <?php
        /* We add some JavaScript to pages with the comment form
         * to support sites with threaded comments (when in use).
         */
        if (is_singular() && get_option('thread_comments'))
            wp_enqueue_script('comment-reply');

        /* Always have wp_head() just before the closing </head>
         * tag of your theme, or you will break many plugins, which
         * generally use this hook to add elements to <head> such
         * as styles, scripts, and meta tags.
         */
        wp_head();
        ?>

        <!-- 
        Google Analytics                                              + v1.01 b01
        -->
        <script>
            (function(i, s, o, g, r, a, m) {
                i['GoogleAnalyticsObject'] = r;
                i[r] = i[r] || function() {
                    (i[r].q = i[r].q || []).push(arguments)
                }, i[r].l = 1 * new Date();
                a = s.createElement(o),
                        m = s.getElementsByTagName(o)[0];
                a.async = 1;
                a.src = g;
                m.parentNode.insertBefore(a, m)
            })(window, document, 'script', '//www.google-analytics.com/analytics.js', 'ga');

            ga('create', 'UA-40368890-4', 'yachtseamanship.tk');
            ga('send', 'pageview');
        </script>
        <!-- END Google Analytics -->
    </head>

    <body <?php body_class(); ?>>

        <!--
        Стандартный якорь для переходов по ссылке "вверх"         + v1.01 b01
        -->
        <a name="go-top"></a>

        <div id="wrapper" class="hfeed">
            <div id="header">
                <div id="masthead">
                    <div id="branding" role="banner">
                        <?php $heading_tag = ( is_home() || is_front_page() ) ? 'h1' : 'div'; ?>
                        <<?php echo $heading_tag; ?> id="site-title">
                        <span>
                            <a href="<?php echo home_url('/'); ?>" title="<?php echo esc_attr(get_bloginfo('name', 'display')); ?>" rel="home"><?php bloginfo('name'); ?></a>
                        </span>
                        </<?php echo $heading_tag; ?>>
                        <div id="site-description"><?php bloginfo('description'); ?></div>

                        <?php
// Compatibility with versions of WordPress prior to 3.4.
                        if (function_exists('get_custom_header')) {
                            // We need to figure out what the minimum width should be for our featured image.
                            // This result would be the suggested width if the theme were to implement flexible widths.
                            $header_image_width = get_theme_support('custom-header', 'width');
                        } else {
                            $header_image_width = HEADER_IMAGE_WIDTH;
                        }

// Check if this is a post or page, if it has a thumbnail, and if it's a big one
                        if (is_singular() && current_theme_supports('post-thumbnails') &&
                        has_post_thumbnail($post->ID) &&
                        ( /* $src, $width, $height */ $image = wp_get_attachment_image_src(get_post_thumbnail_id($post->ID), 'post-thumbnail') ) &&
                        $image[1] >= $header_image_width) :
                            // Houston, we have a new header image!
                            echo get_the_post_thumbnail($post->ID);
                        elseif (get_header_image()) :
                            // Compatibility with versions of WordPress prior to 3.4.
                            if (function_exists('get_custom_header')) {
                                $header_image_width = get_custom_header()->width;
                                $header_image_height = get_custom_header()->height;
                            } else {
                                $header_image_width = HEADER_IMAGE_WIDTH;
                                $header_image_height = HEADER_IMAGE_HEIGHT;
                            }
                            ?>
                            <img src="<?php header_image(); ?>" width="<?php echo $header_image_width; ?>" height="<?php echo $header_image_height; ?>" alt="" />
                        <?php endif; ?>
                    </div><!-- #branding -->

                    <!--
                    Логотип сайта                                           + v1.01 b01
                    Используется аватар из http://www.gravatar.com
                    -->
                    <div class="logo">
                        <a href="http://yachtseamanship.tk/" title="На главную" alt="Главная">
                            <img src="http://yachtseamanship.tk/wp-content/uploads/2014/07/logo_small.jpg" />
                            <!--<img src="http://yachtseamanship.tk/wp-content/uploads/2013/05/AlexZhitkov.jpg" />-->
                            <!--<img src="http://s.gravatar.com/avatar/ccf08f82a6139e35dc3b141cc547d13c?s=130" width="130" height="130" />-->
                            <!--<img src="http://yachtseamanship.tk/wp-content/uploads/2013/05/avatar.png" />-->
                            <!--<img src="http://yachtseamanship.tk/wp-content/uploads/2013/05/AlexZhitkov.jpg" />-->
                        </a>
                    </div>

                    <div id="access" role="navigation">
                        <?php /* Allow screen readers / text browsers to skip the navigation menu and get right to the good stuff */ ?>
                        <div class="skip-link screen-reader-text"><a href="#content" title="<?php esc_attr_e('Skip to content', 'twentyten'); ?>"><?php _e('Skip to content', 'twentyten'); ?></a></div>
                        <?php /* Our navigation menu. If one isn't filled out, wp_nav_menu falls back to wp_page_menu. The menu assiged to the primary position is the one used. If none is assigned, the menu with the lowest ID is used. */ ?>
                        <?php wp_nav_menu(array('container_class' => 'menu-header', 'theme_location' => 'main-first-menu')); ?>
                    </div><!-- #access -->

                    <!-- -------------------------------------------------------
                    Второе навигационное меню                        + v1.01 b02
                    -->
                        <div id="access" class="main-second-menu" role="navigation">
                            <!--Разрешить текстовым броузерам пропускать меню-->
                            <div class="skip-link screen-reader-text">
                                <a href="#content" title="<?php esc_attr_e('Skip to content', 'twentyten'); ?>"><?php _e('Skip to content', 'twentyten'); ?></a>
                            </div>
                            <!--
                            Вывести второе навигационное меню Secondary Navigation
                            если оно не пустое
                            -->
                            <?php
                            if (has_nav_menu('main-second-menu')) {
                                wp_nav_menu(array('container_class' => 'menu-header', 'theme_location' => 'main-second-menu'));
                            }
                            ?>
                    </div><!-- #access -->



                </div><!-- #masthead -->
            </div><!-- #header -->

            <div id="main">