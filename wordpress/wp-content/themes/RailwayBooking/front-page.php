<?php get_header(); ?>

<div class="hero-section" style="text-align:center; padding:50px 0;">
    <h2>Welcome to Railway Ticket Booking</h2>
    <p>Find and book trains easily.</p>

    <div class="booking-form" style="max-width:500px; margin:0 auto;">
        <h3>Search Trains</h3>
        <form action="<?php echo home_url('/'); ?>" method="get">
            <input type="hidden" name="post_type" value="train">

            <div class="form-group">
                <label for="source">Source Station</label>
                <input type="text" name="source" id="source" placeholder="Enter Source (e.g. Chennai)" required>
            </div>

            <div class="form-group">
                <label for="destination">Destination Station</label>
                <input type="text" name="destination" id="destination" placeholder="Enter Destination (e.g. Bangalore)"
                    required>
            </div>

            <div class="form-group">
                <label for="date">Date of Journey</label>
                <input type="date" name="journey_date" id="date" required>
            </div>

            <button type="submit" class="btn">Search Trains</button>
        </form>
    </div>
</div>

<?php get_footer(); ?>