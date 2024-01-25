import { defineStore } from "pinia";
import { ref } from "vue";
import anime from 'animejs'
import { router, usePage } from "@inertiajs/vue3";

export let useMenuStore = defineStore("menu", () => {
    // state
    const showing = ref(false)
    const targets = ref(null)

    const navLinks = ref([])

    const inertia = usePage()

    navLinks.value = inertia.props.menu.map(el => {
        return { route: el.route, name: el.name }
    })

    function triggerShow() {
        if (showing.value) {
                anime({
                    targets: targets.value,
                    opacity: [1, 0],
                    duration: 400,
                    easing: 'easeOutQuad',
                    complete() {
                        showing.value = false
                    }
                  });
        } else {
            anime({
                targets: targets.value,
                width: '100%',
                opacity: [0, 1],
                duration: 400,
                easing: 'easeOutQuad',
                direction: 'normal',
                complete() {
                    showing.value = true
                }
              });
        }
    }

    function NavigateToDashboard() {
        router.visit(route('dashboard'))
    }


    return {
        showing,
        targets,
        navLinks,
        triggerShow,
        NavigateToDashboard
    }
})
