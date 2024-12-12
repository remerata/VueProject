<template>
  <div>
    

    <!-- Main Content -->
    <main class="main">
      <!-- Search Bar -->
      <div class="search-bar">
        <img src="/img/icon.png" class="search-icon" alt="Search Icon">
        <input v-model="searchQuery" type="text" placeholder="Search..." />
      </div>

      <!-- Cards Section -->
      <div class="container">
        <div class="row px-2 mt-4 gap-3" id="filterable-cards">
          <div class="card p-0" v-for="card in filteredCards" :key="card.id" @click="openModal(card)">
            <img :src="card.image" alt="img" />
            <div class="card-body">
              <h6 class="card-title">{{ card.title }}</h6>
              <p class="card-text">{{ card.description }}</p>
            </div>
          </div>
        </div>
      </div>

      <!-- Modal -->
      <div v-if="isModalOpen" class="modal">
        <div class="modal-content">
          <span class="close" @click="closeModal">&times;</span>
          <h2>{{ selectedCard.title }}</h2>
          <form @submit.prevent="reserveBook">
          <label for="borrowerName">Borrower's Name:</label>
          <input type="text" v-model="borrowerName" id="borrowerName" required />
          <label for="phoneNumber">Phone Number:</label>
          <input type="text" v-model="phoneNumber" id="phoneNumber" required />
          <label for="borrowDate">Borrow Date:</label>
          <input type="date" v-model="borrowDate" id="borrowDate" required />
          <label for="returnDate">Return Date:</label>
          <input type="date" v-model="returnDate" id="returnDate" required />
        </form>
          <!-- Additional Card Details -->
          <button @click="reserveCard(selectedCard)">Reserve</button>
        </div>
      </div>
    </main>
  </div>
</template>

<script>
export default {
  data() {
    return {
      searchQuery: "",
      isModalOpen: false,
      selectedCard: null,
      cards: [
        { id: 1, title: "Mountains", description: "Lorem ipsum dolor..", image: "/img/nature-1.jpg" },
        { id: 2, title: "Lights", description: "Lorem ipsum dolor..", image: "/img/nature-2.jpg" },
        { id: 3, title: "Nature", description: "Lorem ipsum dolor..", image: "/img/nature-3.jpg" },
        { id: 4, title: "Retro Car", description: "Lorem ipsum dolor..", image: "/img/car-1.jpg" },
        { id: 5, title: "Fast Car", description: "Lorem ipsum dolor..", image: "/img/car-2.jpg" },
        { id: 6, title: "Classic Car", description: "Lorem ipsum dolor..", image: "/img/car-3.jpg" },
        { id: 7, title: "Men", description: "Lorem ipsum dolor..", image: "/img/people-1.jpg" },
        { id: 8, title: "Girl", description: "Lorem ipsum dolor..", image: "/img/people-2.jpg" }
      ]
    };
  },
  computed: {
    filteredCards() {
      return this.cards.filter(card =>
        card.title.toLowerCase().includes(this.searchQuery.toLowerCase())
      );
    }
  },
  methods: {
    openModal(card) {
      this.selectedCard = card;
      this.isModalOpen = true;
    },
    closeModal() {
      this.isModalOpen = false;
    },
    reserveCard(card) {
      alert(`${card.title} has been reserved successfully.`);
      this.closeModal();
    }
  }
};
</script>

<style scoped>
@import "/public/css/user.css";
.modal {
  display: block;
  position: fixed;
  z-index: 1;
  left: 0;
  top: 0;
  width: 100%;
  height: 100%;
  background-color: rgba(0, 0, 0, 0.4);
  display: flex;
  justify-content: center;
  align-items: center;
}

.modal-content {
  background-color: #fefefe;
  padding: 20px;
  border: 1px solid #888;
  max-width: 500px;
  width: 100%;
}

.close {
  color: #aaa;
  float: right;
  font-size: 28px;
  font-weight: bold;
  cursor: pointer;
}

.close:hover,
.close:focus {
  color: black;
  text-decoration: none;
  cursor: pointer;
}

.search-bar {
  margin-bottom: 20px;
  display: flex;
  align-items: center;
}

.search-icon {
  width: 20px;
  height: 20px;
  margin-right: 8px;
}


button {
  background-color: #28a745;
  color: white;
  padding: 10px;
  border-radius: 5px;
  border: none;
  cursor: pointer;
}

button:hover {
  background-color: #218838;
}
.container {
  display: flex;
  flex-wrap: wrap;
  gap: 1rem;
  justify-content: space-between;
}

.card {
  flex: 0 0 32%; /* 3 cards per row, accounting for the gap */
  border: 1px solid #ddd;
  border-radius: 8px;
  box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
  cursor: pointer;
  overflow: hidden;
  margin-bottom: 1rem;
  height: 300px;
  width: 600px;
  display: flex; /* Using flexbox to arrange image and text side by side */
}

.card img {
  width: 300px; /* Adjust image width */
  height: 100%;
  object-fit: cover; /* Ensures the image covers the area properly */
}

.card-body {
  padding: 15px;
  flex: 1; /* This ensures that the text takes up the remaining space */
  display: flex;
  flex-direction: column;
  justify-content: center; /* Centers the content vertically */
}

.card-title {
  font-size: 18px;
  margin: 0;
  font-weight: bold;
}

.card-text {
  font-size: 14px;
  color: #555;
}

</style>
