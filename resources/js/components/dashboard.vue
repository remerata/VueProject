<template>
  <div class="wrapper">
    <nav class="sidebar">
    <a href="#" class="logo">
      <img src="/img/logo2.png" alt="BOOK CLOUD Logo">
    </a>

    <div class="menu-content">
      <ul class="menu-items">
        <li class="item">
          <router-link to="/dashboard"><i class="fas fa-tachometer-alt"></i> Dashboard</router-link>
        </li>
        <li class="item">
          <router-link to="/available-books"><i class="fas fa-book"></i> Available Books</router-link>
        </li>
        <li class="item">
          <router-link to="/add-book"><i class="fas fa-plus"></i> Add Books</router-link>
        </li>
        <li class="item">
          <router-link to="/receipt"><i class="fas fa-file-invoice"></i> Book Receipt</router-link>
        </li>
        <li class="item">
          <router-link to="/receipt-history"><i class="fas fa-history"></i> Receipt History</router-link>
        </li>
        <li class="item">
          <router-link to="/student-list"><i class="fas fa-user-graduate"></i> Student List</router-link>
        </li>
        <li class="item">
          <router-link to="/reserve"><i class="fas fa-file-invoice"></i> Reserve Item</router-link>
        </li>
      </ul>
    </div>
  </nav>
    <div class="main-content">
      <div class="container">
        <h1>Dashboard</h1>

        <!-- Dashboard Cards Section -->
        <div class="dashboard-cards">
          <div class="card">
            <i class="fas fa-book"></i>
            <h3>Total Books</h3>
            <p>{{ totalBooks }}</p>
          </div>

          <div class="card">
            <i class="fas fa-file-invoice"></i>
            <h3>Total Book Receipts</h3>
            <p>{{ totalReceipts }}</p>
          </div>

          <div class="card">
            <i class="fas fa-undo-alt"></i>
            <h3>Total Returns</h3>
            <p>{{ totalReturns }}</p>
          </div>

          <div class="card">
            <i class="fas fa-user-check"></i>
            <h3>Total Logins Today</h3>
            <p>{{ totalLoginsToday }}</p>
          </div>
        </div>

        <!-- Logins by Month Section -->
        <div class="logins-chart">
          <h3>Total Logins by Month</h3>
          <canvas id="loginsChart"></canvas>
        </div>

        <!-- Top 5 Most Received Books Section -->
        <div class="top-receipts">
          <h3>Top 5 Most Received Books</h3>
          <table>
            <thead>
              <tr>
                <th>Book Title</th>
                <th>Receipt Count</th>
              </tr>
            </thead>
            <tbody>
              <tr v-for="book in topBooks" :key="book.title">
                <td>{{ book.title }}</td>
                <td>{{ book.count }}</td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import { ref, onMounted } from 'vue';
import Chart from 'chart.js/auto';

export default {
  name: 'Dashboard',
  setup() {
    // Reactive state
    const totalBooks = ref(150);
    const totalReceipts = ref(80);
    const totalReturns = ref(40);
    const totalLoginsToday = ref(10);

    const loginsData = ref({
      'Jan': 50,
      'Feb': 70,
      'Mar': 30,
      'Apr': 40,
    });

    const topBooks = ref([
      { title: 'Book A', count: 15 },
      { title: 'Book B', count: 10 },
      { title: 'Book C', count: 9 },
      { title: 'Book D', count: 8 },
      { title: 'Book E', count: 7 }
    ]);

    // Chart.js initialization
    onMounted(() => {
      const ctx = document.getElementById('loginsChart').getContext('2d');
      new Chart(ctx, {
        type: 'bar',
        data: {
          labels: Object.keys(loginsData.value),
          datasets: [{
            label: 'Logins by Month',
            data: Object.values(loginsData.value),
            backgroundColor: 'rgba(52, 152, 219, 0.7)',
            borderColor: 'rgba(52, 152, 219, 1)',
            borderWidth: 1
          }]
        },
        options: {
          scales: {
            y: { beginAtZero: true }
          }
        }
      });
    });

    return {
      totalBooks,
      totalReceipts,
      totalReturns,
      totalLoginsToday,
      topBooks
    };
  }
};
</script>

<style scoped>
@import "/public/css/admin.css";

.wrapper {
  display: flex;
  height: 100vh;
}

.sidebar .logo img {
  width: 100%;
  margin-bottom: 30px;
}

.menu-content .menu-items {
  list-style-type: none;
  padding: 0;
}

.menu-items .item {
  margin: 15px 0;
}

.menu-items .item a {
  color: white;
  text-decoration: none;
  padding: 10px;
  display: block;
  font-size: 18px;
}

.menu-items .item a:hover {
  background-color: #34495e;
}

.main-content {
  margin-left: 250px;
  padding: 40px;
  width: 100%;
  background-image: url('/img/background.jpg');
  background-size: cover;
  
}

.container {
  width: 100%;
  max-width: 1200px;
  margin: 0 auto;
}

h1 {
  font-size: 30px;
  color: #333;
  margin-bottom: 20px;
}

.dashboard-cards {
  display: flex;
  justify-content: space-between;
  flex-wrap: wrap;
  gap: 20px;
}

.card {
  background-color: #ffffff;
  border-radius: 12px;
  box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
  padding: 30px;
  width: calc(25% - 20px);
  position: relative;
  display: flex;
  flex-direction: column;
  align-items: center;
  text-align: center;
  transition: transform 0.3s ease, box-shadow 0.3s ease;
}

.card:hover {
  transform: translateY(-10px);
  box-shadow: 0 6px 18px rgba(0, 0, 0, 0.2);
}

.card h3 {
  font-size: 18px;
  margin-bottom: 10px;
  color: #333;
}

.card p {
  font-size: 28px;
  font-weight: bold;
  color: #3498db;
}

.card i {
  font-size: 3em;
  color: #3498db;
  margin-bottom: 15px;
}

.logins-chart, .top-receipts {
  margin-top: 40px;
  background-color: #fff;
  padding: 30px;
  border-radius: 12px;
  box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
}

.logins-chart h3, .top-receipts h3 {
  font-size: 20px;
  color: #333;
  margin-bottom: 20px;
}

.top-receipts table {
  width: 100%;
  border-collapse: collapse;
}

.top-receipts th, .top-receipts td {
  padding: 15px;
  text-align: left;
  border-bottom: 1px solid #ddd;
}

.top-receipts th {
  background-color: #f8f8f8;
}

.top-receipts tr:hover td {
  background-color: #f2f2f2;
}
</style>
