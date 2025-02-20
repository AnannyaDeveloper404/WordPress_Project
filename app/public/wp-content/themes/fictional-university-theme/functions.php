<?php
require get_theme_file_path('/inc/search-route.php');
function university_custom_rest()
{
    register_rest_field('post', 'authorName', array(
        'get_callback' => function () {
            return get_the_author();
        }
    ));
}
add_action('rest_api_init', 'university_custom_rest');
function pageBanner($args = NULL)
{

    if (!isset($args['title'])) {
        $args['title'] = get_the_title();
    }

    if (!isset($args['subtitle'])) {
        $args['subtitle'] = get_field('page_banner_subtitle');
    }

    if (!isset($args['photo'])) {
        if (get_field('page_banner_background_image') and !is_archive() and !is_home()) {
            $args['photo'] = get_field('page_banner_background_image')['sizes']['pageBanner'];
        } else {
            $args['photo'] = get_theme_file_uri('/images/ocean.jpg');
        }
    }
?>
    <div class="page-banner">
        <div class="page-banner__bg-image" style="background-image: url(<?php
                                                                        echo $args['photo'];  ?>);"></div>
        <div class="page-banner__content container container--narrow">
            <h1 class="page-banner__title"><?php echo $args['title'] ?></h1>
            <div class="page-banner__intro">
                <p><?php echo $args['subtitle'] ?></p>
            </div>
        </div>
    </div>


<?php
}
?>

<?php
function university_files()
{
    wp_enqueue_script('main-university-js', get_theme_file_uri('/build/index.js'), array('jquery'), '1.0', true); //hey wordpress, please output the main.js file
    wp_enqueue_script('googleMap', '//maps.googleapis.com/maps/api/js?key=AIzaSyCRHeN1BW0gMZrj9eAOMmRoARhvHWb_WHc', NULL, '1.0', true); //hey wordpress, please output the main.js file
    wp_enqueue_style('font-awesome', 'https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css');
    wp_enqueue_style('custom-google-fonts', 'https://fonts.googleapis.com/css?family=Roboto+Condensed:300,300i,400,400i,700,700i|Roboto:100,300,400,400i,700,700i');
    wp_enqueue_style('university_main_styles', get_theme_file_uri('/build/style-index.css')); //hey wordpress, please output the style.css file(default stylesheet in wordpress)
    wp_enqueue_style('university_extra_styles', get_theme_file_uri('/build/index.css'));

    wp_localize_script('main-university-js', 'universityData', array(
        'root_url' => get_site_url(),
        'nonce' => wp_create_nonce('wp_rest')
    ));
}
add_action('wp_enqueue_scripts', 'university_files'); //hey wordpress, when you are about to output the scripts, please run this function


function university_features()
{
    // register_nav_menu('headerMenuLocation', 'Header Menu Location'); //hey wordpress, please add the header menu location
    // register_nav_menu('footerLocationOne', 'Footer Location One');
    // register_nav_menu('footerLocationTwo', 'Footer Location Two');
    add_theme_support('title-tag'); //hey wordpress, please add the title tag to the head of the document
    add_theme_support('post-thumbnails'); //hey wordpress, please add the post thumbnail feature
    add_image_size('professorLandscape', 400, 260, true);
    add_image_size('professorPortrait', 480, 650, true);
    add_image_size('professorPortrait2', 200, 300, true);
    add_image_size('pageBanner', 1500, 350, true); //true means crop the image

}
add_action('after_setup_theme', 'university_features');

function university_adjust_queries($query)
{
    if (!is_admin() && is_post_type_archive('program') && is_main_query()) {
        $query->set('orderby', 'title');
        $query->set('order', 'ASC');
        $query->set('posts_per_page', -1);
    }

    if (!is_admin() && is_post_type_archive('event') && $query->is_main_query()) {
        $today = date('Ymd');
        $query->set('meta_key', 'event_date');
        $query->set('orderby', 'meta_value_num');
        $query->set('order', 'ASC');
        $query->set('meta_query', array(
            array(
                'key' => 'event_date',
                'compare' => '>=',
                'value' => $today,
                'type' => 'numeric'
            )
        ));
    }
}


add_action('pre_get_posts', 'university_adjust_queries');

function universityMapKey($api)
{
    $api['key'] = 'AIzaSyCRHeN1BW0gMZrj9eAOMmRoARhvHWb_WHc';
    return $api;
}


add_filter('acf/fields/google_map/api', 'universityMapKey');


//redirect subscriber accounts out of admin and onto homepage
add_action('admin_init', 'redirectSubsToFrontend');
function redirectSubsToFrontend()
{
    $ourCurrentUser = wp_get_current_user();
    if (count($ourCurrentUser->roles) == 1 and $ourCurrentUser->roles[0] == 'subscriber') {
        wp_redirect(site_url('/'));
        exit;
    }
}
add_action('wp_loaded', 'noSubsAdminBar');
function noSubsAdminBar()
{
    $ourCurrentUser = wp_get_current_user();
    if (count($ourCurrentUser->roles) == 1 and $ourCurrentUser->roles[0] == 'subscriber') {
        show_admin_bar(false);
    }
}


//customize login screen

add_filter('login_headerurl', 'ourHeaderUrl');
function ourHeaderUrl()
{
    return esc_url(site_url('/'));
}   //this function will return the url of the site


add_action('login_enqueue_scripts', 'ourLoginCSS');
function ourLoginCSS()
{
    wp_enqueue_style('university_main_styles', get_theme_file_uri('/build/style-index.css')); //hey wordpress, please output the style.css file(default stylesheet in wordpress)
    wp_enqueue_style('university_extra_styles', get_theme_file_uri('/build/index.css'));
    wp_enqueue_style('font-awesome', 'https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css');
    wp_enqueue_style('custom-google-fonts', 'https://fonts.googleapis.com/css?family=Roboto+Condensed:300,300i,400,400i,700,700i|Roboto:100,300,400,400i,700,700i');

}
add_filter('login_headertitle', 'ourLoginTitle');
function ourLoginTitle()
{
    return get_bloginfo('name');
}