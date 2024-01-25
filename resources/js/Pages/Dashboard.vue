<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head } from '@inertiajs/vue3';
import Todo from '@/Pages/Todo.vue'; 
import Weather from '@/Components/Weather.vue'; 




</script>

<template>
    <Head title="Dashboard" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="">Dashboard</h2>
        </template>

        <div class="">
            <div class="">
                <div class="">
                    <div class="">You're logged in!</div>
                </div>
        

            </div>
            <div class="">
                <div class="">
                    <div class="">An interesting project for Space Squad</div>
                </div>
        

            </div>

            <div>
                <div>
                    <div>
                        <Todo />
                    </div>
                </div>
            </div>

            <div>
                <div>
                    <div>
                        <Weather />
                    </div>
                </div>
            </div>

        </div>
    </AuthenticatedLayout>
</template>
