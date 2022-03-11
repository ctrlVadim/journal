<template>
    <div class="content_container">
        <h1>{{formData.id ? "Student update" : "Student creation"}}</h1>
        <form @submit.prevent="formData.id ? update() : create()">
            <div class="d-flex gap-5">
                <div>
                    <div class="vue-field mb-4">
                        <label for="name">Name</label>
                        <input v-model="formData.name" type="text" name="name" id="name" placeholder="Enter the name...">
                    </div>
                    <div class="vue-field mb-4">
                        <label for="surname">Surname</label>
                        <input v-model="formData.surname" type="text" name="surname" id="surname" placeholder="Enter the surname...">
                    </div>
                    <div class="vue-field mb-4">
                        <label for="patronymic">Patronymic</label>
                        <input v-model="formData.patronymic" type="text" name="patronymic" id="patronymic" placeholder="Enter the patronymic...">
                    </div>
                    <div class="vue-field mb-4">
                        <label for="course">Course</label>
                        <input v-model="formData.course" type="text" name="course" id="course" placeholder="Enter the course...">
                    </div>
                    <div class="vue-field mb-4">
                        <label for="group">Group</label>
                        <input v-model="formData.group" type="text" name="group" id="group" placeholder="Enter the group...">
                    </div>
                </div>
                <div>
                    <div class="vue-field mb-4">
                        <label for="address">Address</label>
                        <input v-model="formData.address" type="text" name="address" id="address" placeholder="Enter the address...">
                    </div>
                    <div class="vue-field mb-4">
                        <label for="report_card">Report card</label>
                        <input v-model="formData.report_card" type="text" name="report_card" id="report_card" placeholder="Enter the report card...">
                    </div>
                    <div class="vue-field mb-4">
                        <label for="passport_data">Passport data</label>
                        <input v-model="formData.passport_data" type="text" name="passport_data" id="passport_data" placeholder="Enter the passport data...">
                    </div>
                    <div class="vue-field mb-4">
                        <label for="phone">Phone</label>
                        <input v-model="formData.phone" type="text" name="phone" id="phone" placeholder="Enter the phone...">
                    </div>
                    <div class="vue-field mb-4">
                        <label >Birth</label>
                        <date-picker     v-model="formData.birth"></date-picker>
                    </div>
                </div>
                <div>
                    <div class="vue-field mb-4">
                        <label for="patronymic">Form of study</label>
                        <select v-model="formData.form_of_study" name="form_of_study" id="form_of_study">
                            <option value="0">Заочная</option>
                            <option value="1">Очная</option>
                        </select>
                    </div>

                    <div class="vue-field mb-4">
                        <label for="speciality_id">Speciality</label>
                        <select v-model="formData.speciality_id" name="speciality_id" id="speciality_id">
                            <option v-for="speciality in specialities" :value="speciality.id">
                                {{speciality.name}}
                            </option>
                        </select>
                    </div>
                    <div class="vue-field mb-4">
                        <label for="parents">Parents</label>
                        <select v-model="formData.parents" name="parents" id="parents">
                            <option value="Отец">Отец</option>
                            <option value="Мать">Мать</option>
                            <option value="Отец и мать">Отец и мать</option>
                            <option value="Нет">Нет</option>
                        </select>
                    </div>
                    <div class="vue-field mb-4">
                        <label for="gender">Gender</label>
                        <select v-model="formData.gender" name="gender" id="gender">
                            <option value="М">М</option>
                            <option value="Ж">Ж</option>
                        </select>
                    </div>
                    <div class="vue-field mb-4">
                        <label >Date of admission</label>
                        <date-picker  v-model="formData.date_of_admission"></date-picker>
                    </div>
                </div>
            </div>
            <div class="vue-field">
                <button type="submit" class="main-button red-hover">{{formData.id ? "Update" : "Create  "}}</button>
            </div>
        </form>
    </div>
</template>

<script>
    import DatePicker from 'vue2-datepicker';

    export default {
        name: "StudentSingle",
        components: {
            DatePicker
        },
        mounted() {
            this.getItem(this.$route.params.id);
            this.getSubjects();
            this.getSpecialities();
        },
        data: () => ({
            formData: {
                name: '',
                surname: '',
                patronymic: '',
                gender: '',
                birth: '',
                parents: '',
                address: '',
                phone: '',
                passport_data: '',
                report_card: '',
                date_of_admission: '',
                group: '',
                course: '',
                speciality_id: '',
                form_of_study: '',
            },
            subjects: {},
            specialities: {},
        }),
        methods: {
            getSpecialities(){
                axios.post('/api/speciality').then(response => {
                    this.specialities = response.data;
                });
            },
            getSubjects(){
                axios.post('/api/subject').then(response => {
                    this.subjects = response.data;
                });
            },
            getItem(id){
                axios.get('/api/student/item/' + id).then(response => {
                    this.formData = response.data;
                });
            },
            create(){
                axios.post('/api/student/create', this.formData).then(response => {
                    this.$router.push('/');
                });
            },
            update(){
                axios.post(`/api/student/${this.formData.id}/update`, this.formData).then(response => {
                    this.$router.push('/');
                });
            }
        },
    }
</script>

<style scoped>
    .vue-field label{
        display: block;
        font-size: 18px
    }
    .vue-field input{
        height: 40px;
    }
    .vue-field textarea{

        height: 300px;
        width: 600px;
    }
    .vue-field input, .vue-field textarea{
        margin-right: 20px;
        border-radius: 8px ;
        background: #263144 ;
        color: #fff ;
        border: 0 ;
        outline: none ;
        padding: 0 15px;
        line-height: 40px;
    }
    .vue-field select{
        height: 40px;
        line-height: 40;
        border-radius: 8px ;
        background: #263144 ;
        color: #fff ;
        border: 0 ;
        outline: none ;
        padding: 0 15px;
    }
</style>
