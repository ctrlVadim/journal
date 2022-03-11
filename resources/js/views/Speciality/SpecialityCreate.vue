<template>
    <div class="content_container">
        <h1>{{formData.id ? "Speciality update" : "Speciality creation"}}</h1>
        <form @submit.prevent="formData.id ? update() : create()">
            <div class="vue-field mb-4">
                <label for="name">Name</label>
                <input v-model="formData.name" type="text" name="name" id="name" placeholder="Enter the name of speciality...">
            </div>
            <div class="vue-field mb-4">
                <label for="description">Description</label>
                <textarea v-model="formData.description" type="text" name="description" id="description" placeholder="Enter the description of speciality..."></textarea>
            </div>
            <div class="vue-field">
                <button type="submit" class="main-button red-hover">Create</button>
            </div>
        </form>
    </div>
</template>

<script>
    export default {
        name: "SpecialitySingle",
        mounted() {
            this.getItem(this.$route.params.id);
        },
        data: () => ({
            formData: {
                name: '',
                description: ''
            },
        }),
        methods: {
            getItem(id){
                axios.get('/api/speciality/item/' + id).then(response => {
                    this.formData = response.data;
                });
            },
            create(){
                axios.post('/api/speciality/create', this.formData).then(response => {
                    this.$router.push('/speciality');
                });
            },
            update(){
                axios.post(`/api/speciality/${this.formData.id}/update`, this.formData).then(response => {
                    this.$router.push('/speciality');
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
</style>
