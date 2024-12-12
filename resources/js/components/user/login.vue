  <template>
      <router-link to="/" class="logo">
        <img src="/img/logo3.png" alt="BOOK CLOUD Logo">
      </router-link>
      <div class="container">
        <div class="form-box">
          <h2>Welcome back</h2>
          <p>Log into your account</p>
          <br>
          <form @submit.prevent="loginUser" id="loginForm">
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
            <p class="sign_up">Don't have an account? <router-link to="/register">Register</router-link></p>
            <div class="form-group">
              <button type="submit" :disabled="isLoading">
                {{ isLoading ? 'Logging in...' : 'Login' }}
              </button>
            </div>
            <p id="loginErrorMessage">{{ loginErrorMessage }}</p>
          </form>
        </div>
      </div>
    </template>
    
    <script>
  import axios from 'axios';

  export default {
    data() {
      return {
        email: '',
        password: '',
        loginErrorMessage: '',
        isLoading: false,
        password: '', // The password input
      passwordVisible: false,
      };
    },
    methods: {
      togglePasswordVisibility() {
      this.passwordVisible = !this.passwordVisible; // Toggle visibility
    },
      async loginUser() {
        this.isLoading = true;
        this.loginErrorMessage = '';

        const loginData = {
          email: this.email,
          password: this.password,
        };

        try {
          const response = await axios.post('/login', loginData);

          if (response.data.success) {
            const role = response.data.role;

            // Redirect based on the role
            if (role === 'admin') {
              this.$router.push('/dashboard'); // Redirect to admin dashboard
            } else {
              this.$router.push('/homepage'); // Redirect to user homepage
            }
          }
        } catch (error) {
          this.loginErrorMessage = 'Invalid credentials. Please try again.';
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
    