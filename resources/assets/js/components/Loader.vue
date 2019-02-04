<template>
    <div id="preloader" v-if="counter !== 0">
        <div class="preloader-wrapper big active">
            <div class="spinner-layer spinner-red-only">
                <div class="circle-clipper left">
                    <div class="circle"></div>
                </div><div class="gap-patch">
                    <div class="circle"></div>
                </div><div class="circle-clipper right">
                    <div class="circle"></div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
       data: function () {
           return {
               counter: 0
           }
       },
       mounted() {
           axios.interceptors.request.use((config) => {
               this.counter ++
               return config
           }, (error) => {
               return Promise.reject(error)
           })
           axios.interceptors.response.use((config) => {
               this.counter --
               return config
           }, (error) => {
               this.counter --
               return Promise.reject(error)
           })
       }
    }
</script>

<style>
    #preloader {
        background: rgba(255, 255, 255, 0.5);
        position: fixed;
        left: 0;
        top: 0;
        width:100%;
        height: 100%;
        z-index: 99999;
    }
    #preloader .preloader-wrapper {
        position: fixed;
        left: 50%;
        top: 50%;
    }
</style>