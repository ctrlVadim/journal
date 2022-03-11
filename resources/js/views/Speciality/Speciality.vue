<template>
    <div class="content_container">
        <div class="d-flex gap-4    ">
            <h1 class="title-fc">Specialities table</h1>
            <transition name="fade" mode="out-in">
                <router-link v-if="specialities.length > 0" :to="'/speciality/view'" class="main-button red-hover a-btn">View as items</router-link>
            </transition>
            <router-link :to="'/speciality/create'" class="main-button red-hover a-btn">Add new</router-link>
        </div>
        <div class="vue-row">
            <div class="main-content">
                <div class="vue-table">
                    <div class="vue-table__header">
                        <div class="vue-table__cell" v-for="field in fields">
                            {{field.replaceAll('_', ' ')}}
                            <i class='bx bxs-upvote'></i>
                            <i class='bx bxs-downvote'></i>
                        </div>
                        <div class="vue-table__cell"></div>
                    </div>
                    <transition name="fade" mode="out-in">
                        <div class="table-scroll scroll-box" v-if="specialities.length > 0">
                            <div class="vue-table__row" v-for="speciality in specialities" >
                                <div class="vue-table__cell">
                                    {{ speciality.name }}
                                </div>
                                <div class="vue-table__cell">
                                    {{ speciality.description }}
                                </div>
                                <div class="vue-table__cell">
                                    <router-link :to="`/speciality/${speciality.id}/update/`">
                                        <i class='bx bxs-message-square-edit' ></i>
                                    </router-link>
                                    <i @click="deleteItem(speciality)" class='bx bxs-message-square-x'></i>
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
                <search :filterForm="filterForm" :fields="fields" @filter="getData" />
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
        name: "Speciality",
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
            filterForm: localStorage.getItem('filterFormSpec')
                ? JSON.parse(localStorage.getItem('filterFormSpec'))
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
                'description'
            ],
            specialities: [],
        }),
        methods:{
            deleteItem(speciality){
                this.$props.modals.delete = {
                    visible: true,
                    url: `/api/speciality/${speciality.id}/delete`,
                    method: 'POST',
                    title: 'Delete speciality?',
                    canUpdate: false
                };
            },
            getData(){
                this.showNoMatch = false
                this.showLoader = true;
                axios
                    .post('/api/speciality', this.filterForm).then(response => {
                    this.specialities = response.data;
                    if (this.specialities.length === 0) this.showNoMatch = true;
                    this.showLoader = false;
                })
                    .catch(error => {this.grades = []; this.showNoMatch = true; this.showLoader = false;});

            }
        },
        mounted() {
            document.title = 'Speciality';
            this.getData();
        },
        watch: {
            filterForm: {
                handler(newValue) {localStorage.setItem("filterFormSpec", JSON.stringify(newValue))},
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
    .vue-table__cell:first-child{
        flex: 1 0 20%;
    }
    .vue-table__cell:nth-child(2){
        flex: 1 0 65%;
    }
</style>
