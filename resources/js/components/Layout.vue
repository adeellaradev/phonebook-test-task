<template>
    <div class="row my-5">
        <div class="col-4"></div>
        <div class="col-4 text-center text-white">
            <div class="device">
                <Header></Header>
                <slot></slot>
            </div>
        </div>
        <div class="col-4"></div>
    </div>
</template>

<script>
import Header from "../components/partials/Header.vue";

export default {
    name: "Layout",
    components: {Header}
}
</script>

<style scoped>

</style>
