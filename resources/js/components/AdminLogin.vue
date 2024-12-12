<template>
    <router-link to="/" class="logo">
        <img src="/img/logo3.png" alt="BOOK CLOUD Logo">
    </router-link>
    <div class="container">
        <div class="form-box">
            <h2>Welcome back Admin!</h2>
            <p>Log into your account</p>
            <br>
            <form @submit.prevent="loginUser" id="loginForm">
                <div class="form-group">
                    <input type="email" id="loginEmail" placeholder="Email" required>
                </div>
                <div class="form-group">
                    <div class="password-container">
                        <input type="password" id="loginPassword" placeholder="Password" required>
                        <span class="toggle-password" @click="togglePasswordVisibility('loginPassword')">
                            <i class="fas fa-eye"></i>
                        </span>
                    </div>
                </div>
                <p class="sign_up">Don't have an account? <router-link to="/admin-register">Register</router-link></p>
                <div class="form-group">
                    <button type="submit">Login</button>
                </div>
                <p id="loginErrorMessage">{{ loginErrorMessage }}</p>
            </form>
        </div>
    </div>
</template>

<script>
export default {
    data() {
        return {
            loginErrorMessage: '',
        };
    },
    methods: {
        // Toggle password visibility
        togglePasswordVisibility(id) {
            const passwordField = document.getElementById(id);
            const icon = passwordField.nextElementSibling.querySelector('i');
            if (passwordField.type === 'password') {
                passwordField.type = 'text';
                icon.classList.remove('fa-eye');
                icon.classList.add('fa-eye-slash');
            } else {
                passwordField.type = 'password';
                icon.classList.remove('fa-eye-slash');
                icon.classList.add('fa-eye');
            }
        },

        // Handle user login
        loginUser() {
            const email = document.getElementById('loginEmail').value;
            const password = document.getElementById('loginPassword').value;

            const storedUser = JSON.parse(localStorage.getItem('registeredUser'));
            this.loginErrorMessage = '';

            // Check if the user exists and the password is correct
            if (storedUser && storedUser.email === email && storedUser.password === password) {
                this.loginErrorMessage = 'Login successful!';
                alert('Welcome back!');

                // Redirect to the dashboard page after successful login
                this.$router.push('/dashboard'); // Use Vue Router to go to the dashboard
            } else {
                this.loginErrorMessage = 'Invalid email or password!';
            }
        }
    }
};
</script>

<style scoped>
@import "/public/css/enter.css";
</style>

