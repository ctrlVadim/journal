<template>
    <div class="content_container">
        <div class="d-flex gap-4">
            <h1 class="title-fc">Students views</h1>
            <transition name="fade" mode="out-in">
                <router-link :to="'/'" class="main-button red-hover a-btn">View as table</router-link>
            </transition>
            <router-link :to="'/student/create'" class="main-button red-hover a-btn">Add new</router-link>
        </div>
        <p>Name: {{student.name}}</p>
        <p>Surname: {{student.surname}}</p>
        <p>Patronymic: {{student.patronymic}}</p>
        <p>Birth: {{student.birth}}</p>
        <p>Parents: {{student.parents}}</p>
        <p>Gender: {{student.gender}}</p>
        <p>Address: {{student.address}}</p>
        <p>Phone: {{student.phone}}</p>
        <p>Passport data: {{student.passport_data}}</p>
        <p>Date of admission: {{student.date_of_admission}}</p>
        <p>Group: {{student.group}}</p>
        <p>Course: {{student.course}}</p>
        <p>Speciality id: {{student.speciality_id}}</p>
        <p>Form of study: {{student.form_of_study}}</p>
        <div class="d-flex mt-4 gap-4">
            <router-link :to="`/student/${student.id}/update`" class="main-button blue-hover a-btn">Edit</router-link>
            <button @click="deleteItem(student)" class="main-button red-hover a-btn">Delete</button>
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
        name: "StudentSingle",
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
            student: {},
            pagination: {},
        }),
        methods: {
            getData(){
                axios.get(`/api/student/view?page=${this.page}`).then(response => {
                    console.log(response)
                    this.pagination = response.data
                    this.student = response.data.data[0];
                })
            },
            deleteItem(student){
                this.$props.modals.delete = {
                    visible: true,
                    url: `/api/student/${student.id}/delete`,
                    method: 'POST',
                    title: 'Delete student?',
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
