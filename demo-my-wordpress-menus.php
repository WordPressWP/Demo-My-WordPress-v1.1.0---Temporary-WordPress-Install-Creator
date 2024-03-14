<?php
class DWP_Menus {

	function __construct() {
        if(is_multisite())
        {
            add_filter( 'mu_menu_items', array($this, 'dwp_mu_menu_options' ));
            add_action( 'wpmu_options', array($this, 'dwp_menu_option'), -99 );
            add_action( 'admin_menu', array($this, 'dwp_menu_disable'), 99 ); 
            add_action( 'jetpack_admin_menu', array($this, 'dwp_jetpack_admin_menu_disable'), 99 );
            add_action( 'admin_menu', array($this, 'dwp_menu_plugins_disable'), 999 ); 
            add_filter( 'admin_bar_menu', array($this, 'dwp_reduce_favorite_actions'), 999 );
            add_action( 'admin_page_access_denied',  array($this, 'dwp_access_denied_splash'), 99 );
            $menu_perms = get_site_option( "menu_items" );
            if( !isset($menu_perms[ 'app_cus' ]) ) {
                add_action( 'admin_init', array($this, 'dwp_customize'), 10 );
                add_filter( 'init', array($this,'dwp_removecustmizer_metacap'), 10 );
            }
        }

	}

	function dwp_customize() {
		$menu_perms = get_site_option( "menu_items" );
		if( !isset($menu_perms[ 'super_admin' ] ) && is_super_admin()) 
			return;
		remove_action( 'plugins_loaded', '_wp_customize_include', 10);
		remove_action( 'admin_enqueue_scripts', '_wp_customize_loader_settings', 11);
		add_action( 'load-customize.php', array($this, 'dwp_override_load_customizer_action') );
	}
	
	function dwp_override_load_customizer_action() {
		wp_die( esc_html__( 'The Customizer is currently disabled.', 'demo-my-wordpress' ) );
	}
	
	function dwp_removecustmizer_metacap() {
		$menu_perms = get_site_option( "menu_items" );
		if( !isset($menu_perms[ 'super_admin' ] ) && is_super_admin()) 
			return;
		add_filter( 'map_meta_cap', array($this,'dwp_removecustmizer_metacap_filter'), 10, 4 );
	}	
	
	function dwp_removecustmizer_metacap_filter( $caps = array(), $cap = '', $user_id = 0, $args = array() ) {
        if ($cap == 'customize' ) {
            return array( 'nope' );
        }
        return $caps;
	}

	function dwp_access_denied_splash() {
	
			$user_id = get_current_user_id();
			$redirect = get_dashboard_url( $user_id );
            if(!function_exists('wp_redirect'))
            {
                include_once( ABSPATH . 'wp-includes/pluggable.php' );
            }
			wp_redirect( $redirect );
			exit;	
	}

	function dwp_menu_plugins_disable() {
		global $submenu, $menu;
		$menu_perms = get_site_option( "menu_items" );
		if( is_array( $menu_perms ) == false )
		$menu_perms = array();

			if( !isset($menu_perms[ 'super_admin' ] ) && is_super_admin()) 
			return;
	}

	function dwp_jetpack_admin_menu_disable() {
		global $submenu, $menu;
		$menu_perms = get_site_option( "menu_items" );
		if( is_array( $menu_perms ) == false )
		$menu_perms = array();

			$user_id = get_current_user_id();
			$redirect = get_dashboard_url( $user_id );
		
			if( !isset($menu_perms[ 'super_admin' ] ) && is_super_admin()) 
			return;
			

	if( !isset($menu_perms[ 'menu_jetpack' ]) && current_user_can('manage_options')) {
        remove_menu_page( 'jetpack' );
		if( strpos($_SERVER['REQUEST_URI'], 'jetpack'))		
        { 
            if(!function_exists('wp_redirect'))
            {
                include_once( ABSPATH . 'wp-includes/pluggable.php' );
            }
            wp_redirect( $redirect ); exit(); 
        }
	}

	if( !isset($menu_perms[ 'jetpack_jetpack' ]) && current_user_can('jetpack_manage_modules')) {
        remove_submenu_page( 'jetpack', 'jetpack' );
		if( strpos($_SERVER['REQUEST_URI'], 'jetpack'))		
        { 
            if(!function_exists('wp_redirect'))
            {
                include_once( ABSPATH . 'wp-includes/pluggable.php' );
            }
            wp_redirect( $redirect ); exit(); 
        }
	}


	if( !isset($menu_perms[ 'jetpack_modules' ]) && current_user_can('manage_options')) {
        remove_submenu_page( 'jetpack', 'jetpack_modules' );
		if( strpos($_SERVER['REQUEST_URI'], 'jetpack_modules'))		
		{ 
            if(!function_exists('wp_redirect'))
            {
                include_once( ABSPATH . 'wp-includes/pluggable.php' );
            }
            wp_redirect( $redirect ); exit();
        }
	}


	if( !isset($menu_perms[ 'jetpack_akismet_key_config' ]) && current_user_can('manage_options')) {
        remove_submenu_page( 'jetpack', 'akismet-key-config' );
		if( strpos($_SERVER['REQUEST_URI'], 'akismet-key-config'))		
		{ 
            if(!function_exists('wp_redirect'))
            {
                include_once( ABSPATH . 'wp-includes/pluggable.php' );
            }
            wp_redirect( $redirect ); exit(); 
        }
	}

	if( !isset($menu_perms[ 'jetpack_akismet_stats_display' ]) && current_user_can('manage_options')) {
        remove_submenu_page( 'jetpack', 'akismet-stats-display' );
		if( strpos($_SERVER['REQUEST_URI'], 'akismet-stats-display'))		
		{ 
            if(!function_exists('wp_redirect'))
            {
                include_once( ABSPATH . 'wp-includes/pluggable.php' );
            }
            wp_redirect( $redirect ); exit(); 
        }
	}

	}

	function dwp_reduce_favorite_actions ($wp_toolbar) {
		$menu_perms = get_site_option( "menu_items" );

		if( !isset( $menu_perms[ 'super_admin' ] ) && is_super_admin()) 
		return $wp_toolbar;
		
		if( !isset( $menu_perms[ 'posts_new' ] ) && current_user_can('edit_posts') ) {
			$wp_toolbar->remove_node( 'new-post' );
		}
		if( !isset( $menu_perms[ 'media_new' ] ) && current_user_can('upload_files')) {
			$wp_toolbar->remove_node( 'new-media' );
		}
		if( !isset( $menu_perms[ 'links_new' ] ) && current_user_can('manage_links')) {
			$wp_toolbar->remove_node( 'new-link' );
		}
		if( !isset( $menu_perms[ 'pages_new' ] ) && current_user_can('edit_pages')) {
			$wp_toolbar->remove_node( 'new-page' );
		}
		if( !isset( $menu_perms[ 'users_new' ] ) && current_user_can('create_users')) {
			$wp_toolbar->remove_node( 'new-user' );
		}
		if( !isset( $menu_perms[ 'menu_comments' ] ) && current_user_can('edit_posts')) {
			$wp_toolbar->remove_node( 'comments' );
		}
		if( !isset( $menu_perms[ 'menu_content' ] ) && current_user_can('edit_posts')) {
			$wp_toolbar->remove_node( 'new-content' );
		}
		if( !isset( $menu_perms[ 'dash_mysites' ] ) && current_user_can('read')) {
			$wp_toolbar->remove_node( 'my-sites' );
		}
		if( !isset($menu_perms[ 'user_profile' ]) && current_user_can('read')) {
			$wp_toolbar->remove_node( 'edit-profile' );
			$wp_toolbar->remove_node( 'user-info' );
			$wp_toolbar->remove_node( 'my-account' );
		}
		if( !isset( $menu_perms[ 'menu_dashboard' ] ) && current_user_can('read') ) {
			$wp_toolbar->remove_node( 'dashboard' );
			$wp_toolbar->remove_node( 'site-name' );
		}
		if( !isset( $menu_perms[ 'app_themes' ] ) && current_user_can('switch_themes') ) {
			$wp_toolbar->remove_node( 'themes' );
		}
		if( !isset( $menu_perms[ 'app_cus' ] ) && current_user_can('edit_theme_options') ) {
			$wp_toolbar->remove_node( 'customize' );
		}
		if( !isset( $menu_perms[ 'app_widgets' ] ) && current_user_can('edit_theme_options') ) {
			$wp_toolbar->remove_node( 'widgets' );
		}
		if( !isset( $menu_perms[ 'app_men' ] ) && current_user_can('edit_theme_options') ) {
			$wp_toolbar->remove_node( 'menus' );
		}
		if( !isset( $menu_perms[ 'app_head' ] ) && current_user_can('edit_theme_options') ) {
			$wp_toolbar->remove_node( 'header' );
		}
	}
	function dwp_menu_disable() {
        if(!function_exists('wp_redirect'))
        {
            include_once( ABSPATH . 'wp-includes/pluggable.php' );
         }
		global $submenu, $menu;
		$menu_perms = get_site_option( "menu_items" );
		if( is_array( $menu_perms ) == false )
            $menu_perms = array();
		if( !isset($menu_perms[ 'super_admin' ] ) && is_super_admin()) 
			return;

		$user_id = get_current_user_id();
		$redirect = get_dashboard_url( $user_id );

		if( !isset($menu_perms[ 'menu_dashboard' ]) && current_user_can('read')) {
            if(!empty($menu)) {
                foreach($menu as $key => $sm) {
                if(esc_html__($sm[0], 'demo-my-wordpress') == esc_html__('Dashboard', 'demo-my-wordpress') || $sm[2] == "index.php") {
                    unset($menu[$key]);
                    unset( $submenu[ 'index.php' ] );
                    break; 
                    }
                }
            }
        }

	if( !isset($menu_perms[ 'dash_mysites' ]) && current_user_can('read')) {
		if(!empty($submenu['index.php'])) {
		foreach($submenu['index.php'] as $key => $sm) {
			if(esc_html__($sm[0], 'demo-my-wordpress') == esc_html__('My Sites', 'demo-my-wordpress') || $sm[2] == "my-sites.php") {
				unset($submenu['index.php'][$key]);
				break;
				}
			}
		}
		if( strpos($_SERVER['REQUEST_URI'], 'my-sites.php'))	
        { 
            wp_redirect( $redirect ); exit(); 
        }

	}

	if( !isset($menu_perms[ 'menu_posts' ]) && current_user_can('edit_posts')) {
        remove_menu_page( 'edit.php' );
	}

	if( !isset($menu_perms[ 'posts_posts' ]) && current_user_can('edit_posts')) {
        remove_submenu_page( 'edit.php', 'edit.php' );
		if( strpos($_SERVER['REQUEST_URI'], 'edit.php') && !strpos($_SERVER['REQUEST_URI'], 'edit.php?post_type=page'))
		{ 
            wp_redirect( $redirect ); exit(); 
        }
	}

	if( !isset($menu_perms[ 'posts_new' ]) && current_user_can('edit_posts') ) {
        remove_submenu_page( 'edit.php', 'post-new.php' );
		if( strpos($_SERVER['REQUEST_URI'], 'post-new.php') && !strpos($_SERVER['REQUEST_URI'], 'post-new.php?post_type=page'))		
		{ 
            wp_redirect( $redirect ); exit(); 
        }
	}	

	if( !isset($menu_perms[ 'posts_tags' ]) && current_user_can('manage_categories')) {
        remove_submenu_page( 'edit.php', 'edit-tags.php?taxonomy=post_tag' );
		if( strpos($_SERVER['REQUEST_URI'], 'edit-tags.php?taxonomy=post_tag'))		
		{ 
            wp_redirect( $redirect ); exit(); 
        }
	}

	if( !isset($menu_perms[ 'posts_cats' ]) && current_user_can('manage_categories') ) {
        remove_submenu_page( 'edit.php', 'edit-tags.php?taxonomy=category' );
		if( strpos($_SERVER['REQUEST_URI'], 'edit-tags.php?taxonomy=category'))  
		{ 
            wp_redirect( $redirect ); exit(); 
        }
	}

	if( !isset($menu_perms[ 'menu_media' ]) && current_user_can('upload_files')) {
        remove_menu_page( 'upload.php' );
	}

	if( !isset($menu_perms[ 'media_lib' ]) && current_user_can('upload_files')) {
        remove_submenu_page( 'upload.php', 'upload.php' );
		if( strpos($_SERVER['REQUEST_URI'], 'upload.php'))	
		wp_die('Sorry, Super Admin has disabled Media Library.'); 
	}

	if( !isset($menu_perms[ 'media_new' ]) && current_user_can('upload_files')) {
        remove_submenu_page( 'upload.php', 'media-new.php' );
		if( strpos($_SERVER['REQUEST_URI'], 'media-new.php') || strpos($_SERVER['REQUEST_URI'], 'media-upload.php'))
			wp_die('Sorry, Network Admin has disabled Media Uploads.');
	}

	if( !isset($menu_perms[ 'menu_links' ]) && current_user_can('manage_links')) {
        remove_menu_page( 'link-manager.php' );
	}

	if( !isset($menu_perms[ 'links_links' ]) && current_user_can('manage_links')) {
        remove_submenu_page( 'link-manager.php', 'link-manager.php' );
		if( strpos($_SERVER['REQUEST_URI'], 'link-manager.php'))		
			{ wp_redirect( $redirect ); exit(); }
	}

	if( !isset($menu_perms[ 'links_new' ]) && current_user_can('manage_links') ) {
        remove_submenu_page( 'link-manager.php', 'link-add.php' );
		if( strpos($_SERVER['REQUEST_URI'], 'link-add.php'))		
			{ wp_redirect( $redirect ); exit(); }
	}

	if( !isset($menu_perms[ 'links_cats' ]) && current_user_can('manage_categories')) {
        remove_submenu_page( 'link-manager.php', 'edit-tags.php?taxonomy=link_category' );
		if( strpos($_SERVER['REQUEST_URI'], 'edit-tags.php?taxonomy=link_category'))		
			{ wp_redirect( $redirect ); exit(); }
	}

	if( !isset($menu_perms[ 'menu_pages' ]) && current_user_can('edit_pages')) {
        remove_menu_page( 'edit.php?post_type=page' );

	}

	if( !isset($menu_perms[ 'pages_pages' ]) && current_user_can('edit_pages')) {
        remove_submenu_page( 'edit.php?post_type=page', 'edit.php?post_type=page' );
		if( strpos($_SERVER['REQUEST_URI'], 'edit.php?post_type=page'))		
			{ wp_redirect( $redirect ); exit(); }
	}

	if( !isset($menu_perms[ 'pages_new' ]) && current_user_can('edit_pages')) {
        remove_submenu_page( 'edit.php?post_type=page', 'post-new.php?post_type=page' );
		if( strpos($_SERVER['REQUEST_URI'], 'post-new.php?post_type=page'))		
			{ wp_redirect( $redirect ); exit(); }
	}

	if( !isset($menu_perms[ 'pages_tags' ]) && current_user_can('manage_categories')) {
        remove_submenu_page( 'edit.php?post_type=page', 'edit-tags.php?taxonomy=post_tag&amp;post_type=page' );
		if( strpos($_SERVER['REQUEST_URI'], 'edit-tags.php?taxonomy=post_tag&post_type=page'))		
			{ wp_redirect( $redirect ); exit(); }
	}

	if( !isset($menu_perms[ 'menu_comments' ]) && current_user_can('edit_posts')) {
        remove_menu_page( 'edit-comments.php' );
		if( strpos($_SERVER['REQUEST_URI'], 'edit-comments.php'))		
			{ wp_redirect( $redirect ); exit(); }
	}	

	if( !isset($menu_perms[ 'menu_appearance' ]) && current_user_can('switch_themes')) {
        remove_menu_page( 'themes.php' ); 
	}

	if( !isset($menu_perms[ 'app_themes' ]) && current_user_can('switch_themes')) { 
        remove_submenu_page( 'themes.php', 'themes.php' );
		if( strpos($_SERVER['REQUEST_URI'], 'themes.php'))	
			{ wp_redirect( $redirect ); exit(); }
	}

	if( !isset($menu_perms[ 'app_cus' ]) && current_user_can('edit_theme_options')) {
		if(!empty($submenu['themes.php'])) {
		foreach($submenu['themes.php'] as $key => $sm) {
			if(esc_html__($sm[0], 'demo-my-wordpress') == esc_html__('Customize', 'demo-my-wordpress') || $sm[2] == "customize.php") {
				unset($submenu['themes.php'][$key]);
				break;
				}
			}
		}
		if( strpos($_SERVER['REQUEST_URI'], 'customize.php'))	
			{ wp_redirect( $redirect ); exit(); }
	}

	if( !isset($menu_perms[ 'app_widgets' ]) && current_user_can('edit_theme_options')) { 
        remove_submenu_page( 'themes.php', 'widgets.php' );
		if( strpos($_SERVER['REQUEST_URI'], 'widgets.php'))	
			{ wp_redirect( $redirect ); exit(); }
	}

	if( !isset($menu_perms[ 'app_men' ]) && current_user_can('edit_theme_options')) { 
        remove_submenu_page( 'themes.php', 'nav-menus.php' );
		if( strpos($_SERVER['REQUEST_URI'], 'nav-menus.php'))	
			{ wp_redirect( $redirect ); exit(); }
	}

	if( !isset($menu_perms[ 'app_head' ]) && current_user_can('edit_theme_options')) { 
        remove_submenu_page( 'themes.php', 'custom-header' );
		if( strpos($_SERVER['REQUEST_URI'], 'custom-header'))	
			{ wp_redirect( $redirect ); exit(); }
	}

	if( !isset($menu_perms[ 'app_back' ]) && current_user_can('edit_theme_options')) { 
        remove_submenu_page( 'themes.php', 'custom-background' );
		if( strpos($_SERVER['REQUEST_URI'], 'custom-background'))	
			{ wp_redirect( $redirect ); exit(); }
	}

	if( !isset($menu_perms[ 'plug_plug' ]) && current_user_can('activate_plugins')) {
        remove_submenu_page( 'plugins.php', 'plugins.php' );
		if( strpos($_SERVER['REQUEST_URI'], 'plugins.php'))		
			{ wp_redirect( $redirect ); exit(); }
	}	

	if( !isset($menu_perms[ 'menu_users' ]) && current_user_can('list_users') ) {
		if(!empty($menu)) {
		foreach($menu as $key => $sm) {
			if(esc_html__($sm[0], 'demo-my-wordpress') == "Users") {
				if( !isset($menu_perms[ 'user_profile' ]) && current_user_can('read')) {
				$menu[$key] = array( esc_html__('Profile', 'demo-my-wordpress'), 'read', 'profile.php', '', 'menu-top menu-icon-users', 'menu-users', 'div' );
				} else {
				unset($menu[$key]);
				unset( $submenu[ 'users.php' ] );
				}
				break;
				}
			}
		}
	}

	if( !isset($menu_perms[ 'users_user' ]) && current_user_can('list_users')) {
        remove_submenu_page( 'users.php', 'users.php' );
		if( strpos($_SERVER['REQUEST_URI'], '/users.php')) 
			{ wp_redirect( $redirect ); exit(); }
	}

	if( !isset($menu_perms[ 'users_new' ]) && current_user_can('create_users')) {
        remove_submenu_page( 'users.php', 'user-new.php' );
		if( strpos($_SERVER['REQUEST_URI'], 'user-new.php')) 
			{ wp_redirect( $redirect ); exit(); }
	}

	if( !isset($menu_perms[ 'user_profile' ]) && current_user_can('read')) {
        remove_submenu_page( 'users.php', 'profile.php' );
        remove_menu_page( 'profile.php' ); 
		if( strpos($_SERVER['REQUEST_URI'], 'profile.php'))		
			{ wp_redirect( $redirect ); exit(); }
	}

	if( !isset($menu_perms[ 'menu_tools' ]) && current_user_can('edit_posts')) {
        remove_menu_page( 'tools.php' );
		if( strpos($_SERVER['REQUEST_URI'], 'tools.php'))		
			{ wp_redirect( $redirect ); exit(); }
	}

	if( !isset($menu_perms[ 'tools_tools' ]) && current_user_can('edit_posts')) {
        remove_submenu_page( 'tools.php', 'tools.php' );
		if( strpos($_SERVER['REQUEST_URI'], 'tools.php'))	
			{ wp_redirect( $redirect ); exit(); }
	}

	if( !isset($menu_perms[ 'tools_im' ]) && current_user_can('import')) {
        remove_submenu_page( 'tools.php', 'import.php' );
		if( strpos($_SERVER['REQUEST_URI'], 'import.php'))	
			{ wp_redirect( $redirect ); exit(); }
	}

	if( !isset($menu_perms[ 'tools_ex' ]) && current_user_can('import')) {
        remove_submenu_page( 'tools.php', 'export.php' );
		if( strpos($_SERVER['REQUEST_URI'], 'export.php'))	
			{ wp_redirect( $redirect ); exit(); }
	}

	if( !isset($menu_perms[ 'tools_del' ]) && current_user_can('manage_options')) {
        remove_submenu_page( 'tools.php', 'ms-delete-site.php' );
		if( strpos($_SERVER['REQUEST_URI'], 'ms-delete-site.php'))	
			{ wp_redirect( $redirect ); exit(); }
	}

		if( !isset($menu_perms[ 'menu_settings' ]) && current_user_can('manage_options')) {
        remove_menu_page( 'options-general.php' );
		if( strpos($_SERVER['REQUEST_URI'], 'options-general.php'))		
			{ wp_redirect( $redirect ); exit(); }
	}

	if( !isset($menu_perms[ 'settings_gen' ]) && current_user_can('manage_options')) {
        remove_submenu_page( 'options-general.php', 'options-general.php' );
		if( strpos($_SERVER['REQUEST_URI'], 'options-general.php'))		
			{ wp_redirect( $redirect ); exit(); }
	}

	if( !isset($menu_perms[ 'settings_writ' ]) && current_user_can('manage_options')) {
        remove_submenu_page( 'options-general.php', 'options-writing.php' );
		if( strpos($_SERVER['REQUEST_URI'], 'options-writing.php'))		
			{ wp_redirect( $redirect ); exit(); }
	}

	if( !isset($menu_perms[ 'settings_read' ]) && current_user_can('manage_options')) {
        remove_submenu_page( 'options-general.php', 'options-reading.php' );
		if( strpos($_SERVER['REQUEST_URI'], 'options-reading.php'))		
			{ wp_redirect( $redirect ); exit(); }
	}

	if( !isset($menu_perms[ 'settings_disc' ]) && current_user_can('manage_options')) {
        remove_submenu_page( 'options-general.php', 'options-discussion.php' );
		if( strpos($_SERVER['REQUEST_URI'], 'options-discussion.php'))		
			{ wp_redirect( $redirect ); exit(); }
	}

	if( !isset($menu_perms[ 'settings_med' ]) && current_user_can('manage_options')) {
        remove_submenu_page( 'options-general.php', 'options-media.php' );
		if( strpos($_SERVER['REQUEST_URI'], 'options-media.php'))		
			{ wp_redirect( $redirect ); exit(); }
	}

	if( !isset($menu_perms[ 'settings_perm' ]) && current_user_can('manage_options')) {
        remove_submenu_page( 'options-general.php', 'options-permalink.php' );
			if( strpos($_SERVER['REQUEST_URI'], 'options-permalink.php'))		
				{ wp_redirect( $redirect ); exit(); }

	}
}
	
	function dwp_mu_menu_options() {
		$menu_items = array( 
			'super_admin'	=> esc_html__('Super Admin gets the following limited menus, too?', 'demo-my-wordpress'),
			'menu_dashboard'=> esc_html__('Dashboard', 'demo-my-wordpress'),
			'dash_mysites'	=> esc_html__('Dashboard My Sites', 'demo-my-wordpress'),			
			'menu_jetpack'	=> esc_html__('Jetpack', 'demo-my-wordpress'),
			'jetpack_jetpack'	=> esc_html__('Jetpack Jetpack', 'demo-my-wordpress'),
			'jetpack_modules'	=> esc_html__('Jetpack Settings', 'demo-my-wordpress'),
			'jetpack_akismet_key_config'	=> esc_html__('Akismet', 'demo-my-wordpress'),
			'jetpack_akismet_stats_display'	=> esc_html__('Akismet Stats', 'demo-my-wordpress'),
			'menu_posts'	=> esc_html__('Posts', 'demo-my-wordpress'),
			'posts_posts'	=> esc_html__('Posts Posts', 'demo-my-wordpress'),
			'posts_new'		=> esc_html__('Posts Add New', 'demo-my-wordpress'),
			'posts_cats'	=> esc_html__('Posts Categories', 'demo-my-wordpress'),
			'posts_tags'	=> esc_html__('Posts Tags', 'demo-my-wordpress'),
			'menu_media'    => esc_html__('Media', 'demo-my-wordpress'),
			'media_lib'		=> esc_html__('Media Library', 'demo-my-wordpress'),
			'media_new'		=> esc_html__('Media Add New', 'demo-my-wordpress'),
			'menu_links'	=> esc_html__('Links', 'demo-my-wordpress'),
			'links_links'	=> esc_html__('Links Links', 'demo-my-wordpress'),
			'links_new'		=> esc_html__('Links Add New', 'demo-my-wordpress'),
			'links_cats'	=> esc_html__('Links Link Categories', 'demo-my-wordpress'),
			'menu_pages'    => esc_html__('Pages', 'demo-my-wordpress'),
			'pages_pages'	=> esc_html__('Pages Pages', 'demo-my-wordpress'),
			'pages_new'		=> esc_html__('Pages Add New', 'demo-my-wordpress'),
			'pages_tags'	=> esc_html__('Pages Tags', 'demo-my-wordpress'),
			'menu_comments'	=> esc_html__('Comments', 'demo-my-wordpress'),
			'menu_content'	=> esc_html__('+ New', 'demo-my-wordpress'),
			'menu_appearance' => esc_html__('Appearance', 'demo-my-wordpress'), 
			'app_themes'	=> esc_html__('Appearance Themes', 'demo-my-wordpress'),
			'app_cus'		=> esc_html__('Appearance Customize', 'demo-my-wordpress'),
			'app_widgets'	=> esc_html__('Appearance Widgets', 'demo-my-wordpress'),
			'app_men'		=> esc_html__('Appearance Menus', 'demo-my-wordpress'),
			'app_head'		=> esc_html__('Appearance Header', 'demo-my-wordpress'),
			'app_back'		=> esc_html__('Appearance Background', 'demo-my-wordpress'),
			'plugins' 		=> esc_html__('Plugins', 'demo-my-wordpress' ),
			'plug_plug'		=> esc_html__('Plugins Plugins', 'demo-my-wordpress'),
			'menu_users'	=> esc_html__('Users', 'demo-my-wordpress'), 
			'users_user'	=> esc_html__('Users All Users', 'demo-my-wordpress'),
			'users_new'		=> esc_html__('Users Add New', 'demo-my-wordpress'),
			'user_profile'	=> esc_html__('Users Your Profile', 'demo-my-wordpress'),
			'menu_tools'	=> esc_html__('Tools', 'demo-my-wordpress'),
			'tools_tools'	=> esc_html__('Tools Available Tools', 'demo-my-wordpress'),
			'tools_im'		=> esc_html__('Tools Import', 'demo-my-wordpress'),
			'tools_ex'		=> esc_html__('Tools Export', 'demo-my-wordpress'),
			'tools_del'		=> esc_html__('Tools Delete Site', 'demo-my-wordpress'),
			'menu_settings'	=> esc_html__('Settings', 'demo-my-wordpress'),
			'settings_gen'	=> esc_html__('Settings General', 'demo-my-wordpress'),
			'settings_writ'	=> esc_html__('Settings Writing', 'demo-my-wordpress'),
			'settings_read'	=> esc_html__('Settings Reading', 'demo-my-wordpress'),
			'settings_disc'	=> esc_html__('Settings Discussion', 'demo-my-wordpress'),
			'settings_med'	=> esc_html__('Settings Media', 'demo-my-wordpress'),  
			'settings_perm'	=> esc_html__('Settings Permalinks', 'demo-my-wordpress')
			 );
			 return $menu_items;
	}
	function dwp_menu_option() {
		echo '<small>' . esc_html__('Disabling "Dashboard" may not be a good idea, it needs to be at least a page every user can see.') . '</small>';
	}
}
new DWP_Menus();	
?>