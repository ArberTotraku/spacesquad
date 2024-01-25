<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import AllOfInventories from "@/Pages/Inventory/Partial/AllOfInventories.vue";
import Modal from "@/Components/Modal.vue";
import { Head, router } from '@inertiajs/vue3';
import { onBeforeMount, onMounted, watch } from 'vue';
import { useInventoriesStore } from '@/Stores/InventoriesStore';
import { storeToRefs } from 'pinia';

import { FormKit } from '@formkit/vue';

const prop = defineProps({
    inventories: Object
});

const storeinvetory = useInventoriesStore()
const {
    setUpInventories,
    saveInventoryAndOpenModal,
    storeArticleAndAppendFormkit,
    deleteInventory
} = storeinvetory
const {
    showing,
    inventory,
    formkitclasses,
    triggerchange,
    articles
} = storeToRefs(storeinvetory)

onBeforeMount(() => {
    setUpInventories(prop.inventories)
})

onMounted(() => {
    console.log(prop.inventories);
})

watch(triggerchange, (change) => {
    if (change) {
        router.reload({
            only: ['inventories'],
            onFinish: visit => {
                setUpInventories(prop.inventories)
                triggerchange.value = false
            }
        })
    }
})
</script>

<template>
    <Head title="Inventory" />

    <AuthenticatedLayout>
        <div class="py-12">
            <div class="mx-auto space-y-6 max-w-7xl sm:px-6 lg:px-8">
                <button class="px-2 py-0.5 font-semibold border bg-white shadow-md rounded-md" @click="saveInventoryAndOpenModal">
                    Create
                </button>
                <div class="p-4 bg-white shadow sm:p-8 sm:rounded-lg">
                    <AllOfInventories />
                </div>
            </div>
        </div>
        <Modal :show="showing">
            <div class="w-full">
                <div class="relative">
                    <button class="absolute right-4 top-4" @click="deleteInventory(inventory)">
                        close
                    </button>
                </div>
            </div>
            <div class="flex-col px-8 flex w-full mt-20 h-[50vh]">
                <FormKit ref="formacat" type="form" :actions="false">
                    <FormKit type="text" label="Category title" :classes="formkitclasses" :value="inventory?.name" />
                </FormKit>
                <button class="px-2 py-1 mx-auto mt-2 rounded-md w-fit bg-emerald-300" @click="storeArticleAndAppendFormkit">
                    + Article
                </button>
                <div class="h-[30] overflow-y-auto">
                    <FormKit ref="formarticle" type="form" :actions="false" v-for="article in articles" :key="article.id">
                        <div class="grid grid-cols-12 gap-x-3">
                            <div class="grid grid-cols-12 col-span-9 gap-x-2">
                                <div class="col-span-9">
                                    <FormKit type="text" label="Name" :classes="formkitclasses" />
                                </div>
                                <div class="col-span-3">
                                    <FormKit type="select" label="Name" :classes="formkitclasses" />
                                </div>
                            </div>
                        </div>
                    </FormKit>
                </div>
            </div>
        </Modal>
    </AuthenticatedLayout>
</template>
