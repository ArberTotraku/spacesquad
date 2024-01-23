<template>
    <div>
      <h1>My To-Do List</h1>
      <input v-model="newTodo" @keyup.enter="addTodo" placeholder="Add new todo">
      <ul>
        <li v-for="todo in todos" :key="todo.id">
          {{ todo.title }}
          <button @click="removeTodo(todo.id)">Delete</button>
        </li>
      </ul>
    </div>
  </template>
  
  <script>
  export default {
    data() {
      return {
        newTodo: '',
        todos: [],
      };
    },
    methods: {
      addTodo() {
        if (this.newTodo.trim()) {
          this.todos.push({ id: Date.now(), title: this.newTodo });
          this.newTodo = '';
        }
      },
      removeTodo(id) {
        this.todos = this.todos.filter(todo => todo.id !== id);
      },
    },
  };
  </script>
  