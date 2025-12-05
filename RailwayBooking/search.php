<?php get_header(); ?>

<div class="container">
    <h2>Search Results</h2>

    <?php
    // Custom Search Logic
    $source = isset($_GET['source']) ? sanitize_text_field($_GET['source']) : '';
    $destination = isset($_GET['destination']) ? sanitize_text_field($_GET['destination']) : '';

    if ($source && $destination) {
        $args = array(
            'post_type' => 'train',
            'meta_query' => array(
                'relation' => 'AND',
                array(
                    'key' => 'source_station',
                    'value' => $source,
                    'compare' => 'LIKE'
                ),
                array(
                    'key' => 'destination_station',
                    'value' => $destination,
                    'compare' => 'LIKE'
                )
            )
        );
        $query = new WP_Query($args);

        if ($query->have_posts()):
            echo '<div class="train-list">';
            while ($query->have_posts()):
                $query->the_post();
                $train_number = get_post_meta(get_the_ID(), 'train_number', true);
                $departure = get_post_meta(get_the_ID(), 'departure_time', true);
                $arrival = get_post_meta(get_the_ID(), 'arrival_time', true);
                $price = get_post_meta(get_the_ID(), 'ticket_price', true);
                ?>
                <div class="train-card"
                    style="background:#fff; padding:20px; margin-bottom:20px; border-radius:8px; box-shadow:0 2px 4px rgba(0,0,0,0.1); display:flex; justify-content:space-between; align-items:center;">
                    <div>
                        <h3><?php the_title(); ?> (<?php echo esc_html($train_number); ?>)</h3>
                        <p><strong><?php echo esc_html($departure); ?></strong> ➔ <strong><?php echo esc_html($arrival); ?></strong>
                        </p>
                        <p>Price: ₹<?php echo esc_html($price); ?></p>
                    </div>
                    <a href="<?php the_permalink(); ?>?date=<?php echo esc_attr($_GET['journey_date']); ?>" class="btn">Book Now</a>
                </div>
                <?php
            endwhile;
            echo '</div>';
            wp_reset_postdata();
        else:
            echo '<p>No trains found between ' . esc_html($source) . ' and ' . esc_html($destination) . '.</p>';
        endif;
    } else {
        echo '<p>Please perform a search from the homepage.</p>';
    }
    ?>
</div>

<?php get_footer(); ?>