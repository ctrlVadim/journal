<template>
    <div class="content_container">
        <h1>Grades table</h1>
        <div class="vue-table" v-if="grades.length > 0">
            <div class="vue-table__header">
                <div class="vue-table__cell" v-model="filterForm.student" onclick="updateFilter('student')">
                    Student
                    <i class='bx bxs-upvote'></i>
                    <i class='bx bxs-downvote'></i>
                </div>
                <div class="vue-table__cell">
                    Subject
                    <i class='bx bxs-upvote'></i>
                    <i class='bx bxs-downvote'></i>
                </div>
                <div class="vue-table__cell">
                    Date
                    <i class='bx bxs-upvote'></i>
                    <i class='bx bxs-downvote'></i>
                </div>
                <div class="vue-table__cell">
                    Grade
                    <i class='bx bxs-upvote'></i>
                    <i class='bx bxs-downvote'></i>
                </div>
                <div class="vue-table__cell">

                </div>
            </div>
            <div class="vue-table__row" v-for="grade in grades" >
                <div class="vue-table__cell">
                    {{ `${grade.student.name} ${grade.student.surname} ${grade.student.patronymic}` }}
                </div>
                <div class="vue-table__cell">
                    {{ grade.subject.name }}
                </div>
                <div class="vue-table__cell">
                    {{ grade.date }}
                </div>
                <div class="vue-table__cell">
                    {{ grade.grade }}
                </div>
                <div class="vue-table__cell">
                    <router-link :to="'/grade/update/' + grade.id">
                        <i class='bx bxs-message-square-edit' ></i>
                    </router-link>
                    <i class='bx bxs-message-square-x' @click="showModal('delete', 'Delete this grade?')"></i>

                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        name: "Grade",
        data: () => ({
            filterForm: {
                sort: 0,
            },
            grades: [],
        }),
        methods:{
            getGrades(){
                axios.get('/api/grade').then(
                    response => {
                        console.log(response.data)
                        this.grades = response.data;
                    }
                ).catch(
                    error => {
                        this.grades = [];
                    }
                );
            }
        },
        mounted() {
            this.getGrades();
        },
    }
</script>

<style scoped>
    .vue-table__cell{
        flex: 1 0 22.5%;
    }
</style>
