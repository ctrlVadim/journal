<template>
    <form @submit.prevent="search" class="search-form">
        <div class="date-sort__container" v-if="dateFields.includes(filterForm.search_field)">
            <span>From:</span>
            <date-picker v-model="filterForm.date_from"></date-picker>
            <span>To:</span>
            <date-picker v-model="filterForm.date_to"></date-picker>
        </div>
        <input v-if="!(dateFields.includes(filterForm.search_field))" type="text" name="student" v-model="filterForm.search" placeholder="Search for...">
        <div class="search-form__clear red-hover" v-if="filterForm.search" @click="clear">
            <i class='bx bx-x'></i>
        </div>
        <select :class="dateFields.includes(filterForm.search_field) ? 'br-full' : ''" type="text" v-model="filterForm.search_field">
            <option value="" selected>Select the field</option>
            <option v-for="field in fields" :value="field">{{field.replaceAll('_', ' ')}}</option>
        </select>
        <button type="submit" class="red-hover"><i class='bx bx-search-alt' ></i> Search</button>
    </form>
</template>

<script>
    import DatePicker from 'vue2-datepicker';
    import 'vue2-datepicker/index.css';

    export default {
        name: "Search",
        components: { DatePicker },
        props: {
            filterForm: {
                type: Object,
                default: () => ({}),
            },
            dateFields: {
                type: Array,
                default: () => ([]),
            },
            fields: {
                type: Array,
                default: () => ([]),
            }
        },
        methods: {
            search(){
                this.$emit('filter')
            },
            clear(){
                this.filterForm.search = '';
                this.$emit('filter')
            }
        }
    }
</script>

<style scoped>
    .date-sort__container{
        padding: 0 !important;
        flex: 1;
    }

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
    .search-form select, .search-form option{
        text-transform: capitalize;
    }
    .br-full{
        border-radius: 8px 0 0 8px;
    }
</style>
