# Manual Test Steps for WordPress Banking Application

## 1. Environment Setup
- [ ] Ensure Local WP Server is running: `wp server --port=8000`
- [ ] Log in as an administrator/user at `http://localhost:8000/wp-login.php`

## 2. Dashboard UI Verification
- [ ] Navigate to `http://localhost:8000/custom-dashboard` (or page with `[banking_dashboard]` shortcode)
- [ ] **Verify Premium UI**:
    - [ ] Cards have glassmorphism effect (semi-transparent white, blur).
    - [ ] Buttons have gradient colors (blue to dark blue).
    - [ ] Typography is clear and uses theme colors.
- [ ] **Verify Data Display**:
    - [ ] Account Number is masked (e.g., XXXX-XXXX-1234).
    - [ ] Balance is displayed correctly with currency symbol (₹).
    - [ ] Recent transactions list is visible (or "No transactions found" message).

## 3. Transaction Functionality
- [ ] **Quick Transfer**:
    - [ ] Click "Transfer Money" button.
    - [ ] Verify it redirects to the transfer page (or opens modal if implemented).
    - [ ] Complete a transfer of ₹100.
    - [ ] Return to Dashboard.
    - [ ] **Verify Balance Update**: Balance should decrease by ₹100.
    - [ ] **Verify Transaction Log**: New debit transaction should appear in the list.

## 4. Responsive Design
- [ ] Resize browser window to mobile width (approx 375px).
- [ ] Verify cards stack vertically.
- [ ] Verify text is readable and buttons are clickable.

## 5. Error Handling
- [ ] Attempt to transfer more than current balance.
- [ ] Verify error message appears (e.g., "Insufficient funds").
