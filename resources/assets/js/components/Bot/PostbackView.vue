<template>
    <div>
        <h3><small>Postbacks:</small> {{ postback.value }}</h3>

    </div>
</template>

<script>
    export default {
        computed: {
            postback() {
                return this.$store.state.postback.postback
            }
        },
        mounted() {
            this.$store.dispatch('getPostback', this.$route.params.id)
        }
    }
</script>