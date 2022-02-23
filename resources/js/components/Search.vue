<template>
    <form @submit.prevent="search" class="search-form">
        <input type="text" name="student" v-model="filterForm.search" placeholder="Search for...">
        <div class="search-form__clear red-hover" v-if="filterForm.search" @click="filterForm.search = ''">
            <i class='bx bx-x'></i>
        </div>
        <select type="text" name="student" v-model="filterForm.search_field">
            <option value="" selected>Select the field</option>
            <option value="student">Student</option>
            <option value="subject">Subject</option>
            <option value="date">Date</option>
            <option value="grade">Grade</option>
        </select>
        <button type="submit" class="red-hover"><i class='bx bx-search-alt' ></i> Search</button>
    </form>
</template>

<script>
    export default {
        name: "Search",
        props: {
            filterForm: {
                type: Object,
                default: () => ({}),
            }
        },
        methods: {
            search(){
                console.log('asd')
                this.$emit('filter')
            },
        }
    }
</script>

<style scoped>
    .search-form__clear{
        width: 40px;
        display: flex;
        align-items: center;
        justify-content: center;
        color: #fff;
        border-radius: 0;
        border: 0;
        font-size: 30px;
    }
    .search-form{
        width: 100%;
        margin-top: 20px;
        height: 40px;
        display: flex;
    }
    .search-form>*{
        height: 40px;
        margin: 0;
        padding: 0 15px;
        line-height: 40px;
        outline: 0;
        border: 0;
    }
    .search-form input{
        border-radius: 8px 0 0 8px;
        background: #263144;
        color: #fff;
        flex: 1;
    }
    .search-form select{
        padding-right: 20px;
        background: #35455f;
        color: #fff;
    }
    .search-form button{
        border-radius: 0 8px 8px 0;
        display: flex;
        align-items: center;
    }
    .search-form button i{
        font-size: 20px;
        padding: 0;
    }
</style>
