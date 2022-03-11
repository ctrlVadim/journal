<template>
    <div class="content_container">
        <div class="d-flex gap-4">
            <h1 class="title-fc">Specialities views</h1>
            <transition name="fade" mode="out-in">
                <router-link :to="'/speciality'" class="main-button red-hover a-btn">View as table</router-link>
            </transition>
            <router-link :to="'/speciality/create'" class="main-button red-hover a-btn">Add new</router-link>
        </div>
        <p>Name: {{speciality.name}}</p>
        <p>Description: {{speciality.description}}</p>
        <div class="d-flex mt-4 gap-4">
            <router-link :to="`/speciality/${speciality.id}/update`" class="main-button blue-hover a-btn">Edit</router-link>
            <button @click="deleteItem(speciality)" class="main-button red-hover a-btn">Delete</button>
        </div>
        <div class="pagination mt-4 d-flex gap-4">
            <div class="pagination__pages">
                <button class="main-button red-hover a-btn" :disabled="Number(pagination.current_page) - 1 < 1" @click="changePage(Number(pagination.current_page) - 1)">
                    <i class='bx bxs-left-arrow'></i>
                </button>
                <button class="main-button red-hover a-btn" :disabled="Number(pagination.current_page) + 1 > Number(pagination.last_page)" @click="changePage(Number(pagination.current_page) + 1)">
                    <i class='bx bxs-right-arrow'></i>
                </button>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        name: "SpecialitySingle",
        mounted() {
            this.getData();
        },
        props: {
            modals: {
                type: Object,
                default: () => ({})
            }
        },
        data: () => ({
            page: 1,
            speciality: {},
            pagination: {},
        }),
        methods: {
            getData(){
                axios.get(`/api/speciality/view?page=${this.page}`).then(response => {
                    console.log(response)
                    this.pagination = response.data
                    this.speciality = response.data.data[0];
                })
            },
            deleteItem(speciality){
                console.log(speciality)
                this.$props.modals.delete = {
                    visible: true,
                    url: `/api/speciality/${speciality.id}/delete`,
                    method: 'POST',
                    title: 'Delete speciality?',
                    canUpdate: false
                };
            },
            changePage(page){
                this.page = page;
                this.getData(this.page);
            }
        },
        watch: {
            modals: {
                handler(newValue) {
                    if (newValue.delete.canUpdate){
                        this.getData();
                        this.$props.modals.delete.canUpdate = false;
                    }
                },
                deep: true
            }
        }
    }
</script>

<style scoped>
    .pagination__page{
        width: 40px;
    }
</style>
