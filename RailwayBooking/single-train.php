<?php get_header(); ?>

<div class="container">
    <?php while (have_posts()):
        the_post();
        $train_number = get_post_meta(get_the_ID(), 'train_number', true);
        $price = get_post_meta(get_the_ID(), 'ticket_price', true);
        $journey_date = isset($_GET['date']) ? sanitize_text_field($_GET['date']) : date('Y-m-d');
        ?>
        <div class="booking-container" style="display:flex; gap:30px;">
            <div class="train-details" style="flex:1;">
                <h2>Book Ticket: <?php the_title(); ?></h2>
                <p><strong>Train Number:</strong> <?php echo esc_html($train_number); ?></p>
                <p><strong>Date:</strong> <?php echo esc_html($journey_date); ?></p>
                <p><strong>Price per Ticket:</strong> ₹<?php echo esc_html($price); ?></p>
                <div class="description">
                    <?php the_content(); ?>
                </div>
            </div>

            <div class="booking-form-wrapper" style="flex:1;">
                <div class="booking-form">
                    <h3>Passenger Details</h3>
                    <form method="post" action="">
                        <input type="hidden" name="train_id" value="<?php the_ID(); ?>">
                        <input type="hidden" name="journey_date" value="<?php echo esc_attr($journey_date); ?>">
                        <input type="hidden" name="action" value="book_ticket">

                        <div class="form-group">
                            <label for="passenger_name">Passenger Name</label>
                            <input type="text" name="passenger_name" required>
                        </div>

                        <div class="form-group">
                            <label for="passenger_age">Age</label>
                            <input type="number" name="passenger_age" required>
                        </div>

                        <div class="form-group">
                            <label for="seat_count">Number of Seats</label>
                            <input type="number" name="seat_count" value="1" min="1" max="6" required>
                        </div>

                        <button type="submit" name="submit_booking" class="btn">Confirm Booking</button>
                    </form>

                    <?php
                    if (isset($_POST['submit_booking'])) {
                        // Simple booking logic
                        $train_id = intval($_POST['train_id']);
                        $name = sanitize_text_field($_POST['passenger_name']);
                        $seats = intval($_POST['seat_count']);
                        $date = sanitize_text_field($_POST['journey_date']);

                        $pnr = 'PNR' . rand(100000, 999999);

                        $booking_id = wp_insert_post(array(
                            'post_type' => 'booking',
                            'post_title' => 'Booking ' . $pnr,
                            'post_status' => 'publish',
                        ));

                        if ($booking_id) {
                            update_post_meta($booking_id, 'pnr_number', $pnr);
                            update_post_meta($booking_id, 'train_id', $train_id);
                            update_post_meta($booking_id, 'passenger_name', $name);
                            update_post_meta($booking_id, 'journey_date', $date);
                            update_post_meta($booking_id, 'seat_count', $seats);
                            update_post_meta($booking_id, 'booking_status', 'Confirmed');

                            // Link to user if logged in
                            if (is_user_logged_in()) {
                                update_post_meta($booking_id, 'user_id', get_current_user_id());
                            }

                            echo '<div class="alert alert-success" style="margin-top:20px; color:green;">Booking Confirmed! PNR: <strong>' . $pnr . '</strong></div>';
                        }
                    }
                    ?>
                </div>
            </div>
        </div>
    <?php endwhile; ?>
</div>

<?php get_footer(); ?>