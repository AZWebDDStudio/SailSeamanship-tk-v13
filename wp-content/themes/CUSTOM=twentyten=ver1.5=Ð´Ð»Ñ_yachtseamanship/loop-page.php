<?php
/**
 * The loop that displays a page.
 *
 * The loop displays the posts and the post content. See
 * http://codex.wordpress.org/The_Loop to understand it and
 * http://codex.wordpress.org/Template_Tags to understand
 * the tags used in it.
 *
 * This can be overridden in child themes with loop-page.php.
 *
 * @package WordPress
 * @subpackage Twenty_Ten
 * @since Twenty Ten 1.2
 */
?>

<?php if (have_posts()) while (have_posts()) : the_post(); ?>

    <div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
      <?php if (is_front_page()) { ?>
        <h2 class="entry-title"><?php the_title(); ?></h2>
      <?php } else { ?>
        <h1 class="entry-title"><?php the_title(); ?></h1>
      <?php } ?>

      <!-- Pluso. Кнопки для добавления контента в социальные сети -->
      <script type="text/javascript">(function() {
          if (window.pluso)
            if (typeof window.pluso.start == "function")
              return;
          var d = document, s = d.createElement('script'), g = 'getElementsByTagName';
          s.type = 'text/javascript';
          s.charset = 'UTF-8';
          s.async = true;
          s.src = ('https:' == window.location.protocol ? 'https' : 'http') + '://share.pluso.ru/pluso-like.js';
          var h = d[g]('head')[0] || d[g]('body')[0];
          h.appendChild(s);
        })();</script>
      <div class="pluso" data-options="medium,square,line,horizontal,counter,theme=03" data-services="facebook,twitter,blogger,livejournal,vkontakte,odnoklassniki,google,moimir,moikrug,yandex,linkedin,liveinternet,vkrugu,myspace,email,print" data-background="transparent"></div>
      <!-- END Pluso. Кнопки для добавления контента в социальные сети -->

      <div class="entry-content">
        <?php the_content(); ?>
        <?php wp_link_pages(array('before' => '<div class="page-link">' . __('Pages:', 'twentyten'), 'after' => '</div>')); ?>
        <?php edit_post_link(__('Edit', 'twentyten'), '<span class="edit-link">', '</span>'); ?>
      </div><!-- .entry-content -->
    </div><!-- #post-## -->

    <?php comments_template('', true); ?>

  <?php endwhile; // end of the loop. ?>
