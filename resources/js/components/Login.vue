<template>
  <div class="login-form">
    <h2>Login</h2>
    <form @submit.prevent="login">
      <label for="email">Email:</label>
      <input type="email" id="email" v-model="email" required><br>
      <label for="password">Password:</label>
      <input type="password" id="password" v-model="password" required><br>
      <button type="submit">Login</button>
    </form>
  </div>
</template>

<script>
import axios from 'axios';

export default {
  data() {
    return {
      email: '',
      password: '',
    };
  },
  methods: {
    login() {
      axios.post('/login', {
        email: this.email,
        password: this.password,
      })
          .then(response => {
            // Redirect or perform other actions upon successful login
          })
          .catch(error => {
            console.error(error);
          });
    },
  },
};
</script>

<style scoped>
.login-form {
  max-width: 300px;
  margin: 0 auto;
  padding: 20px;
}

label, input {
  display: block;
  margin-bottom: 10px;
}

button {
  background-color: #007bff;
  color: white;
  padding: 10px 20px;
  border: none;
  border-radius: 4px;
  cursor: pointer;
}

button:hover {
  background-color: #0056b3;
}
</style>