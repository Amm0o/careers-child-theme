<?php



/**

 * The template for displaying the footer

 *

 * @package Berserk

 * @version 1.0.0

 */



if (!defined('ABSPATH')) {

    exit; // Exit if accessed directly

}



?>

<?php if (!brk_is_woocommerce() || is_singular('product')) { ?>

    </div><!-- .col -->



    <?php get_sidebar() ?>

<?php } ?>



</div> <!-- .row -->



<?php

if (is_singular('post')) {



    // Related Posts

    echo BRK_Helper::get_related_posts($post->ID);
}

?>



</div><!-- .container -->



<?php

if (is_singular('product') && brk_get_option_layout() != 'fullwidth') {



    /**

     * Get product bottom content

     */

    get_template_part('woocommerce/single-product/single-product', 'bottom-content');



    include(locate_template('woocommerce/single-product/single-product-related-comments-tabs.php'));
}

?>



</div><!-- #content -->



</main><!-- .main-container -->

</div><!-- #page -->



<?php



/**

 * Berserk Get Footer

 */

// get_template_part( 'templates/layouts/footer/footer' );



// Get if Site is EN OR PT

$localization = "/en/";

$url_addon = "";

$actual_link = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";

if (strpos($actual_link, $localization) !== false) {

    $url_addon = $localization;
} else {

    $url_addon = "";
}

// END Get if Site is EN OR PT





?>



<div class="footer-container">

    <div class="pelican-container">

        <div class="pelican-footer-1row">

            <div class="pelican-footer-left">

                <div class="pelican-location-container">

                    <img class="pelican-pin" src="https://careersdev.xpand-it.com/wp-content/uploads/2017/11/ico_pin_transparent.png" class="pin" alt="pin" />

                    <p class="pelican-location">Portugal</p>

                    <img class="pelican-pin" src="https://careersdev.xpand-it.com/wp-content/uploads/2017/11/ico_pin_transparent.png" class="pin" alt="pin" />

                    <p class="pelican-location">United Kingdom</p>

                    <img class="pelican-pin" src="https://careersdev.xpand-it.com/wp-content/uploads/2017/11/ico_pin_transparent.png" class="pin" alt="pin" />

                    <p class="pelican-location">Sweden</p>

                </div>

                <a>

                    <img id="pelican-footer-logo" src="https://careers.xpand-it.com/wp-content/uploads/2017/11/Logo_white_RGB.svg" alt="Carreira em IT logo Xpand IT" />

                </a>

                <div>



                    <div class="pelican-social-links">

                        <a data-iconcolor="#5FB0D5" target="_blank" href="https://www.linkedin.com/company/xpand-it/" style="background-color: rgba(0, 0, 0, 0);"><i class="fa fa-linkedin" style="color: rgb(255, 255, 255);"></i></a>

                        <a data-iconcolor="#634d40" target="_blank" href="https://www.instagram.com/xpand_it/" style="background-color: rgba(0, 0, 0, 0);"><i class="fa fa-instagram" style="color: rgb(255, 255, 255);"></i></a>

                        <a data-iconcolor="#3b5998" target="_blank" href="https://www.facebook.com/Xpand-IT-206508579394292/" style="background-color: rgba(0, 0, 0, 0);"><i class="fa fa-facebook" style="color: rgb(255, 255, 255);"></i></a>

                        <a data-iconcolor="#00acee" target="_blank" href="https://twitter.com/xpandit" style="background-color: rgba(0, 0, 0, 0);"><i class="fa fa-twitter" style="color: rgb(255, 255, 255);"></i></a>

                        <a data-iconcolor="#c4302b" target="_blank" href="https://www.youtube.com/xpandit" style="background-color: rgba(0, 0, 0, 0);"><i class="fa fa-youtube" style="color: rgb(255, 255, 255);"></i></a>



                    </div>



                </div>

                <a class="pelica-news-btn newsbtn-footer pum-trigger" style="cursor: pointer;">Subscrever Newsletter</a>



            </div>



            <div class="pelican-right-footer">

                <div class="pelican-footer-link-list">

                    <?php

                    if ($url_addon !== '/en/') {

                        echo '<!--';
                    }

                    ?>

                    <ul class="pelican-footer-list">

                        <li class="pelica-list-title"><?php _e('Find a job', 'berserk') ?></li>

                        <li class="pelican-list-link">

                            <a href="/en/it-job-opportunities/"><?php _e('Job Opportunities', 'berserk') ?></a>

                        </li>

                        <li class="pelican-list-link">

                            <a href="/en/students-universities-tech-summer-internships/"><?php _e('Students & Universities', 'berserk') ?></a>

                        </li>

                    </ul>

                    <ul class="pelican-footer-list">

                        <li class="pelica-list-title">Life at Xpand IT</li>

                        <li class="pelican-list-link">

                            <a href="/en/working-at-xpand-it/"><?php _e('Working at Xpand IT', 'berserk') ?></a>

                        </li>

                        <li class="pelican-list-link">

                            <a href="/en/our-values-professional-growth/"><?php _e('Our Values', 'berserk') ?></a>

                        </li>

                    </ul>





                    <?php

                    if ($url_addon !== '/en/') {

                        echo '-->';
                    }

                    ?>



                    <!-- Portugue Version -->





                    <?php

                    if ($url_addon === '/en/') {

                        echo '<!--';
                    }

                    ?>

                    <ul class="pelican-footer-list">

                        <li class="pelica-list-title"><?php _e('Find a job', 'berserk') ?></li>

                        <li class="pelican-list-link">

                            <a href="/oportunidades-de-emprego-it/"><?php _e('Job Opportunities', 'berserk') ?></a>

                        </li>

                        <li class="pelican-list-link">

                            <a href="/estudantes-universidades-estagios-de-verao-em-engenharia-informatica/"><?php _e('Students & Universities', 'berserk') ?></a>

                        </li>

                    </ul>

                    <ul class="pelican-footer-list">

                        <li class="pelica-list-title">Life at Xpand IT</li>

                        <li class="pelican-list-link">

                            <a href="/trabalhar-na-xpand-it/"><?php _e('Working at Xpand IT', 'berserk') ?></a>

                        </li>

                        <li class="pelican-list-link">

                            <a href="/os-nossos-valores-crescimento-profissional/"><?php _e('Our Values', 'berserk') ?></a>

                        </li>

                    </ul>





                    <ul class="pelican-footer-list">

                        <li class="pelica-list-title"><?php _e('Resources', 'berserk') ?></li>

                        <li class="pelican-list-link">

                            <a href="/blog/"><?php _e('Blog', 'berserk') ?></a>

                        </li>


                        <li class="pelican-list-link">

                            <a href="/recursos-webinares-conteudos-ebooks-programacao/"><?php _e('Webinares e Conteúdos', 'berserk') ?></a>

                        </li>

                        <li class="pelican-list-link">

                            <a href="/italks/"><?php _e('ITalks lives @Instagram', 'berserk') ?></a>

                        </li>

                    </ul>



                    <?php

                    if ($url_addon === '/en/') {

                        echo '-->';
                    }

                    ?>







                    <!-- END Portugue Version -->

                </div>

                <div class="pelican-footer-link-list2">

                    <?php

                    if ($url_addon !== '/en/') {

                        echo '<!--';
                    }

                    ?>

                    <ul class="pelican-footer-list">

                        <li class="pelica-list-title"><?php _e('About Us', 'berserk') ?></li>

                        <li class="pelican-list-link">

                            <a href="/en/product-technology/"><?php _e('Product & Technology', 'berserk') ?></a>

                        </li>

                        <li class="pelican-list-link">

                            <a href="/en/corporate-teams/"><?php _e('Corporate', 'berserk') ?></a>

                        </li>

                        <li class="pelican-list-link">

                            <a href="/en/about-xpand-it-what-we-do/"><?php _e('What we do', 'berserk') ?></a>

                        </li>



                    </ul>

                    <ul class="pelican-footer-list">



                        <li class="pelica-list-title">

                            <a href="/en/about-xpand-it-what-we-do/"><?php _e('Contacts', 'berserk') ?></a>

                        </li>

                    </ul>

                    <?php

                    if ($url_addon !== '/en/') {

                        echo '-->';
                    }

                    ?>



                    <!-- Portuguese Version -->



                    <?php

                    if ($url_addon === '/en/') {

                        echo '<!--';
                    }

                    ?>

                    <ul class="pelican-footer-list">

                        <li class="pelica-list-title"><?php _e('About Us', 'berserk') ?></li>

                        <li class="pelican-list-link">

                            <a href="/equipas-de-produto-e-tecnologia/"><?php _e('Product & Technology', 'berserk') ?></a>

                        </li>

                        <li class="pelican-list-link">

                            <a href="/equipas-corporativas/"><?php _e('Corporate', 'berserk') ?></a>

                        </li>

                        <li class="pelican-list-link">

                            <a href="/sobre-a-xpand-it-o-que-fazemos/"><?php _e('What we do', 'berserk') ?></a>

                        </li>



                        <li class="pelican-list-link">

                            <a href="/artigos-de-imprensa-sobre-carreiras-xpand-it/"><?php _e('Press', 'berserk') ?></a>

                        </li>



                    </ul>

                    <ul class="pelican-footer-list">



                        <li class="pelica-list-title">

                            <a href="/contactos-duvidas-sobre-carreiras-na-xpand-it/"><?php _e('Contacts', 'berserk') ?></a>

                        </li>

                    </ul>

                    <?php

                    if ($url_addon === '/en/') {

                        echo '-->';
                    }

                    ?>





                    <!-- END Portuguese Version -->

                </div>

            </div>

        </div>



        <div class="pelican-divider">

            <div class=" custom-html-widget pelican-color-footer"><a href="https://www.xpand-it.com" target="_blank" rel="noopener">www.xpand-it.com</a>&nbsp;&nbsp;<span class="all_rights pelican-color-footer">2021 | All rights

                    reserved</span>



            </div>

            <div class="pelican-footer-left-links">

                <a href="https://www.xpand-it.com/legal/" target="_blank">Legal</a>

                <a id="privacy" href="https://www.xpand-it.com/privacy-policy/" target="_blank">Privacy Policy</a>

                <a href="https://www.xpand-it.com/terms-of-use/" target="_blank">Terms Of Use</a>

            </div>

        </div>



        <div class="pelican-footer-imgs">

            <div class="pelican-footer-imgs pelican-footer-2-imgs">

                <a href="https://www.xpand-it.com/pt-pt/iag-intelligent-agents-generator/" target="_blank">

                    <img id="lisboa2020" class="pelican-footer-img" src="https://www.xpand-it.com/wp-content/uploads/2021/06/logo_lisboa2020.png" width="134" height="77" style="margin-right: 1rem; " alt="Logo Xpand IT" />

                </a>

                <a href="https://www.xpand-it.com/projectos-financiados-xgamify/" target="_blank">

                    <img class="pelican-footer-img" src="https://careers.xpand-it.com/wp-content/uploads/2017/11/Logo_Norte2020-134x77-1.png" width="134" height="77" alt="Logo norte 2020" />

                </a>

            </div>



            <div class="pelican-footer-imgs">



                <a href="https://www.xpand-it.com/projectos-financiados-xpand-no-mercado-global/" target="_blank">

                    <img class="pelican-footer-img" class="pelican-footer-img" src="http://careers.xpand-it.com/wp-content/uploads/2017/11/Logo_Compete2020-177x65.png" width="177" height="77" alt="logo Compete 2020" />

                </a>

            </div>

            <div class="pelican-footer-imgs">

                <a href="https://www.xpand-it.com/pt-pt/iag-intelligent-agents-generator/" target="_blank">

                    <img id="portugal2020" class="pelican-footer-img" src="https://careers.xpand-it.com/wp-content/uploads/2017/11/Logo_Portugal2020_UniaoEuropeia-300x42.png" width="300" height="77" alt="Logo Portugal 2020" />

                </a>

            </div>



            <div class="pelican-footer-imgs">

                <a href="https://www.xpand-it.com/pt-pt/pledge-1-de-lucro/" target="_blank">

                    <img id="p1" class="pelican-footer-img" src="https://careers.xpand-it.com/wp-content/uploads/2017/11/Logos-CMMI-and-Pledge-1-300x75.png" width="300" height="77" alt="Logos CMMI e Pledge 1" />

                </a>

            </div>





        </div>



    </div>

    <div>



        <?php

        wp_footer();

        do_action('after_footer_careers');

        ?>



        </body>



        </html>