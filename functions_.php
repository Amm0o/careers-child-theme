<?php
/**
 * The Berserk Child Theme Functions
 */

/**
 * Wp Enqueue Styles
 */
function brk_child_enqueue_styles() {


	echo " <link rel=\"stylesheet\" type=\"text/css\" href=\"/scripts/style.css\">";

	echo '<link href="https://fonts.googleapis.com/css2?family=Raleway:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">';
wp_enqueue_style('berserk-child', get_stylesheet_directory_uri() .'/style.css' );
}
add_action('wp_enqueue_scripts', 'brk_child_enqueue_styles' );

/**
 * Copy All Parent Theme Options
 */
function brk_child_after_switch_theme() {
	$parent_theme_options = get_option( 'theme_mods_berserk' );
	update_option( 'theme_mods_berserk-child', $parent_theme_options );
}
add_action('after_switch_theme', 'brk_child_after_switch_theme');

function put_my_scripts() {

	// if ( is_active_sidebar( 'footer_botom' ) )
		// dynamic_sidebar( 'footer_botom' );

	echo "<script src=\"/scripts/script.js?6233\"></script>";
}
add_action('after_footer_careers','put_my_scripts');



function register_widgets_careers(){

	$sidebars = array(
		array(
			'name' => 'Footer Top 1',
			'id' => 'footer_top_1',
			'before_widget' => '',
			'after_widget' => '',
			'before_title' => '<h3>',
			'after_title' => '</h3>',
		),
		array(
			'name' => 'Footer Bottom 1 - Column 1',
			'id' => 'footer_bottom_1_column_1',
			'before_widget' => '',
			'after_widget' => '',
			'before_title' => '<h3>',
			'after_title' => '</h3>',
		),
		array(
			'name' => 'Footer Bottom 1 - Column 2',
			'id' => 'footer_bottom_1_column_2',
			'before_widget' => '',
			'after_widget' => '',
			'before_title' => '<h3>',
			'after_title' => '</h3>',
		),
		array(
			'name' => 'Footer Bottom 1 - Column 3',
			'id' => 'footer_bottom_1_column_3',
			'before_widget' => '',
			'after_widget' => '',
			'before_title' => '<h3>',
			'after_title' => '</h3>',
		),
		array(
			'name' => 'Footer Bottom 1 - Column 4',
			'id' => 'footer_bottom_1_column_4',
			'before_widget' => '',
			'after_widget' => '',
			'before_title' => '<h3>',
			'after_title' => '</h3>',
		),
		array(
			'name' => 'Footer Bottom 2',
			'id' => 'footer_bottom_2',
			'before_widget' => '',
			'after_widget' => '',
			'before_title' => '<h3>',
			'after_title' => '</h3>',
		),
	);

	foreach($sidebars as $sidebar){
		register_sidebar($sidebar);
	}

}
add_action('widgets_init', 'register_widgets_careers', 99);

function print_css_variables(){

	global $post;

	$thumbnail = get_the_post_thumbnail_url($post, 'full');

	echo '<style>
			:root{';

	if($thumbnail)
		echo ' --post-thumbnail-url: url("'.$thumbnail.'"); ';

	if(is_category()){


		$category = get_the_category();

		if(!empty($category)){

			$term_id = $category[0]->term_id;

			$name = get_term_meta($term_id, 'category_banner_text', true);

			if(empty($name) || !$name)
				$name = $category[0]->name;

			echo ' --blog-name: "'.$name.'"; ';

			$thumbnail = get_term_meta($term_id, 'category_banner_image', true);

			if($thumbnail){

				$thumbnail = wp_get_original_image_url($thumbnail);
				echo ' --post-thumbnail-url: url("'.$thumbnail.'"); ';

			}

		}

	}


	echo 	'}
		</style>';
}

add_action('wp_footer', 'print_css_variables');


add_action('init', 'add_category_to_custom_post_types');
function add_category_to_custom_post_types(){
    register_taxonomy_for_object_type('category', 'brs_staff');
    register_taxonomy_for_object_type('category', 'brs_testimonials');
}


// add page title to blog post's and archive's pages

// add_action('init', 'archive_page_title');

function archive_page_title(){
	if( is_archive() ){

	}
}

function cc_mime_types($mimes) {
 $mimes['svg'] = 'image/svg+xml';
 return $mimes;
}
add_filter('upload_mimes', 'cc_mime_types');



function careers_register_scripts_and_styles(){
	if(!is_admin()){

		wp_register_script( 'ResizeSensorMin',  get_stylesheet_directory_uri() . '/js/ResizeSensor.min.js', ['jquery']);
		wp_enqueue_script( 'ResizeSensorMin');

		wp_register_script( 'theia-sticky-sidebar-min',  get_stylesheet_directory_uri() . '/js/theia-sticky-sidebar.min.js', ['jquery']);
		wp_enqueue_script( 'theia-sticky-sidebar-min');

		// wp_register_style( 'splide-carousel-css',  get_stylesheet_directory_uri() . '/css/splide.min.css');
		// wp_enqueue_style( 'splide-carousel-css');

		// wp_register_script( 'splide-carousel-js',  get_stylesheet_directory_uri() . '/js/splide.min.js', ['jquery']);
		// wp_enqueue_script( 'splide-carousel-js');

	}
}
add_action('wp_enqueue_scripts', 'careers_register_scripts_and_styles', 99);


/* print berserk's "share socials" wherever we want, in the page */
function add_shortcode_post_share_socials(){
	global $post;

	$html = '<div class="post__share_socials_function">';

	$links = apply_filters( 'brk_add_social_share_single_post', $post->ID );

	$links = explode('</a><a', $links);


	foreach($links as $key => $link){

		if( strpos($link, 'pinterest.com') !== false || strpos($link, 'Google+') !== false ){
			unset($links[$key]);
		}
	}

	$links = array_values($links);

	// the last "link" has the RSS feed and also the wrapping </div>'s
	// sandwitch it with the first links, with linkedin in the middle
	$lastLink = end($links);

	unset( $links[ count($links) - 1 ] );

	$url = get_permalink();

	$links[] = ' class="brk-social-links__item" href="https://www.linkedin.com/cws/share?url='.
				$url.'" target="_blank" title="Linkedin"><i class="fab fa-linkedin"></i>';

	$links[] = $lastLink;

	$links = implode('</a><a', $links);

	$html .= $links . '</div>';

	return $html;
}

add_shortcode('post_share_socials', 'add_shortcode_post_share_socials');


/* replicate old website shortcodes */

add_shortcode( 'blockquote', 'add_shortcode_blockquote' );
function add_shortcode_blockquote( $atts, $content ) {

	$footer = !empty($atts['who']) ? '<footer>' . $atts['who'] . '</footer>' : '';

	return
		'<blockquote class="mt-20 mb-20 custom-blockquote">
			<div class="content">'.
				$content .
			'</div>'.
			$footer .
		'</blockquote>';
}

add_shortcode( 'heading', 'add_shortcode_heading' );
function add_shortcode_heading( $atts, $content ) {

	$header_type = !empty($atts['header_type']) ? $atts['header_type'] : 'h1';

	$bold_class = !empty($atts['header_weight']) && $atts['header_weight'] == 'bold' ?
		'font__weight-bold' : '';

	$header_size = '';

	if(!empty($atts['header_size'])){
		switch($atts['header_size']){
			case 'big':
				$header_size = 'font-size-big';
				break;
			case 'bigger':
				$header_size = 'font-size-bigger';
				break;
			case 'super':
				$header_size = 'font-size-super';
				break;
			case 'hyper':
				$header_size = 'font-size-hyper';
				break;
			case 'normal':
			default:
				$header_size = '';
		}
	}

	$extra_classes = !empty($atts['extra_classes'])  ?  $atts['extra_classes'] : '';
	switch($header_type){
		case 'h1':
			$margin = 'mt-70 mb-50';
			break;
		case 'h2':
			$margin = 'mt-50 mb-30';
			break;
		case 'h3':
			$margin = 'mt-20 mb-10';
			break;
		case 'h4':
			$margin = 'mt-10';
			break;
		default:
			$margin = '';
	}


	return
		'<'.$header_type.' class="'.$margin . ' ' . $bold_class.' '.$header_size.' '.$extra_classes.' custom-header">'.
			$content .
		'</'.$header_type.'>';
}


add_action( 'admin_init', function() {
    add_post_type_support( 'post', 'page-attributes' );
    add_post_type_support( 'brs_staff', 'page-attributes' );
} );


	function cptui_register_my_cpts() {

		/**
		 * Post Type: Jobs.
		 */

		$labels = [
			"name" => __( "Jobs", "berserk" ),
			"singular_name" => __( "Job", "berserk" ),
		];

		$args = [
			"label" => __( "Jobs", "berserk" ),
			"labels" => $labels,
			"description" => "",
			"public" => true,
			"publicly_queryable" => true,
			"show_ui" => true,
			"show_in_rest" => true,
			"rest_base" => "",
			"rest_controller_class" => "WP_REST_Posts_Controller",
			"has_archive" => false,
			"show_in_menu" => true,
			"show_in_nav_menus" => true,
			"delete_with_user" => false,
			"exclude_from_search" => false,
			"capability_type" => "post",
			"map_meta_cap" => true,
			"hierarchical" => false,
			"rewrite" => [ "slug" => "jobs", "with_front" => false ],
			"query_var" => true,
			"supports" => [ "title", "editor", "thumbnail" ],
		];

		register_post_type( "jobs", $args );
	}

	add_action( 'init', 'cptui_register_my_cpts' );

	add_filter('post_type_link', 'jobcategory_permalink_structure', 10, 4);
	function jobcategory_permalink_structure($post_link, $post, $leavename, $sample) {
	    if (false !== strpos($post_link, '%job_categories%')) {
	        $projectscategory_type_term = get_the_terms($post->ID, 'job_categories');
	        if (!empty($projectscategory_type_term))
	            $post_link = str_replace('%job_categories%', array_pop($projectscategory_type_term)->
	            slug, $post_link);
	        else
	            $post_link = str_replace('%job_categories%', 'uncategorized', $post_link);
	    }
	    return $post_link;
	}


function cptui_register_my_taxes_job_categories() {

	/**
	 * Taxonomy: Job Categories.
	 */

	$labels = [
		"name" => __( "Job Categories", "berserk" ),
		"singular_name" => __( "Job Category", "berserk" ),
	];


 $args = array(
        'hierarchical' => true,
        'rewrite' => array('slug' => 'jobs'),
        'show_in_nav_menus' => true,
        'labels' => $labels
    );
	register_taxonomy( "job_categories", [ "jobs" ], $args );
}
add_action( 'init', 'cptui_register_my_taxes_job_categories' );






add_shortcode( 'job_slot_sidebar_shortcode', 'job_slot_sidebar_shortcode_function' );
function job_slot_sidebar_shortcode_function() {

	global $post;

	$location = get_post_meta($post->ID, 'localizacao', true);

	if($location){

		$location = explode(',', $location);

		if(count($location) > 1){
			$location = '<ul><li>' . implode('</li><li>', $location) . '</li></ul>';
            $class = " has-multiple-locations ";
		}else{
			$location = '<span>' . $location[0] . '</span>';
            $class = "";
		}
	}else{
		$location = '<span>Lisboa</span>';
        $class = "";
	}

	$html =
		'<div class="job-opportunities-sidebar">
			<div class="job-opportunities-sidebar_header side-linear-gradient         '.$class.'">
				<svg id="Layer_1" data-name="Layer 1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 600 600"><defs><style>.cls-1{fill:#ffffff}</style></defs><path class="cls-1" d="M301.4 440.45A5.1 5.1 0 0 1 297 438l-80.19-129.26A97.78 97.78 0 1 1 384 307.42L305.81 438a5.18 5.18 0 0 1-4.35 2.5zM300 169.72a87.47 87.47 0 0 0-74.45 133.61l75.78 122.11 73.84-123.29A87.53 87.53 0 0 0 300 169.72z"></path><path class="cls-1" d="M300 304.58a47.25 47.25 0 1 1 47.25-47.25A47.31 47.31 0 0 1 300 304.58zm0-84.33a37.08 37.08 0 1 0 37 37.08 37.12 37.12 0 0 0-37-37.08z"></path></svg>
				'.$location.'
			</div>
			<div class="job-opportunities-sidebar_body">
				<h3>Benefícios</h3>
				<div class="sidebar-benefit">
					<svg id="Layer_1" data-name="Layer 1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 600 600"><defs><style>.cls-1{fill:#009ea9}</style></defs><path class="cls-1" d="M412.55 447.75h-225.1a4.85 4.85 0 0 1-4.85-4.85V319.23h-41.25a4.85 4.85 0 0 1-3.4-8.31l160.44-157.28a4.84 4.84 0 0 1 6.84 0L462.09 311a4.85 4.85 0 0 1-3.44 8.27H417.4V442.9a4.85 4.85 0 0 1-4.85 4.85zm-79.66-9.7h74.81V314.38a4.85 4.85 0 0 1 4.85-4.85H447L301.75 163.94 153.23 309.53h34.22a4.85 4.85 0 0 1 4.85 4.85v123.67h140.59z"></path><path class="cls-1" d="M205.78 424.2a4.85 4.85 0 0 1-4.85-4.85V314.76a4.85 4.85 0 0 1 9.7 0v104.59a4.85 4.85 0 0 1-4.85 4.85zM300.09 276.36a64.39 64.39 0 1 0 64.39 64.39 64.45 64.45 0 0 0-64.39-64.39zm56.17 64.39a56.17 56.17 0 1 1-56.17-56.17 56.23 56.23 0 0 1 56.17 56.17z"></path><path class="cls-1" d="M302.45 342l-.12-36.53a4.11 4.11 0 1 0-8.22 0l.12 37.53a6 6 0 0 0 2.12 4.57L319 367a4.11 4.11 0 0 0 5.35-6.25z"></path></svg>
					<span>Flexibilidade e Trabalho Remoto</span>
				</div>
				<div class="sidebar-benefit">
					<svg id="Layer_1" data-name="Layer 1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 600 600"><defs><style>.cls-1{fill:#009ea9}</style></defs><path class="cls-1" d="M423.31 206.32c-.13 0-1.64-.5-4.18-1.19-11.28-3.09-45.6-12.45-59-18.37s-47.26-27.14-57.33-33.51l-.82-.5a4.51 4.51 0 0 0-3.8-.07 10.85 10.85 0 0 0-1.49.93c-9.86 6.82-35.14 23.66-56.77 32.54-6.25 2.57-21.8 8-60.37 19.3-1.93.56-3 .93-3.05 1a4.41 4.41 0 0 0-2.5 4.23c.22 4.22 5.54 103.78 21.8 139.81 25.82 57.19 99.07 95.18 102.17 96.77a4.52 4.52 0 0 0 2 .49 4.46 4.46 0 0 0 2.41-.71c3-2 74.87-48.73 96-96.58 9.38-21.19 25.39-67.46 27.62-139.92a4.46 4.46 0 0 0-2.69-4.22zm-33 140.51c-18.07 40.94-78.33 83.05-90.53 91.28-12.58-6.89-73.78-42.41-95.88-91.31-13.92-30.86-19.72-115-20.83-133.14 30.69-9 51-15.48 60.23-19.3C264 185.87 287 171 300.05 162c12.09 7.62 43.38 27.08 56.5 32.87 14 6.19 48.8 15.69 60.24 18.81l.22.06c-2.57 68.93-17.78 112.87-26.72 133.09z"></path><path class="cls-1" d="M350.8 271.9h-29.89V242a4.43 4.43 0 0 0-4.43-4.43h-33a4.43 4.43 0 0 0-4.44 4.43v29.9H249.2a4.43 4.43 0 0 0-4.43 4.43v33a4.43 4.43 0 0 0 4.43 4.43h29.89v29.89a4.43 4.43 0 0 0 4.44 4.43h33a4.43 4.43 0 0 0 4.43-4.43v-29.93h29.84a4.43 4.43 0 0 0 4.44-4.43v-33a4.43 4.43 0 0 0-4.44-4.39zm-4.44 33h-29.88a4.44 4.44 0 0 0-4.44 4.44v29.88H288v-29.93a4.43 4.43 0 0 0-4.43-4.44h-29.93v-24.08h29.89a4.43 4.43 0 0 0 4.43-4.44v-29.88H312v29.88a4.44 4.44 0 0 0 4.44 4.44h29.88zM223 336.07c-11.69-27.94-15.76-110-15.8-110.82a4.36 4.36 0 0 0-4.6-4.25 4.43 4.43 0 0 0-4.22 4.65c.16 3.43 4.19 84.44 16.48 113.81a4.43 4.43 0 0 0 4.09 2.72 4.33 4.33 0 0 0 1.71-.35 4.43 4.43 0 0 0 2.34-5.76zM241.16 362.87c-3-1.76-9-10.07-12.31-15.41a4.44 4.44 0 0 0-7.53 4.7c1.53 2.45 9.45 14.85 15.3 18.33a4.43 4.43 0 1 0 4.54-7.62z"></path></svg>
					<span>Seguro de Saúde</span>
				</div>
				<div class="sidebar-benefit">
					<svg id="Layer_1" data-name="Layer 1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 600 600"><defs><style>.cls-1{fill:#009ea9}</style></defs><path class="cls-1" d="M176.12 427.65a3.77 3.77 0 0 1-3.77-3.77v-59.8a3.77 3.77 0 0 1 3.77-3.77h34.17a3.77 3.77 0 0 1 3.77 3.77v4.77h24.59L253.51 354V206a3.77 3.77 0 0 1 3.77-3.77h41.77l-1.33-.91c-5.7-3.94-8.84-9.17-8.84-14.71 0-8 6.76-14.28 15.39-14.28 8.32 0 20.18 3.91 29.45 22.53l.45.91.45-.91c9.27-18.62 21.14-22.53 29.46-22.53 8.62 0 15.38 6.27 15.38 14.28 0 5.54-3.14 10.77-8.84 14.71l-1.32.91h41.76a3.77 3.77 0 0 1 3.77 3.77v150.64l.37.1a17.24 17.24 0 0 1 3.65 31.59l-61.47 34.56a3.6 3.6 0 0 1-1.85.49H214.06v.5a3.77 3.77 0 0 1-3.77 3.77zm3.77-7.54h26.63v-52.27h-26.63zm34.17-4.27h140.49l60.61-34.11a9.7 9.7 0 0 0-4.78-18.16h-.64a9.72 9.72 0 0 0-4.06.9l-52.84 24.4a4 4 0 0 1-1.58.33h-72.12v-7.53H315a11.19 11.19 0 0 0 0-22.37h-56.17l-16 16a3.89 3.89 0 0 1-2.67 1.09h-26.1zm47-64.08H315a18.71 18.71 0 0 1 15.56 29.12l-.52.79h20.44l52.09-24.06a17.88 17.88 0 0 1 4.36-1.33l.42-.07V209.79h-146.3zm43.22-171.87c-4.47 0-7.85 2.9-7.85 6.74 0 3.45 2.68 7 7.34 9.66 3.85 2.25 11.17 5.09 24.19 5.79h.82l-.33-.75c-3.45-7.98-11.28-21.44-24.18-21.44zm59.81 0c-13 0-20.73 13.46-24.17 21.49l-.32.75h.81c13-.7 20.34-3.54 24.19-5.79 4.66-2.68 7.34-6.21 7.34-9.66-.01-3.89-3.39-6.79-7.86-6.79z"></path><path class="cls-1" d="M334.17 329.4a3.84 3.84 0 0 1-3-1.51l-63.9-72.39a3.8 3.8 0 0 1 .16-5.17l25.62-25.63a3.91 3.91 0 0 1 2.68-1.09h76.89a3.92 3.92 0 0 1 2.69 1.1l25.62 25.62a3.8 3.8 0 0 1 .15 5.16l-63.87 72.37a3.85 3.85 0 0 1-3.04 1.54zm0-15.68l16.12-48.4h-32.23zm24.27-48.88l-14 42.05.85.49L388 258.89zm-35.37 42.54l.86-.49-14-42.05-29.6-5.95zm-3.43-49.59h29.07l-14.54-23.29zm-41.89-7.08l28.25 5.64-11.28-22.64zm84.61 5.64l28.28-5.64-17-17zm-49.17-2.48l14.2-22.72h-25.55zm42 0l11.36-22.72H341zM368.84 359.3a21.87 21.87 0 0 0-21.35-21.3v-7.6a21.89 21.89 0 0 0 21.35-21.35h7.55a21.9 21.9 0 0 0 21.36 21.35v7.6a21.89 21.89 0 0 0-21.36 21.35zm3.35-35.64a29.73 29.73 0 0 1-10.08 10.08l-.72.43.72.43a29.76 29.76 0 0 1 10.08 10.09l.43.71.43-.71a29.67 29.67 0 0 1 10.08-10.09l.72-.43-.72-.43a29.64 29.64 0 0 1-10.08-10.08l-.43-.71z"></path></svg>
					<span>Protocolos e Parceiros</span>
				</div>
				<div class="sidebar-benefit">
					<svg id="Layer_1" data-name="Layer 1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 600 600"><defs><style>.cls-1{fill:#009ea9}</style></defs><path class="cls-1" d="M346.44 332.47a4.25 4.25 0 1 0-8 2.88l.06.16c3.88 10.13 4.16 17.87.77 21.28-4.12 4.11-14.38 2.82-27.45-3.43a182 182 0 0 1-47.1-35.15c-33.33-33.33-47.08-66-38.57-74.54a11.59 11.59 0 0 1 9.62-2.25 4.26 4.26 0 0 0 .83-8.47 19.6 19.6 0 0 0-16.47 4.69c-15.59 15.58 8.24 56.23 38.58 86.57A190.35 190.35 0 0 0 308.15 361a83.47 83.47 0 0 0 10.26 4.11l-30.23 11.46A120.43 120.43 0 0 1 212 282.79a4.26 4.26 0 1 0-8.41 1.32 127.25 127.25 0 0 0 2.66 12.67 129.14 129.14 0 0 0 70.41 84.15l-49.75 18.82a4.35 4.35 0 0 0-.85-1 59.28 59.28 0 0 1-22-41.2l-2-23.9a4.22 4.22 0 0 0-4.48-3.92h-.13a4.27 4.27 0 0 0-3.91 4.58l2 23.9a67.74 67.74 0 0 0 22.51 44.82l-35.5 13.44 6.39-26.19a4.26 4.26 0 1 0-8.27-2l-8.31 34a4.25 4.25 0 0 0 5.65 5l157.42-59.57a4 4 0 0 0 .71-.44 16.54 16.54 0 0 0 9-4.5c4.36-4.18 7.99-12.87 1.3-30.3z"></path><path class="cls-1" d="M386.59 321.49a140.15 140.15 0 0 0-72.08-7l-15.21 2.56a4.26 4.26 0 0 0 1.41 8.39l15.2-2.54a131.55 131.55 0 0 1 67.7 6.58 4.3 4.3 0 0 0 5.75-4 4.25 4.25 0 0 0-2.77-3.99zM401.72 255.57a4.26 4.26 0 0 0-5.67-2l-89.35 42.54a4.26 4.26 0 0 0-2 5.67 4.25 4.25 0 0 0 5.67 2l89.35-42.55a4.25 4.25 0 0 0 2-5.66zM275.69 201.18a4.26 4.26 0 1 0-8.34 1.7v.15A119 119 0 0 1 261 275l-6.19 14.85a4.26 4.26 0 0 0 2.29 5.55 4.13 4.13 0 0 0 1.63.33 4.27 4.27 0 0 0 3.93-2.62l6.19-14.83a127.46 127.46 0 0 0 6.84-77.1zM406.38 325.48a12.77 12.77 0 1 0 12.76 12.76 12.76 12.76 0 0 0-12.76-12.76zm0 17a4.26 4.26 0 1 1 4.25-4.26 4.26 4.26 0 0 1-4.25 4.28zM304.26 206.35A12.76 12.76 0 1 0 317 219.11a12.76 12.76 0 0 0-12.74-12.76zm0 17a4.25 4.25 0 1 1 4.26-4.25 4.25 4.25 0 0 1-4.26 4.26z"></path><circle class="cls-1" cx="265.97" cy="180.82" r="8.51"></circle><path class="cls-1" d="M385.1 193.58a4.25 4.25 0 0 0-4.25 4.26v4.25a4.26 4.26 0 1 0 8.51 0v-4.25a4.26 4.26 0 0 0-4.26-4.26zM385.1 172.31a4.25 4.25 0 0 0-4.25 4.25v4.26a4.26 4.26 0 0 0 8.51 0v-4.26a4.25 4.25 0 0 0-4.26-4.25zM397.87 185.07h-4.26a4.26 4.26 0 0 0 0 8.51h4.26a4.26 4.26 0 0 0 0-8.51zM376.59 185.07h-4.25a4.26 4.26 0 1 0 0 8.51h4.25a4.26 4.26 0 1 0 0-8.51zM355.32 219H334a4.26 4.26 0 0 0-4.25 4.26v21.36a4.25 4.25 0 0 0 4.25 4.25h21.37a4.25 4.25 0 0 0 4.25-4.25v-21.34a4.25 4.25 0 0 0-4.3-4.28zm-4.26 21.36h-12.85v-12.83h12.85zM324.32 254.55a4.26 4.26 0 0 0-5.89-.31l-42.54 38.29a4.26 4.26 0 0 0 5.69 6.33l42.55-38.3a4.25 4.25 0 0 0 .19-6.01zM402.12 270.17a4.25 4.25 0 0 0-4.25 4.25v4.26a4.26 4.26 0 0 0 8.51 0v-4.26a4.25 4.25 0 0 0-4.26-4.25zM420.17 269.44l-3-3a4.25 4.25 0 0 0-6 6l3 3a4.25 4.25 0 0 0 6-6zM423.39 253.15h-4.25a4.26 4.26 0 1 0 0 8.51h4.25a4.26 4.26 0 1 0 0-8.51zM420.07 239.35a4.26 4.26 0 0 0-5.91 0l-3 3a4.25 4.25 0 0 0 3 7.26 4.24 4.24 0 0 0 3-1.24l3-3a4.25 4.25 0 0 0-.09-6.02zM402.12 231.87a4.25 4.25 0 0 0-4.25 4.26v4.25a4.26 4.26 0 1 0 8.51 0v-4.25a4.26 4.26 0 0 0-4.26-4.26zM393.09 242.36l-3-3a4.25 4.25 0 0 0-6 6l3 3a4.25 4.25 0 0 0 6-6zM223.21 190.7a4.26 4.26 0 0 0-3.43-2.89L207.29 186l-5.57-11.31a4.43 4.43 0 0 0-6.06-1.57 4.38 4.38 0 0 0-1.57 1.57l-5.6 11.31-12.49 1.81a4.26 4.26 0 0 0-3.61 4.82 4.31 4.31 0 0 0 1.24 2.44l9 8.8-2.13 12.44a4.26 4.26 0 0 0 6.18 4.5l11.17-5.89 11.17 5.87a4.24 4.24 0 0 0 6.17-4.48l-2.12-12.44 9-8.8a4.27 4.27 0 0 0 1.14-4.37zm-17.66 8.64a4.28 4.28 0 0 0-1.23 3.76l1.06 6.15-5.51-2.9a4.26 4.26 0 0 0-4 0l-5.53 2.9 1.06-6.15a4.24 4.24 0 0 0-1.21-3.76l-4.43-4.34 6.18-.9a4.25 4.25 0 0 0 3.2-2.33l2.75-5.58 2.76 5.58a4.23 4.23 0 0 0 3.2 2.33l6.17.9zM413.28 385.58l-1.77-2.58a64.24 64.24 0 0 0-42.73-27.63 4.25 4.25 0 0 0-1.4 8.39 55.72 55.72 0 0 1 32.47 18.1 25.1 25.1 0 0 0-17 11.69 17 17 0 1 0 29.72 16.59 24.71 24.71 0 0 0 2.76-10.92 20.79 20.79 0 0 1 .93 22.1 4.25 4.25 0 1 0 7.32 4.34 2 2 0 0 0 .11-.2 29.7 29.7 0 0 0-10.41-39.88zm-8.15 20.36a8.51 8.51 0 1 1-14.9-8.22v-.07a15.94 15.94 0 0 1 11.52-7.5 4.39 4.39 0 0 1 2.13.49c3.63 2.01 3.82 10.7 1.25 15.3z"></path></svg>
					<span>Eventos</span>
				</div>
				<div class="sidebar-benefit">
					<svg id="Layer_1" data-name="Layer 1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 600 600"><defs><style>.cls-1{fill:#009ea9;}</style></defs><path class="cls-1" d="M431.76,228a3.9,3.9,0,0,0-5.51,0L406,248.24a3.91,3.91,0,0,0-1.09,3.39l1.26,7.67a33.3,33.3,0,0,1-9.3,28.85L362.5,322.56a7.79,7.79,0,0,1-7,2.16V307.4l16.12-16.12a3.9,3.9,0,0,0-5.51-5.51L355.5,296.38v-15a15.36,15.36,0,0,0-23.67-12.93,15.36,15.36,0,0,0-22.25-8.75V257a15.33,15.33,0,0,0-5.33-11.62L316.66,233a3.9,3.9,0,0,0-5.51-5.51l-10.87,10.87L272.7,210.73a33.45,33.45,0,0,0-30.37-9.15l-2.76.56-34-34a3.9,3.9,0,1,0-5.51,5.51l34.59,34.59a6.23,6.23,0,0,0,5.66,1.7l3.57-.72a25.67,25.67,0,0,1,23.3,7l25.46,25.46A15.41,15.41,0,0,0,280,251.12a15.36,15.36,0,0,0-24.13,12.63v43.6a15.93,15.93,0,0,0-1.21-1.38l-20.21-20.2a3.9,3.9,0,0,0-5.51,5.51l20.21,20.2a7.92,7.92,0,0,1,1.58,2.27,15.67,15.67,0,0,0-6.51,11.09,7.86,7.86,0,0,1-6.16-2.28l-24.83-24.83a3.9,3.9,0,0,0-5.51,5.51l24.83,24.83a15.6,15.6,0,0,0,11,4.59h.54v42.51a41.09,41.09,0,0,0,17.07,33.29l4.69,3.38V429.1a3.9,3.9,0,1,0,7.8,0V409.83a3.9,3.9,0,0,0-1.63-3.16l-6.31-4.55a33.27,33.27,0,0,1-13.83-27V326.49a7.84,7.84,0,1,1,15.67,0v28.57a3.9,3.9,0,0,0,7.8,0V326.49a15.66,15.66,0,0,0-11.74-15.14v-47.6a7.59,7.59,0,1,1,15.17,0v51a3.9,3.9,0,1,0,7.79,0V257a7.59,7.59,0,0,1,15.17,0V316.8a3.9,3.9,0,0,0,7.79,0V273.1a7.58,7.58,0,1,1,15.16,0v43.7a3.9,3.9,0,0,0,7.8,0V281.42h0a7.58,7.58,0,1,1,15.16,0v65a3.9,3.9,0,0,0,7.79,0V332.59c.5.05,1,.08,1.48.08a15.6,15.6,0,0,0,11-4.59l34.41-34.42a41.11,41.11,0,0,0,11.48-35.61l-.94-5.71,18.8-18.8a3.88,3.88,0,0,0,0-5.51Z"></path><path class="cls-1" d="M351.6,359.09a3.9,3.9,0,0,0-3.9,3.89v18.1a25.67,25.67,0,0,1-11.51,21.45l-3,2a6.24,6.24,0,0,0-2.8,5.21V429.1a3.9,3.9,0,0,0,7.8,0V410.58l2.34-1.56a33.42,33.42,0,0,0,15-27.94V363a3.89,3.89,0,0,0-3.89-3.89Z"></path><path class="cls-1" d="M325.65,222.36a3.91,3.91,0,0,0,2.76-1.14l5-5a25.69,25.69,0,0,1,23.31-7l3.57.72a6.24,6.24,0,0,0,5.66-1.7l34.58-34.59a3.9,3.9,0,1,0-5.51-5.51l-34,34-2.76-.56a33.43,33.43,0,0,0-30.36,9.15l-5,5a3.9,3.9,0,0,0,2.76,6.66Z"></path><path class="cls-1" d="M194.36,259.31l1.25-7.68a3.88,3.88,0,0,0-1.09-3.39l-20.77-20.77a3.9,3.9,0,0,0-5.51,5.51l19.36,19.36-.93,5.71a41,41,0,0,0,9.17,33.11,3.9,3.9,0,0,0,5.95-5A33.13,33.13,0,0,1,194.36,259.31Z"></path></svg>
					<span>Teambuilding</span>
				</div>
				<div class="sidebar-benefit">
					<svg id="Layer_1" data-name="Layer 1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 600 600"><defs><style>.cls-1{fill:#009ea9}</style></defs><path class="cls-1" d="M267.93 309.43A52.44 52.44 0 1 0 215.5 257a52.49 52.49 0 0 0 52.43 52.43zm0-95.61A43.18 43.18 0 1 1 224.75 257a43.23 43.23 0 0 1 43.18-43.18zM267.93 321.33a95.69 95.69 0 0 0-95.58 95.59 4.63 4.63 0 0 0 9.25 0 86.34 86.34 0 1 1 172.67 0 4.63 4.63 0 0 0 9.25 0 95.7 95.7 0 0 0-95.59-95.59zM423 183.92h-15.31v-.84a4.62 4.62 0 0 0-4.63-4.62h-66.21a4.62 4.62 0 0 0-4.63 4.62v.84h-15.58a4.62 4.62 0 0 0-4.62 4.62c0 23.14 11.93 43.74 29.11 50.68 3.48 6.93 8.29 12.48 14.91 15.77v13.32h-5.62a4.63 4.63 0 0 0 0 9.25h38.82a4.63 4.63 0 0 0 0-9.25h-5.36v-13.57c5.85-3.23 10.3-8.54 13.71-15.07 17.69-6.53 30-27.56 30-51.13a4.62 4.62 0 0 0-4.59-4.62zm-101.57 9.25h10.92c.33 11 1.32 22.32 3.83 32.34-8.18-7.15-13.68-19.01-14.73-32.34zm56.05 54.39a4.61 4.61 0 0 0-2.87 4.28v16.47h-9.34V252a4.64 4.64 0 0 0-3.05-4.35c-18.95-6.9-20.61-42-20.75-59.89h56.93c-.64 32.89-8.17 54.59-20.9 59.8zM402.85 226c2.84-10.23 4.17-21.75 4.64-32.8h10.73c-1.08 13.62-6.87 25.69-15.37 32.8z"></path></svg>
					<span>Bónus</span>
				</div>
			</div>
		</div>';

	return $html;

}
// check for a certain meta key on the current post and add a body class if meta value exists

add_filter('body_class','krogs_custom_field_body_class');

function krogs_custom_field_body_class( $classes ) {
$post = get_post(get_the_ID());
if($post->post_type=="jobs"){
	$terms = get_the_terms(get_the_ID(),"job_categories");
	foreach($terms as $term){
	$classes[] = $term->slug;
	}
}else{
if (is_single() ) {
      foreach((get_the_category($post->ID)) as $category) {
        // add category slug to the $classes array
        $classes[] = $category->category_nicename;
      }
    }
}
return $classes;
}


add_action('wp_after_insert_post', 'job_terminated', 10, 2);
function job_terminated($post_id, $post){

	if($post->post_type == 'jobs'){

		if( has_term('ofertaterminada', 'job_categories', $post_id ) )
			$noindex = 1;
		else
			$noindex = 0;
			//cancelar isto por pedido da sara
	//	update_post_meta($post_id, '_yoast_wpseo_meta-robots-noindex', $noindex);

		global $wpdb;

		$sql =
			'UPDATE ' . $wpdb->prefix . 'yoast_indexable
			SET is_robots_noindex = '.$noindex.'
			WHERE object_id = ' . $post_id . ' AND object_type = "post"';
	//cancelar isto por pedido da sara
	//	$wpdb->query($sql);

	}

}



function xpand_it_hide_posts( $query ) {
	  if ( !$query->is_search )
        return $query;
	//$query->query_vars['category__not_in'][] = 275;
    $taxquery = array(
            'taxonomy' => 'category',
            'field' => 'id',
            'terms' => array( 275 ),
            'operator'=> 'NOT IN'
        );

    //$query->set( 'tax_query', $taxquery );

     $query->tax_query->queries[] = $taxquery;

    $query->query_vars['tax_query'] = $query->tax_query->queries;

}
add_action( 'pre_get_posts', 'xpand_it_hide_posts' );