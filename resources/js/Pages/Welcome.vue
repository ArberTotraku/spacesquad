<script setup>
import { Head, Link } from '@inertiajs/vue3';
import Weather from './Weather.vue';
import Todo from './Todo.vue';
import OrderForm from '@/Components/OrderForm.vue';
import GuestLayout from '@/Layouts/GuestLayout.vue';


defineProps({
    canLogin: {
        type: Boolean,
    },
    canRegister: {
        type: Boolean,
    },
 
});
</script>

<template>


    <GuestLayout>
        <Head title="Log in" />

        <Weather/>
        <Todo/>
        <OrderForm/>
    </GuestLayout>
 
  
</template>

<style>

</style>
