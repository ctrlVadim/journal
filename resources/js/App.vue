<template>
    <div>
        <side-bar :modals="modals"/>
        <div class="content">
            <transition
                name="fade"
                mode="out-in"
            >
                <router-view :modals="modals" />
            </transition>
        </div>
        <modal :modals="modals" />
    </div>
</template>

<script>
    import SideBar from "./components/SideBar";
    import Modal from "./components/Modal";
    export default {
        name: "App",
        components: {SideBar, Modal},
        data: () => ({
            modals  : {
                delete: false,
            },
        }),
        created() {

        },
        methods: {

        }
    }
</script>

<style>

</style>
