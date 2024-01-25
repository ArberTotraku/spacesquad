import { defineStore } from "pinia";
import { computed, ref } from "vue";
import { router, usePage } from "@inertiajs/vue3";

export let useInventoriesStore = defineStore("inventories", () => {
    // state
    const showing = ref(false)
    const triggerchange = ref(false)
    const inventorieswitharticles = ref([])
    const articles = ref([])
    const inventory = ref(null)
    const options = ref([
        'all',
        'Drinks',
        'Snacks',
        'Take-Away',
        'Board-Game'
    ])
    // const inertia = usePage()

    //computed
    const formkitclasses = computed(() => {
        return {
            inner: '$reset shadow-none',
            wrapper: '$reset w-full border-0',
            input: '$reset bg-neutral-50 w-full rounded-md outline-neutral-500 focus:!border-audostrade text-neutral-700 placeholder:text-neutral-500 hover:outline-neutral-300 focus:outline-audostrade py-2 outline-1 !-outline-offset-2 ring-0 focus:!ring-0 hover:!ring-0 border border-neutral-200 hover:border-neutral-400 transition-all duration-300 ease-in-out mt-2',
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

    return {
        showing,
        options,
        inventory,
        articles,
        triggerchange,
        inventorieswitharticles,
        formkitclasses,
        setUpInventories,
        deleteInventory,
        saveInventoryAndOpenModal,
        storeArticleAndAppendFormkit,
    }
})
