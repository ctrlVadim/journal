<template>
    <div>
        <transition name="fade" appear>
            <div class="modal-overlay" v-if="Object.values(modals).some(val => val.visible === true)" @click="Object.keys(modals).forEach(val => modals[val].visible = false)"></div>
        </transition>
        <transition name="fade" appear>
            <div class="modal-vue delete-modal" v-if="modals.delete.visible">
                <div class="vue-modal-content">
                    <h3 class="title">{{modals.delete.title}}</h3>
                    <button class="btn-cancel" @click="close">Cancel</button>
                    <button class="red-hover main-button" @click="sendRequest(modals.delete)">Accept</button>
                </div>
            </div>
        </transition>
    </div>
</template>

<script>

    export default {
        name: "Modal",
        props: {
            modals: {
                type: Object,
                default: () => ({})
            }
        },
        methods: {
            sendRequest(config){
                axios({
                    method: config.method,
                    url: config.url
                }).then(response => {
                    this.close();
                    this.$props.modals.delete.canUpdate = true;
                });
            },
            close(){
                Object.keys(this.$props.modals).forEach(val => this.$props.modals[val].visible = false)
            },
            change(modal){
                Object.keys(this.$props.modals).forEach(val => this.$props.modals[val].visible = false)
                this.$props.modals[modal].visible = true;
            }
        }
    }
</script>

<style scoped>
    .vue-modal-content{
        padding: 20px;
    }
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
        background: rgba(0, 0, 0, .5);
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
