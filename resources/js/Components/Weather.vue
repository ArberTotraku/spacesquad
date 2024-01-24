<template>
    <div class="weather-widget">
      <h3>Weather Information</h3>
      <form @submit.prevent="fetchWeather">
        <input v-model="city" placeholder="Enter city name" />
        <button class="button" type="submit">Get Weather</button>
      </form>
      <div v-if="weather">
        <h4>{{ weather.location.name }}, {{ weather.location.country }}</h4>
        <p>Temperature: {{ weather.current.temp_c }}°C</p>
        <p>Condition: {{ weather.current.condition.text }}</p>
        <img :src="weather.current.condition.icon" alt="Weather Icon">
      </div>
    </div>
  </template>
  
  <script>
  import axios from 'axios';
  
  export default {
    data() {
      return {
        city: '',
        weather: null,
      };
    },
    methods: {
      async fetchWeather() {
        try {
          const response = await axios.get(`https://api.weatherapi.com/v1/current.json?key=35b97c8b19214737a0e144321231302&q=${this.city}&aqi=no`);
          this.weather = response.data;
        } catch (error) {
          console.error("Error fetching weather data:", error);
          this.weather = null; 
        }
      },
    },
  };
  </script>
  
  <style>
  .weather-widget {

    background-color: blue;
    margin-top: 10%;
    font-size: 1rem;
    width: 400px;
    height: 200px;
    margin: 0 auto;
    color: white;
    margin: 0 auto;
    margin-left: 300px
  }
  .button {color: white;
background-color: tomato;
width:130px;
height: 30px;
border-radius: 10px;
margin-left: 5px;
}
  </style>
  