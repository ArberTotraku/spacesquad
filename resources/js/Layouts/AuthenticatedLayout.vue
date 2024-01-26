<script setup>
import { onMounted, ref } from 'vue';
import ResponsiveNavLink from '@/Components/ResponsiveNavLink.vue';
import { Link, router } from '@inertiajs/vue3';
import HamburgerMenuButton from "@/Components/HamburgerMenuButton.vue";
import MenuAnimated from "@/Components/MenuAnimated.vue";
import { useMenuStore } from '@/Stores/DisplaySidebarMenu';
import { storeToRefs } from 'pinia';

const menu = useMenuStore();
const { triggerShow } = menu
const { showing, navLinks } = storeToRefs(menu);


const updateShowingOnNavigation = () => {
    showing.value = false; // Update the sidebar so it's closed
};



const showingNavigationDropdown = ref(false);

onMounted(() => {
    // Close the sidebar after each navigation
    router.on("navigate", updateShowingOnNavigation);
});

</script>

<template>
    <div class="h-screen max-h-screen overflow-y-auto">
        <div class="flex flex-col min-h-screen md:bg-neutral-100">
            <nav class="w-full border-b border-gray-100 bg-emerald-600 overrideForSidebar">
                <div class="flex items-center justify-between w-full h-12 px-2 md:px-4 2xl:px-8 2xl:max-w-8xl xl:mx-auto xl:max-w-9xl">
                    <!-- ------------------- -->
                    <div class="flex items-center -space-x-4">
                        <HamburgerMenuButton class="-translate-x-2 lg:-translate-x-4" />
                    </div>

                </div>

                <div v-if="showingNavigationDropdown">
                    <div class="pt-2 pb-3 space-y-1">
                        <ResponsiveNavLink :href="route('dashboard')" :active="route().current('dashboard')"> Dashboard </ResponsiveNavLink>
                    </div>

                    <!-- Responsive Settings Options -->
                    <div class="pt-4 pb-1 border-t border-gray-200">
                        <div class="px-4">
                            <div class="text-base font-medium text-gray-800">
                                {{ $page.props.auth.user.name }}
                            </div>
                            <div class="text-sm font-medium text-gray-500">{{ $page.props.auth.user.email }}</div>
                        </div>

                        <div class="mt-3 space-y-1">
                            <ResponsiveNavLink :href="route('profile.edit')"> Profile </ResponsiveNavLink>
                            <ResponsiveNavLink :href="route('logout')" method="post" as="button"> Log Out </ResponsiveNavLink>
                        </div>
                    </div>
                </div>
            </nav>

            <!-- Page Heading -->
            <div class="fixed top-0 left-0 w-screen h-screen transition-all duration-500 ease-in-out z-900" v-if="showing">
                <div
                    class="w-screen h-full"
                    :class="showing ? 'bg-neutral-900/50' : 'bg-neutral-900/0 pointer-events-none'"
                    @click="() => (triggerShow())"
                ></div>
                <MenuAnimated :nav-links="navLinks" :open="showing" />
            </div>

            <!-- Page Content -->
            <!-- Normalizing margin - Sidebar has a width of ~64px => so apply a margin of 4rem / 64px  -->
            <main class="flex flex-col grow">
                <section class="flex flex-col grow">
                    <slot />

                </section>
            </main>
        </div>
    </div>
</template>


<style>
.overrideForSidebar {
    padding-left: 0rem;
}
</style>
