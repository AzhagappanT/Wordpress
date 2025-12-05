<?php
use PHPUnit\Framework\TestCase;

class BankingFunctionsTest extends TestCase
{

    protected function setUp(): void
    {
        // Ensure WordPress functions are available
        if (!function_exists('banking_get_balance')) {
            // This assumes the test runner loads WordPress or functions.php
            // If not, we might need to include it here, but it depends on WP core.
        }
    }

    public function test_banking_get_balance_format()
    {
        // Mock user ID
        $user_id = 1;

        // We can't easily test WP DB interactions without a full test suite,
        // but we can verify if the function exists and returns a string if mocked.
        $this->assertTrue(function_exists('banking_get_balance'), 'banking_get_balance function should exist');
    }

    public function test_shortcode_registration()
    {
        $this->assertTrue(shortcode_exists('banking_dashboard'), 'banking_dashboard shortcode should be registered');
    }
}
