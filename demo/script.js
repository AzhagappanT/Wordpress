// Demo Banking App Script

// Sample transaction data (expanded)
const allTransactions = [
    { id: 1, type: 'credit', from: 'Rajesh Kumar', to: 'You', amount: 50000, date: '2025-12-01 14:30', method: 'Account Transfer' },
    { id: 2, type: 'debit', from: 'You', to: 'Priya Sharma', amount: 15000, date: '2025-11-30 10:15', method: 'Mobile Transfer' },
    { id: 3, type: 'credit', from: 'Vijay Patel', to: 'You', amount: 30000, date: '2025-11-29 16:45', method: 'Email Transfer' },
    { id: 4, type: 'debit', from: 'You', to: 'Ananya Reddy', amount: 7500, date: '2025-11-28 13:20', method: 'Account Transfer' },
    { id: 5, type: 'credit', from: 'Karthik Iyer', to: 'You', amount: 25000, date: '2025-11-27 11:00', method: 'Mobile Transfer' },
    { id: 6, type: 'debit', from: 'You', to: 'Deepak Singh', amount: 12000, date: '2025-11-26 09:30', method: 'Email Transfer' },
    { id: 7, type: 'credit', from: 'Meera Nair', to: 'You', amount: 18000, date: '2025-11-25 15:45', method: 'Account Transfer' },
    { id: 8, type: 'debit', from: 'You', to: 'Arjun Menon', amount: 9500, date: '2025-11-24 12:00', method: 'Mobile Transfer' },
    { id: 9, type: 'credit', from: 'Sanjay Gupta', to: 'You', amount: 22000, date: '2025-11-23 17:20', method: 'Email Transfer' },
    { id: 10, type: 'debit', from: 'You', to: 'Lakshmi Krishnan', amount: 8500, date: '2025-11-22 10:40', method: 'Account Transfer' },
    { id: 11, type: 'credit', from: 'Arun Kumar', to: 'You', amount: 35000, date: '2025-11-21 14:15', method: 'Mobile Transfer' },
    { id: 12, type: 'debit', from: 'You', to: 'Divya Rao', amount: 11000, date: '2025-11-20 11:30', method: 'Email Transfer' },
    { id: 13, type: 'credit', from: 'Ramesh Babu', to: 'You', amount: 28000, date: '2025-11-19 16:00', method: 'Account Transfer' },
    { id: 14, type: 'debit', from: 'You', to: 'Kavya Patel', amount: 6500, date: '2025-11-18 09:45', method: 'Mobile Transfer' },
    { id: 15, type: 'credit', from: 'Suresh Reddy', to: 'You', amount: 19000, date: '2025-11-17 13:25', method: 'Email Transfer' },
    { id: 16, type: 'debit', from: 'You', to: 'Pooja Sharma', amount: 14000, date: '2025-11-16 10:10', method: 'Account Transfer' },
    { id: 17, type: 'credit', from: 'Niranjan Singh', to: 'You', amount: 27000, date: '2025-11-15 15:30', method: 'Mobile Transfer' },
    { id: 18, type: 'debit', from: 'You', to: 'Sneha Das', amount: 5500, date: '2025-11-14 12:50', method: 'Email Transfer' }
];

// Pagination settings
let currentPage = 1;
const itemsPerPage = 5;
let filteredTransactions = [...allTransactions];

// Format currency
function formatCurrency(amount) {
    return new Intl.NumberFormat('en-IN', { minimumFractionDigits: 2 }).format(amount);
}

// Format date
function formatDate(dateStr) {
    const date = new Date(dateStr);
    return date.toLocaleDateString('en-IN', { month: 'short', day: 'numeric', year: 'numeric' }) + ' ' +
        date.toLocaleTimeString('en-IN', { hour: '2-digit', minute: '2-digit' });
}

// Render transactions
function renderTransactions() {
    const list = document.getElementById('transactions-list');
    if (!list) return;

    const start = (currentPage - 1) * itemsPerPage;
    const end = start + itemsPerPage;
    const pageTransactions = filteredTransactions.slice(start, end);

    list.innerHTML = '';

    pageTransactions.forEach(t => {
        const li = document.createElement('li');
        li.className = `transaction-item ${t.type}`;
        li.innerHTML = `
            <div>
                <strong>${t.type === 'credit' ? 'Received from ' + t.from : 'Sent to ' + t.to}</strong><br>
                <small>${formatDate(t.date)} • ${t.method}</small>
            </div>
            <div style="font-weight: bold;">
                ${t.type === 'credit' ? '+' : '-'}₹${formatCurrency(t.amount)}
            </div>
        `;
        list.appendChild(li);
    });

    renderPagination();
}

// Render pagination
function renderPagination() {
    const pagination = document.getElementById('pagination');
    if (!pagination) return;

    const totalPages = Math.ceil(filteredTransactions.length / itemsPerPage);

    if (totalPages <= 1) {
        pagination.innerHTML = '';
        return;
    }

    let html = '';

    // Previous button
    html += `<button class="page-btn" ${currentPage === 1 ? 'disabled' : ''} onclick="changePage(${currentPage - 1})">‹ Prev</button>`;

    // Page numbers
    for (let i = 1; i <= totalPages; i++) {
        if (i === 1 || i === totalPages || (i >= currentPage - 1 && i <= currentPage + 1)) {
            html += `<button class="page-btn ${i === currentPage ? 'active' : ''}" onclick="changePage(${i})">${i}</button>`;
        } else if (i === currentPage - 2 || i === currentPage + 2) {
            html += `<span class="page-dots">...</span>`;
        }
    }

    // Next button
    html += `<button class="page-btn" ${currentPage === totalPages ? 'disabled' : ''} onclick="changePage(${currentPage + 1})">Next ›</button>`;

    pagination.innerHTML = html;
}

// Change page
function changePage(page) {
    const totalPages = Math.ceil(filteredTransactions.length / itemsPerPage);
    if (page < 1 || page > totalPages) return;
    currentPage = page;
    renderTransactions();
}

// Filter transactions
function filterTransactions() {
    const typeFilter = document.getElementById('filter-type')?.value || 'all';
    const periodFilter = document.getElementById('filter-period')?.value || 'all';

    filteredTransactions = allTransactions.filter(t => {
        // Type filter
        if (typeFilter !== 'all' && t.type !== typeFilter) return false;

        // Period filter
        if (periodFilter !== 'all') {
            const tDate = new Date(t.date);
            const now = new Date();
            const daysDiff = Math.floor((now - tDate) / (1000 * 60 * 60 * 24));

            if (periodFilter === 'week' && daysDiff > 7) return false;
            if (periodFilter === 'month' && daysDiff > 30) return false;
        }

        return true;
    });

    currentPage = 1;
    renderTransactions();
}

// Tab switching
document.addEventListener('DOMContentLoaded', function () {
    // Initialize transactions page
    if (document.getElementById('transactions-list')) {
        renderTransactions();

        document.getElementById('filter-type')?.addEventListener('change', filterTransactions);
        document.getElementById('filter-period')?.addEventListener('change', filterTransactions);
    }

    // Tab switching for transfer page
    const tabBtns = document.querySelectorAll('.tab-btn');
    const tabContents = document.querySelectorAll('.tab-content');

    tabBtns.forEach(btn => {
        btn.addEventListener('click', function () {
            const tab = this.dataset.tab;

            tabBtns.forEach(b => b.classList.remove('active'));
            tabContents.forEach(c => c.classList.remove('active'));

            this.classList.add('active');
            document.getElementById(`transfer-${tab}-form`).classList.add('active');
        });
    });
});

// Handle Login Form
const loginForm = document.getElementById('banking-login-form');
if (loginForm) {
    loginForm.addEventListener('submit', function (e) {
        e.preventDefault();

        const username = document.getElementById('username').value;
        const password = document.getElementById('password').value;
        const message = document.getElementById('login-message');

        if (username === 'demo' && password === 'demo') {
            message.className = 'alert alert-success';
            message.textContent = 'Login successful! Redirecting...';
            message.style.display = 'block';

            setTimeout(() => {
                window.location.href = 'dashboard.html';
            }, 1000);
        } else {
            message.className = 'alert alert-danger';
            message.textContent = 'Invalid username or password.';
            message.style.display = 'block';
        }
    });
}

// Handle Transfer Forms
function setupTransferForm(formId, recipientField) {
    const form = document.getElementById(formId);
    if (!form) return;

    form.addEventListener('submit', function (e) {
        e.preventDefault();

        const message = document.getElementById('transfer-message');
        const amountInput = this.querySelector('input[name="amount"]');
        const amount = parseFloat(amountInput.value);
        const balanceElement = document.getElementById('balance');
        const currentBalance = parseFloat(balanceElement.textContent.replace(/,/g, ''));
        const recipient = this.querySelector(`[name="${recipientField}"]`).value;

        if (amount <= 0) {
            message.className = 'alert alert-danger';
            message.textContent = 'Invalid amount.';
            message.style.display = 'block';
            return;
        }

        if (amount > currentBalance) {
            message.className = 'alert alert-danger';
            message.textContent = 'Insufficient funds.';
            message.style.display = 'block';
            return;
        }

        // Simulate transfer
        const newBalance = currentBalance - amount;
        balanceElement.textContent = formatCurrency(newBalance);

        message.className = 'alert alert-success';
        message.textContent = `Transfer successful! ₹${formatCurrency(amount)} sent to ${recipient}`;
        message.style.display = 'block';

        form.reset();

        setTimeout(() => {
            message.style.display = 'none';
        }, 3000);
    });
}

setupTransferForm('transfer-account-form', 'account_holder_name');
setupTransferForm('transfer-mobile-form', 'mobile_number');


// Premium UI Enhancements (Vanilla JS)
document.addEventListener('DOMContentLoaded', function () {
    const cards = document.querySelectorAll('.banking-card');
    cards.forEach(card => {
        card.addEventListener('mouseenter', () => card.classList.add('hovered'));
        card.addEventListener('mouseleave', () => card.classList.remove('hovered'));
    });
});
