<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the id=main div and all content
 * after. Calls sidebar-footer.php for bottom widgets.
 *
 * @package WordPress
 * @subpackage Twenty_Ten
 * @since Twenty Ten 1.0
 */
?>
</div><!-- #main -->

<div id="footer" role="contentinfo">
    <div id="colophon">

        <?php
        /* A sidebar in the footer? Yep. You can can customize
         * your footer with four columns of widgets.
         */
        get_sidebar('footer');
        ?>

        <div id="site-info">
            <a href="<?php echo home_url('/'); ?>" title="<?php echo esc_attr(get_bloginfo('name', 'display')); ?>" rel="home">
                <?php bloginfo('name'); ?></a><br />
            <a href="http://sailseamanship.tk/wp-admin" title="Вход для Администратора"  style="color: #fff">Администратор</a><br />
            <!--<a href="https://code.google.com/p/yacht-seamanship-v12/issues/entry" title="Сообщение о проблеме" style="color: #fff">BUG треккер</a> -->
            <a href="https://github.com/AZWebDDS/yacht-seamanship-v12/issues" target="_blank" title="Сообщение о проблеме" style="color: #fff">GitHub</a>
            
        </div><!-- #site-info -->

        <div class="counters">

            <!-- Yandex.Metrika informer -->
            <a href="http://metrika.yandex.ru/stat/?id=21231178&amp;from=informer"
               target="_blank" rel="nofollow"><img src="//bs.yandex.ru/informer/21231178/3_0_6B8ACEFF_6B8ACEFF_1_pageviews"
                                                style="width:88px; height:31px; border:0;" alt="Яндекс.Метрика" title="Яндекс.Метрика: данные за сегодня (просмотры, визиты и уникальные посетители)" onclick="try {
                                                            Ya.Metrika.informer({i: this, id: 21231178, lang: 'ru'});
                                                            return false
                                                        } catch (e) {
                                                        }"/></a>
            <!-- /Yandex.Metrika informer -->

            <!-- Yandex.Metrika counter -->
            <script type="text/javascript">
                (function(d, w, c) {
                    (w[c] = w[c] || []).push(function() {
                        try {
                            w.yaCounter21231178 = new Ya.Metrika({id: 21231178,
                                webvisor: true,
                                clickmap: true,
                                trackLinks: true,
                                accurateTrackBounce: true});
                        } catch (e) {
                        }
                    });

                    var n = d.getElementsByTagName("script")[0],
                            s = d.createElement("script"),
                            f = function() {
                                n.parentNode.insertBefore(s, n);
                            };
                    s.type = "text/javascript";
                    s.async = true;
                    s.src = (d.location.protocol == "https:" ? "https:" : "http:") + "//mc.yandex.ru/metrika/watch.js";

                    if (w.opera == "[object Opera]") {
                        d.addEventListener("DOMContentLoaded", f, false);
                    } else {
                        f();
                    }
                })(document, window, "yandex_metrika_callbacks");
            </script>
            <noscript><div><img src="//mc.yandex.ru/watch/21231178" style="position:absolute; left:-9999px;" alt="" /></div></noscript>
            <!-- /Yandex.Metrika counter -->

            <!--LiveInternet counter-->
            <script type="text/javascript"><!--
      document.write("<a href='http://www.liveinternet.ru/click' " +
                        "target=_blank><img src='//counter.yadro.ru/hit?t13.11;r" +
                        escape(document.referrer) + ((typeof (screen) == "undefined") ? "" :
                        ";s" + screen.width + "*" + screen.height + "*" + (screen.colorDepth ?
                                screen.colorDepth : screen.pixelDepth)) + ";u" + escape(document.URL) +
                        ";" + Math.random() +
                        "' alt='' title='LiveInternet: показано число просмотров за 24" +
                        " часа, посетителей за 24 часа и за сегодня' " +
                        "border='0' width='88' height='31'><\/a>")
//--></script>
            <!--/LiveInternet-->


        </div>

        <?php
        /** ----------------------------------------------------------------
         * Выключена ссылка "сайт работает на WordPress"
         * 
          <div id="site-generator">
          <?php do_action( 'twentyten_credits' ); ?>
          <a href="<?php echo esc_url( __( 'http://wordpress.org/', 'twentyten' ) ); ?>" title="<?php esc_attr_e( 'Semantic Personal Publishing Platform', 'twentyten' ); ?>"><?php printf( __( 'Proudly powered by %s.', 'twentyten' ), 'WordPress' ); ?></a>
          </div><!-- #site-generator -->
         */
        ?>

    </div><!-- #colophon -->
</div><!-- #footer -->

</div><!-- #wrapper -->

<?php
/* Always have wp_footer() just before the closing </body>
 * tag of your theme, or you will break many plugins, which
 * generally use this hook to reference JavaScript files.
 */

wp_footer();
?>

</body>
</html>
