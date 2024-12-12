<template>
     <nav class="sidebar">
      <router-link to="/" class="logo">
        <img src="/img/logo2.png" alt="BOOK CLOUD Logo">
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
  <div class="main">
    <table border="1" id="receiptTable">
      <thead>
        <tr>
          <th>Receipt ID</th>
          <th>Borrower Name</th>
          <th>Book Title</th>
          <th>ISBN</th>
          <th>Borrow Date</th>
          <th>Due Date</th>
          <th>Return Date</th>
          <th>Actions</th>
        </tr>
      </thead>
      <tbody>
        <tr v-if="receipts.length === 0">
          <td colspan="8">No receipts found</td>
        </tr>
        <tr v-for="(receipt, index) in receipts" :key="index">
          <td>{{ receipt.id }}</td>
          <td>{{ receipt.borrowerName }}</td>
          <td>{{ receipt.bookTitle }}</td>
          <td>{{ receipt.ISBN }}</td>
          <td>{{ receipt.borrowDate }}</td>
          <td>{{ receipt.dueDate }}</td>
          <td>
            <span v-if="receipt.returnDate">{{ receipt.returnDate }}</span>
            <button v-else @click="markAsReturned(index)">Return</button>
          </td>
          <td>
            <button @click="deleteReceipt(index)">Delete</button>
          </td>
        </tr>
      </tbody>
    </table>
  </div>
</template>

<script>
export default {
  data() {
    return {
      receipts: [
        { id: 'R001', borrowerName: 'John Doe', bookTitle: 'The Great Gatsby', ISBN: '1234567890', borrowDate: '2024-11-01', dueDate: '2024-11-15', returnDate: '' },
        { id: 'R002', borrowerName: 'Jane Smith', bookTitle: '1984', ISBN: '9876543210', borrowDate: '2024-11-05', dueDate: '2024-11-20', returnDate: '' },
        // Add more static data as needed
      ]
    };
  },
  methods: {
    // Mark an item as returned and update the return date
    markAsReturned(index) {
      const returnDate = new Date().toLocaleString();
      this.receipts[index].returnDate = returnDate; // Update the return date
    },
    // Delete a receipt instantly from the table
    deleteReceipt(index) {
      this.receipts.splice(index, 1); // Remove the receipt from the array
    }
  }
};
</script>  
  <style scoped>
  @import "/public/css/admin.css";
  
  </style>
  