<template>
  <div class="task-form">
    <h1>Add Task</h1>
    <form @submit.prevent="addTask">
      <label for="title">Title:</label>
      <input type="text" id="title" v-model="newTask.title" required><br>
      <label for="description">Description:</label>
      <textarea id="description" v-model="newTask.description" required></textarea><br>
      <label for="due_date">Due Date:</label>
      <input type="date" id="due_date" v-model="newTask.due_date" required><br>
      <label for="status">Status:</label>
      <select id="status" v-model="newTask.status" required>
        <option value="PENDING">PENDING</option>
        <option value="STARTED">STARTED</option>
        <option value="COMPLETED">COMPLETED</option>
      </select><br>
      <button type="submit">Add</button>
    </form>
    <router-link to="/">Back to Task List</router-link>
  </div>
</template>

<script>
import axios from 'axios';

export default {
  data() {
    return {
      newTask: {
        title: '',
        description: '',
        due_date: '',
      },
    };
  },
  methods: {
    addTask() {
      axios.post('/api/tasks', this.newTask).then(() => {
        this.$router.push('/');
      });
    },
  },
};
</script>

<style scoped>
.task-form {
  max-width: 400px;
  margin: 0 auto;
  padding: 20px;
}

.task-form label {
  display: block;
  margin-bottom: 5px;
}

.task-form input,
.task-form textarea {
  width: 100%;
  padding: 8px;
  margin-bottom: 10px;
  border: 1px solid #ccc;
  border-radius: 4px;
}

.task-form button {
  background-color: #007bff;
  color: white;
  padding: 10px 20px;
  border: none;
  border-radius: 4px;
  cursor: pointer;
}

.task-form button:hover {
  background-color: #0056b3;
}
</style>