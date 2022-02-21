<template>
    <div>
        <side-bar :showModal="showModal"/>
        <div class="content">
            <transition
                name="fade"
                mode="out-in"
            >
                <router-view />
            </transition>
        </div>
        <modal :showModal="showModal" />
    </div>
</template>

<script>
    import SideBar from "./components/SideBar";
    import Modal from "./components/Modal";
    export default {
        name: "App",
        components: {SideBar, Modal},
        data: () => ({
            showModal: {
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
    .content{
        position: absolute;
        height: 100%;
        left: 78px;
        width: calc(100% - 78px);
        transition: all .4s ease;
        background: #101826;
        color: #fff
    }
    .sidebar.active ~ .content{
        width: calc(100% - 240px);
        left: 240px;
    }
    .fade-enter-active,
    .fade-leave-active {
        transition-duration: .3s;
        transition-property: opacity;
        transition-timing-function: linear;
    }

    .fade-enter,
    .fade-leave-active {
        opacity: 0
    }
    .vue-table__cell:last-child{
        text-align: right;
        justify-content: right;
        flex: 1 0 10%;
    }
    .vue-table__cell:last-child i:hover{
        color: #EE4443 !important;
    }
    .vue-table__cell i{
        transition: ease .2s;
        cursor: pointer;
        color: #fff !important;
        margin-left: 10px;
        font-size: 24px;
    }
    .vue-table__header .vue-table__cell i{
        visibility: hidden;
    }
    .vue-table__header .vue-table__cell.up .bxs-upvote{
        visibility: visible;
    }

    .vue-table__cell.down .bxs-downvote{
        visibility: visible;
    }
    .vue-table__row{
        border-radius: 7px;
        transition: ease .3s;
        padding: 0 5px;
    }
    .vue-table__row:hover{
        background: #121c2b;
    }
    .vue-table__row .vue-table__cell{
        color: #fff;
        font-size: 16px;
        font-weight: 100;
        padding: 5px 0;
        display: flex;
        align-items: center;
    }
    .vue-table__row .vue-table__cell a{
        text-decoration: none;
        display: flex;
        align-items: center;
    }
    .vue-table__header, .vue-table__row{
        display: flex;
    }
    .vue-table__cell.active{
        color: #EE4443;
    }
    .vue-table__header{
        position: relative;
        font-weight: 700;
        font-size: 18px;
        cursor: pointer;
    }
    .vue-table__header:after{
        content: "";
        height: 3px;
        border-radius: 6px;
        width: 100%;
        position: absolute;
        bottom: -5px;
        left: 0;
        right: 0;
        background: #EE4443;
    }
    .content_container{
        padding: 40px;
    }
    h1{
        font-weight: 700;
    }
    .loader-container{
        position: relative;
        width: 100px;
        height: 100px;
    }
    .vue-table{
        background: #263144;
        max-width: 1100px;
        padding: 15px;
        border-radius: 12px;
    }
    .vue-table__row:nth-child(2){
        margin-top: 10px;
    }
</style>
