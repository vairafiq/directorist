<?php
global $post;
$listing_id = $post->ID;
$fm_plan = get_post_meta($listing_id, '_fm_plans', true);

$cats = get_the_terms($post->ID, ATBDP_CATEGORY);
$custom_section_lable = get_directorist_option('custom_section_lable', __('Details', ATBDP_TEXTDOMAIN));

// make main column size 12 when sidebar or submit widget is active @todo; later make the listing submit widget as real widget instead of hard code
$main_col_size = is_active_sidebar('right-sidebar-listing') ? 'col-lg-8' : 'col-lg-12';
?>

            <?php

            $term_id = get_post_meta($post->ID, '_admin_category_select', true);
            $meta_array = array('relation' => 'AND');
            $meta_array = array(
                'key' => 'category_pass',
                'value' => $term_id,
                'compare' => 'EXISTS'
            );

            if (('-1' === $term_id) || empty($term_id)) {
                $post_ids_array = $cats; //this array will be dynamically generated
                if (!empty($post_ids_array)) {
                    $meta_array = array('relation' => 'OR');
                    foreach ($post_ids_array as $key => $value) {
                        array_push($meta_array,
                            array(
                                'key' => 'category_pass',
                                'value' => $value->term_id,
                                'compare' => 'EXISTS'
                            )
                        );
                    }
                }

            }
            $custom_fields = new WP_Query(array(
                'post_type' => ATBDP_CUSTOM_FIELD_POST_TYPE,
                'posts_per_page' => -1,
                'post_status' => 'publish',
                'meta_query' => array(
                    'relation' => 'OR',
                    array(
                        'key' => 'associate',
                        'value' => 'form',
                        'compare' => 'EXISTS'
                    ),
                    $meta_array
                )
            ));

            $custom_fields_posts = $custom_fields->posts;
            $has_field_value = array();
            foreach ($custom_fields_posts as $custom_fields_post) {
                setup_postdata($custom_fields_post);
                $has_field_id = $custom_fields_post->ID;
                $has_field_details = get_post_meta($listing_id, $has_field_id, true);
                $has_field_value[] = $has_field_details;
            }
            $has_field = join($has_field_value);

            if (!empty($has_field)) {
            ?>
            <div class="atbd_content_module atbd_custom_fields_contents">
                <div class="atbd_content_module__tittle_area">
                    <div class="atbd_area_title">
                        <h4>
                            <span class="fa fa-bars atbd_area_icon"></span><?php _e($custom_section_lable, ATBDP_TEXTDOMAIN) ?>
                        </h4>
                    </div>
                </div>
                <div class="atbdb_content_module_contents">
                    <ul class="atbd_custom_fields">
                        <!--  get data from custom field-->
                        <?php

                        foreach ($custom_fields_posts as $post) {
                            setup_postdata($post);
                            $field_id = $post->ID;
                            $field_details = get_post_meta($listing_id, $field_id, true);
                            $has_field_value[] = $field_details;

                            $field_title = get_the_title($field_id);
                            $field_type = get_post_meta($field_id, 'type', true);
                            if (!empty($field_details)) {
                                ?>
                                <li>
                                    <div class="atbd_custom_field_title">
                                        <p><?php echo esc_attr($field_title); ?></p></div>
                                    <div class="atbd_custom_field_content">
                                        <p><?php if ('color' == $field_type) {
                                                printf('<div class="atbd_field_type_color" style="background-color: %s;"></div>', $field_details);
                                            } elseif ($field_type === 'time') {
                                                echo date('h:i A', strtotime($field_details));
                                            } elseif ($field_type === 'url') {
                                                printf('<a href="%s" target="_blank">%s</a>', esc_url($field_details), esc_url($field_details));
                                            } elseif ($field_type === 'checkbox') {
                                                $choices = get_post_meta($field_id, 'choices', true);
                                                $choices = explode("\n", $choices);
                                                $values = explode("\n", $field_details);
                                                $values = array_map('trim', $values);
                                                $output = array();
                                                foreach ($choices as $choice) {
                                                    if (strpos($choice, ':') !== false) {
                                                        $_choice = explode(':', $choice);
                                                        $_choice = array_map('trim', $_choice);

                                                        $_value = $_choice[0];
                                                        $_label = $_choice[1];
                                                    } else {
                                                        $_value = trim($choice);
                                                        $_label = $_value;
                                                    }
                                                    $_checked = '';
                                                    if (in_array($_value, $values)) {
                                                        $space = str_repeat(' ', 1);
                                                        $output[] = "{$space}$_value";
                                                    }
                                                }
                                                echo join(',', $output);

                                            } else {
                                                $content = apply_filters('get_the_content', $field_details);
                                                echo do_shortcode(wpautop($content));
                                                //echo esc_attr($field_details);
                                            } ?></p>

                                    </div>
                                </li>
                                <?php
                            }
                        }
                        wp_reset_postdata();
                        ?>
                    </ul>
                </div>
            </div><!-- end .atbd_custom_fields_contents -->
            <?php } ?>
