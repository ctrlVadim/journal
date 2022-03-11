<template>
    <div class="pagination mt-4 d-flex gap-4">
        <div class="pagination__pages">
            <button class="main-button red-hover a-btn" :disabled="Number(pagination.current_page) - 1 < 1" @click="changePage(Number(pagination.current_page) - 1)">
                <i class='bx bxs-left-arrow'></i>
            </button>
            <button class="main-button red-hover a-btn" :disabled="Number(pagination.current_page) + 1 > Number(pagination.last_page)" @click="changePage(Number(pagination.current_page) + 1)">
                <i class='bx bxs-right-arrow'></i>
            </button>
        </div>
    </div>
</template>

<script>
    export default {
        name: "Pagination",
        props: {
            pagination: {
                type: Object,
                default: () => ({}),
            }
        }
    }
</script>

<style scoped>

</style>
