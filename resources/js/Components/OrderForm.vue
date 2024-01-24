

<template>
    <div class="order-form">
      <h2>Place Your Order</h2>
      <form @submit.prevent="submitOrder">
        <div class="input-group">
          <label for="item">Select Item</label>
          <select id="item" v-model="form.item">
            <option disabled value="">Please select one</option>
            <option v-for="option in options" :key="option.value" :value="option.value">
              {{ option.text }}
            </option>
          </select>
        </div>
        <div class="input-group">
          <label for="name">Your Name</label>
          <input id="name" v-model="form.name" type="text" placeholder="John Doe" required>
        </div>
        <div class="input-group">
          <label for="rating">Rating</label>
          <input id="rating" v-model="form.rating" type="number" min="1" max="5" placeholder="5" required>
        </div>
        <button type="submit">Submit Order</button>
      </form>
    </div>
  </template>
  
  <script>
  import { ref } from 'vue';
//   import { Inertia } from '@inertiajs/inertia';
  
  export default {
    setup() {
      const form = ref({
        item: '',
        name: '',
        rating: null,
      });
      const options = ref([
        { value: 'drink', text: 'Drink' },
        { value: 'snack', text: 'Snack' },
        { value: 'alcoholic_drink', text: 'Alcoholic Drink' },
      ]);
  
      const submitOrder = () => {
        Inertia.post('/api/orders', form.value);
        // Reset the form after submission
        form.value = { item: '', name: '', rating: null };
      };
  
      return { form, options, submitOrder };
    },
  };
  </script>
  
  <style scoped>
  .order-form {
    max-width: 500px;
    margin: auto;
    padding: 20px;
  }
  
  .input-group {
    margin-bottom: 15px;
  }
  
  input, select {
    width: 100%;
    padding: 8px;
    margin-top: 5px;
  }
  
  button {
    padding: 10px 20px;
    cursor: pointer;
  }
  </style>
  