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
    deleteInventory,
    updateArticle,
    triggerSubmitArticle,
    updateInventory,
    closeModal,
    triggerUpdateInventory,
    deleteArticle,
} = storeinvetory
const {
    showing,
    options,
    inventory,
    formkitclasses,
    triggerchange,
    articles,
    forminventory,
    articleCartRef
} = storeToRefs(storeinvetory)

// methods
const setOptionDynRef = (payload) => {
    return el => {
        articleCartRef.value[payload] = el;
    };
}

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
                <FormKit
                ref="forminventory"
                type="form"
                :actions="false"
                @submit="updateInventory">
                    <FormKit type="text" label="Category title" name="name" :classes="formkitclasses" :value="inventory?.name" />
                    <FormKit type="hidden" name="inventory" :value="inventory" />
                </FormKit>
                <button type="button" class="px-2 py-1 mx-auto mt-2 rounded-md w-fit bg-emerald-300" @click="storeArticleAndAppendFormkit">
                    + Article
                </button>
                <div class="h-[30vh] overflow-y-auto">
                    <FormKit
                    :ref="setOptionDynRef(article.id)"
                    @submit="updateArticle"
                    type="form"
                    :actions="false"
                    v-for="article in articles"
                    :key="article.id">
                        <div class="grid grid-cols-12 gap-x-3">
                            <div class="grid grid-cols-12 col-span-8 gap-x-2">
                                <div class="col-span-8">
                                    <FormKit type="text" :disabled="article?.edit" :value="article?.article_name" name="article_name" label="Name" :classes="formkitclasses" />
                                    <FormKit type="hidden" name="article" :value="article" />
                                </div>
                                <div class="col-span-4">
                                    <FormKit type="select" name="type" :disabled="article?.edit" :value="article?.type" :options="options" label="Type" :classes="formkitclasses" />
                                </div>
                            </div>
                            <div class="grid grid-cols-2 col-span-4 gap-x-3">
                                <button type="button" class="py-2 mt-auto rounded-md bg-emerald-400 h-fit text-slate-50"
                                @click="triggerSubmitArticle(article)">
                                    sa
                                </button>
                                <button type="button" class="py-2 mt-auto bg-red-600 rounded-md text-slate-50 h-fit"
                                @click="deleteArticle(article)">
                                    de
                                </button>
                            </div>
                        </div>
                    </FormKit>
                </div>
                <div class="flex justify-center w-8/12 ml-auto gap-x-2">
                    <button type="button" class="px-3 py-1 shadow-sm bg-slate-300" @click="closeModal">
                        CLOSE INVENTORY
                    </button>
                    <button type="button" class="px-3 py-1 shadow-sm bg-emerald-500" @click="triggerUpdateInventory">
                        SAVE INVENTORY
                    </button>
                </div>
            </div>
        </Modal>
    </AuthenticatedLayout>
</template>
