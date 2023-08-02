<template>
  <div class="task-list">
    <h1>Task List</h1>
    <table>
      <thead>
      <tr>
        <th>Title</th>
        <th>Description</th>
        <th>Due Date</th>
        <th>Status</th>
        <th></th>
      </tr>
      </thead>
      <tbody>
      <tr v-for="task in tasks" :key="task.id">
        <td>{{ task.title }}</td>
        <td>{{ task.description }}</td>
        <td>{{ task.due_date }}</td>
        <td>{{ task.status }}</td>
        <td>
          <button @click="editTask(task.id)">Edit</button>
          <button @click="deleteTask(task.id)">Delete</button>
        </td>
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
      tasks: [],
    };
  },
  methods: {
    fetchTasks() {
      axios.get('/api/tasks').then(response => {
        this.tasks = response.data;
      });
    },
    editTask(taskId) {
      this.$router.push(`/edit/${taskId}`);
    },
    deleteTask(taskId) {
      if (confirm('Are you sure you want to delete this task?')) {
        axios.delete(`/api/tasks/${taskId}`).then(() => {
          this.fetchTasks();
        });
      }
    },
  },
  mounted() {
    this.fetchTasks();
  },
};
</script>

<style scoped>
.task-list {
  max-width: 800px;
  margin: 0 auto;
  padding: 20px;
}

table {
  width: 100%;
  border-collapse: collapse;
  margin-top: 20px;
}

th, td {
  border: 1px solid #ccc;
  padding: 8px;
  text-align: left;
}

th {
  background-color: #f9f9f9;
}

button {
  background-color: #007bff;
  color: white;
  padding: 5px 10px;
  border: none;
  border-radius: 4px;
  cursor: pointer;
}

button:hover {
  background-color: #0056b3;
}
</style>
