<?php
   function dwp_logs()
   {
       global $wp_filesystem;
       if ( ! is_a( $wp_filesystem, 'WP_Filesystem_Base') ){
           include_once(ABSPATH . 'wp-admin/includes/file.php');$creds = request_filesystem_credentials( site_url() );
           wp_filesystem($creds);
       }
       if(isset($_POST['dwp_delete']))
       {
           if($wp_filesystem->exists(WP_CONTENT_DIR . '/dwp_info.log'))
           {
               $wp_filesystem->delete(WP_CONTENT_DIR . '/dwp_info.log');
           }
       }
       if(isset($_POST['dwp_delete_email']))
       {
           update_option('dwp_email_list', array());
       }
       if(isset($_POST['dwp_restore_defaults']))
       {
           dwp_activation_callback(true);
       }
   ?>
<div class="wp-header-end"></div>
<div class="wrap gs_popuptype_holder seo_pops">
<div>
   <div>
      <div>
         <h3>
            <?php echo esc_html__("System Info:", 'demo-my-wordpress');?> 
            <div class="bws_help_box bws_help_box_right dashicons dashicons-editor-help cr_align_middle">
               <div class="bws_hidden_help_text cr_min_260px">
                  <?php
                     echo esc_html__("Some general system information.", 'demo-my-wordpress');
                     ?>
               </div>
            </div>
         </h3>
         <hr/>
         <table class="cr_server_stat">
            <tr class="cdr-dw-tr">
               <td class="cdr-dw-td"><?php echo esc_html__("User Agent:", 'demo-my-wordpress');?></td>
               <td class="cdr-dw-td-value"><?php echo esc_html($_SERVER['HTTP_USER_AGENT']); ?></td>
            </tr>
            <tr class="cdr-dw-tr">
               <td class="cdr-dw-td"><?php echo esc_html__("Web Server:", 'demo-my-wordpress');?></td>
               <td class="cdr-dw-td-value"><?php echo esc_html($_SERVER['SERVER_SOFTWARE']); ?></td>
            </tr>
            <tr class="cdr-dw-tr">
               <td class="cdr-dw-td"><?php echo esc_html__("PHP Version:", 'demo-my-wordpress');?></td>
               <td class="cdr-dw-td-value"><?php echo esc_html(phpversion()); ?></td>
            </tr>
            <tr class="cdr-dw-tr">
               <td class="cdr-dw-td"><?php echo esc_html__("PHP Max POST Size:", 'demo-my-wordpress');?></td>
               <td class="cdr-dw-td-value"><?php echo esc_html(ini_get('post_max_size')); ?></td>
            </tr>
            <tr class="cdr-dw-tr">
               <td class="cdr-dw-td"><?php echo esc_html__("PHP Max Upload Size:", 'demo-my-wordpress');?></td>
               <td class="cdr-dw-td-value"><?php echo esc_html(ini_get('upload_max_filesize')); ?></td>
            </tr>
            <tr class="cdr-dw-tr">
               <td class="cdr-dw-td"><?php echo esc_html__("PHP Memory Limit:", 'demo-my-wordpress');?></td>
               <td class="cdr-dw-td-value"><?php echo esc_html(ini_get('memory_limit')); ?></td>
            </tr>
            <tr class="cdr-dw-tr">
               <td class="cdr-dw-td"><?php echo esc_html__("PHP DateTime Class:", 'demo-my-wordpress');?></td>
               <td class="cdr-dw-td-value"><?php echo (class_exists('DateTime') && class_exists('DateTimeZone')) ? '<span class="cdr-green">' . esc_html__('Available', 'demo-my-wordpress') . '</span>' : '<span class="cdr-red">' . esc_html__('Not available', 'demo-my-wordpress') . '</span> | <a href="http://php.net/manual/en/datetime.installation.php" target="_blank">more info&raquo;</a>'; ?> </td>
            </tr>
            <tr class="cdr-dw-tr">
               <td class="cdr-dw-td"><?php echo esc_html__("PHP Curl:", 'demo-my-wordpress');?></td>
               <td class="cdr-dw-td-value"><?php echo (function_exists('curl_version')) ? '<span class="cdr-green">' . esc_html__('Available', 'demo-my-wordpress') . '</span>' : '<span class="cdr-red">' . esc_html__('Not available', 'demo-my-wordpress') . '</span>'; ?> </td>
            </tr>
            <?php do_action('coderevolution_dashboard_widget_server') ?>
         </table>
      </div>
      <div>
         <br/>
         <hr class="cr_special_hr"/>
         <div>
            <h3>
               <?php echo esc_html__('Restore Plugin Default Settings', 'demo-my-wordpress');?> 
               <div class="bws_help_box bws_help_box_right dashicons dashicons-editor-help cr_align_middle">
                  <div class="bws_hidden_help_text cr_min_260px">
                     <?php
                        echo esc_html__('Hit this button and the plugin settings will be restored to their default values. Warning! All settings will be lost!', 'demo-my-wordpress');
                        ?>
                  </div>
               </div>
            </h3>
            <hr/>
            <form method="post" onsubmit="return confirm('<?php echo esc_html__('Are you sure you want to restore the default plugin settings?', 'demo-my-wordpress');?>');"><input name="dwp_restore_defaults" type="submit" value="<?php echo esc_html__('Restore Plugin Default Settings', 'demo-my-wordpress');?>"></form>
         </div>
         <h3>
            <?php echo esc_html__('Email List:', 'demo-my-wordpress');?>
            <div class="bws_help_box bws_help_box_right dashicons dashicons-editor-help cr_align_middle">
               <div class="bws_hidden_help_text cr_min_260px">
                  <?php
                     echo esc_html__("This is the main email list that was gattered using the plugin's demo form feature.", 'demo-my-wordpress');
                     ?>
               </div>
            </div>
         </h3>
         <div>
            <?php
               $emails = get_option('dwp_email_list', array());
               if(is_array($emails) && count($emails) > 0)
               {
                   echo json_encode($emails);
               }
               else
               {
                   echo esc_html__('No emails yet in the list.', 'demo-my-wordpress');
               }
               ?>
            <hr/>
            <form method="post" onsubmit="return confirm('Are you sure you want to delete all email addresses?');">
               <input name="dwp_delete_email" type="submit" value="Delete Emails">
            </form>
         </div>
         <h3>
            <?php echo esc_html__('Activity Log:', 'demo-my-wordpress');?>
            <div class="bws_help_box bws_help_box_right dashicons dashicons-editor-help cr_align_middle">
               <div class="bws_hidden_help_text cr_min_260px">
                  <?php
                     echo esc_html__('This is the main log of your plugin. Here will be listed every single instance of the rules you run or are automatically run by schedule jobs (if you enable logging, in the plugin configuration).', 'demo-my-wordpress');
                     ?>
               </div>
            </div>
         </h3>
         <div>
            <?php
               if($wp_filesystem->exists(WP_CONTENT_DIR . '/dwp_info.log'))
               {
                    $log = $wp_filesystem->get_contents(WP_CONTENT_DIR . '/dwp_info.log');
                   $log = esc_html($log);$log = str_replace('&lt;br/&gt;', '<br/>', $log);echo $log;
               }
               else
               {
                   echo esc_html__('Log empty', 'demo-my-wordpress');
               }
               ?>
         </div>
      </div>
      <hr/>
      <form method="post" onsubmit="return confirm('<?php echo esc_html__('Are you sure you want to delete all logs?', 'demo-my-wordpress');?>');">
         <input name="dwp_delete" type="submit" value="<?php echo esc_html__('Delete Logs', 'demo-my-wordpress');?>">
      </form>
   </div>
</div>
<?php
   }
   ?>