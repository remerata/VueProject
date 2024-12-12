<template>
  <div class="container">
    <h2>Student List</h2>
    <table>
      <thead>
        <tr>
          <th>Full Name</th>
          <th>Email</th>
          <th>Student ID</th>
          <th>Course & Section</th>
          <th>Gender</th>
        </tr>
      </thead>
      <tbody>
        <tr v-for="user in users" :key="user.id">
          <td>{{ user.fullname }}</td>
          <td>{{ user.email }}</td>
          <td>{{ user.studentid }}</td>
          <td>{{ user.courseSection }}</td>
          <td>{{ user.gender }}</td>
        </tr>
      </tbody>
    </table>
  </div>
</template>

<script>
import axios from 'axios';

export default {
  data() {
    return {
      users: [],
    };
  },

  created() {
    this.fetchUsers();
  },

  methods: {
    async fetchUsers() {
      try {
        const response = await axios.get('/api/users');
        this.users = response.data;
      } catch (error) {
        console.error('There was an error fetching the users:', error);
      }
    }
  }
}
</script>

<style scoped>
.container {
  padding: 20px;
}

table {
  width: 100%;
  border-collapse: collapse;
}

th, td {
  padding: 12px;
  border: 1px solid #ddd;
  text-align: left;
}

th {
  background-color: #f4f4f4;
}
</style>
