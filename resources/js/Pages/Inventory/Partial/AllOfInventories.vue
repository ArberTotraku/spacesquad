<script setup>
import { useInventoriesStore } from '@/Stores/InventoriesStore';
import { storeToRefs } from 'pinia';

const inventory = useInventoriesStore()
const { deleteInventory } = inventory
const { inventorieswitharticles } = storeToRefs(inventory)

</script>
<template>

    <div class="grid grid-cols-4" v-for="inventory in inventorieswitharticles" :key="inventory.id">
        <p class="col-span-3">
            {{ inventory.name }}
        </p>
        <button class="bg-red-500 text-slate-50" @click="deleteInventory(inventory)">
            delete
        </button>

    </div>


</template>
