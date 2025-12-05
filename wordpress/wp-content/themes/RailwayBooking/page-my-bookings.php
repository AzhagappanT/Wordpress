<?php
/* Template Name: My Bookings */
get_header();
?>

<div class="container">
    <h2>My Bookings</h2>

    <?php
    if (is_user_logged_in()) {
        $user_id = get_current_user_id();
        $args = array(
            'post_type' => 'booking',
            'meta_key' => 'user_id',
            'meta_value' => $user_id,
            'posts_per_page' => -1
        );
        $query = new WP_Query($args);

        if ($query->have_posts()):
            echo '<table style="width:100%; border-collapse:collapse; margin-top:20px;">';
            echo '<tr style="background:#ddd; text-align:left;">
                    <th style="padding:10px;">PNR</th>
                    <th style="padding:10px;">Train</th>
                    <th style="padding:10px;">Date</th>
                    <th style="padding:10px;">Status</th>
                  </tr>';

            while ($query->have_posts()):
                $query->the_post();
                $pnr = get_post_meta(get_the_ID(), 'pnr_number', true);
                $train_id = get_post_meta(get_the_ID(), 'train_id', true);
                $date = get_post_meta(get_the_ID(), 'journey_date', true);
                $status = get_post_meta(get_the_ID(), 'booking_status', true);
                $train_name = get_the_title($train_id);
                ?>
                <tr style="border-bottom:1px solid #eee;">
                    <td style="padding:10px;"><strong><?php echo esc_html($pnr); ?></strong></td>
                    <td style="padding:10px;"><?php echo esc_html($train_name); ?></td>
                    <td style="padding:10px;"><?php echo esc_html($date); ?></td>
                    <td style="padding:10px; color:<?php echo ($status == 'Confirmed') ? 'green' : 'orange'; ?>;">
                        <?php echo esc_html($status); ?></td>
                </tr>
                <?php
            endwhile;
            echo '</table>';
            wp_reset_postdata();
        else:
            echo '<p>No bookings found.</p>';
        endif;
    } else {
        echo '<p>Please <a href="' . wp_login_url() . '">login</a> to view your bookings.</p>';
    }
    ?>
</div>

<?php get_footer(); ?>