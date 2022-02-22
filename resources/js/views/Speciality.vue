<template>
    <div class="content_container">
        <h1>Specialities table</h1>
        <div class="vue-table" v-if="specialities.length > 0">
            <div class="vue-table__header">
                <div class="vue-table__cell">
                    Name
                    <i class='bx bxs-upvote'></i>
                    <i class='bx bxs-downvote'></i>
                </div>
                <div class="vue-table__cell">
                    Description
                    <i class='bx bxs-upvote'></i>
                    <i class='bx bxs-downvote'></i>
                </div>
                <div class="vue-table__cell">

                </div>
            </div>
            <div class="vue-table__row" v-for="speciality in specialities" >
                <div class="vue-table__cell">
                    {{ speciality.name }}
                </div>
                <div class="vue-table__cell">
                    {{ speciality.description }}
                </div>
                <div class="vue-table__cell">
                    <router-link :to="'/speciality/update/' + speciality.id">
                        <i class='bx bxs-message-square-edit' ></i>
                    </router-link>
                    <i class='bx bxs-message-square-x' @click="showModal('delete', 'Delete this speciality?')"></i>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        name: "Speciality",
        data: () => ({
            filterForm: {
                sort: 0,
            },
            specialities: [],
        }),
        methods:{
            getSpeciality(){
                axios.get('/api/speciality').then(
                    response => {
                        console.log(response.data)
                        this.specialities = response.data;
                    }
                ).catch(
                    error => {
                        this.specialities = [];
                    }
                );
            }
        },
        mounted() {
            this.getSpeciality();
        },
    }
</script>

<style scoped>
    .vue-table__cell{
        flex: 1 0 22.5%;
    }
</style>
