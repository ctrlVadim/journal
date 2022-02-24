<template>
    <div :class="[active, 'sidebar']">
        <div class="logo_content">
            <div class="logo">
                <i class='bx bxl-vuejs'></i>
                <div class="logo_name">Journal</div>
            </div>
            <i class='bx bx-menu btn-menu' @click="toggleSideBar"></i>
        </div>
        <ul class="nav_list sidebar_block">
            <li>
                <router-link to="/student">
                    <i class='bx bxs-user-circle' ></i>
                    <span class="links_name">Students</span>
                </router-link>
            </li>
            <li>
                <router-link to="/subject">
                    <i class='bx bxs-book-alt'></i>
                    <span class="links_name">Subject</span>
                </router-link>
            </li>
            <li>
                <router-link to="/speciality">
                    <i class='bx bxs-user-badge' ></i>
                    <span class="links_name">Speciality</span>
                </router-link>
            </li>
            <li>
                <router-link to="/grade">
                    <i class='bx bxs-graduation'></i>
                    <span class="links_name">Grade</span>
                </router-link>
            </li></ul>
        <ul class="nav_list sidebar_block"></ul>
    </div>
</template>

<script>
    export default {
        name: "SideBar",
        props: {

            modals: {
                type: Object,
                default: () => ({})
            },
        },
        created() {
        },
        data: () => ({
            active: localStorage.getItem('sidebar') === 'active' ? 'active' : '',
        }),
        methods: {
            toggleSideBar(){
                this.active = this.active === '' ? 'active' : '';
                localStorage.setItem('sidebar', this.active)
            },
        }
    }
</script>

<style scoped>
    .profile{
        margin-top: auto;
        color: #fff;
    }
    .profile .name i{
        font-size: 24px;
    }

    .logo_content{
        position: relative;
    }

    .sidebar_block{
        position: relative;
    }

    .sidebar_block:after{
        content: "";
        height: 3px;
        border-radius: 6px;
        width: 100%;
        position: absolute;
        top: -10px;
        left: 0;
        right: 0;
        background: #EE4443;
    }

    .sidebar_block:last-child{
        bottom: 0;
        position: absolute;
        width: calc(100% - 28px);
        margin-bottom: 6px;
    }

    .sidebar{
        position: fixed;
        top: 0;
        left: 0;
        height: 100%;
        width: 78px;
        background: #263144;
        padding: 6px 14px;
        transition: all .4s ease;
    }

    .sidebar.active{
        width: 240px;
    }

    .sidebar.active .logo_content  .logo{
        color: #EE4443;
        opacity: 1;
    }

    .sidebar .logo_content .logo{
        transition: all .4s ease;
        color: #fff;
        display: flex;
        height: 50px;
        width: 100%;
        align-items: center;
        opacity: 0;
        pointer-events: none;
    }

    .logo_content .logo i{
        font-size: 28px;
        margin-right: 5px;
    }

    .logo_content .logo .logo_name{
        font-size: 20px;
        font-weight: 400;
    }

    .sidebar .btn-menu{
        position: absolute;
        cursor: pointer;
        color: #Fff;
        top: 6px;
        left: 50%;
        font-size: 24px;
        height: 50px;
        width: 50px;
        text-align: center;
        line-height: 50px;
        transform: translateX(-50%);
        transition: all .4s ease;
    }

    .sidebar.active .btn-menu{
        left: 90%;
        color: #EE4443;
    }

    .sidebar ul{
        padding: 0;
        margin-top: 20px;
    }

    .sidebar ul li{
        position: relative;
        list-style: none;
        height: 50px;
        width: 100%;
        line-height: 50px;
    }

    .sidebar ul li a{
        color: #fff;
        display: flex;
        align-items: center;
        text-decoration: none;
        transition: all .5s ease;
        border-radius: 12px;
        margin: 5px 0;
    }

    .sidebar ul li a:hover, .sidebar ul li a.active{
        background: #121c2b;
        color: #EE4443;
    }

    .sidebar ul li a i{
        height: 50px;
        min-width: 50px;
        border-radius: 12px;
        line-height: 50px;
        font-size: 24px;
        text-align: center;
    }

    .sidebar .links_name{
        opacity: 0;
        pointer-events: none;
    }

    .sidebar.active .links_name{
        opacity: 1;
        pointer-events: auto;
    }

    .sidebar .btn-auth{
        position: absolute;
        left: 50%;
        bottom: 5px;
        transform: translateX(-50%);
        min-width: 50px;
        line-height: 50px;
        font-size: 24px;
        border-radius: 12px;
        text-align: center;
        transition: all .4s ease;
        cursor: pointer;
    }

    .btn-auth:hover{
        color: #EE4443;
    }

    .sidebar.active .btn-auth {
        left: 88%;
    }
    .profile_content .name{
        padding-top: 15px;
        width: 50px;
        display: flex;
        align-items: center;
        justify-content: center;
        flex-direction: column;
        text-align: center;
    }
</style>
