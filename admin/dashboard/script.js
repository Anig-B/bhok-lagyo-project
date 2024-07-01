document.getElementById("toggle-btn").addEventListener("click", function () {
  var sidebar = document.getElementById("sidebar");
  var mainContent = document.getElementById("main-content");
  var toggleBtnClosed = document.getElementById("toggle-btn-closed");
  sidebar.classList.toggle("closed");
  mainContent.classList.toggle("full-width");
  toggleBtnClosed.classList.toggle("visible");
});

document
  .getElementById("toggle-btn-closed")
  .addEventListener("click", function () {
    var sidebar = document.getElementById("sidebar");
    var mainContent = document.getElementById("main-content");
    var toggleBtnClosed = document.getElementById("toggle-btn-closed");
    sidebar.classList.toggle("closed");
    mainContent.classList.toggle("full-width");
    toggleBtnClosed.classList.toggle("visible");
  });

const orderData = {
  labels: ["January", "February", "March", "April", "May", "June"],
  datasets: [
    {
      label: "Orders",
      data: [65, 59, 80, 81, 56, 55],
      backgroundColor: "rgba(255, 117, 39, 0.2)",
      borderColor: "#FF7527",
      borderWidth: 1,
    },
  ],
};

const configOrders = {
  type: "line",
  data: orderData,
  options: {
    responsive: true,
    scales: {
      y: {
        beginAtZero: true,
      },
    },
  },
};

const ordersChart = new Chart(
  document.getElementById("ordersChart"),
  configOrders
);

const revenueData = {
  labels: ["January", "February", "March", "April", "May", "June"],
  datasets: [
    {
      label: "Revenue",
      data: [500, 600, 800, 700, 900, 750],
      backgroundColor: "rgba(54, 162, 235, 0.2)",
      borderColor: "rgba(54, 162, 235, 1)",
      borderWidth: 1,
    },
  ],
};

const configRevenue = {
  type: "line",
  data: revenueData,
  options: {
    responsive: true,
    scales: {
      y: {
        beginAtZero: true,
      },
    },
  },
};

const revenueChart = new Chart(
  document.getElementById("revenueChart"),
  configRevenue
);
