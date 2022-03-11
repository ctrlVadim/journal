<template>
    <div class="content_container">
        <div class="d-flex gap-4">
            <h1 class="title-fc">Students table</h1>
            <transition name="fade" mode="out-in">
                <router-link v-if="students.length > 0" :to="'/student/view'" class="main-button red-hover a-btn">View as items</router-link>
            </transition>
            <router-link :to="'/student/create'" class="main-button red-hover a-btn">Add new</router-link>
        </div>

        <div class="vue-row">
            <div class="main-content">
                <div class="vue-table">
                    <div class="vue-table__header">
                        <div class="vue-table__cell">
                            Name, gender,<br> birth, phone
                        </div>
                        <div class="vue-table__cell">
                            Parents, passport,<br>
                            address
                        </div>
                        <div class="vue-table__cell">
                            Group, course, report card,<br>
                            speciality, admission date,<br>
                            form of study
                        </div>
                        <div class="vue-table__cell">
                        </div>
                    </div>
                    <transition name="fade" mode="out-in">
                        <div class="table-scroll scroll-box" v-if="students.length > 0">
                            <div class="vue-table__row" v-for="student in students" >
                                <div class="vue-table__cell">
                                    <div>
                                        {{student.name}} {{student.surname}} {{student.patronymic}},&nbsp;
                                        <span :class="student.gender === 'М' ? 'blue' : 'pink'">{{student.gender}}</span><br>
                                        {{student.birth}}, {{student.phone}}
                                    </div>
                                </div>
                                <div class="vue-table__cell">
                                    <div>
                                        {{student.parents}}<br>
                                        {{student.passport_data}}<br>
                                        {{student.address}}
                                    </div>
                                </div>
                                <div class="vue-table__cell">
                                    <div>
                                        {{student.group}}, {{student.course}} course, {{student.report_card}}<br>
                                        {{student.speciality.name}}, {{student.date_of_admission}}<br>
                                        {{student.form_of_study === 1 ? "Extramural studies" : "Full time studies"}}
                                    </div>
                                </div>
                                <div class="vue-table__cell">
                                    <router-link :to="`/student/${student.id}/update/`">
                                        <i class='bx bxs-message-square-edit' ></i>
                                    </router-link>
                                    <i @click="deleteItem(student)" class='bx bxs-message-square-x'></i>
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
                <search :filterForm="filterForm" :dateFields="['birth', 'date_of_admission']" :fields="fields" @filter="getData" />
            </div>
            <div class="left-content">
                <sort :filterForm="filterForm" :fields="fields" @filter="getData"/>
            </div>
        </div>
    </div>
</template>

<script>
    import Search from "../../components/Search";
    import Loader from "../../components/Loader";
    import Sort from "../../components/Sort";
    import NoMatches from "../../components/NoMatches";

    export default {
        name: "Student",
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
            filterForm: localStorage.getItem('filterFormStudent')
                ? JSON.parse(localStorage.getItem('filterFormStudent'))
                : {
                    sort_field: '',
                    search: '',
                    search_field: '',
                    sort: 'ASC',
                    date_from: '',
                    date_to: ''
                },
            fields: [
                'name',
                'gender',
                'birth',
                'parents',
                'address',
                'phone',
                'passport_data',
                'report_card',
                'date_of_admission',
                'group',
                'course',
                'speciality',
                'form_of_study'
            ],
            students: [],
        }),
        methods:{
            deleteItem(student){
                this.$props.modals.delete = {
                    visible: true,
                    url: `/api/student/${student.id}/delete`,
                    method: 'POST',
                    title: 'Delete student?',
                    canUpdate: false
                };
            },
            getData(){
                this.showNoMatch = false
                this.showLoader = true;
                axios
                    .post('/api/student', this.filterForm).then(response => {
                    this.students = response.data;
                    if (this.students.length === 0) this.showNoMatch = true;
                    this.showLoader = false;
                })
                    .catch(error => {this.grades = []; this.showNoMatch = true; this.showLoader = false;});
            }
        },
        mounted() {
            document.title = 'Subject';
            this.getData();
        },
        watch: {
            filterForm: {
                handler(newValue) {localStorage.setItem("filterFormStudent", JSON.stringify(newValue))},
                deep: true
            },
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
    .table-scroll {
        max-height: calc(100vh - 80px - 44px - 60px - 70px - 50px);
    }
    .blue{
        font-weight: 700;
        color: #4c4cff
    }
    .pink{
        font-weight: 700;
        color: #EE4443
    }
    .vue-table__cell{
        flex: 1 0 25%;
        width: 25%;
    }

</style>
