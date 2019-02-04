<template>
    <div>
        <div v-if="products.length > 0">
            <div v-for="product in products" class="chip" v-bind:key="product.id">
                {{ product.title }}
                <a class="btn-floating red" @click.prevent="removeProduct(product.id)">
                    <i class="material-icons">close</i>
                </a>
            </div>
        </div>

        <div class="card red" v-if="products.length === 0">
            <div class="card-content white-text">
                Nenhum produto...
            </div>
        </div>

        <form class="grey lighten-4" @submit.prevent="newProduct()" style="margin-top: 40px; padding: 10px; border-radius: 2px;">
            <strong>Novo produto:</strong>
            <div class="">
                <select class="browser-default" v-model="newProductData">
                    <option value="" disabled="" selected="">Escolha um produto</option>
                    <option v-for="product in productsList.data" :value="product" v-bind:key="product.id">{{ product.title }}</option>
                </select>
            </div>
            <input id="elementSaveBtn" type="submit" value="+" class="btn">
        </form>
    </div>
</template>

<script>
    export default {
        props: [
            'messageData'
        ],
        data: function () {
            return {
                message: this.messageData,
                dataToSave: {},
                newProductData: '',
                products: []
            }
        },
        methods: {
            newProduct: function () {
                let data = {
                    id: this.message.id,
                    product_id: this.newProductData.id
                }
                
                this.$store.dispatch('setMessageProduct', data).then(() => {
                    this.$store.dispatch('getMessageProduct', this.message.id).then((response) => {
                        this.products = response.data
                        this.newProductData = ''
                    })
                })
            },
            removeProduct: function (productId) {
                let data = {
                    id: this.message.id,
                    product_id: productId
                }
                this.$store.dispatch('removeMessageProduct', data).then(() => {
                    this.$store.dispatch('getMessageProduct', this.message.id).then((response) => {
                        this.products = response.data
                    })
                })
            }
        },
        computed: {
            productsList () {
                return this.$store.state.product.listProducts
            }
        },
        mounted () {
            this.$store.dispatch('getProducts')
            this.$store.dispatch('getMessageProduct', this.message.id).then((response) => {
                this.products = response.data
            })
        }
    }
</script>