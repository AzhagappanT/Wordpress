# A Bank - Banking Demo Application

A modern, feature-rich banking application demo built with HTML, CSS, and JavaScript.

## Features

- User Authentication with secure login
- Dashboard with account summary and balance
- Money Transfer via Account Number or Mobile Number
- Transaction History with pagination and filters
- Responsive Design for all devices
- Uses Indian Rupee (₹) currency

## How to Run

1. Open the `demo` folder
2. Double-click on `index.html`
3. The application will open in your browser

That's it! No installation needed.

## Login Details

- **Username:** demo
- **Password:** demo

## Project Structure

```
demo/
├── index.html          # Homepage
├── login.html          # Login page
├── dashboard.html      # User dashboard
├── transactions.html   # Transaction history
├── transfer.html       # Money transfer page
├── style.css          # Styles
└── script.js          # Application logic

BankingTheme/           # WordPress Theme (Banking Application)
├── style.css
├── functions.php
├── header.php
├── footer.php
├── index.php
├── assets/
└── page-templates/
```

## Features Overview

### Dashboard
- Account details (Account number, mobile)
- Current balance display
- Monthly statistics

### Transactions
- View 18 sample transactions
- Filter by type (Received/Sent)
- Filter by period (This Week/Month)
- 5 transactions per page

### Transfer Money
- Transfer to Account Number (with IFSC code)
- Transfer to Mobile Number
- Add optional remarks
- Balance validation

## Demo Account

- **Account Number:** XXXX-XXXX-6789
- **Account Type:** Savings Account
- **Mobile:** +91 98765-43210
- **Balance:** ₹1,00,000.00

## Customization

To customize:
- Bank name: Replace "A Bank" in all HTML files
- Colors: Edit CSS variables in `style.css`
- Transactions: Modify `allTransactions` array in `script.js`

---

**Created by:** Azhagappan  
**Bank:** A Bank  
**Version:** 1.0
