<template>
  <router-link to="/" class="logo">
    <img src="/img/logo3.png" alt="BOOK CLOUD Logo">
  </router-link>
  <div class="container">
    <div class="form-box">
      <h2>Create Account</h2>
      <p>Getting started is easy</p>
      <form id="registrationForm" @submit.prevent="registerUser">
        <div class="form-group">
          <input type="text" v-model="fullname" placeholder="Full Name" required>
        </div>
        <div class="form-group">
          <input type="email" v-model="email" placeholder="Email" required>
        </div>
        <div class="form-group">
          <input type="number" v-model="studentid" placeholder="Student ID" required>
        </div>
        <div class="form-group">
          <input type="text" v-model="courseSection" placeholder="Course & Section" required>
        </div>
        <div class="form-group">
          <select v-model="gender" required>
            <option value="">Select Gender</option>
            <option value="Male">Male</option>
            <option value="Female">Female</option>
            <option value="Other">Other</option>
          </select>
        </div>
        <div class="form-group">
          <div class="password-container">
            <input :type="passwordVisible ? 'text' : 'password'" v-model="password" placeholder="Password" required>
            <span class="toggle-password" @click="togglePasswordVisibility('password')">
              <i class="fas fa-eye"></i>
            </span>
          </div>
        </div>
        <div class="form-group">
          <div class="password-container">
            <input :type="confirmPasswordVisible ? 'text' : 'password'" v-model="confirmPassword" placeholder="Confirm Password" required>
            <span class="toggle-password" @click="togglePasswordVisibility('confirmPassword')">
              <i class="fas fa-eye"></i>
            </span>
          </div>
        </div>
        <p class="sign_up">Already have an account? <router-link to="/login">Login</router-link></p>
        <div class="form-group">
          <button :disabled="isLoading" type="submit">
            {{ isLoading ? 'Registering...' : 'Create Account' }}
          </button>
        </div>
        <p id="registrationErrorMessage">{{ registrationMessage }}</p>
      </form>
    </div>
  </div>
</template>

<script>
import axios from 'axios';

export default {
  data() {
    return {
      fullname: '',
      email: '',
      studentid: '',
      courseSection: '',
      gender: '',
      password: '',
      confirmPassword: '',
      registrationMessage: '',
      passwordVisible: false,
      confirmPasswordVisible: false,
      isLoading: false,
    };
  },

  methods: {
    async registerUser() {
  if (this.password !== this.confirmPassword) {
    this.registrationMessage = 'Passwords do not match!';
    return;
  }
  const userData = {
    fullname: this.fullname,
    email: this.email,
    studentid: this.studentid,
    courseSection: this.courseSection,
    gender: this.gender,
    password: this.password,
    password_confirmation: this.confirmPassword,
  };
  this.isLoading = true;
  try {
    // Use the correct endpoint here
    const response = await axios.post('/register', userData);
    
    if (response.status === 200) {
      this.registrationMessage = 'Registration successful!';
      setTimeout(() => {
        this.$router.push('/login');
      }, 2000);
    }
  } catch (error) {
    if (error.response && error.response.data.error) {
      this.registrationMessage = Object.values(error.response.data.error).join(', ');
    } else {
      this.registrationMessage = 'An error occurred. Please try again.';
    }
  } finally {
    this.isLoading = false;
  }
}
  }
}
</script>

<style scoped>
@import "/public/css/enter.css";

.form-group {
  margin-bottom: 15px;
}

input, select {
  width: 100%;
  padding: 10px;
  font-size: 16px;
  border-radius: 5px;
  border: 1px solid #ccc;
}

button {
  width: 100%;
  padding: 10px;
  background-color: #007bff;
  color: white;
  border: none;
  border-radius: 5px;
  cursor: pointer;
}

button:hover {
  background-color: #0056b3;
}

button:disabled {
  background-color: #a9a9a9;
  cursor: not-allowed;
}

.password-container {
  position: relative;
}

.toggle-password {
  position: absolute;
  right: 10px;
  top: 50%;
  transform: translateY(-50%);
  cursor: pointer;
}

#registrationErrorMessage {
  color: red;
  text-align: center;
}

.sign_up {
  text-align: center;
  margin-top: 10px;
}
</style>
