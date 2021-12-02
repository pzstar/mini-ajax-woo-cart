<?php  
    $display = isset($majc_settings['display']) ? $majc_settings['display'] : null;
?>

<div id="display-settings" class="tab-content" style="display: none;">
	<h2><?php esc_html_e('Display Settings', 'mini-ajax-cart'); ?></h2>

    <div class="majc-settings-field">
        <label><?php esc_html_e('Enable Flying Cart', 'mini-ajax-cart'); ?></label>
        <div class="majc-settings-input-field">
            <label class="majc-switch">
                <input type="checkbox" name="majc_settings[display][enable_flying_cart]" <?php if(isset($display['enable_flying_cart'])) { checked($display['enable_flying_cart'], 'on', true); } ?>>
                <span class="majc-switch-slider round"></span>
            </label>
        </div>
    </div>

    <div class="majc-settings-field">
        <label><?php esc_html_e('Hide Flying Cart On Mobile Devices', 'mini-ajax-cart'); ?></label>
        <div class="majc-settings-input-field">
            <label class="majc-switch">
                <input type="checkbox" name="majc_settings[display][mobile_hide]" <?php if(isset($display['mobile_hide'])) { checked($display['mobile_hide'], 'on', true); } ?>>
                <span class="majc-switch-slider round"></span>
            </label>
        </div>
    </div>

    <div class="majc-settings-field">
        <label><?php esc_html_e('Hide Flying Cart On Desktop', 'mini-ajax-cart'); ?></label>
        <div class="majc-settings-input-field">
            <label class="majc-switch">
                <input type="checkbox" name="majc_settings[display][desktop_hide]" <?php if(isset($display['desktop_hide'])) { checked($display['desktop_hide'], 'on', true); } ?>>
                <span class="majc-switch-slider round"></span>
            </label>
        </div>
    </div>

    <div class="majc-settings-field">
        <label><?php esc_html_e('Show/Hide in Pages', 'mini-ajax-cart') ?></label>
        <div class="majc-settings-input-field">
            <label class="majc-raido-field">
                <input type="radio" name="majc_settings[display][hide_show_pages]" value="show_in_pages" <?php if(isset($display['hide_show_pages'])) { checked($display['hide_show_pages'], 'show_in_pages'); } ?>>
                <?php esc_html_e('Show in Pages', 'mini-ajax-cart'); ?>
            </label>

            <label class="majc-raido-field">
                <input type="radio" name="majc_settings[display][hide_show_pages]" value="hide_in_pages" <?php if(isset($display['hide_show_pages'])) { checked($display['hide_show_pages'], 'hide_in_pages'); } ?>>
                <?php esc_html_e('Hide in Pages', 'mini-ajax-cart'); ?>
            </label>
        </div>
    </div>

    <div class="majc-display-lists">
        <div class="majc-postbox-fields">
            <h2><?php esc_html_e('Default WordPress Pages', 'mini-ajax-cart'); ?><!-- <span class="toggle-indicator" aria-hidden="true"></span> --></h2>

            <div class="majc-toggle-tab-body">
                <p>
                    <input type="checkbox" name="majc_settings[display][front_pages]" id="majc_front_pages" <?php if(isset($display['front_pages'])) { checked($display['front_pages'], 'on', true); } ?>/>
                    <label for="majc_front_pages"><?php esc_html_e('Front Page', 'mini-ajax-cart'); ?></label>
                </p>

                <p>
                    <input type="checkbox" name="majc_settings[display][blog_pages]" id="majc_blog_pages" <?php if(isset($display['blog_pages'])) { checked($display['blog_pages'], 'on', true); } ?>/>
                    <label for="majc_blog_pages"><?php esc_html_e('Home/Blog Page', 'mini-ajax-cart'); ?></label>
                </p>

                <p>
                    <input type="checkbox" name="majc_settings[display][archive_pages]" id="majc_archive_pages" <?php if(isset($display['archive_pages'])) { checked($display['archive_pages'], 'on', true); } ?>/>
                    <label for="majc_archive_pages"><?php esc_html_e('Archive Page', 'mini-ajax-cart'); ?></label>
                </p>

                <p>
                    <input type="checkbox" name="majc_settings[display][error_pages]"  id="majc_404_pages" <?php if(isset($display['error_pages'])) { checked($display['error_pages'], 'on', true); } ?>/>
                    <label for="majc_404_pages"><?php esc_html_e('404 Page', 'mini-ajax-cart'); ?></label>
                </p>

                <p>
                    <input type="checkbox" name="majc_settings[display][search_pages]"  id="majc_search_pages" <?php if(isset($display['search_pages'])) { checked($display['search_pages'], 'on', true); } ?>/>
                    <label for="majc_search_pages"><?php esc_html_e('Search Page', 'mini-ajax-cart'); ?></label>
                </p>

                <p>
                    <input type="checkbox" name="majc_settings[display][single_pages]" id="majc_single_pages" <?php if(isset($display['single_pages'])) { checked($display['single_pages'], 'on', true); } ?>/>
                    <label for="majc_single_pages"><?php esc_html_e('All Single Page', 'mini-ajax-cart'); ?></label>
                </p>

            </div>
        </div>


        <?php
        $majc_specific_page = array();
        if (!empty($display['specific_pages'])) {
            foreach ($display['specific_pages'] as $values) {
                $majc_specific_page[] = $values;
            }
        }
        $post_types = get_post_types(array('public' => 'false'));
        sort($post_types);
        foreach ($post_types as $post_type) {
            if (!($post_type == 'attachment')) {
                $posts_loop = new WP_Query(array('post_type' => $post_type, 'posts_per_page' => -1, 'post_status' => 'publish'));
                
                if (!empty($posts_loop->posts)) {
                    ?>
                    <div class="majc-hide-singular" <?php if (isset($display['single_pages'])) echo 'style="display:none;"'; ?>>

                        <h2>
                            <?php 
                                esc_html_e('Specific ', 'mini-ajax-cart');
                                echo esc_html(ucwords($post_type)); 
                            ?>
                            <!-- <span class="toggle-indicator" aria-hidden="true"></span> -->
                        </h2>

                        <div class="majc-toggle-tab-body">
                            <?php
                            while ($posts_loop->have_posts()) : $posts_loop->the_post();
                                $postid = get_the_ID();
                                ?>
                                <p>
                                    <input type="checkbox" name="majc_settings[display][specific_pages][]" id="majc-post-<?php echo esc_attr($postid); ?>" value="<?php echo esc_attr($postid); ?>" <?php if (isset($majc_specific_page) && in_array($postid, $majc_specific_page)) echo 'checked'; ?>	/>
                                    <label for="majc-post-<?php echo esc_attr($postid); ?>"><?php esc_html(the_title()); ?></label>
                                </p>
                                <?php
                            endwhile;
                            wp_reset_query();
                            ?>
                        </div>
                    </div>
                    <?php
                }
            }
        }
        ?>
    </div>

</div>