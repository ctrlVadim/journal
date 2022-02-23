<template>
    <div class="filter">
        <form @submit.prevent="$emit('filter')" @reset.prevent="clear">
            <h3>Select field</h3>
            <div class="fields scroll-box">
                <div v-for="field in fields" class="sort-field">
                    <input type="radio" :value="field" :id="'sort-field__' + field" v-model="filterForm.sort_field" name="sort-field__field">
                    <label :for="'sort-field__' + field" :class="filterForm.sort_field === field ? 'active' : ''">{{field}}</label>
                </div>
            </div>
            <div class="sort-type">
                <input v-model="filterForm.sort" id="sort-type__asc" class="radio-input" type="radio" name="hopping" value="ASC" checked>
                <label for="sort-type__asc" class="radio-label" ><span></span>Sort Ascending <i class='bx bxs-up-arrow' ></i></label>
                <input v-model="filterForm.sort" id="sort-type__desc" class="radio-input"  type="radio" name="hopping" value="DESC">
                <label for="sort-type__desc" class="radio-label" ><span></span>Sort Descending <i class='bx bxs-down-arrow' ></i></label>
                <div class="worm">
                    <div class="worm__segment"></div>
                </div>
            </div>
            <div class="button-container">
                <button type="submit" class="main-button red-hover"><i class='bx bxs-cog' ></i> Sort</button>
                <button type="reset" class="main-button red-hover"><i class='bx bx-reset' ></i>Reset</button>
            </div>
        </form>
    </div>
</template>

<script>
    export default {
        name: "Sort",
        props: {
            fields: {
                type: Array,
                default: () => ([]),
            },
            filterForm: {
                type: Object,
                default: () => ({}),
            }
        },
        data: () => ({
        }),
        methods: {
            sort(){

            },
            clear(){

            }
        },
    }
</script>

<style scoped>
    .button-container button{
        display: flex;
        align-items: center;
    }
    .button-container button i{
        font-size: 20px;
        padding: 0;
    }
    .filter{
        height: 100%;
        padding: 15px;
        background: #263144;
        border-radius: 8px;
    }
    .sort-field input{
        display: none;
    }
    .fields{
        background: #3e4f6d;
        border-radius: 8px;
        height: 200px;
    }
    .sort-field label{
        height: 40px;
        line-height: 40px;
        padding: 0 10px;
        font-size: 20px;
        background: #3e4f6d;
        transition: ease .2s;
        width: 100%;
        cursor: pointer;
    }
    .sort-field input:checked + label{
        background: #4f6890;
    }
    .sort-field label:hover{
        background: #35455f;
    }
    .sort-type{
        position: relative;
        margin-top: 20px;
    }
    form{
        display: flex;
        flex-direction: column;
        flex-flow: column;
        height: 100%    ;
    }
    .sort-field label::first-letter {
        text-transform:capitalize;
    }
    .button-container{
        margin-top: 10px;
        flex: 1;
        display: flex;
        gap: 10px;
        height: auto;
    }
    .button-container button{
        margin-top: auto;
    }
</style>
