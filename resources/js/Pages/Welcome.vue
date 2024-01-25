<script setup>
import { Head, Link } from '@inertiajs/vue3';
import GuestLayout from '@/Layouts/GuestLayout.vue';
import MenuAnimated from '@/Components/MenuAnimated.vue';


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
<MenuAnimated />
        <!-- <Weather/>
        <Todo/>
        <OrderForm/>   -->
    </GuestLayout>
 
  
</template>

<style>

</style>
