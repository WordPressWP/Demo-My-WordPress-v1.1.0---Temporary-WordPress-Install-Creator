<?php
/** 
Plugin Name: Demo My WordPress
Plugin URI: //1.envato.market/coderevolution
Description: This plugin will generate demo pages for you, to show off your cool themes or plugins
Author: CodeRevolution
Version: 1.1.0
Author URI: //coderevolution.ro
License: Commercial. For personal use only. Not to give away or resell.
Text Domain: demo-my-wordpress
*/
/*  
Copyright 2016 - 2024 CodeRevolution
*/

defined('ABSPATH') or die();
require_once (dirname(__FILE__) . "/res/other/plugin-dash.php"); 

/* fix by phpCore */
if(!function_exists('switch_to_blog')) require_once ( ABSPATH . 'wp-includes'.DIRECTORY_SEPARATOR.'ms-blogs.php' );

function dwp_load_textdomain() {
    load_plugin_textdomain( 'demo-my-wordpress', false, basename( dirname( __FILE__ ) ) . '/languages' ); 
}
add_action( 'init', 'dwp_load_textdomain' );

$plugin = plugin_basename(__FILE__);
if(is_admin())
{
    if(!is_multisite())
    {
        add_action('admin_menu', 'dwp_register_my_custom_menu_page');
    }
    else
    {
        add_action('network_admin_menu', 'dwp_register_my_custom_menu_page');
    }
    $plugin_slug = explode('/', $plugin);
    $plugin_slug = $plugin_slug[0];
    if(isset($_POST[$plugin_slug . '_register']) && isset($_POST[$plugin_slug. '_register_code']) && trim($_POST[$plugin_slug . '_register_code']) != '')
    {
        $uoptions = array();
        $uoptions['item_id'] = 22475451;
        $uoptions['item_uid'] = 'pqwl9-he9jk-p6t92-c8sdu-og987-rqidc-egybg';
        $uoptions['code'] = $_POST[$plugin_slug . '_register_code'];
        $uoptions['item_name'] = ' Demo My WordPress - Temporary WordPress Install Creator';
        $uoptions['created_at'] = '24.12.1974';
        $uoptions['buyer'] = 'Tom & Jerry';
        $uoptions['licence'] = 'extended';
        $uoptions['supported_until'] = '24.12.2038';
        update_option($plugin_slug . '_registration', $uoptions);
        update_option('coderevolution_settings_changed', 2);
    }
    require "update-checker/plugin-update-checker.php";
    $fwdu3dcarPUC = YahnisElsts\PluginUpdateChecker\v5\PucFactory::buildUpdateChecker("https://wpinitiate.com/auto-update/?action=get_metadata&slug=demo-my-wordpress", __FILE__, "demo-my-wordpress");
    add_filter("plugin_action_links_$plugin", 'dwp_add_support_link');
    add_filter("plugin_action_links_$plugin", 'dwp_add_settings_link');
    add_filter("plugin_action_links_$plugin", 'dwp_add_rating_link');
    add_action('admin_init', 'dwp_register_mysettings');
    require(dirname(__FILE__) . "/demo-my-wordpress-main.php");
    require(dirname(__FILE__) . "/demo-my-wordpress-logs.php");
    require(dirname(__FILE__) . "/demo-my-wordpress-menus.php");
}

function dwp_admin_enqueue_all()
{
    $reg_css_code = '.cr_auto_update{background-color:#fff8e5;margin:5px 20px 15px 20px;border-left:4px solid #fff;padding:12px 12px 12px 12px !important;border-left-color:#ffb900;}';
    wp_register_style( 'dwp-plugin-reg-style', false );
    wp_enqueue_style( 'dwp-plugin-reg-style' );
    wp_add_inline_style( 'dwp-plugin-reg-style', $reg_css_code );
}
function dwp_admin_load_files()
{
    wp_register_style('dwp-browser-style', plugins_url('styles/dwp-browser.css', __FILE__), false, '1.0.0');
    wp_enqueue_style('dwp-browser-style');
    wp_register_style('dwp-custom-style', plugins_url('styles/coderevolution-style.css', __FILE__), false, '1.0.0');
    wp_enqueue_style('dwp-custom-style');
    wp_enqueue_script('jquery');
}
function dwp_register_mysettings()
{
    add_action( 'wp_dashboard_setup', 'dwp_remove_dashboard_widgets');
    register_setting('dwp_option_group', 'dwp_Main_Settings');
}
function dwp_add_support_link($links)
{
    $settings_link = '<a href="//coderevolution.ro/knowledge-base/" target="_blank">' . esc_html__('Support', 'demo-my-wordpress') . '</a>';
    array_push($links, $settings_link);
    return $links;
}

function dwp_add_settings_link($links)
{
    $settings_link = '<a href="admin.php?page=dwp_admin_settings">' . esc_html__('Settings', 'demo-my-wordpress') . '</a>';
    array_push($links, $settings_link);
    return $links;
}

function dwp_add_rating_link($links)
{
    $settings_link = '<a href="//codecanyon.net/downloads" target="_blank" title="Rate">
            <i class="wdi-rate-stars"><svg xmlns="http://www.w3.org/2000/svg" width="15" height="15" viewBox="0 0 24 24" fill="#ffb900" stroke="#ffb900" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-star"><polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"></polygon></svg><svg xmlns="http://www.w3.org/2000/svg" width="15" height="15" viewBox="0 0 24 24" fill="#ffb900" stroke="#ffb900" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-star"><polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"></polygon></svg><svg xmlns="http://www.w3.org/2000/svg" width="15" height="15" viewBox="0 0 24 24" fill="#ffb900" stroke="#ffb900" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-star"><polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"></polygon></svg><svg xmlns="http://www.w3.org/2000/svg" width="15" height="15" viewBox="0 0 24 24" fill="#ffb900" stroke="#ffb900" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-star"><polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"></polygon></svg><svg xmlns="http://www.w3.org/2000/svg" width="15" height="15" viewBox="0 0 24 24" fill="#ffb900" stroke="#ffb900" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-star"><polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"></polygon></svg></i></a>';
    array_push($links, $settings_link);
    return $links;
}

function dwp_get_blog_timezone() {

    $tzstring = get_option( 'timezone_string' );
    $offset   = get_option( 'gmt_offset' );

    if( empty( $tzstring ) && 0 != $offset && floor( $offset ) == $offset ){
        $offset_st = $offset > 0 ? "-$offset" : '+'.absint( $offset );
        $tzstring  = 'Etc/GMT'.$offset_st;
    }
    if( empty( $tzstring ) ){
        $tzstring = 'UTC';
    }
    $timezone = new DateTimeZone( $tzstring );
    return $timezone; 
}
function dwp_log_to_file($str)
{
    dwp_switch_to_new_blog(1);
    $dwp_Main_Settings = get_option('dwp_Main_Settings', false);
    if (isset($dwp_Main_Settings['enable_logging']) && $dwp_Main_Settings['enable_logging'] == 'on') {
        $tz = dwp_get_blog_timezone();
        if($tz !== false)
            date_default_timezone_set($tz->getName());
        $d = date("j-M-Y H:i:s e", time());
        error_log("[$d] " . $str . "<br/>\r\n", 3, WP_CONTENT_DIR . '/dwp_info.log');
        if($tz !== false)
            date_default_timezone_set('UTC');
    }
    dwp_restore_current_blog();
}

function dwp_add_activation_link($links)
{
    $settings_link = '<a href="admin.php?page=dwp_admin_settings">' . esc_html__('Activate Plugin License', 'demo-my-wordpress') . '</a>';
    array_push($links, $settings_link);
    return $links;
}

function dwp_register_my_custom_menu_page()
{
    add_menu_page('Demo My WordPress', 'Demo My WordPress', 'manage_options', 'dwp_admin_settings', 'dwp_admin_settings', plugins_url('images/icon.png', __FILE__));
    $main = add_submenu_page('dwp_admin_settings', esc_html__("Main Settings", 'demo-my-wordpress'), esc_html__("Main Settings", 'demo-my-wordpress'), 'manage_options', 'dwp_admin_settings');
    add_action( 'load-' . $main, 'dwp_load_all_admin_js' );
    add_action( 'load-' . $main, 'dwp_load_main_admin_js' );
    dwp_switch_to_new_blog(1);
    $dwp_Main_Settings = get_option('dwp_Main_Settings', false);
    dwp_restore_current_blog();
    if (isset($dwp_Main_Settings['dwp_enabled']) && $dwp_Main_Settings['dwp_enabled'] == 'on') {
        $logs = add_submenu_page('dwp_admin_settings', esc_html__("Activity & Logging", 'demo-my-wordpress'), esc_html__("Activity & Logging", 'demo-my-wordpress'), 'manage_options', 'dwp_logs', 'dwp_logs');
        add_action( 'load-' . $logs, 'dwp_load_all_admin_js' );
    }
}
function dwp_load_main_admin_js(){
    add_action('admin_enqueue_scripts', 'dwp_enqueue_main_admin_js');
}

function dwp_enqueue_main_admin_js(){
    wp_enqueue_script('dwp-main-script', plugins_url('scripts/main.js', __FILE__), array('jquery'));
}
function dwp_load_all_admin_js(){
    add_action('admin_enqueue_scripts', 'dwp_admin_load_files');
}
function dwp_check_activate( $network_wide ) {
    if (!function_exists('curl_init')) {
        echo '<h3>'.esc_html__('Please enable curl PHP extension. Please contact your hosting provider\'s support to help you in this matter.', 'demo-my-wordpress').'</h3>';
        die;
    }
    if (version_compare(phpversion(), '5.4', '<')) {
        echo '<h3>'.esc_html__('Please update your PHP version to version 5.4 or greater. Right now you have PHP ' . phpversion(), 'demo-my-wordpress').'</h3>';
        trigger_error(esc_html__('Please update your PHP version to version 5.4 or greater. Right now you have PHP ' . phpversion(), 'demo-my-wordpress'), E_USER_ERROR);
    }
}

register_activation_hook(__FILE__, 'dwp_check_activate');

function dwp_easy_noindex_nofollow_add_header(){
	echo "<meta name=\"robots\" content=\"noindex, nofollow\"/>\n";
}
function dwp_remove_dashboard_widgets () {
    dwp_switch_to_new_blog(1);
    $dwp_Main_Settings = get_option('dwp_Main_Settings', false);
    dwp_restore_current_blog();
    if( is_array( $dwp_Main_Settings ) == false )
        $dwp_Main_Settings = array();
    if( isset($dwp_Main_Settings[ 'disabla_dash_qpw' ]) && $dwp_Main_Settings[ 'disabla_dash_qpw' ] == 'on' && current_user_can('manage_options')) {
        remove_meta_box( 'dashboard_quick_press',   'dashboard', 'side' );      //Quick Press Widget
    }
    if( isset($dwp_Main_Settings[ 'disabla_dash_rd' ]) && $dwp_Main_Settings[ 'disabla_dash_rd' ] == 'on' && current_user_can('manage_options')) {
        remove_meta_box( 'dashboard_recent_drafts', 'dashboard', 'side' );      //Recent Drafts
    }
    if( isset($dwp_Main_Settings[ 'disabla_dash_wp' ]) && $dwp_Main_Settings[ 'disabla_dash_wp' ] == 'on' && current_user_can('manage_options')) {
        remove_meta_box( 'dashboard_primary',       'dashboard', 'side' );      //WordPress.com Blog
    }
    if( isset($dwp_Main_Settings[ 'disabla_dash_owp' ]) && $dwp_Main_Settings[ 'disabla_dash_owp' ] == 'on' && current_user_can('manage_options')) {
        remove_meta_box( 'dashboard_secondary',     'dashboard', 'side' );      //Other WordPress News
    }
    if( isset($dwp_Main_Settings[ 'disabla_dash_il' ]) && $dwp_Main_Settings[ 'disabla_dash_il' ] == 'on' && current_user_can('manage_options')) {
        remove_meta_box( 'dashboard_incoming_links','dashboard', 'normal' );    //Incoming Links
    }
    if( isset($dwp_Main_Settings[ 'disabla_dash_pl' ]) && $dwp_Main_Settings[ 'disabla_dash_pl' ] == 'on' && current_user_can('manage_options')) {
        remove_meta_box( 'dashboard_plugins',       'dashboard', 'normal' );    //Plugins
    }
    if( isset($dwp_Main_Settings[ 'disabla_dash_rn' ]) && $dwp_Main_Settings[ 'disabla_dash_rn' ] == 'on' && current_user_can('manage_options')) {
        remove_meta_box( 'dashboard_right_now',     'dashboard', 'normal' );    //Right Now
    }
}
register_activation_hook(__FILE__, 'dwp_activation_callback');
function dwp_activation_callback($defaults = FALSE)
{
    if (!get_option('dwp_Main_Settings') || $defaults === TRUE) {
        $dwp_Main_Settings = array(
            'dwp_enabled' => 'on',
            'enable_logging' => 'on',
            'dwp_noindex' => 'on',
            'dwp_hinactive' => 'on',
            'delete_sample' => '',
            'set_theme' => 'on',
            'delete_hello' => '',
            'dwp_blog_title' => '',
            'dwp_blog_desc' => '',
            'disabla_dash_qpw' => '',
            'def_pass' => '',
            'disabla_dash_rd' => '',
            'disabla_dash_wp' => '',
            'disabla_dash_owp' => '',
            'disabla_dash_il' => '',
            'disabla_dash_pl' => '',
            'disabla_dash_rn' => '',
            'auto_delete_demo' => 'daily',
            'user_role_set' => 'administrator',
            'dwp_captcha' => 'on',
            'enable_clone' => '',
            'gocopy_files' => '',
            'from_the_id' => '',
            'dwp_email' => '',
            'allow_site_name' => '',
            'allow_clone_id' => '',
            'banned_id' => '',
            'email_template' => '',
            'email_template_title' => 'Demo login URL',
            'only_one' => ''
        );
        if ($defaults === FALSE) {
            add_option('dwp_Main_Settings', $dwp_Main_Settings);
        } else {
            update_option('dwp_Main_Settings', $dwp_Main_Settings);
        }
    }
}

require_once(dirname(__FILE__) . "/demo-my-wordpress-captcha.php");
add_action( 'dwp_user_redirected', 'dwp_dummy_user_redirect');
function dwp_dummy_user_redirect() {
}
add_action( 'enqueue_block_editor_assets', 'dwp_enqueue_block_editor_assets' );
function dwp_enqueue_block_editor_assets() {
	wp_register_style('dwp-browser-style', plugins_url('styles/dwp-browser.css', __FILE__), false, '1.0.0');
    wp_enqueue_style('dwp-browser-style');
	$block_js_display   = 'scripts/block.js';
	wp_enqueue_script(
		'dwp-block-js', 
        plugins_url( $block_js_display, __FILE__ ), 
        array(
			'wp-blocks',
			'wp-i18n',
			'wp-element',
		),
        '1.0.0'
	);
}
add_action('init', 'dwp_start_session');
function dwp_start_session(){
    if ( function_exists( 'register_block_type' ) ) {
        register_block_type( 'demo-my-wordpress/dwp-list', array(
            'render_callback' => 'dwp_demo_form',
        ) );
    }
    dwp_switch_to_new_blog(1);
    $dwp_Main_Settings = get_option('dwp_Main_Settings', false);
    dwp_restore_current_blog();
    if (isset($dwp_Main_Settings['dwp_enabled']) && $dwp_Main_Settings['dwp_enabled'] == 'on') {
        if (isset($dwp_Main_Settings['dwp_noindex']) && $dwp_Main_Settings['dwp_noindex'] == 'on') {
            add_action('wp_head', 'dwp_easy_noindex_nofollow_add_header');
        } 
    }
}
add_shortcode('dwp_demo_form', 'dwp_demo_form');
function dwp_demo_form($atts = null){
    if ( is_admin() ) 
    {
        return;
    }
    if(!is_multisite())
    {
        ob_start();
        echo esc_html__('A Multisite WordPress install is needed for this shortcode to work.', 'demo-my-wordpress');
        $output = ob_get_contents();
        ob_end_clean();
        return $output;
    }
    else
    {
        extract( shortcode_atts(
            array(
                'activate_plugins' => '',
                'switch_theme' => ''
            ), $atts )
        );
        dwp_switch_to_new_blog(1);
        $dwp_Main_Settings = get_option('dwp_Main_Settings', false);
        dwp_restore_current_blog();
        $cpa = new DemoCaptchaWP();
        {
            $cpa->reset_captcha();
            wp_enqueue_script('dwp-front-script', plugins_url('scripts/front.js', __FILE__), array('jquery'));
            if (isset($dwp_Main_Settings['allow_site_name']) && $dwp_Main_Settings['allow_site_name'] == 'on') {
                $sitenameon = '1';
            }
            else
            {
                $sitenameon = '0';
            }
            if (isset($dwp_Main_Settings['allow_clone_id']) && $dwp_Main_Settings['allow_clone_id'] == 'on') {
                $cloneidon = '1';
            }
            else
            {
                $cloneidon = '0';
            }
            if (isset($dwp_Main_Settings['dwp_email']) && $dwp_Main_Settings['dwp_email'] == 'on') {
                $emailon = '1';
            }
            else
            {
                $emailon = '0';
            }
            if (isset($dwp_Main_Settings['dwp_captcha']) && $dwp_Main_Settings['dwp_captcha'] == 'on') {
                $captchaon = '1';
            }
            else
            {
                $captchaon = '0';
            }
            $conf_settings = array(
                'fronttext' => esc_html__("Processing your request, please wait", 'demo-my-wordpress') . '... <img src="' . esc_url(plugins_url('images/running.gif', __FILE__)) . '"/>',
                'sitenameon' => $sitenameon,
                'emailon' => $emailon,
                'cloneidon' => $cloneidon,
                'captchaon' => $captchaon,
                'activate_plugins' => $activate_plugins,
                'switch_theme' => $switch_theme,
                'ajaxurl' => admin_url('admin-ajax.php')
            );
            wp_localize_script('dwp-front-script', 'dwpssettings', $conf_settings);
            ob_start();
            ?>
            <form enctype="multipart/form-data" method="post" id="cbs-register" action="">
<?php
if (isset($dwp_Main_Settings['dwp_email']) && $dwp_Main_Settings['dwp_email'] == 'on') {
?>
                <p><?php
                echo esc_html__('Email address: ', 'demo-my-wordpress');
                ?>
                <input name="email" id="dwp_email"  type="email" value="" required />
                </p>
<?php
}
if (isset($dwp_Main_Settings['allow_site_name']) && $dwp_Main_Settings['allow_site_name'] == 'on') {
?>
                <p><?php
                echo esc_html__('Site name: ', 'demo-my-wordpress');
                ?>
                <input name="sitename" id="dwp_sitename" type="text" value="" required />
                </p>
<?php
}
if (isset($dwp_Main_Settings['allow_clone_id']) && $dwp_Main_Settings['allow_clone_id'] == 'on') {
?>
                <p><?php
                echo esc_html__('Site ID to be cloned: ', 'demo-my-wordpress');
                ?>
                <input name="siteid" min="1" step="1" id="dwp_siteid"  type="number" value="" required />
                </p>
<?php 
}
if (isset($dwp_Main_Settings['dwp_captcha']) && $dwp_Main_Settings['dwp_captcha'] == 'on')
{
?>
                <p><?php
                echo esc_html__('Solve this simple Captcha: ', 'demo-my-wordpress') . $cpa->get_captcha_text() . " = ?";
                ?>
                <input name="captcha" id="dwp_captcha"  type="text" value="" required />
                </p>
<?php
}
?>
                <p class="form-submit"><br/>
                    <span id="dwp_status"><p>   </p></span><br/>
                    <input type="button" onclick="myAction_dwp();" name="dwp_action_ajaxify" value="<?php echo esc_html__('Create Demo', 'demo-my-wordpress');?>">
                    <input name="dwp_action" type="hidden" id="dwp_action" value="dwp_demo" />
                </p>
            </form>
            <?php
            $output = ob_get_contents();
            ob_end_clean();
            return $output;
        }
    }
}

add_action('wp_ajax_dwp_my_action', 'dwp_my_action_func');
add_action('wp_ajax_nopriv_dwp_my_action', 'dwp_my_action_func');
function dwp_my_action_func()
{
    dwp_switch_to_new_blog(1);
    $dwp_Main_Settings = get_option('dwp_Main_Settings', false);
    dwp_restore_current_blog();
    if (isset($dwp_Main_Settings['dwp_email']) && $dwp_Main_Settings['dwp_email'] == 'on') {
        if(!isset($_REQUEST['email']) || $_REQUEST['email'] == '')
        {
            echo '<p>' . esc_html__('Please enter an email address before clicking the "Create Demo" button.', 'demo-my-wordpress') . '</p>';
            die();
        }
        if (!filter_var($_REQUEST['email'], FILTER_VALIDATE_EMAIL)) {
            echo '<p>' . esc_html__('Please enter a valid email address. The email you entered failed to validate.', 'demo-my-wordpress') . '</p>';
            die();
        }
    }
    if (isset($dwp_Main_Settings['allow_site_name']) && $dwp_Main_Settings['allow_site_name'] == 'on') {
        if(!isset($_REQUEST['sitename']) || $_REQUEST['sitename'] == '')
        {
            echo '<p>' . esc_html__('Please enter the name of the site you wish to be created.', 'demo-my-wordpress') . '</p>';
            die();
        }
    }
    if (isset($dwp_Main_Settings['allow_clone_id']) && $dwp_Main_Settings['allow_clone_id'] == 'on') {
        if(!isset($_REQUEST['siteid']) || $_REQUEST['siteid'] == '')
        {
            echo '<p>' . esc_html__('Please enter the site ID you wish to be cloned.', 'demo-my-wordpress') . '</p>';
            die();
        }
    }
    if (isset($dwp_Main_Settings['dwp_captcha']) && $dwp_Main_Settings['dwp_captcha'] == 'on')
    {
        if(!isset($_REQUEST['captcha']) || $_REQUEST['captcha'] == '')
        {
            echo '<p>' . esc_html__('Please solve the provided captcha.', 'demo-my-wordpress') . '</p>';
            die();
        }
        $captcha_val = $_REQUEST['captcha'];
        $cpa = new DemoCaptchaWP();
        if( !$cpa->validate($captcha_val) ){
            echo '<p>' . esc_html__('Incorect Captcha. Please try again.', 'demo-my-wordpress') . '</p>';
            die();
        }
    }
    if (isset($dwp_Main_Settings['dwp_email']) && $dwp_Main_Settings['dwp_email'] == 'on') {
        $email = $_REQUEST['email'];
    }
    else
    {
        $rand = 'dwp' . rand(1000, 9999);
        $email = $rand . '@noreply.com';
    }
    if (isset($dwp_Main_Settings['allow_clone_id']) && $dwp_Main_Settings['allow_clone_id'] == 'on') {
        $siteid = $_REQUEST['siteid'];
    }
    else
    {
        $siteid = '';
    }
    if (isset($_REQUEST['activate_plugins'])) {
        $activate_plugins = $_REQUEST['activate_plugins'];
    }
    else
    {
        $activate_plugins = '';
    }
    if (isset($_REQUEST['switch_theme'])) {
        $switch_theme = $_REQUEST['switch_theme'];
    }
    else
    {
        $switch_theme = '';
    }
    if (isset($dwp_Main_Settings['def_pass']) && $dwp_Main_Settings['def_pass'] != '')
    {
        $password =  $dwp_Main_Settings['def_pass'];
    }
    else
    {
        $password =  'demo';
    }
    $main_site = DOMAIN_CURRENT_SITE;
    if (isset($dwp_Main_Settings['only_one']) && $dwp_Main_Settings['only_one'] == 'on') 
    {
        global $current_user;
        wp_get_current_user();
        if (is_user_logged_in())
        {
            $is_existing = email_exists($email);
            if($is_existing !== false)
            {
                $myid = $is_existing;
            }
            else
            {
                $myid = $current_user->ID;
            }
            $user_blogs = get_blogs_of_user( $myid );
            if(count($user_blogs) > 0)
            {
                if(count($user_blogs) == 1)
                {
                    foreach($user_blogs as $ub)
                    {
                        if ( $ub->userblog_id == get_current_blog_id() ) {
                        }
                        else
                        {
                            echo '<p>' . esc_html__('Your account already created a demo site using this user account. Please access it using provided credentials.', 'demo-my-wordpress') . '</p>';
                            die();
                        }
                    }
                }
                else
                {
                    echo '<p>' . esc_html__('You already created a demo site using this user account. Please access it using provided credentials.', 'demo-my-wordpress') . '</p>';
                    die();
                }
            }
            if(isset($current_user->user_login) && $current_user->user_login != '')
            {
                if (isset($dwp_Main_Settings['allow_site_name']) && $dwp_Main_Settings['allow_site_name'] == 'on')
                {
                    $rand = trim($_REQUEST['sitename']);
                    $rand = sanitize_title($rand);
                    if( is_subdomain_install() ) {
                        $newdomain = "{$rand}.$main_site";
                        $path = '/';
                    } else {
                        $newdomain = $main_site;
                        $path = PATH_CURRENT_SITE . "{$rand}/";
                    }
                    if(domain_exists($newdomain, $path))
                    {
                        echo '<p>' . esc_html__('The site name you entered already exists.', 'demo-my-wordpress') . '</p>';
                        die();
                    }
                }
                else
                {
                    $rand = $current_user->user_login;
                    $rand = sanitize_title($rand);
                    if( is_subdomain_install() ) {
                        $newdomain = "{$rand}.$main_site";
                        $path = '/';
                    } else {
                        $newdomain = $main_site;
                        $path = PATH_CURRENT_SITE . "{$rand}/";
                    }
                    if(domain_exists($newdomain, $path))
                    {
                        echo '<p>' . esc_html__('You already created a demo site using this user account.', 'demo-my-wordpress') . '</p>';
                        die();
                    }
                }
            }
            else
            {
                echo '<p>' . esc_html__('Your user name is not correct.', 'demo-my-wordpress') . '</p>';
                die();
            }
        } 
        else 
        {
            echo '<p>' . esc_html__('You must be logged in to use this feature.', 'demo-my-wordpress') . '</p>';
            die();
        }
        $username = $current_user->user_login;
    }
    else
    {
        if (isset($dwp_Main_Settings['allow_site_name']) && $dwp_Main_Settings['allow_site_name'] == 'on')
        {
            $rand = trim($_REQUEST['sitename']);
            $rand = sanitize_title($rand);
            if( is_subdomain_install() ) {
                $newdomain = "{$rand}.$main_site";
                $path = '/';
            } else {
                $newdomain = $main_site;
                $path = PATH_CURRENT_SITE . "{$rand}/";
            }
            if(domain_exists($newdomain, $path))
            {
                echo '<p>' . esc_html__('The site name you entered already exists.', 'demo-my-wordpress') . '</p>';
                die();
            }                    
        }
        else
        {
            do {
                $rand = 'demo' . dwp_rand_string();
                if( is_subdomain_install() ) {
                    $newdomain = "{$rand}.$main_site";
                    $path = '/';
                } else {
                    $newdomain = $main_site;
                    $path = PATH_CURRENT_SITE . "{$rand}/";
                }
            } while( username_exists($rand) && domain_exists($newdomain, $path) );
        }
        $username = $rand;
        $is_user = username_exists($username);
        if($is_user !== false)
        {
            $username .= uniqid();
        }
    }
    $is_existing = email_exists($email);
    if($is_existing === false)
    {
        $is_user = username_exists($username);
        if($is_user !== false)
        {
            $username .= uniqid();
        }
        $user_id = wpmu_create_user( $username, $password, $email );
    }
    else
    {
        $user_id = $is_existing;
        $userx = get_user_by( 'ID', $user_id );
        if($userx != false)
        {
            $username = $userx->user_login;
        }
    }
    
    if( $user_id == false ){
        dwp_log_to_file('Error while creating demo user account!');
        echo '<p>' . esc_html__('Failed to create the user account for the new demo. Please try again.', 'demo-my-wordpress') . '</p>';
        die();
    }
    if( is_wp_error( $user_id ) ){
        dwp_log_to_file('Error while creating demo: ' . print_r($user_id, true));
        echo '<p>' . esc_html__('Error occurred while creating the new user account for the demo. Please try again.', 'demo-my-wordpress') . '</p>';
        die();
    }
    $title = 'Demo';
    if (isset($dwp_Main_Settings['gocopy_files']) && $dwp_Main_Settings['gocopy_files'] == 'on')
    {
        $gocopy_files = '1';
    }
    else
    {
        $gocopy_files = '0';
    }
    if($siteid == '')
    {
        if (isset($dwp_Main_Settings['from_the_id']) && $dwp_Main_Settings['from_the_id'] != '')
        {
            $args = array(
                'ID' => intval($dwp_Main_Settings['from_the_id'])
            );
            $sites_count = get_sites( $args );
            if(count($sites_count) == 0)
            {
                dwp_log_to_file('The site ID to be cloned set in plugin settings was not found: ' . intval($dwp_Main_Settings['from_the_id']));
                echo '<p>' . esc_html__('The site ID to be cloned set in plugin settings was not found: ', 'demo-my-wordpress') . intval($dwp_Main_Settings['from_the_id']) . '</p>';
                die();
            }
            $from_the_id = intval($dwp_Main_Settings['from_the_id']);
        }
        else
        {
            $from_the_id = 1;
        }
    }
    else
    {
        if (isset($dwp_Main_Settings['banned_id']) && $dwp_Main_Settings['banned_id'] != '')
        {
            $banned_list = explode(',', $dwp_Main_Settings['banned_id']);
            $banned_list = array_map('trim', $banned_list);
            foreach($banned_list as $barxx)
            {
                if($barxx == $siteid)
                {
                    dwp_log_to_file('The site ID the user entered is not allowed to be cloned: ' . $siteid);
                    echo '<p>' . esc_html__('The site ID you entered is not allowed to be cloned: ', 'demo-my-wordpress') . $siteid . '</p>';
                    die();
                }
            }
        }
        $args = array(
            'ID' => intval($siteid)
        );
        $sites_count = get_sites( $args );
        if(count($sites_count) == 0)
        {
            dwp_log_to_file('The site ID to be cloned the user entered was not found: ' . $siteid);
            echo '<p>' . esc_html__('The site ID to be cloned you entered was not found: ', 'demo-my-wordpress') . $siteid . '</p>';
            die();
        }
        $from_the_id = intval($siteid);
    }
    
    if (isset($dwp_Main_Settings['enable_clone']) && $dwp_Main_Settings['enable_clone'] == 'on')
    {
        $param_arr = array(
            'domain'        => $newdomain,
            'path'          => $path,
            'title'         => $title,
            'user_id'       => $user_id,
            'from_site_id'  => $from_the_id,
            'files'         => $gocopy_files,
            'meta'          => array(
                'public' => 1
            )
        );
        $blog_id = dwp_wp_clone_site( $param_arr );
    }
    else
    {
        $blog_id = wpmu_create_blog( $newdomain, $path, $title, $user_id , array( 'public' => 1 ) );
    }
    
    if( is_wp_error( $blog_id ) ){
        dwp_log_to_file('Error while creating demo: ' . print_r($blog_id, true));
        echo '<p>' . esc_html__('The new demo account could not be created. Please try again.', 'demo-my-wordpress') . '</p>';
        die();
    }
    elseif( !is_numeric( $blog_id ) ){
        dwp_log_to_file('Error while creating and cloning demo site.');
        echo '<p>' . esc_html__('The new demo account could not be created. Please try again.', 'demo-my-wordpress') . '</p>';
        die();
    }
    $location =  get_site_url( $blog_id );
    $nonce = wp_create_nonce('dwp_noncer' . $user_id);
    $location .= "/?dwp_autologin=true&uid=" . $user_id . "&_wpnonce=" . $nonce;
    if(trim($activate_plugins) != '')
    {
        $location .= "&dwp_activate=" . urlencode($activate_plugins);
    }
    
    if(trim($switch_theme) != '')
    {
        $location .= "&switch_theme=" . urlencode($switch_theme);
    }
    
    if (isset($dwp_Main_Settings['dwp_email']) && $dwp_Main_Settings['dwp_email'] == 'on') {
        if (isset($dwp_Main_Settings['email_template']) && $dwp_Main_Settings['email_template'] != '') {
            $email = dwp_replace_shortcode(stripslashes($dwp_Main_Settings['email_template']), $location, $username, $password);
        }
        else
        {
            $email = esc_html__(dwp_replace_shortcode('Thank you for using our demo. Please log in to the generated demo page %%site_link%%. Your username is: %%site_user%% and your password is: %%site_password%%', $location, $username, $password), 'demo-my-wordpress');
        }
        if (isset($dwp_Main_Settings['email_template_title']) && $dwp_Main_Settings['email_template_title'] != '') {
            $email_subject = dwp_replace_shortcode(stripslashes($dwp_Main_Settings['email_template_title']), $location, $username, $password);
        }
        else
        {
            $email_subject = esc_html__('Demo Login URL', 'demo-my-wordpress');
        }
        $urlparts = parse_url(site_url());
        $domain = $urlparts ['host'];
        $domainparts = explode(".", $domain);
        if(count($domainparts) > 1)
        {
            $domain = $domainparts[count($domainparts)-2] . "." . $domainparts[count($domainparts)-1];
        }
        else
        {
            $domain = 'demo.com';
        }
        $headers = array(
            'From: noreply@' . $domain,
            'Content-Type: text/html; charset=UTF-8'
        );

        if(wp_mail($_REQUEST['email'], $email_subject, $email, $headers))
        {
            $emails = get_option('dwp_email_list', array());
            if(!in_array($_REQUEST['email'], $emails))
            {
                $emails[] = $_REQUEST['email'];
                update_option('dwp_email_list', $emails);
            }
            echo '<p>' . esc_html__("An email was sent to provided email address with the demo login URL.", 'demo-my-wordpress') . '</p>';
            die();
        }
        else
        {
            echo '<p>' . esc_html__("An error occurred while sending email.", 'demo-my-wordpress') . '</p>';
            die();
        }
    }
    echo $location;
    die();
}
function dwp_get_role_names() {
    $editable_roles = get_editable_roles();
    foreach ($editable_roles as $role => $details) {
        $sub['role'] = esc_attr($role);
        $sub['name'] = translate_user_role($details['name']);
        $roles[] = $sub;
    }
    return $roles;
}
function dwp_admin_change_role($blog_id, $user_id) 
{
    dwp_switch_to_new_blog(1);
    $dwp_Main_Settings = get_option('dwp_Main_Settings', false);
    dwp_restore_current_blog();
    if (isset($dwp_Main_Settings['dwp_enabled']) && $dwp_Main_Settings['dwp_enabled'] == 'on') {
        if (isset($dwp_Main_Settings['user_role_set']) && $dwp_Main_Settings['user_role_set'] != '' && $dwp_Main_Settings['user_role_set'] != 'administrator') {
            add_user_to_blog($blog_id, $user_id, $dwp_Main_Settings['user_role_set'] );
        }
    }
}
add_action( 'wpmu_new_blog', 'dwp_admin_change_role', 10, 2 );
function dwp_replace_shortcode($the_content, $location, $username, $password)
{
    $the_content = str_replace('%%demo_user%%', $username, $the_content);
    $the_content = str_replace('%%demo_password%%', $password, $the_content);
    $the_content = str_replace('%%demo_link%%', '<a href="' . $location . '" target="_blank">' . $location . '</a>', $the_content);
    $the_content = str_replace('%%demo_url%%', $location, $the_content);
    $the_content = str_replace('%%site_user%%', $username, $the_content);
    $the_content = str_replace('%%site_password%%', $password, $the_content);
    $the_content = str_replace('%%site_link%%', '<a href="' . $location . '" target="_blank">' . $location . '</a>', $the_content);
    $the_content = str_replace('%%site_url%%', $location, $the_content);
    return $the_content;
}

function dwp_rand_string($length = 8)
{
	return substr(sha1(rand()), 0, $length);
}


function dwp_hide_site_plugins($plugins){
    dwp_switch_to_new_blog(1);
    if(!function_exists('is_plugin_active'))
    {
        include_once( ABSPATH . 'wp-admin/includes/plugin.php' );
    }
    $dwp_Main_Settings = get_option('dwp_Main_Settings', false);
    dwp_restore_current_blog();
    if (isset($dwp_Main_Settings['dwp_enabled']) && $dwp_Main_Settings['dwp_enabled'] == 'on') {
        if (isset($dwp_Main_Settings['dwp_hinactive']) && $dwp_Main_Settings['dwp_hinactive'] == 'on' && !is_main_site() && !is_network_admin()) {
            foreach($plugins as $pname => $pval)
            {
                if(!is_plugin_active($pname))
                {
                    unset($plugins[$pname]);
                }
            }
        }
    }
	return $plugins;	
}
add_filter('query_vars', 'dwp_parameter_queryvars' );
function dwp_parameter_queryvars( $qvars )
{
    $qvars[] = 'dwp_autologin';
    $qvars[] = 'uid';
    $qvars[] = '_wpnonce';
    $qvars[] = 'switch_theme';
    $qvars[] = 'dwp_activate';
    return $qvars;
}

function dwp_call_post_function($uid, $nonce, $switch_theme, $dwp_activate)
{
    dwp_switch_to_new_blog(1);
    $dwp_Main_Settings = get_option('dwp_Main_Settings', false);
    dwp_restore_current_blog();

    $arr_params = array( 'dwp_autologin', 'uid', '_wpnonce', 'dwp_activate', 'switch_theme' );
    $current_page_url = remove_query_arg( $arr_params, dwp_curpageurl() );
    do_action('dwp_user_redirected');

    if (isset($dwp_Main_Settings['delete_sample']) && $dwp_Main_Settings['delete_sample'] == 'on') {
        $xposts = get_posts(
            array(
                'post_type'              => 'page',
                'title'                  => 'Sample Page',
                'post_status'            => 'all',
                'numberposts'            => 1,
                'update_post_term_cache' => false,
                'update_post_meta_cache' => false,           
                'orderby'                => 'post_date ID',
                'order'                  => 'ASC',
            )
        );
        if ( ! empty( $xposts ) ) {
            $defaultPage = $xposts[0];
        } else {
            $defaultPage = null;
        }
        if ( ! empty( $defaultPage ) ) 
            wp_delete_post( $defaultPage->ID, $bypass_trash = true );
    }
    if (isset($dwp_Main_Settings['delete_hello']) && $dwp_Main_Settings['delete_hello'] == 'on') {
        $defaultPost = get_posts( array( 'title' => 'Hello world!' ) );
        if ( ! empty( $defaultPost ) ) 
            wp_delete_post( $defaultPost[0]->ID, $bypass_trash = true );
    }
    if (isset($dwp_Main_Settings['dwp_blog_title']) && $dwp_Main_Settings['dwp_blog_title'] != '') {
        update_option( 'blogname', $dwp_Main_Settings['dwp_blog_title'] );
    }
    if (isset($dwp_Main_Settings['dwp_blog_desc']) && $dwp_Main_Settings['dwp_blog_desc'] != '') {
        update_option( 'blogdescription', $dwp_Main_Settings['dwp_blog_desc'] );
    }
    if (isset($dwp_Main_Settings['set_theme']) && $dwp_Main_Settings['set_theme'] == 'on') {
        dwp_switch_to_new_blog(1);
        $ss = get_stylesheet();
        dwp_restore_current_blog();
    }
    else
    {
        $ss = false;
    }
    if (isset($dwp_Main_Settings['set_theme']) && $dwp_Main_Settings['set_theme'] == 'on' && $ss !== false) 
    {
        switch_theme( $ss );
    }
    if($switch_theme != '')
    {
        switch_theme(urldecode($switch_theme));
    }
    if(!function_exists('wp_redirect'))
    {
        include_once( ABSPATH . 'wp-includes/pluggable.php' );
    }
    if ( !wp_verify_nonce( $nonce, 'dwp_noncer' . $uid ) )
    {
        wp_redirect( $current_page_url);
        exit;
    } 
    else 
    {
        $author_obj = get_user_by('id', $uid);
        if($author_obj !== false)
        {
            wp_clear_auth_cookie();
            wp_set_current_user( $uid, $author_obj->user_login );
            wp_set_auth_cookie( $uid );
            do_action( 'wp_login', $author_obj->user_login, $author_obj );
        }
        else
        {
            dwp_log_to_file('Failed to set user ID: ' . $uid);
        }
        
        if($dwp_activate != '')
        {
            $plugins = explode(',', urldecode($dwp_activate));
            $current = get_option('active_plugins', array());
            $changed = false;
            global $wp_filesystem;
            if ( ! is_a( $wp_filesystem, 'WP_Filesystem_Base') ){
                include_once(ABSPATH . 'wp-admin/includes/file.php');$creds = request_filesystem_credentials( site_url() );
                wp_filesystem($creds);
            }
            foreach($plugins as $plugin)
            {
                $plugin = trim($plugin);
                if($plugin == '')
                {
                    continue;
                }
                if (!in_array($plugin, $current)) 
                {
                    if ($wp_filesystem->exists(WP_PLUGIN_DIR . '/' . $plugin)) 
                    {
                        include_once(WP_PLUGIN_DIR . '/' . $plugin);
                        $changed = true;
                        do_action('activate_plugin', $plugin);
                        do_action('activate_' . $plugin);
                        $current[] = $plugin;
                    }
                }
            }
            if($changed)
            {
                sort($current);
                update_option('active_plugins', $current);
                do_action('activated_plugin', $plugin);
            }
        }
        $redirect_to = admin_url();
        wp_redirect($redirect_to);
        exit;
    }
}

add_action( 'init', 'dwp_autologin_after_creation' );
function dwp_autologin_after_creation(){
	if( isset( $_REQUEST['dwp_autologin'] ) && isset( $_REQUEST['uid'] ) && isset( $_REQUEST['_wpnonce'] ))
    {
        $uid = $_REQUEST['uid'];
		$nonce  = $_REQUEST['_wpnonce'];
        if(isset($_REQUEST['switch_theme']) && $_REQUEST['switch_theme'] != '' && current_user_can('switch_themes'))
        {
            $switch_theme = $_REQUEST['switch_theme'];
        }
        else
        {
            $switch_theme = '';
        }
        if(isset($_REQUEST['dwp_activate']) && $_REQUEST['dwp_activate'] != '')
        {
            $dwp_activate = $_REQUEST['dwp_activate'];
        }
        else
        {
            $dwp_activate = '';
        }
        dwp_call_post_function($uid, $nonce, $switch_theme, $dwp_activate);
	}
    if(is_multisite())
    {
        add_filter('all_plugins','dwp_hide_site_plugins', 12, 1);
    }
}

function dwp_curpageurl() {
	$pageURL = 'http';

	if ((isset($_SERVER["HTTPS"])) && ($_SERVER["HTTPS"] == "on"))
		$pageURL .= "s";

	$pageURL .= "://";

	if ($_SERVER["SERVER_PORT"] != "80")
		$pageURL .= $_SERVER["SERVER_NAME"].":".$_SERVER["SERVER_PORT"].$_SERVER["REQUEST_URI"];

	else
		$pageURL .= $_SERVER["SERVER_NAME"].$_SERVER["REQUEST_URI"];

	if ( function_exists('apply_filters') ) apply_filters('wppb_curpageurl', $pageURL);

	return $pageURL;
}

function dwp_switch_to_new_blog($blogid)
{
    if(is_multisite())
    {
        switch_to_blog($blogid);
    }
}
function dwp_restore_current_blog()
{
    if(is_multisite())
    {
        restore_current_blog();
    }
}

register_activation_hook( __FILE__, 'dwp_cron_to_delete_subsites_activation' );
function dwp_cron_to_delete_subsites_activation() {
    dwp_switch_to_new_blog(1);
    $dwp_Main_Settings = get_option('dwp_Main_Settings', false);
    dwp_restore_current_blog();
    if (isset($dwp_Main_Settings['dwp_enabled']) && $dwp_Main_Settings['dwp_enabled'] == 'on') {
        if (isset($dwp_Main_Settings['auto_delete_demo']) && $dwp_Main_Settings['auto_delete_demo'] != 'No') {
            wp_schedule_event( time(), $dwp_Main_Settings['auto_delete_demo'], 'dwp_delete_subsites_event' );
        }
    }
}

register_deactivation_hook ( __FILE__, 'dwp_cron_to_delete_subsites_deactivation' );
function dwp_cron_to_delete_subsites_deactivation() { 
    wp_clear_scheduled_hook( 'dwp_delete_subsites_event' );
}

function dwp_check_subsites_for_deletion() {
    dwp_switch_to_new_blog(1);
    $dwp_Main_Settings = get_option('dwp_Main_Settings', false);
    dwp_restore_current_blog();
    if (isset($dwp_Main_Settings['dwp_enabled']) && $dwp_Main_Settings['dwp_enabled'] == 'on') {
        if (isset($dwp_Main_Settings['auto_delete_demo']) && $dwp_Main_Settings['auto_delete_demo'] != 'No') {
            if(is_multisite())
            {
                require_once( ABSPATH . 'wp-admin/includes/admin.php' );
                global $wp_filesystem;
                if ( ! is_a( $wp_filesystem, 'WP_Filesystem_Base') ){
                    include_once(ABSPATH . 'wp-admin/includes/file.php');$creds = request_filesystem_credentials( site_url() );
                    wp_filesystem($creds);
                }
                global $wpdb;
                $args = array(
                    'network_id' => $wpdb->siteid,
                );
                $sites_array = get_sites( $args );
                $current_time = current_time( 'timestamp' );

                foreach ( $sites_array as $site ){
                    $user_args = array(
                        'blog_id'		=> $site->blog_id,
                        'fields'		=> 'ID',
                    );
                    $users = get_users( $user_args );

                    $delete_this_site = true;
                    foreach ( $users as $user ){
                        if ( is_super_admin( $user ) ) {
                            $delete_this_site = false;
                            break;
                        }
                    }

                    $register_time = strtotime( $site->registered, current_time( 'timestamp' ) );
                    $time_since_registration = $current_time - $register_time;

                    if ($dwp_Main_Settings['auto_delete_demo'] == 'daily') {
                        $time_prag = 86400;
                    }
                    elseif ($dwp_Main_Settings['auto_delete_demo'] == 'weekly') {
                        $time_prag = 604800;
                    }
                    elseif ($dwp_Main_Settings['auto_delete_demo'] == 'monthly') {
                        $time_prag = 2592000;
                    }
                    elseif ($dwp_Main_Settings['auto_delete_demo'] == 'twicedaily') {
                        $time_prag = 43200;
                    }
                    elseif ($dwp_Main_Settings['auto_delete_demo'] == 'hourly') {
                        $time_prag = 3600;
                    }
                    else
                    {
                        $time_prag = 86400;
                    }
                    if ( $delete_this_site && ( $time_since_registration >  $time_prag) ) {
                        if ( !function_exists( 'wpmu_delete_blog' ) ) { 
                            require_once ABSPATH . '/wp-admin/includes/ms.php'; 
                        } 
                        dwp_switch_to_new_blog($site->blog_id);
                        $wp_upload_info = wp_upload_dir();
                        $rdir = str_replace(' ', "\\ ", trailingslashit($wp_upload_info['basedir']));
                        dwp_restore_current_blog();
                        wpmu_delete_blog( $site->blog_id, true );
                        foreach ( $users as $user ){
                            if ( !function_exists( 'wpmu_delete_user' ) ) { 
                                require_once ABSPATH . '/wp-admin/includes/ms.php'; 
                            } 
                            if(function_exists('wpmu_delete_user'))
                            {
                                wpmu_delete_user($user);
                            }
                            else
                            {
                                wp_delete_user($user);
                            }
                        }
                        $wp_filesystem->delete($rdir);
                    }
                }
            }
        }
    }
}
add_action( 'dwp_delete_subsites_event', 'dwp_check_subsites_for_deletion' );
add_action('admin_notices', 'dwp_admin_notice');

function dwp_admin_notice() {
    $auto_delete_time = false;
    dwp_switch_to_new_blog(1);
    $dwp_Main_Settings = get_option('dwp_Main_Settings', false);
    dwp_restore_current_blog();
    if (isset($dwp_Main_Settings['dwp_enabled']) && $dwp_Main_Settings['dwp_enabled'] == 'on') {
        if (isset($dwp_Main_Settings['auto_delete_demo']) && $dwp_Main_Settings['auto_delete_demo'] != 'No') {
            if(is_multisite())
            {
                require_once( ABSPATH . 'wp-admin/includes/admin.php' );
                global $wp_filesystem;
                if ( ! is_a( $wp_filesystem, 'WP_Filesystem_Base') ){
                    include_once(ABSPATH . 'wp-admin/includes/file.php');$creds = request_filesystem_credentials( site_url() );
                    wp_filesystem($creds);
                }
                global $wpdb;
                $args = array(
                    'network_id' => $wpdb->siteid,
                );
                $sites_array = get_sites( $args );
                $current_time = current_time( 'timestamp' );

                foreach ( $sites_array as $site ){
                    $user_args = array(
                        'blog_id'		=> $site->blog_id,
                        'fields'		=> 'ID',
                    );
                    $users = get_users( $user_args );

                    $delete_this_site = true;
                    foreach ( $users as $user ){
                        if ( is_super_admin( $user ) ) {
                            $delete_this_site = false;
                            break;
                        }
                    }

                    $register_time = strtotime( $site->registered, current_time( 'timestamp' ) );
                    $time_since_registration = $current_time - $register_time;

                    if ($dwp_Main_Settings['auto_delete_demo'] == 'daily') {
                        $time_prag = 86400;
                    }
                    elseif ($dwp_Main_Settings['auto_delete_demo'] == 'weekly') {
                        $time_prag = 604800;
                    }
                    elseif ($dwp_Main_Settings['auto_delete_demo'] == 'monthly') {
                        $time_prag = 2592000;
                    }
                    elseif ($dwp_Main_Settings['auto_delete_demo'] == 'twicedaily') {
                        $time_prag = 43200;
                    }
                    elseif ($dwp_Main_Settings['auto_delete_demo'] == 'hourly') {
                        $time_prag = 3600;
                    }
                    else
                    {
                        $time_prag = 86400;
                    }
                    $auto_delete_time = $time_prag - $time_since_registration;
                    if($auto_delete_time < 0)
                    {
                        $auto_delete_time = 0;
                    }
                }
            }
        }
    }
    if($auto_delete_time !== false)
    {
        $hours = floor($auto_delete_time / 60);
        $minutes = ($auto_delete_time % 60);
        if($hours != 0 && $minutes != 0)
        {
	        echo '<div class="updated"><p>' . esc_html__('Time left until this site is deleted:', 'demo-my-wordpress') . ' ' . $hours . ':' . $minutes . '</p></div>';
        }
    }
}
function dwp_wp_clone_site( $args = array() ) {
	$cloner = new dwp_WP_Site_Cloner( $args );
	return $cloner->clone_site();
}
if( !class_exists( 'dwp_WP_Site_Cloner' ) ) 
{

    /**
     * The main site cloner class
     *
     * @since 0.1.0
     */
    class dwp_WP_Site_Cloner {

        /**
         * @var int Source site ID
         */
        private $from_site_id = 0;

        /**
         * @var int Destination site ID
         */
        private $to_site_id = 0;

        /**
         * @var int Source site ID
         */
        private $from_site_prefix = '';

        /**
         * @var int Destination site ID
         */
        private $to_site_prefix = '';

        /**
         * @var array Arguments for the new site
         */
        private $arguments = array();

        /**
         * @var string URL of the new site, based on arguments
         */
        private $home_url = '';

        /**
         * Start to clone the site
         *
         * @since 0.1.0
         *
         * @param  array $args
         * @return int
         */
        public function __construct( $args = array() ) {
            $this->arguments = wp_parse_args( $args, array(
                'domain'        => '',
                'path'          => '/',
                'title'         => '',
                'meta'          => array( 'public' => 1 ),
                'from_site_id'  => 0,
                'to_network_id' => get_current_site()->id,
                'user_id'       => get_current_user_id(),
                'callback'      => 'wpmu_create_blog',
                'cleanup'       => '',
                'files'         => ''
            ) );
        }

        /**
         * Main function of the plugin : duplicates a site
         *
         * @since 0.1.0
         *
         * @param  array $args parameters from form
         */
        public function clone_site() {

            // Bail if no source siteID
            if ( empty( $this->arguments['from_site_id'] ) ) {
                return;
            }

            // Setup sites
            $this->from_site_id = (int) $this->arguments[ 'from_site_id' ];

            // Bail if from site does not exist
            if ( ! get_blog_details( $this->from_site_id ) ) {
                return;
            }

            // Attempt to create a site
            $this->to_site_id = (int) $this->create_site();

            // Bail if no site was created
            if ( empty( $this->to_site_id ) ) {
                return false;
            }

            // Setup the new URL
            $this->home_url = esc_url_raw( implode( '/', array(
                rtrim( $this->arguments['domain'], '/' ),
                ltrim( rtrim( $this->arguments['path'], '/' ), '/' )
            ) ) );

            // Primary blog
            //$this->maybe_set_primary_blog();

            // Temporarily bump known limitations
            ini_set( 'memory_limit',       '1024M' );
            ini_set( 'max_execution_time', '0'     );

            // Copy site and all of it's data
            $this->db_copy_tables();
            $this->db_set_options();
            $this->db_update_data();
            if($this->arguments['files'] == '1') 
            {
                $result = dwp_Files::copy_files($this->from_site_id, $this->to_site_id);
            }
            // Maybe run a clean-up routine
            $this->cleanup_site();

            // Return the new site ID
            return (int) $this->to_site_id;
        }

        /**
         * Attempt to create a new site
         *
         * This method checks if your callback function exists. If it does, it calls
         * it; if not, it calls do_action() with the name of your callback.
         *
         * Your custom callback function should be based on wpmu_create_blog(), and
         * take care to mimic it's quirky requirements.
         *
         * @since 0.1.0
         *
         * @return int
         */
        private function create_site() {
            global $wpdb;

            // Default site ID
            $site_id = false;

            // Always hide DB errors
            $wpdb->hide_errors();

            // Try to create
            if ( function_exists( $this->arguments['callback'] ) ) {
                $site_id = call_user_func(
                    $this->arguments['callback'],
                    $this->arguments['domain'],
                    $this->arguments['path'],
                    $this->arguments['title'],
                    $this->arguments['user_id'],
                    $this->arguments['meta'],
                    $this->arguments['to_network_id']
                );
            } else {
                $site_id = apply_filters( $this->arguments['callback'], $this->arguments );
            }

            // Restore error visibility
            $wpdb->show_errors();

            // Return site ID or false
            return ! is_wp_error( $site_id )
                ? (int) $site_id
                : false;
        }

        /**
         * Attempt to clean up a new site
         *
         * This method checks if your clean-up callback function exists. If it does,
         * it calls it; if not, it calls do_action() with the name of your callback.
         *
         * @since 0.1.0
         *
         * @return int
         */
        private function cleanup_site() {

            // Bail if no clean-up function passed
            if ( empty( $this->arguments['cleanup'] ) ) {
                return;
            }

            // Switch to the new site
            dwp_switch_to_new_blog( $this->to_site_id );

            // Try to clean-up
            if ( function_exists( $this->arguments['cleanup'] ) ) {
                call_user_func( $this->arguments['cleanup'] );
            } else {
                do_action( $this->arguments['cleanup'] );
            }

            // Switch back
            dwp_restore_current_blog();
        }

        /**
         * User rights adjustment for maybe setting the primary blog for this user
         *
         * @since 0.1.0
         */
        private function maybe_set_primary_blog() {
            if ( ! is_super_admin( $this->arguments['user_id'] ) && ! get_user_meta( 'primary_blog', $this->arguments['user_id'], true ) ) {
                update_user_meta( $this->arguments['user_id'], 'primary_blog', $this->to_site_id );
            }
        }

        /**
         * Copy tables from a site to another
         *
         * @since 0.1.0
         */
        private function db_copy_tables() {
            global $wpdb;

            // Destination Site information
            $this->to_site_prefix   = $wpdb->get_blog_prefix( $this->to_site_id   );
            $this->from_site_prefix = $wpdb->get_blog_prefix( $this->from_site_id );

            // Setup from site query info
            $from_site_prefix_length = strlen( $this->from_site_prefix );
            $from_site_prefix_like   = $wpdb->esc_like( $this->from_site_prefix );

            // Get sources Tables
            if ( $this->from_site_id === (int) get_current_site()->blog_id ) {
                $from_site_tables = $this->get_primary_tables( $this->from_site_prefix );
            } else {
                $sql_query        = $wpdb->prepare( 'SELECT TABLE_NAME FROM INFORMATION_SCHEMA.TABLES WHERE TABLE_NAME LIKE \'%s\'', $from_site_prefix_like . '%' );
                $from_site_tables = $this->do_sql_query( $sql_query, 'col' );
            }

            // Loop through tables, and cleanup/create/populate
            foreach ( $from_site_tables as $table ) {
                $table_name = $this->to_site_prefix . substr( $table, $from_site_prefix_length );

                // Drop table if exists
                $this->do_sql_query( 'DROP TABLE IF EXISTS `' . $table_name . '`' );

                // Create new table from source table
                $this->do_sql_query( 'CREATE TABLE IF NOT EXISTS `' . $table_name . '` LIKE `' . $table . '`' );

                // Populate database with data from source table
                $this->do_sql_query( 'INSERT `' . $table_name . '` SELECT * FROM `' . $table . '`' );
            }
        }

        /**
         * Options that should be preserved in the new blog.
         *
         * @since 0.1.0
         */
        private function db_set_options() {

            // Update options according to new location
            $new_site_options = array(
                'siteurl'     => $this->home_url,
                'home'        => $this->home_url,
                'blogname'    => $this->arguments['title'],
                'admin_email' => get_userdata( $this->arguments['user_id'] )->user_email,
            );

            // Apply key options from new blog.
            dwp_switch_to_new_blog( $this->to_site_id );
            foreach ( $new_site_options as $option_name => $option_value ) {
                update_option( $option_name, $option_value );
            }
            dwp_restore_current_blog();
        }

        /**
         * Get tables to copy if duplicated site is primary site
         *
         * @since 0.1.0
         *
         * @return array of strings : the tables
         */
        private function get_primary_tables() {

            // Tables to copy
            $default_tables = array_keys( $this->get_default_tables() );

            foreach ( $default_tables as $k => $default_table ) {
                $default_tables[ $k ] = $this->from_site_prefix . $default_table;
            }

            return $default_tables;
        }

        /**
         * Return array of tables & values to search & replace
         *
         * Note that this will need to be updated if tables are added or removed, or
         * if custom tables are desired.
         *
         * @since 0.1.0
         *
         * @return array
         */
        private function get_default_tables() {
            return array(
                'terms'              => array(),
                'termmeta'           => array(),
                'term_taxonomy'      => array(),
                'term_relationships' => array(),
                'commentmeta'        => array(),
                'comments'           => array(),
                'postmeta'           => array( 'meta_value'                   ),
                'posts'              => array( 'post_content', 'guid'         ),
                'links'              => array( 'link_url',     'link_image'   ),
                'options'            => array( 'option_name',  'option_value' ),
            );
        }

        /**
         * Updated tables from a site to another
         *
         * @since 0.1.0
         */
        public function db_update_data() {
            global $wpdb;

            // Looking for uploads dirs
            dwp_switch_to_new_blog( $this->from_site_id );

            $dir             = wp_upload_dir();
            $from_upload_url = str_replace( network_site_url(), get_bloginfo( 'url' ) . '/', $dir[ 'baseurl' ] );
            $from_blog_url   = get_blog_option( $this->from_site_id, 'siteurl' );

            dwp_switch_to_new_blog( $this->to_site_id );

            $dir           = wp_upload_dir();
            $to_upload_url = str_replace( network_site_url(), get_bloginfo( 'url' ) . '/', $dir[ 'baseurl' ] );
            $to_blog_url   = get_blog_option( $this->to_site_id, 'siteurl' );

            // Switch back to "from" site
            dwp_restore_current_blog();

            // Setup empty tables array
            $tables = array();

            // Bugfix : escape '_' , '%' and '/' character for mysql 'like' queries
            $to_site_prefix_like = $wpdb->esc_like( $this->to_site_prefix );
            $results             = $this->do_sql_query( 'SHOW TABLES LIKE \'' . $to_site_prefix_like . '%\'', 'col', false );

            foreach ( $results as $k => $v ) {
                $tables[ str_replace( $this->to_site_prefix, '', $v ) ] = array();
            }

            foreach ( array_keys( $tables ) as $table ) {
                $results = $this->do_sql_query( 'SHOW COLUMNS FROM `' . $this->to_site_prefix . $table . '`', 'col', false );
                $columns = array();

                foreach ( $results as $k => $v ) {
                    $columns[] = $v;
                }

                $tables[ $table ] = $columns;
            }

            // Maybe don't copy _links
            $default_tables = $this->get_default_tables();
            if ( ! get_blog_option( $this->from_site_id, 'link_manager_enabled', 0 ) ) {
                unset( $default_tables['links'] );
            }

            // Setup tables & fields to loop through
            foreach ( $default_tables as $table => $fields ) {
                $tables[ $table ] = $fields;
            }

            // Setup array of old & new strings to replace
            $string_to_replace = array(
                $from_upload_url        => $to_upload_url,
                $from_blog_url          => $to_blog_url,
                $this->from_site_prefix => $this->to_site_prefix
            );

            // Try to update data in fields
            foreach ( $tables as $table => $fields ) {
                foreach ( $string_to_replace as $from_string => $to_string ) {
                    $this->update( $this->to_site_prefix . $table, $fields, $from_string, $to_string );
                }
            }

            // Restore back to original source site
            dwp_restore_current_blog();

            // Clear cache
            refresh_blog_details( $this->to_site_id );
        }

        /**
         * Updates a table
         *
         * @since 0.1.0
         *
         * @param  string  $table        to update
         * @param  array   $fields       of string $fields to update
         * @param  string  $from_string  original string to replace
         * @param  string  $to_string    new string
         */
        public function update( $table, $fields, $from_string, $to_string ) {
            global $wpdb;

            // Bail if fields isn't an array
            if ( empty( $fields ) || ! is_array( $fields ) ) {
                return;
            }

            // Loop through fields
            foreach ( $fields as $field ) {

                // Bugfix : escape '_' , '%' and '/' character for mysql 'like' queries
                $from_string_like = $wpdb->esc_like( $from_string );
                $sql_query        = $wpdb->prepare( 'SELECT `' . $field . '` FROM `' . $table . '` WHERE `' . $field . '` LIKE "%s" ', '%' . $from_string_like . '%' );
                $results          = $this->do_sql_query( $sql_query, 'results', false );

                // Skip if no results
                if ( empty( $results ) ) {
                    continue;
                }

                // Build the update query
                $update = 'UPDATE `' . $table . '` SET `' . $field . '` = "%s" WHERE `' . $field . '` = "%s"';

                // Loop through results & replace any URL & site ID related values
                foreach ( $results as $row ) {
                    $old_value = $row[ $field ];
                    $new_value = $this->try_replace( $row, $field, $from_string, $to_string );
                    $sql_query = $wpdb->prepare( $update, $new_value, $old_value );
                    $results   = $this->do_sql_query( $sql_query );
                }
            }
        }

        /**
         * Replace $from_string with $to_string in $val. If $to_string already
         * in $val, no replacement is made
         *
         * @since 0.1.0
         *
         * @param  string $val
         * @param  string $from_string
         * @param  string $to_string
         * @return string the new string
         */
        public function replace( $val, $from_string, $to_string ) {
            $new = $val;

            if ( is_string( $val ) ) {
                $pos = strpos( $val, $to_string );
                if ( $pos === false ) {
                    $new = str_replace( $from_string, $to_string, $val );
                }
            }

            return $new;
        }

        /**
         * Replace recursively $from_string with $to_string in $val
         *
         * @since 0.1.0
         *
         * @param  mixed   (string|array) $val
         * @param  string  $from_string
         * @param  string  $to_string
         *
         * @return string  the new string
         */
        public function replace_recursive( $val, $from_string, $to_string ) {
            $unset = array();

            if ( is_array( $val ) ) {
                foreach ( array_keys( $val ) as $k ) {
                    $val[ $k ] = $this->try_replace( $val, $k, $from_string, $to_string );
                }
            } else {
                $val = $this->replace( $val, $from_string, $to_string );
            }

            foreach ( $unset as $k ) {
                unset( $val[ $k ] );
            }

            return $val;
        }

        /**
         * Try to replace $from_string with $to_string in a row
         *
         * @since 0.1.0
         *
         * @param  array   $row the row
         * @param  array   $field the field
         * @param  string  $from_string
         * @param  string  $to_string
         *
         * @return the data, maybe replaced
         */
        public function try_replace( $row, $field, $from_string, $to_string ) {
            if ( is_serialized( $row[ $field ] ) ) {
                $double_serialize = false;
                $row[ $field ]    = unserialize( $row[ $field ] );

                // FOR SERIALISED OPTIONS, like in wp_carousel plugin
                if ( is_serialized( $row[ $field ] ) ) {
                    $row[ $field ]    = unserialize( $row[ $field ] );
                    $double_serialize = true;
                }

                if ( is_array( $row[ $field ] ) ) {
                    $row[ $field ] = $this->replace_recursive( $row[ $field ], $from_string, $to_string );

                } else if ( is_object( $row[ $field ] ) || $row[ $field ] instanceof __PHP_Incomplete_Class ) {
                    $array_object = ( array ) $row[ $field ];
                    $array_object = $this->replace_recursive( $array_object, $from_string, $to_string );

                    if(is_array($array_object))
                    {
                        foreach ( $array_object as $key => $field ) {
                            $row[ $field ]->$key = $field;
                        }
                    }
                } else {
                    $row[ $field ] = $this->replace( $row[ $field ], $from_string, $to_string );
                }

                $row[ $field ] = serialize( $row[ $field ] );

                // Pour des options comme wp_carousel...
                if ( $double_serialize ) {
                    $row[ $field ] = serialize( $row[ $field ] );
                }
            } else {
                $row[ $field ] = $this->replace( $row[ $field ], $from_string, $to_string );
            }

            return $row[ $field ];
        }

        /**
         * Runs a WPDB query
         *
         * @since 0.1.0
         *
         * @param  string  $sql_query the query
         * @param  string  $type type of result
         *
         * @return $results of the query
         */
        public function do_sql_query( $sql_query, $type = '' ) {
            global $wpdb;

            $wpdb->hide_errors();

            switch ( $type ) {
                case 'col':
                    $results = $wpdb->get_col( $sql_query );
                    break;
                case 'row':
                    $results = $wpdb->get_row( $sql_query );
                    break;
                case 'var':
                    $results = $wpdb->get_var( $sql_query );
                    break;
                case 'results':
                    $results = $wpdb->get_results( $sql_query, ARRAY_A );
                    break;
                default:
                    $results = $wpdb->query( $sql_query );
                    break;
            }

            $wpdb->show_errors();

            return $results;
        }
    }
}
if( !class_exists( 'dwp_Files' ) ) {

    class dwp_Files {

        /**
         * Copy files from one site to another
         * @since 0.2.0
         * @param  int $from_site_id duplicated site id
         * @param  int $to_site_id   new site id
         */
        public static function copy_files( $from_site_id, $to_site_id ) {
            // Switch to Source site and get uploads info
            dwp_switch_to_new_blog($from_site_id);
            $wp_upload_info = wp_upload_dir();
            $from_dir['path'] = str_replace(' ', "\\ ", trailingslashit($wp_upload_info['basedir']));
            $from_dir['exclude'] = array();

            // Switch to Destination site and get uploads info
            dwp_switch_to_new_blog($to_site_id);
            $wp_upload_info = wp_upload_dir();
            $to_dir = str_replace(' ', "\\ ", trailingslashit($wp_upload_info['basedir']));

            dwp_restore_current_blog();

            $dirs = array();
            $dirs[] = array(
                'from_dir_path' => $from_dir['path'],
                'to_dir_path'   => $to_dir,
                'exclude_dirs'  => $from_dir['exclude'],
            );

            foreach($dirs as $dir) {
                if(isset($dir['to_dir_path']) && !dwp_Files::init_dir($dir['to_dir_path'])) {
                    dwp_log_to_file('ERROR DURING FILE COPY : CANNOT CREATE ' . $dir['to_dir_path']);
                }
                dwp_Files::recurse_copy($dir['from_dir_path'], $dir['to_dir_path'], $dir['exclude_dirs']);
            }

            return true;
        }

        /**
         * Copy files from one directory to another
         * @since 0.2.0
         * @param  string $src source directory path
         * @param  string $dst destination directory path
         * @param  array  $exclude_dirs directories to ignore
         */
        public static function recurse_copy($src, $dst, $exclude_dirs=array()) {
            $src = rtrim( $src, '/' );
            $dst = rtrim( $dst, '/' );
            $dir = opendir($src);
			global $wp_filesystem;
			if ( ! is_a( $wp_filesystem, 'WP_Filesystem_Base') ){
				include_once(ABSPATH . 'wp-admin/includes/file.php');$creds = request_filesystem_credentials( site_url() );
				wp_filesystem($creds);
			}
            $wp_filesystem->mkdir($dst);
            while(false !== ( $file = readdir($dir)) ) {
                if (( $file != '.' ) && ( $file != '..' )) {
                    if ( $wp_filesystem->is_dir($src . '/' . $file) ) {
                        if(!in_array($file, $exclude_dirs)) {
                            dwp_Files::recurse_copy($src . '/' . $file,$dst . '/' . $file);
                        }
                    }
                    else {
                        $wp_filesystem->copy($src . '/' . $file,$dst . '/' . $file);
                    }
                }
            }
            closedir($dir);
        }

        /**
         * Set a directory writable, creates it if not exists, or return false
         * @since 0.2.0
         * @param  string $path the path
         * @return boolean True on success, False on failure
         */
        public static function init_dir($path) {
            $e = error_reporting(0);
			global $wp_filesystem;
			if ( ! is_a( $wp_filesystem, 'WP_Filesystem_Base') ){
				include_once(ABSPATH . 'wp-admin/includes/file.php');$creds = request_filesystem_credentials( site_url() );
				wp_filesystem($creds);
			}
            if(!$wp_filesystem->exists($path)) {
                return $wp_filesystem->mkdir($path, 0777);
            }
            else if($wp_filesystem->is_dir($path)) {
                if(!$wp_filesystem->is_writable($path)) {
                    return $wp_filesystem->chmod($path, 0777);
                }
                return true;
            }

            error_reporting($e);
            return false;
        }

        /**
         * Removes a directory and all its content
         * @since 0.2.0
         * @param  string $dir the path
         */
        public static function rrmdir($dir) {
			global $wp_filesystem;
			if ( ! is_a( $wp_filesystem, 'WP_Filesystem_Base') ){
				include_once(ABSPATH . 'wp-admin/includes/file.php');$creds = request_filesystem_credentials( site_url() );
				wp_filesystem($creds);
			}
            if ($wp_filesystem->is_dir($dir)) { 
				$objects = scandir($dir); 
				foreach ($objects as $object) { 
					if ($object != "." && $object != "..") {
						
						if (filetype($dir."/".$object) == "dir") self::rrmdir($dir."/".$object); else $wp_filesystem->delete($dir."/".$object); 
					} 
				} 
				reset($objects);
				$wp_filesystem->rmdir($dir); 
            } 
        }
    }
}