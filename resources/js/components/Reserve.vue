<template>
  <div class="container">
    <nav class="sidebar">
      <router-link to="/" class="logo">
        <img src="/img/logo2.png" alt="BOOK CLOUD Logo" />
      </router-link>

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

    <!-- Main Content Area -->
    <div class="main-content">
      <center>
        <h1>Reserve Books</h1>
        <!-- Reserve Item Table -->
        <table>
          <thead>
            <tr>
              <th>Book Title</th>
              <th>Author</th>
              <th>Availability</th>
              <th>Reserve</th>
            </tr>
          </thead>
          <tbody>
            <tr v-for="book in books" :key="book.id">
              <td>{{ book.title }}</td>
              <td>{{ book.author }}</td>
              <td>{{ book.availability }}</td>
              <td>
                <button 
                  v-if="book.availability === 'Available'" 
                  @click="reserveBook(book)">
                  Reserve
                </button>
                <button 
                  v-else
                  disabled>
                  Not Available
                </button>
              </td>
            </tr>
          </tbody>
        </table>
      </center>
    </div>
  </div>
</template>

<script>
export default {
  name: 'Reserve',
  data() {
    return {
      books: [
        { id: 1, title: "Book A", author: "Author A", availability: "Available" },
        { id: 2, title: "Book B", author: "Author B", availability: "Available" },
        { id: 3, title: "Book C", author: "Author C", availability: "Reserved" },
        { id: 4, title: "Book D", author: "Author D", availability: "Not Available" }
      ]
    };
  },
  methods: {
    reserveBook(book) {
      book.availability = "Reserved";
      alert(`${book.title} has been reserved successfully.`);
    }
  }
};
</script>

<style scoped>
@import "/public/css/admin.css";

/* Container to handle layout */
.container {
  display: flex;
  flex-direction: row;
  width: 100%;
  height: 100vh;
}



/* Main content area */
.main-content {
  margin-left: 250px;  /* Same width as sidebar */
  padding: 20px;
  width: calc(100% - 250px); /* Adjust width to accommodate sidebar */
  overflow: auto;
  background-image: url('/img/background.jpg');
  background-size: cover;
}

/* Table Styles */
table {
  width: 100%;
  margin-top: 20px;
  border-collapse: collapse;
}

th, td {
  padding: 12px;
  text-align: left;
}

th {
  background-color: #f4f4f4;
}

td button {
  padding: 8px 16px;
  background-color: #28a745;
  color: white;
  border: none;
  border-radius: 5px;
  cursor: pointer;
}

td button:disabled {
  background-color: #ccc;
}

td button:hover {
  background-color: #218838;
}
</style>
