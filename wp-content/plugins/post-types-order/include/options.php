<?php


function cpt_plugin_options()
    {
        $options          =     cpt_get_options();
        
        if (isset($_POST['form_submit']))
            {
                $options['show_reorder_interfaces'] = (array) $_POST['show_reorder_interfaces'];
                $options['show_reorder_interfaces'] =   array_map( 'sanitize_key', $options['show_reorder_interfaces'] );
                    
                $options['capability']              = sanitize_key($_POST['capability']);
                
                $options['autosort']                = isset($_POST['autosort'])     ? intval($_POST['autosort'])    : '';
                $options['adminsort']               = isset($_POST['adminsort'])    ? intval($_POST['adminsort'])   : '';
                
                $options['navigation_sort_apply']   = isset($_POST['navigation_sort_apply'])    ? intval($_POST['navigation_sort_apply'])   : '';
                                    
                echo '<div class="updated fade"><p>' . __('Settings Saved', 'cpt') . '</p></div>';

                update_option('cpto_options', $options);
                update_option('CPT_configured', 'TRUE');
                   
            }
            
            $queue_data = get_option('ce_queue');
            
                    ?>
                      <div class="wrap"> 
                        <div id="icon-settings" class="icon32"></div>
                            <h2><?php _e('General Settings', 'cpt') ?></h2>
                           
                           <?php cpt_info_box(); ?>
                           
                            <form id="form_data" name="form" method="post">   
                                <br />
                                <h2 class="subtitle"><?php _e('General', 'cpt') ?></h2>                              
                                <table class="form-table">
                                    <tbody>
                                        <tr valign="top">
                                            <th scope="row" style="text-align: right;"><label><?php _e('Show / Hide re-order interface', 'cpt') ?></label></th>
                                            <td>
                                                <?php
                                                
                                                    $post_types = get_post_types();
                                                    foreach( $post_types as $post_type_name ) 
                                                        {
                                                            //ignore list
                                                            $ignore_post_types  =   array(
                                                                                            'reply',
                                                                                            'topic',
                                                                                            'report',
                                                                                            'status'  
                                                                                            );
                                                            
                                                            if(in_array($post_type_name, $ignore_post_types))
                                                                continue;
                                                            
                                                            if(is_post_type_hierarchical($post_type_name))
                                                                continue;
                                                                
                                                            $post_type_data = get_post_type_object( $post_type_name );
                                                            if($post_type_data->show_ui === FALSE)
                                                                continue;
                                                ?>
                                                <p><label>
                                                    <select name="show_reorder_interfaces[<?php echo $post_type_name ?>]">
                                                        <option value="show" <?php if(isset($options['show_reorder_interfaces'][$post_type_name]) && $options['show_reorder_interfaces'][$post_type_name] == 'show') {echo ' selected="selected"';} ?>><?php _e( "Show", 'cpt' ) ?></option>
                                                        <option value="hide" <?php if(isset($options['show_reorder_interfaces'][$post_type_name]) && $options['show_reorder_interfaces'][$post_type_name] == 'hide') {echo ' selected="selected"';} ?>><?php _e( "Hide", 'cpt' ) ?></option>
                                                    </select> &nbsp;&nbsp;<?php echo $post_type_data->labels->singular_name ?>
                                                </label><br />&nbsp;</p>
                                                <?php  } ?>
                                            </td>
                                        </tr>
                                        <tr valign="top">
                                            <th scope="row" style="text-align: right;"><label><?php _e('Minimum Level to use this plugin', 'cpt') ?></label></th>
                                            <td>
                                                <select id="role" name="capability">
                                                    <option value="read" <?php if (isset($options['capability']) && $options['capability'] == "read") echo 'selected="selected"'?>><?php _e('Subscriber', 'cpt') ?></option>
                                                    <option value="edit_posts" <?php if (isset($options['capability']) && $options['capability'] == "edit_posts") echo 'selected="selected"'?>><?php _e('Contributor', 'cpt') ?></option>
                                                    <option value="publish_posts" <?php if (isset($options['capability']) && $options['capability'] == "publish_posts") echo 'selected="selected"'?>><?php _e('Author', 'cpt') ?></option>
                                                    <option value="publish_pages" <?php if (isset($options['capability']) && $options['capability'] == "publish_pages") echo 'selected="selected"'?>><?php _e('Editor', 'cpt') ?></option>
                                                    <option value="switch_themes" <?php if (!isset($options['capability']) || empty($options['capability']) || (isset($options['capability']) && $options['capability'] == "switch_themes")) echo 'selected="selected"'?>><?php _e('Administrator', 'cpt') ?></option>
                                                </select>
                                            </td>
                                        </tr>
                                        
                                        <tr valign="top">
                                            <th scope="row" style="text-align: right;"><label for="autosort"><?php _e('Auto Sort', 'cpt') ?></label></th>
                                            <td>
                                                <p><input type="checkbox" <?php if ($options['autosort'] == "1") {echo ' checked="checked"';} ?> id="autosort" value="1" name="autosort"> <?php _e("If checked, the plug-in automatically update the WordPress queries to use the new order (<b>No code update is necessarily</b>)", 'cpt'); ?></p>
                                                <p class="description"><?php _e("If only certain queries need to use the custom sort, keep this unchecked and include 'orderby' => 'menu_order' into query parameters", 'cpt') ?>.
                                                <br />
                                                <a href="http://www.nsp-code.com/sample-code-on-how-to-apply-the-sort-for-post-types-order-plugin/" target="_blank"><?php _e('Additional Description and Examples', 'cpt') ?></a></p>
                                                
                                            </td>
                                        </tr>
                                        
                                        
                                        <tr valign="top">
                                            <th scope="row" style="text-align: right;"><label for="adminsort"><?php _e('Admin Sort', 'cpt') ?></label></th>
                                            <td>
                                                <p>
                                                <input type="checkbox" <?php if ($options['adminsort'] == "1") {echo ' checked="checked"';} ?> id="adminsort" value="1" name="adminsort">
                                                <?php _e("To affect the admin interface, to see the post types per your new sort, this need to be checked", 'cpt') ?>.</p>
                                            </td>
                                        </tr>
                                        
                                        <tr valign="top">
                                            <th scope="row" style="text-align: right;"><label for="navigation_sort_apply"><?php _e('Next / Previous Apply', 'cpt') ?></label></th>
                                            <td>
                                                <p>
                                                <input type="checkbox" <?php if ($options['navigation_sort_apply'] == "1") {echo ' checked="checked"';} ?> id="navigation_sort_apply" value="1" name="navigation_sort_apply">
                                                <?php _e("Apply the sort on Next / Previous site-wide navigation.", 'cpt') ?> <?php _e('This can also be controlled through', 'cpt') ?> <a href="http://www.nsp-code.com/apply-custom-sorting-for-next-previous-site-wide-navigation/" target="_blank"><?php _e('code', 'cpt') ?></a></p>
                                            </td>
                                        </tr>
                                        
                                    </tbody>
                                </table>
                                                   
                                <p class="submit">
                                    <input type="submit" name="Submit" class="button-primary" value="<?php 
                                    _e('Save Settings', 'cpt') ?>">
                               </p>
                            
                                <input type="hidden" name="form_submit" value="true" />
                                
                                
                            </form>

                    <br />
                            
                    <?php  
            echo '</div>';   
        
        
    }

?>