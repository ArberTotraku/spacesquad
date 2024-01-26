import { defineStore } from "pinia";
import { ref } from "vue";

export let useMapWithInvetoriesStore = defineStore("map-inventories", () => {
    // state
    let long_lat = ref({lat: '' , lng: '' })

    const url = ref('https://{s}.tile.osm.org/{z}/{x}/{y}.png')
    let zoomOuter = ref(11)

    return {
        url,
        zoomOuter,
        long_lat,
    }
})
