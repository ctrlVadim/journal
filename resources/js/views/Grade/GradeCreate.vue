<template>
    <div class="content_container">
        <h1>{{formData.id ? "Grade update" : "Grade creation"}}</h1>
        <form @submit.prevent="formData.id ? update() : create()">
            <div class="vue-field mb-4">
                <label for="student_id">Student</label>
                <select v-model="formData.student_id" name="student_id" id="student_id">
                    <option v-for="student in students" :value="student.id">
                        {{ `${student.name} ${student.surname} ${student.patronymic}` }}
                    </option>
                </select>
            </div>
            <div class="vue-field mb-4">
                <label for="subject_id">Subject</label>
                <select v-model="formData.subject_id" name="subject_id" id="subject_id">
                    <option v-for="subject in subjects" :value="subject.id">
                        {{subject.name}}
                    </option>
                </select>
            </div>
            <div class="vue-field mb-4">
                <label >Date</label>
                <date-picker v-model="formData.date"></date-picker>
            </div>
            <div class="vue-field mb-4">
                <label for="grade">Grade</label>
                <select v-model="formData.grade" name="grade" id="grade">
                    <option v-for="grade in [1, 2, 3, 4, 5]" :value="grade">{{grade}}</option>
                </select>
            </div>
            <div class="vue-field">
                <button type="submit" class="main-button red-hover">{{formData.id ? "Update" : "Create"}}</button>
            </div>
        </form>
    </div>
</template>

<script>
    import DatePicker from 'vue2-datepicker';

    export default {
        name: "gradeSingle",
        components: {
            DatePicker
        },
        mounted() {
            this.getItem(this.$route.params.id);
            this.getStudents(this.$route.params.id);
            this.getSubjects(this.$route.params.id);
        },
        data: () => ({
            formData: {
                grade: '',
                student_id: '',
                subject_id: '',
                date: ''
            },
            students: {},
            subjects: {},
        }),
        methods: {
            getStudents(){
                axios.post('/api/student').then(response => {
                    this.students = response.data;
                });
            },
            getSubjects(){
                axios.post('/api/subject').then(response => {
                    this.subjects = response.data;
                });
            },
            getItem(id){
                axios.get('/api/grade/item/' + id).then(response => {
                    this.formData = response.data;
                });
            },
            create(){
                axios.post('/api/grade/create', this.formData).then(response => {
                    this.$router.push('/grade');
                });
            },
            update(){
                axios.post(`/api/grade/${this.formData.id}/update`, this.formData).then(response => {
                    this.$router.push('/grade');
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
