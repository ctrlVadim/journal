<template>
    <div class="content_container">
        <div class="d-flex">
            <h1 class="title-fc">Grades table</h1>
            <transition name="fade" mode="out-in">
                <router-link v-if="grades.length > 0" :to="'/grade/' + grades[0].id" class="main-button red-hover a-btn">View as items</router-link>
            </transition>
        </div>

        <div class="vue-row">
            <div class="main-content">
                <div class="vue-table">
                    <div class="vue-table__header">
                        <div class="vue-table__cell" v-for="field in fields">
                            {{field}}
                            <i class='bx bxs-upvote'></i>
                            <i class='bx bxs-downvote'></i>
                        </div>
                        <div class="vue-table__cell">

                        </div>
                    </div>
                    <transition name="fade" mode="out-in">
                        <div class="table-scroll scroll-box" v-if="grades.length > 0">
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
                                <router-link :to="'/grade/update/' + grade.grade_id">
                                    <i class='bx bxs-message-square-edit' ></i>
                                </router-link>
                                <i @click="deleteItem(grade)" class='bx bxs-message-square-x'></i>
                            </div>
                        </div>
                    </div>
                    </transition>
                    <transition name="fade" mode="out-in">
                        <no-matches v-if="showNoMatch"/>
                    </transition>
                    <transition name="fade" mode="out-in">
                        <loader v-if="showLoader"/>
                    </transition>
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
    import Loader from "../components/Loader";
    import Sort from "../components/Sort";
    import NoMatches from "../components/NoMatches";

    export default {
        name: "Grade",
        components:{
            NoMatches,
            Sort,
            Search,
            Loader
        },
        props: {
            modals: {
                type: Object,
                default: () => ({})
            }
        },
        data: () => ({
            showNoMatch: false,
            showLoader: false,
            filterForm: localStorage.getItem('filterForm')
                ? JSON.parse(localStorage.getItem('filterForm'))
                : {
                    sort_field: '',
                    search: '',
                    search_field: 'date',
                    sort: 'ASC',
                    date_from: '',
                    date_to: ''
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
                    url: `/api/grade/${grade.grade_id}/delete`,
                    method: 'POST',
                    title: 'Delete grade?',
                    canUpdate: false
                };
            },
            getGrades(){
                this.showNoMatch = false
                this.showLoader = true;
                axios
                    .post('/api/grade', this.filterForm).then(response => {
                        this.grades = response.data;
                        if (this.grades.length === 0) this.showNoMatch = true;
                        this.showLoader = false;
                    })
                    .catch(error => {this.grades = []; this.showNoMatch = true; this.showLoader = false;});

            }
        },
        mounted() {
            document.title = 'Grade';
            this.getGrades();
        },
        watch: {
            filterForm: {
                handler(newValue) {localStorage.setItem("filterForm", JSON.stringify(newValue))},
                deep: true
            },
            modals: {
                handler(newValue) {
                    if (newValue.delete.canUpdate){
                        this.getGrades();
                        this.$props.modals.delete.canUpdate = false;
                    }
                },
                deep: true
            }
        }
    }
</script>

<style scoped>
    .vue-table__cell{
        flex: 1 0 22.5%;
    }
</style>
