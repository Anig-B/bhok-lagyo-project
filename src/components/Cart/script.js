document.addEventListener('DOMContentLoaded', () => {
    const cartTable = document.querySelector('.cart-table');
    const subtotalElement = document.getElementById('subtotal');
    const deliveryElement = document.getElementById('delivery');
    const totalElement = document.getElementById('total');

    // Function to update totals
    const updateTotals = () => {
        let subtotal = 0;
        cartTable.querySelectorAll('tbody tr').forEach(row => {
            const quantity = parseInt(row.querySelector('input').value);
            const unitPrice = parseFloat(row.querySelector('td:nth-child(3)').textContent.replace('Rs. ', ''));
            const total = quantity * unitPrice;
            row.querySelector('td:nth-child(4)').textContent = `Rs. ${total.toFixed(2)}`;
            subtotal += total;
        });

        const deliveryCharge = 100;
        const grandTotal = subtotal + deliveryCharge;

        subtotalElement.textContent = `Rs. ${subtotal.toFixed(2)}`;
        deliveryElement.textContent = `Rs. ${deliveryCharge.toFixed(2)}`;
        totalElement.textContent = `Rs. ${grandTotal.toFixed(2)}`;
    };
    // Initial update of totals
    updateTotals();

    // Event listener for input changes
    cartTable.querySelectorAll('input').forEach(input => {
        input.addEventListener('input', updateTotals);
    });

    // Event delegation for delete buttons
    cartTable.addEventListener('click', event => {
        if (event.target.classList.contains('delete-item')) {
            const row = event.target.closest('tr');
            const itemName = row.querySelector('td:first-child').textContent.trim();
            if (confirm(`Are you sure you want to delete "${itemName}" from your cart?`)) {
                row.remove();
                updateTotals();
            }
        }
    });


});
