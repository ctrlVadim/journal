<template>
    <div class="content_container">
        <h1>Grades table</h1>
        <div class="vue-row">
            <div class="main-content">
                <div class="vue-table" v-if="grades.length > 0">
                    <div class="vue-table__header">
                        <div class="vue-table__cell">
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
                    <div class="table-scroll scroll-box">
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
                                <i @click="deleteItem(grade)" class='bx bxs-message-square-x'></i>
                            </div>
                        </div>
                    </div>
                </div>
                <search :filterForm="filterForm" @filter="getGrades" />
            </div>
            <div class="left-content">
                <sort :filterForm="filterForm" :fields="fields" @filter="getGrades"/>
            </div>
        </div>

    </div>
</template>

<script>
    import Search from "../components/Search";
    import Sort from "../components/Sort";

    export default {
        name: "Grade",
        components:{
            Sort,
            Search
        },
        props: {
            modals: {
                type: Object,
                default: () => ({})
            }
        },
        data: () => ({
            filterForm: {
                sort_field: '',
                search: '',
                search_field: '',
                sort: 'ASC',

            },
            fields: [
                'student',
                'subject',
                'date',
                'grade'
            ],
            grades: [],
        }),
        methods:{
            deleteItem(grade){
                this.$props.modals.delete = {
                    visible: true,
                    url: `/api/grade/${grade.id}/delete`,
                    method: 'POST',
                    title: 'Delete grade?',
                    canUpdate: false
                };
            },
            getGrades(){
                const data = {
                    sort: this.filterForm.sort,
                    sort_field: this.filterForm.sort_field,
                    search: this.filterForm.search,
                    search_field: this.filterForm.search_field,
                }
                console.log(data)
                axios.post('/api/grade', data).then(
                    response => {
                        console.log(response)
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
            document.title = 'Grade';
            this.getGrades();
        },
    }
</script>

<style scoped>
    .vue-table__cell{
        flex: 1 0 22.5%;
    }
</style>
