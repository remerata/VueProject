  <template>
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

    <main class="main">
      <div class="add-book-form">
        <h2>Add New Book</h2>
        <form @submit.prevent="handleAddBook">
          <div class="form-group">
            <label for="bookDescription">Book Tittle</label>

            <input v-model="title" id="title" type="text" placeholder="Title:" required />

          </div>

          <div class="form-group">
            <label for="bookDescription">Author</label>

            <input type="text" id="author" v-model="author" name="author" required />
          </div>

          <div class="form-group">
            <label for="bookDescription">Book ID</label>

            <input type="text" id="bookId" v-model="bookId" name="bookId" required />
          </div>
          <div class="form-group">
            <label for="bookDescription">Publication Date</label>

            <input type="date" id="publicationDate" v-model="publicationDate" name="publicationDate" required />
          </div>
              <!-- Description -->
          <div class="form-group">
            <label for="bookDescription">Book Description</label>
            <textarea id="bookDescription" v-model="description" name="description"></textarea>
          </div>

          <button type="submit">Add</button>
        </form>
      </div>
    </main>
  </template>

  <script>
  import axios from 'axios';

export default {
    data() {
        return {
            title: '',
            author: '',
            bookId: '',
            publicationDate: '',
            description: ''
        };
    },
    methods: {
    async handleAddBook() {
        try {
            const response = await axios.post('http://127.0.0.1:8000/add-book', {
                title: this.title,
                author: this.author,
                bookId: this.bookId,
                publicationDate: this.publicationDate,
                description: this.description
            });

            console.log(response.data);  // Book added successfully
        } catch (error) {
            console.error('Error adding book:', error);
        }
    }
}
};
  </script>

  <style scoped>
  @import "/public/css/admin.css";
  .add-book-form {
    max-width: 600px;
    margin: 20px auto;
    padding: 20px;
    border-radius: 8px;
  }

  .add-book-form h2 {
    text-align: center;
    margin-bottom: 20px;
    font-size: 24px;
  }
  .add-book-form {
    margin-bottom: 15px;
  margin-top: -20px;
  }
  .form-group {
    margin-bottom: 15px;
    background-color: #fff;

  }

  .add-book-form label {
    display: block;
    margin-bottom: 5px;
    font-weight: bold;
  }

  .add-book-form input, .add-book-form select, .add-book-form textarea {
    width: 100%;
    padding: 10px;
    font-size: 16px;
    border: 1px solid #ccc;
    border-radius: 4px;
  }

  .add-book-form textarea {
    resize: vertical;
    height: 100px;
  }

  .add-book-form button {
    width: 100%;
    padding: 10px;
    background-color: #007bff;
    color: #fff;
    font-size: 18px;
    border: none;
    border-radius: 4px;
    cursor: pointer;
  }

  .add-book-form button:hover {
    background-color: #0056b3;
  }
  </style>
