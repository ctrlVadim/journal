<template>
    <div class="loader">
        <div class="lds-dual-ring"></div>
    </div>
</template>

<script>
    export default {
        name: "Loader"
    }
</script>

<style scoped>
    .loader{
        width: 100%;
        height: 100%;
        display: flex;
        align-items: center;
        justify-content: center;
    }
    .lds-dual-ring {
        display: inline-block;
        width: 40px;
        height: 40px;
    }
    .lds-dual-ring:after {
        content: " ";
        display: block;
        width: 32px;
        height: 32px;
        margin: 8px;
        border-radius: 50%;
        border: 4px solid #EE4443;
        border-color: #EE4443 transparent #EE4443 transparent;
        animation: lds-dual-ring 2s linear infinite;
    }
    @keyframes lds-dual-ring {
        0% {
            transform: rotate(0deg);
        }
        100% {
            transform: rotate(360deg);
        }
    }

</style>
