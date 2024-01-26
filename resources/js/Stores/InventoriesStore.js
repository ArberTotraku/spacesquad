import { defineStore } from "pinia";
import { computed, ref } from "vue";
import { router } from "@inertiajs/vue3";

export let useInventoriesStore = defineStore("inventories", () => {
    // state
    const showing = ref(false)
    const triggerchange = ref(false)
    const inventorieswitharticles = ref([])
    const articles = ref([])
    const inventory = ref(null)

    // refs elements
    const forminventory = ref(null)
    const articleCartRef = ref({});

    // refs options
    const options = ref([
        'all',
        'Drinks',
        'Snacks',
        'Take-Away',
        'Board-Game'
    ])

    //computed
    const formkitclasses = computed(() => {
        return {
            inner: '$reset shadow-none',
            wrapper: '$reset w-full border-0',
            input: '$reset bg-neutral-50 w-full rounded-md outline-neutral-500 focus:!border-audostrade text-neutral-700 placeholder:text-neutral-500 hover:outline-neutral-300 focus:outline-audostrade py-2 outline-1 !-outline-offset-2 ring-0 focus:!ring-0 hover:!ring-0 border border-neutral-200 hover:border-neutral-400 transition-all duration-300 ease-in-out mt-1',
            label: '$reset w-full text-sm font-normal text-neutral-500',
        }
    })

    // methods
    function setUpInventories(payload) {
        inventorieswitharticles.value = payload
    }

    async function saveInventoryAndOpenModal() {
        const response = await axios.post(route('inventory.store'))
        if (response.data) {
            inventory.value = response.data
            showing.value = true
        }
    }

    async function storeArticleAndAppendFormkit() {
        const response = await axios.post(route('inventory.article.store', inventory.value))
        if (response.data) {
            articles.value = response.data
        }
    }

    function deleteInventory(payload) {
        router.delete(route('inventory.delete', payload), {
            onFinish: visit => {
                triggerchange.value = true
                showing.value = false
            }
        })
    }

    async function updateArticle(flds) {
        const response = await axios.put(route('inventory.article.update', flds.article), flds)
        if (response.data) {
            const filtered = articles.value.filter(el => el.id === response.data.id)
            if (filtered.length) {
                filtered[0].edit = response.data.edit
            }
        }
    }

    function triggerSubmitArticle(payload) {
        articleCartRef.value[payload.id].node.submit()
    }

    async function updateInventory(flds) {
        const response = await axios.put(route('inventory.update', inventory.value), flds)
        if (response.data === 'done') {
            inventory.value = null
            triggerchange.value = true
            showing.value = false
        }
    }

    function triggerUpdateInventory() {
        forminventory.value.node.submit()
    }

    function closeModal() {
        inventory.value = null
        showing.value = false
    }

    async function deleteArticle(payload) {
        articles.value.splice( articles.value.findIndex(f => f.id === payload.id ),1);
        const response = await axios.delete(route('article.delete', payload))
        if (response.data) {
            articles.value = response.data
        }
    }

    return {
        showing,
        options,
        inventory,
        articles,
        forminventory,
        triggerchange,
        articleCartRef,
        inventorieswitharticles,
        formkitclasses,
        closeModal,
        updateArticle,
        deleteArticle,
        updateInventory,
        setUpInventories,
        deleteInventory,
        triggerSubmitArticle,
        triggerUpdateInventory,
        saveInventoryAndOpenModal,
        storeArticleAndAppendFormkit,
    }
})
