<script setup>
import { onMounted } from "vue";

import { Link, router, usePage } from "@inertiajs/vue3";

import NavLink from "@/Components/NavLink.vue";
import { storeToRefs } from "pinia";
import { useMenuStore } from "@/Stores/DisplaySidebarMenu";


// properties
const inertia = usePage();
// pinia
const menu = useMenuStore();
const { NavigateToDashboard } = menu
const { targets } = storeToRefs(menu);

// props
const prop = defineProps({
    navLinks: Array,
    navLinksSettings: Array,
    open: Boolean,
});

// methods

// hooks
onMounted(() => {});
</script>
<template>
<div class="fixed top-0 left-0 flex flex-col h-full max-h-full text-left bg-white z-700 v-sid-menu" ref="targets">
    <div class="flex flex-col w-full p-2 mt-3 text-neutral-800">
        <button class="p-2 seperationBase" @click="NavigateToDashboard">
            DASHBOARD
        </button>
        <div class="flex items-center justify-between w-full containerPaddingXs seperationSm">
            <p class="">{{ $page.props.auth.user.name }}</p>
        </div>
    </div>
    <div class="relative flex flex-col flex-1">
        <div class="w-full overflow-hidden ">
            <div class="h-full overflow-y-auto">
                <ul class="flex flex-col scroll">
                    <li v-for="link in navLinks" :key="link" class="text-sm text-center">
                        <NavLink
                            :classNames="'py-2'"
                            :href="route(link.route)"
                            :active="route().current(link.route)">
                            {{ link.name }}
                        </NavLink>
                    </li>
                </ul>
                <hr style="border-color: rgba(0, 0, 0, 0.1); margin: 20px;">
            </div>
        </div>
    </div>

</div>
</template>

<style>
.v-sid-menu {
    width: 100% !important;
}

/* width: 400px */

@media (min-width: 1000px) {
    .v-sid-menu {
        width: 400px !important;
    }
}

.scroll {
    transition: width .3s ease;
}

.v-sid-menu.vsm_white-theme .vsm--link_level-1 .vsm--icon {
    background-color: rgb(241 245 249) !important ;
}


.v-sid-menu.vsm_white-theme .vsm--link {
    color: rgb(100 116 139) !important;
}

.v-sid-menu .vsm--toggle-btn {
    background-color: #40865c !important;
    color: white !important;
}

.v-sid-menu .title > span:first-child {
    width: 100% !important;
    display: block !important;
    word-wrap: break-word !important;
    white-space: normal !important;
    line-height: normal;
    font-size: 0.9rem;
}
/* v-sidebar-menu vsm_collapsed vsm_white-theme */

/* .localPopoverButton {
    @apply w-full flex items-center space-x-2 !py-1.5 !px-2
}

.localPopoverButtonIcon {
    @apply mr-2;
}

.v-sid-menu .title {
    text-transform: uppercase;
} */
</style>

