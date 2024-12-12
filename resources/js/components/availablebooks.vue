<template>
  <div>
    <!-- Sidebar content -->
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
      <div class="search-bar">
        <img src="/img/icon.png" class="search-icon" alt="Search Icon">
        <input type="text" v-model="searchQuery" placeholder="Search..." />
      </div>

      <table>
        <thead>
          <tr>
            <th><i>Title</i></th>
            <th><i>Author</i></th>
            <th><i>Publication Date</i></th>
            <th><i>Book ID</i></th>
            <th><i>Availability</i></th>
            <th><i>Actions</i></th>
          </tr>
        </thead>
        <tbody>
          <tr v-for="(book, index) in filteredBooks" :key="book.id">
            <td>{{ book.title }}</td>
            <td>{{ book.author }}</td>
            <td>{{ book.publicationDate }}</td>
            <td>{{ book.id }}</td>
            <td>{{ book.availability }}</td>
            <td><button @click="editBook(index)">Edit</button></td>
          </tr>
        </tbody>
      </table>
    </main>

    <!-- Modal for editing availability -->
    <div v-if="showModal" class="modal" @click.self="closeModal">
      <div class="modal-content">
        <h3>Edit Book Details</h3>
        <label for="editTitle">Title:</label>
        <input type="text" v-model="editBookData.title" id="editTitle">
        <label for="editAuthor">Author:</label>
        <input type="text" v-model="editBookData.author" id="editAuthor">
        <label for="availabilitySelect">Availability:</label>
        <select v-model="editBookData.availability" id="availabilitySelect">
          <option value="Available">Available</option>
          <option value="Reserved">Reserved</option>
          <option value="Not Available until">Not Available until</option>
        </select>
        <input type="date" v-if="editBookData.availability === 'Not Available until'" v-model="editBookData.availabilityDate" id="availabilityDate" />
        <button @click="saveBook">Save</button>
        <button @click="closeModal">Cancel</button>
        <button @click="deleteBook" class="delete-button">Delete Book</button>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  data() {
    return {
      searchQuery: '',
      books: [
        { title: 'Book Title 1', author: 'Author 1', publicationDate: '2023-10-01', id: '001', availability: 'Available' },
        { title: 'Book Title 2', author: 'Author 2', publicationDate: '2022-05-15', id: '002', availability: 'Reserved' },
        // Add more sample books here
      ],
      showModal: false,
      selectedBookIndex: null,
      editBookData: {
        title: '',
        author: '',
        availability: 'Available',
        availabilityDate: ''
      }
    };
  },
  computed: {
    filteredBooks() {
      return this.books.filter(book => {
        return book.title.toLowerCase().includes(this.searchQuery.toLowerCase());
      });
    }
  },
  methods: {
    editBook(index) {
      this.selectedBookIndex = index;
      const book = this.books[index];
      this.editBookData = { ...book, availabilityDate: book.availability.includes('until') ? book.availability.split('until ')[1] : '' };
      this.showModal = true;
    },
    saveBook() {
      if (this.editBookData.availability === 'Not Available until' && !this.editBookData.availabilityDate) {
        alert('Please select an availability date.');
        return;
      }
      this.books[this.selectedBookIndex] = { ...this.editBookData };
      this.closeModal();
    },
    deleteBook() {
      this.books.splice(this.selectedBookIndex, 1);
      this.closeModal();
    },
    closeModal() {
      this.showModal = false;
      this.editBookData = { title: '', author: '', availability: 'Available', availabilityDate: '' };
    }
  }
};
</script>

<style scoped>
@import "/public/css/admin.css";
/* General Styling */
body {
  font-family: Arial, sans-serif;
  margin: 0;
  padding: 0;
  display: flex;
}

.menu-items {
  list-style: none;
  padding: 0;
}

.menu-items .item {
  margin: 10px 0;
}

.menu-items .item a {
  color: #fff;
  text-decoration: none;
  display: flex;
  align-items: center;
}

.menu-items .item a i {
  margin-right: 10px;
}

.main {
  flex-grow: 1;
  padding: 20px;
}

.search-bar {
  display: flex;
  margin-bottom: 20px;
}

.search-bar input {
  flex-grow: 1;
  padding: 10px;
}

table {
  width: 100%;
  border-collapse: collapse;
}

table th, table td {
  padding: 10px;
  text-align: left;
  border: 1px solid #ddd;
}

table th {
  background-color: #f4f4f4;
}


.modal {
  display: block;
  position: fixed;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  background: rgba(0, 0, 0, 0.5);
  justify-content: center;
  align-items: center;
  display: flex; /* Ensure modal uses flexbox */
  z-index: 1000; /* Ensure the modal is on top of other content */
}

.modal-content {
  background: #fff;
  padding: 20px;
  border-radius: 8px;
  width: 300px;
  max-width: 100%; /* Prevents the modal from overflowing on small screens */
  box-sizing: border-box; /* Ensure padding is accounted for in width calculation */
  margin: auto; /* Center horizontally */
}


.modal-content label, .modal-content select, .modal-content input {
  display: block;
  width: 100%;
  margin-bottom: 10px;
}

.modal-content button {
  margin-top: 10px;
  padding: 10px;
  cursor: pointer;
}

.delete-button {
  background-color: #ff4c4c;
  color: #fff;
  border: none;
  width: 100%;
  padding: 10px;
  border-radius: 5px;
  cursor: pointer;
}

.delete-button:hover {
  background-color: #e60000;
}
</style>
