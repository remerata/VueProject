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


  <main class="main">
    <div class="scrollable-content">
      <div class="receipt-form">
        <h2>Create Receipt</h2>
        <form @submit.prevent="createReceipt">
          <!-- Borrower Information Section -->
          <label for="borrowerName">Borrower Name:</label>
          <input type="text" v-model="borrowerName" required>

          <label for="phone">Phone Number:</label>
          <input type="tel" v-model="phone" required>

          <!-- Book Information Section -->
          <label for="bookTitle">Book Title:</label>
          <input type="text" v-model="bookTitle" required>

          <label for="isbn">ISBN:</label>
          <input type="text" v-model="isbn" required>

          <label for="borrowDate">Borrow Date:</label>
          <input type="date" v-model="borrowDate" required>

          <label for="dueDate">Return Date:</label>
          <input type="date" v-model="dueDate" required>

          <label for="quantity">Quantity:</label>
          <input type="number" v-model="quantity" min="1" required>

          <button type="submit">Create Receipt</button>
        </form>
      </div>
    </div>
  </main>
</template>

<script>
import axios from 'axios';

export default {
  data() {
    return {
      borrowerName: '',
      phone: '',
      bookTitle: '',
      isbn: '',
      borrowDate: '',
      dueDate: '',
      quantity: 1,
      receiptMessage: '',
    };
  },
  methods: {
    async createReceipt() {
      const receiptData = {
        borrower_name: this.borrowerName,
        phone: this.phone,
        book_title: this.bookTitle,
        isbn: this.isbn,
        borrow_date: this.borrowDate,
        due_date: this.dueDate,
        quantity: this.quantity,
      };

      try {
        const response = await axios.post('/receipts', receiptData);
        this.receiptMessage = response.data.message;

        // Reset form after successful submission
        this.borrowerName = '';
        this.phone = '';
        this.bookTitle = '';
        this.isbn = '';
        this.borrowDate = '';
        this.dueDate = '';
        this.quantity = 1;

        alert('Receipt created successfully!');
      } catch (error) {
        console.error(error);
        this.receiptMessage = 'An error occurred while creating the receipt.';
      }
    }
  }
};
</script>

<style scoped>
@import "/public/css/admin.css";
* {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
    }

    body {
      font-family: Arial, sans-serif;
    }

    /* Sidebar Styles */


    /* Main Content Styles */
    .main {
      margin-left: 260px; /* To offset for the fixed sidebar */
      padding: 20px;
    }

    /* Make the form container scrollable */
    .scrollable-content {
      max-height: 90vh; /* Adjust this to fit within the screen */
      overflow-y: auto;
      padding-right: 0;
    }

    .receipt-form {
      width: 100%;
      max-width: 600px;
      margin: 20px auto;
      padding: 20px;
      border-radius: 8px;
      border: 1px solid #ccc;
    }

    .receipt-form h2 {
      text-align: center;
      margin-bottom: 20px;
      font-size: 24px;
    }

    .receipt-form label {
      display: block;
      margin-bottom: 5px;
      font-weight: bold;
    }

    .receipt-form input, .receipt-form select {
      width: 100%;
      padding: 10px;
      font-size: 16px;
      border: 1px solid #ccc;
      border-radius: 4px;
      margin-bottom: 10px;
    }

    .receipt-form button {
      width: 100%;
      padding: 10px;
      background-color: #007bff;
      color: #fff;
      font-size: 18px;
      border: none;
      border-radius: 4px;
      cursor: pointer;
      margin-top: 20px;
    }

    .receipt-form button:hover {
      background-color: #0056b3;
    }

</style>
