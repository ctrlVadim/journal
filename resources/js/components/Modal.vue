<template>
    <div>
        <transition name="fade" appear>
            <div class="modal-overlay" v-if="Object.values(showModal).some(val => val === true)" @click="Object.keys(showModal).forEach(val => showModal[val] = false)"></div>
        </transition>
        <transition name="fade" appear>
            <div class="modal-vue delete-modal" v-if="showModal.delete">
                delete ?
            </div>
        </transition>
    </div>
</template>

<script>

    export default {
        name: "Modal",
        props: {
            showModal: {
                type: Object,
                default: () => ({})
            }
        },
        methods: {
            close(){
                Object.keys(this.$props.showModal).forEach(val => this.$props.showModal[val] = false)
            },
            change(modal){
                Object.keys(this.$props.showModal).forEach(val => this.$props.showModal[val] = false)
                this.$props.showModal[modal] = true;
            }
        }
    }
</script>

<style scoped>
    .modal-container{
        width: 100%;
        height: 100vh;
        position: relative;
    }
    .modal-overlay{
        position: absolute;
        top: 0;
        bottom: 0;
        left: 0;
        right: 0;
        z-index: 99;
        background: rgba(0, 0, 0, .8);
    }

    .fade-enter-active,
    .fade-leave-active{
        transition: opacity .5s;
    }

    .fade-enter,
    .fade-leave-to{
        opacity: 0;
    }
    .modal-vue{
        position: absolute;
        left: 50%;
        top: 50%;
        transform: translate(-50%, -50%);
        z-index: 100;
        max-width: 400px;
        height: fit-content;
        background: #34495E;
        color: #fff;
        border-radius: 12px;
    }
    .modal-vue h3{
        font-weight: 700;
    }
    .accept_buttons{
        width: 100%;
        display: flex;
        justify-content: center;
        gap: 20px;
    }

</style>
