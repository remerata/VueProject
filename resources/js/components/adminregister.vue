<template>
  <router-link to="/" class="logo">
      <img src="/img/logo3.png" alt="BOOK CLOUD Logo">
  </router-link>
  <div class="container">
      <div class="form-box">
          <h2>Create Admin Account</h2>
          <p>Getting started is easy</p>
          <form id="registrationForm" @submit.prevent="registerAdmin">
              <div class="form-group">
                  <input type="text" v-model="fullname" placeholder="Full Name" required>
              </div>
              <div class="form-group">
                  <input type="email" v-model="email" placeholder="Email" required>
              </div>
              <div class="form-group">
                  <div class="password-container">
                      <input :type="passwordVisible ? 'text' : 'password'" v-model="password" placeholder="Password" required>
                      <span class="toggle-password" @click="togglePasswordVisibility">
                          <i class="fas fa-eye"></i>
                      </span>
                  </div>
              </div>
              <div class="form-group">
                  <div class="password-container">
                      <input :type="confirmPasswordVisible ? 'text' : 'password'" v-model="confirmPassword" placeholder="Confirm Password" required>
                      <span class="toggle-password" @click="toggleConfirmPasswordVisibility">
                          <i class="fas fa-eye"></i>
                      </span>
                  </div>
              </div>
              <p class="sign_up">Already have an account? <router-link to="/admin-login">Login</router-link></p>
              <div class="form-group">
                  <button type="submit" :disabled="isLoading">
                      {{ isLoading ? 'Creating Account...' : 'Create Account' }}
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
    password: '',
    confirmPassword: '',
    registrationMessage: '',
    isLoading: false,
    passwordVisible: false,
    confirmPasswordVisible: false,
  };
},
methods: {
  togglePasswordVisibility() {
    this.passwordVisible = !this.passwordVisible;
  },
  toggleConfirmPasswordVisibility() {
    this.confirmPasswordVisible = !this.confirmPasswordVisible;
  },
  async registerAdmin() {
    if (this.password !== this.confirmPassword) {
      this.registrationMessage = 'Passwords do not match!';
      return;
    }

    const adminData = {
      fullname: this.fullname,
      email: this.email,
      password: this.password,
    };

    try {
      this.isLoading = true;
      const response = await axios.post('/admin-register', adminData);
      this.registrationMessage = response.data.message;

      setTimeout(() => {
        this.$router.push('/admin-login');
      }, 2000);
    } catch (error) {
      this.registrationMessage = error.response?.data?.error || 'An error occurred during registration.';
    } finally {
      this.isLoading = false;
    }
  },
},
};
</script>

<style scoped>
@import "/public/css/enter.css";
</style>
