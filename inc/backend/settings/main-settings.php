<?php
$majc_display = isset($majc_settings['display']) ? $majc_settings['display'] : null;
$majc_header = isset($majc_settings['header']) ? $majc_settings['header'] : null;
$majc_buttons = isset($majc_settings['buttons']) ? $majc_settings['buttons'] : null;
$majc_coupon = isset($majc_settings['coupon']) ? $majc_settings['coupon'] : null;
$majc_summary = isset($majc_settings['summary']) ? $majc_settings['summary'] : null;
$majc_cart_basket = isset($majc_settings['cart_basket']) ? $majc_settings['cart_basket'] : null;
$majc_animations = $this->majc_animations();
$majc_display = isset($majc_settings['display']) ? $majc_settings['display'] : null;
?>

<div id="layout-settings" class="tab-content">
    <h2><?php esc_html_e('General Settings', 'mini-ajax-cart'); ?></h2>

    <div class="majc-settings-row">
        <label><?php esc_html_e('Enable Mini Ajax Cart', 'mini-ajax-cart'); ?></label>
        <div class="majc-settings-fields  majc-toggle-input-field">
            <input type="checkbox" name="majc_settings[display][enable_flying_cart]" <?php
            if (isset($majc_display['enable_flying_cart'])) {
                checked($majc_display['enable_flying_cart'], 'on', true);
            }
            ?>>
            <p class="majc-desc"><?php esc_html_e('Display Ajax Cart?', 'mini-ajax-cart'); ?></p>
        </div>
    </div>

    <h2><?php esc_html_e('Display Settings', 'mini-ajax-cart'); ?></h2>

    <div class="majc-settings-row">
        <label><?php esc_html_e('Hide in Screens', 'mini-ajax-cart'); ?></label>
        <div class="majc-settings-fields">
            <div class="majc-text-check-box">
                <label>
                    <input type="checkbox" value="desktop" name="majc_settings[display][hide_screen][]" <?php echo in_array('desktop', $majc_display['hide_screen']) ? 'checked' : ''; ?> />
                    <span><i class="icon_desktop"></i><?php esc_html_e('Desktop', 'mini-ajax-cart'); ?></span>
                </label>
                <label>
                    <input type="checkbox" value="tablet" name="majc_settings[display][hide_screen][]" <?php echo in_array('tablet', $majc_display['hide_screen']) ? 'checked' : ''; ?> />
                    <span><i class="icon_tablet"></i><?php esc_html_e('Tablet', 'mini-ajax-cart'); ?></span>
                </label>
                <label>
                    <input type="checkbox" value="mobile" name="majc_settings[display][hide_screen][]" <?php echo in_array('mobile', $majc_display['hide_screen']) ? 'checked' : ''; ?> />
                    <span><i class="icon_mobile"></i><?php esc_html_e('Mobile', 'mini-ajax-cart'); ?></span>
                </label>
            </div>
        </div>
    </div>

    <div class="majc-settings-row">
        <label><?php esc_html_e('Show/Hide in Pages', 'mini-ajax-cart') ?></label>
        <div class="majc-settings-fields">
            <div class="majc-settings-list">
                <select name="majc_settings[display][display_condition]" data-condition="toggle" id="majc-display-condition-show-hide">
                    <option value="show_all" <?php selected($majc_display['display_condition'], 'show_all'); ?>><?php esc_html_e('Show in All Pages', 'mini-ajax-cart'); ?></option>
                    <option value="hide_all" <?php selected($majc_display['display_condition'], 'hide_all'); ?>><?php esc_html_e('Hide in All Pages', 'mini-ajax-cart'); ?></option>
                    <option value="show_selected" <?php selected($majc_display['display_condition'], 'show_selected'); ?>><?php esc_html_e('Show in Selected Pages', 'mini-ajax-cart'); ?></option>
                    <option value="hide_selected" <?php selected($majc_display['display_condition'], 'hide_selected'); ?>><?php esc_html_e('Hide in Selected Pages', 'mini-ajax-cart'); ?></option>
                </select>
            </div>

            <div class="majc-display-lists" data-condition-toggle="majc-display-condition-show-hide" data-condition-val="show_selected,hide_selected">
                <div class="majc-postbox-fields">
                    <h4><?php esc_html_e('Default WordPress Pages', 'mini-ajax-cart'); ?><!-- <span class="toggle-indicator" aria-hidden="true"></span> --></h4>

                    <div class="majc-toggle-tab-body">
                        <p>
                            <input type="checkbox" name="majc_settings[display][front_pages]" id="majc_front_pages" <?php
                            if (isset($majc_display['front_pages'])) {
                                checked($majc_display['front_pages'], 'on', true);
                            }
                            ?> />
                            <label for="majc_front_pages"><?php esc_html_e('Front Page', 'mini-ajax-cart'); ?></label>
                        </p>

                        <p>
                            <input type="checkbox" name="majc_settings[display][blog_pages]" id="majc_blog_pages" <?php
                            if (isset($majc_display['blog_pages'])) {
                                checked($majc_display['blog_pages'], 'on', true);
                            }
                            ?> />
                            <label for="majc_blog_pages"><?php esc_html_e('Home/Blog Page', 'mini-ajax-cart'); ?></label>
                        </p>

                        <p>
                            <input type="checkbox" class="majc-hide-show-archive-list" name="majc_settings[display][archive_pages]" id="majc_archive_pages" <?php
                            if (isset($majc_display['archive_pages'])) {
                                checked($majc_display['archive_pages'], 'on', true);
                            }
                            ?> />
                            <label for="majc_archive_pages"><?php esc_html_e('Archive Page', 'mini-ajax-cart'); ?></label>
                        </p>

                        <p>
                            <input type="checkbox" name="majc_settings[display][error_pages]" id="majc_404_pages" <?php
                            if (isset($majc_display['error_pages'])) {
                                checked($majc_display['error_pages'], 'on', true);
                            }
                            ?> />
                            <label for="majc_404_pages"><?php esc_html_e('404 Page', 'mini-ajax-cart'); ?></label>
                        </p>

                        <p>
                            <input type="checkbox" name="majc_settings[display][search_pages]" id="majc_search_pages" <?php
                            if (isset($majc_display['search_pages'])) {
                                checked($majc_display['search_pages'], 'on', true);
                            }
                            ?> />
                            <label for="majc_search_pages"><?php esc_html_e('Search Page', 'mini-ajax-cart'); ?></label>
                        </p>

                        <?php
                        $majc_post_types = get_post_types(array('public' => 'false'));
                        sort($majc_post_types);
                        foreach ($majc_post_types as $post_type) {
                            if (!($post_type == 'attachment') and get_posts(['post_type' => $post_type])) {
                                ?>
                                <p>
                                    <input type="checkbox" name="majc_settings[display][cpt_pages][]" class="majc-hide-show-cpt-posts" id="majc-hscpt-<?php echo esc_attr($post_type); ?>" data-posttype="<?php echo esc_attr($post_type); ?>" value="<?php echo esc_attr($post_type); ?>" <?php echo in_array(esc_attr($post_type), $majc_display['cpt_pages']) ? 'checked="checked"' : '' ?> />
                                    <label for="majc-hscpt-<?php echo esc_attr($post_type); ?>"><?php echo esc_html('All ' . ucwords($post_type)); ?></label>
                                </p>
                                <?php
                            }
                        }
                        ?>
                    </div>
                </div>

                <?php
                $majc_specific_page = array();
                if (!empty($majc_display['specific_pages'])) {
                    foreach ($majc_display['specific_pages'] as $majc_values) {
                        $majc_specific_page[] = $majc_values;
                    }
                }
                $majc_post_types = get_post_types(array('public' => 'false'));
                sort($majc_post_types);
                ?>
                <div class="majc-hide-singular" id="majc-show-archive" <?php echo $majc_display['archive_pages'] == 'on' ? 'style="display:none;"' : '' ?>>
                    <h4>
                        <?php
                        esc_html_e('Specific Archive Page', 'mini-ajax-cart');
                        ?>
                        <!-- <span class="toggle-indicator" aria-hidden="true"></span> -->
                    </h4>

                    <div class="majc-toggle-tab-body">
                        <?php
                        foreach ($majc_post_types as $post_type) {
                            if (!($post_type == 'attachment' || $post_type == 'majc-cart-template')) {
                                ?>
                                <p>
                                    <input type="checkbox" name="majc_settings[display][specific_archive][]" id="majc-archive-<?php echo esc_attr($post_type); ?>" value="<?php echo esc_attr($post_type); ?>" <?php if (in_array($post_type, $majc_display['specific_archive']))
                                              echo 'checked'; ?> />
                                    <label for="majc-archive-<?php echo esc_attr($post_type); ?>"><?php echo esc_html(ucwords($post_type)); ?></label>
                                </p>
                                <?php
                            }
                        }
                        ?>
                    </div>
                </div>
                <?php
                foreach ($majc_post_types as $post_type) {
                    if (!($post_type == 'attachment')) {
                        $majc_posts_loop = new WP_Query(array('post_type' => $post_type, 'posts_per_page' => -1, 'post_status' => 'publish'));

                        if (!empty($majc_posts_loop->posts)) {
                            ?>
                            <div class="majc-hide-singular" id="majc-cpt-<?php echo esc_attr($post_type); ?>" <?php echo in_array(esc_attr($post_type), $majc_display['cpt_pages']) ? 'style="display:none;"' : '' ?>>

                                <h4>
                                    <?php
                                    esc_html_e('Specific ', 'mini-ajax-cart');
                                    echo esc_html(ucwords($post_type));
                                    ?>
                                    <!-- <span class="toggle-indicator" aria-hidden="true"></span> -->
                                </h4>

                                <div class="majc-toggle-tab-body">
                                    <?php
                                    while ($majc_posts_loop->have_posts()):
                                        $majc_posts_loop->the_post();
                                        $majc_post_id = get_the_ID();
                                        ?>
                                        <p>
                                            <input type="checkbox" name="majc_settings[display][specific_pages][]" id="majc-post-<?php echo esc_attr($majc_post_id); ?>" value="<?php echo esc_attr($majc_post_id); ?>" <?php if (isset($majc_specific_page) && in_array($majc_post_id, $majc_specific_page))
                                                      echo 'checked'; ?> />
                                            <label for="majc-post-<?php echo esc_attr($majc_post_id); ?>"><?php esc_html(the_title()); ?></label>
                                        </p>
                                        <?php
                                    endwhile;
                                    wp_reset_postdata();
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
    </div>
</div>