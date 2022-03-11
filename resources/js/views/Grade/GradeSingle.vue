<template>
    <div class="content_container">
        <div class="d-flex gap-4">
            <h1 class="title-fc">Grades views</h1>
            <transition name="fade" mode="out-in">
                <router-link :to="'/grade'" class="main-button red-hover a-btn">View as table</router-link>
            </transition>
            <router-link :to="'/grade/create'" class="main-button red-hover a-btn">Add new</router-link>
        </div>
        <p>Grade: {{grade.grade}}</p>
        <p>Student id: {{grade.student_id}}</p>
        <p>Subject id: {{grade.subject_id}}</p>
        <p>Date id: {{grade.date}}</p>
        <div class="d-flex mt-4 gap-4">
            <router-link :to="`/grade/${grade.id}/update`" class="main-button blue-hover a-btn">Edit</router-link>
            <button @click="deleteItem(grade)" class="main-button red-hover a-btn">Delete</button>
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
        name: "GradeSingle",
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
            grade: {},
            pagination: {},
        }),
        methods: {
            getData(){
                axios.get(`/api/grade/view?page=${this.page}`).then(response => {
                    console.log(response)
                    this.pagination = response.data
                    this.grade = response.data.data[0];
                })
            },
            deleteItem(grade){
                this.$props.modals.delete = {
                    visible: true,
                    url: `/api/grade/${grade.id}/delete`,
                    method: 'POST',
                    title: 'Delete grade?',
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
