// document.addEventListener('DOMContentLoaded', () => {
//     const cartTable = document.querySelector('.cart-table');
//     const subtotalElement = document.getElementById('subtotal');
//     const deliveryElement = document.getElementById('delivery');
//     const totalElement = document.getElementById('total');

//     // Function to update totals
//     const updateTotals = () => {
//         let subtotal = 0;
//         cartTable.querySelectorAll('tbody tr').forEach(row => {
//             const quantity = parseInt(row.querySelector('input').value);
//             const unitPrice = parseFloat(row.querySelector('td:nth-child(3)').textContent.replace('Rs. ', ''));
//             const total = quantity * unitPrice;
//             row.querySelector('td:nth-child(4)').textContent = `Rs. ${total.toFixed(2)}`;
//             subtotal += total;
//         });

//         const deliveryCharge = 100;
//         const grandTotal = subtotal + deliveryCharge;

//         subtotalElement.textContent = `Rs. ${subtotal.toFixed(2)}`;
//         deliveryElement.textContent = `Rs. ${deliveryCharge.toFixed(2)}`;
//         totalElement.textContent = `Rs. ${grandTotal.toFixed(2)}`;
//     };
//     // Initial update of totals
//     updateTotals();

//     // Event listener for input changes
//     cartTable.querySelectorAll('input').forEach(input => {
//         input.addEventListener('input', updateTotals);
//     });

//     // Event delegation for delete buttons
//     cartTable.addEventListener('click', event => {
//         if (event.target.classList.contains('delete-item')) {
//             const row = event.target.closest('tr');
//             const itemName = row.querySelector('td:first-child').textContent.trim();
//             if (confirm(`Are you sure you want to delete "${itemName}" from your cart?`)) {
//                 row.remove();
//                 updateTotals();
//             }
//         }
//     });

// });
document.addEventListener("DOMContentLoaded", function () {
  const deleteButtons = document.querySelectorAll(".delete-item");

  // Function to get a cookie
  function getCookie(name) {
    const nameEQ = name + "=";
    const ca = document.cookie.split(";");
    for (let i = 0; i < ca.length; i++) {
      let c = ca[i];
      while (c.charAt(0) === " ") c = c.substring(1, c.length);
      if (c.indexOf(nameEQ) === 0) return c.substring(nameEQ.length, c.length);
    }
    return null;
  }

  // Function to set a cookie
  function setCookie(name, value, days) {
    const date = new Date();
    date.setTime(date.getTime() + days * 24 * 60 * 60 * 1000);
    const expires = "expires=" + date.toUTCString();
    document.cookie =
      name + "=" + JSON.stringify(value) + ";" + expires + ";path=/";
  }

  // Function to update the cart cookie
  function updateCartCookie(cartData) {
    setCookie("cartData", cartData, 1);
  }

  // Event listener for delete buttons
  deleteButtons.forEach((button) => {
    button.addEventListener("click", function () {
      const row = button.closest("tr");
      const itemName = button.getAttribute("data-name");

      // Remove the row from the table
      row.parentNode.removeChild(row);

      // Update the cart data in the cookie
      const cartData = JSON.parse(getCookie("cartData")) || [];
      const updatedCartData = cartData.filter((item) => item.name !== itemName);
      updateCartCookie(updatedCartData);

      // Update the displayed subtotal and total (optional)
      let subtotal = 0;
      updatedCartData.forEach((item) => {
        subtotal += item.total;
      });
      document.getElementById("subtotal").textContent = "Rs. " + subtotal;
      const deliveryCharge = 100; // example delivery charge
      document.getElementById("total-1").textContent =
        "Rs. " + (subtotal + deliveryCharge);
    });
  });
});
