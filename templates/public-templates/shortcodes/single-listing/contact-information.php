<?php
if ((!$hide_contact_info) && !empty($address || $phone ||$phone2 ||$fax || $email || $website || $zip || $social) && empty($disable_contact_info)) { ?>
    <div class="atbd_content_module atbd_contact_information_module">
        <div class="atbd_content_module_title_area">
            <div class="atbd_area_title">
                <h4>
                    <span class="<?php atbdp_icon_type(true);?>-envelope-o"></span><?php _e($contact_info_text, 'directorist'); ?>
                </h4>
            </div>
        </div>
        <div class="atbdb_content_module_contents">
            <div class="atbd_contact_info">
                <ul>
                    <?php
                    if (!empty($address) && !empty($display_address_field)) { ?>
                        <li>
                            <div class="atbd_info_title"><span
                                        class="<?php atbdp_icon_type(true);?>-map-marker"></span><?php _e($address_label, 'directorist'); ?>
                            </div>
                            <div class="atbd_info"><?php echo $address_text; ?></div>
                        </li>
                    <?php } ?>
                    <?php
                    if (isset($phone) && !is_empty_v($phone) && !empty($display_phone_field) && $plan_phone) { ?>
                        <!-- In Future, We will have to use a loop to print more than 1 number-->
                        <li>
                            <div class="atbd_info_title"><span
                                        class="<?php atbdp_icon_type(true);?>-phone"></span><?php _e($phone_label, 'directorist'); ?>
                            </div>
                            <div class="atbd_info">
                                <a href="tel:<?php ATBDP_Helper::sanitize_tel_attr( $phone ); ?>"><?php ATBDP_Helper::sanitize_html( $phone ); ?></a>
                            </div>
                        </li>
                    <?php } ?>
                    <?php
                    if (isset($phone2) && !is_empty_v($phone2) && !empty($display_phone2_field)) { ?>
                        <!-- In Future, We will have to use a loop to print more than 1 number-->
                        <li>
                            <div class="atbd_info_title">
                                <span class="<?php atbdp_icon_type(true);?>-phone"></span><?php echo $phone_label2; ?>
                            </div>
                            <div class="atbd_info"><a href="tel:<?php ATBDP_Helper::sanitize_tel_attr( $phone2 ); ?>"><?php ATBDP_Helper::sanitize_html( $phone2 ); ?></a>
                            </div>
                        </li>
                    <?php } ?>
                    <?php
                    if (isset($fax) && !is_empty_v($fax) && !empty($display_fax_field)) { ?>
                        <!-- In Future, We will have to use a loop to print more than 1 number-->
                        <li>
                            <div class="atbd_info_title"><span
                                        class="<?php atbdp_icon_type(true);?>-fax"></span><?php echo $fax_label; ?>
                            </div>
                            <div class="atbd_info"><a href="tel:<?php ATBDP_Helper::sanitize_tel_attr( $fax ); ?>"><?php ATBDP_Helper::sanitize_html( $fax ); ?></a>
                            </div>
                        </li>
                    <?php } ?>
                    <?php
                    if (!empty($email) && !empty($display_email_field) && $plan_email) { ?>
                        <li>
                            <div class="atbd_info_title"><span
                                        class="<?php atbdp_icon_type(true);?>-envelope"></span><?php _e($email_label, 'directorist'); ?>
                            </div>
                            <span class="atbd_info"><a target="_top"
                                                       href="mailto:<?php echo esc_html($email); ?>"><?php echo esc_html($email); ?></a></span>
                        </li>
                    <?php } ?>
                    <?php
                    if (!empty($website) && !empty($display_website_field) && $plan_webLink) { ?>
                        <li>
                            <div class="atbd_info_title"><span
                                        class="<?php atbdp_icon_type(true);?>-globe"></span><?php _e($website_label, 'directorist'); ?>
                            </div>
                            <a target="_blank" href="<?php echo esc_url($website); ?>"
                               class="atbd_info" <?php echo !empty($use_nofollow) ? 'rel="nofollow"' : ''; ?>><?php echo esc_html($website); ?></a>
                        </li>
                    <?php } ?>
                    <?php
                    if (isset($zip) && !is_empty_v($zip) && !empty($display_zip_field)) { ?>
                        <!-- In Future, We will have to use a loop to print more than 1 number-->
                        <li>
                            <div class="atbd_info_title"><span
                                        class="<?php atbdp_icon_type(true);?>-at"></span><?php _e($zip_label, 'directorist'); ?>
                            </div>
                            <div class="atbd_info"><?php echo esc_html($zip); ?></div>
                        </li>
                    <?php } ?>
                </ul>
            </div>
            <?php
            if (!empty($social) && is_array($social) && !empty($display_social_info_field) && $plan_social_networks) { ?>
                <div class="atbd_director_social_wrap">
                    <?php foreach ($social as $link) {
                        $link_id = $link['id'];
                        $link_url = $link['url'];

                        $n = esc_attr($link_id);
                        $l = esc_url($link_url);
                        ?>
                        <a target='_blank' href="<?php echo $l; ?>" class="<?php echo $n; ?>">
                            <span class="fa fa-<?php echo $n; ?>"></span>
                        </a>
                    <?php } ?>
                </div>
            <?php } ?>
        </div>
    </div><!-- end .atbd_custom_fields_contents -->
<?php }