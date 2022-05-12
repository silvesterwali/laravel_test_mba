<template>
    <div class="container">
         <div class="pricing-header px-3 py-3 pt-md-5 pb-md-4 mx-auto text-center">
            <h1 class="display-4">Happy Product</h1>
            <p class="lead">Quickly build an effective pricing table for your potential customers with this Bootstrap example. It's built with default Bootstrap components and utilities with little customization.</p>
        </div>
        <div class="table-responsive">
            <table class="table table-stipped">
                <thead>
                    <tr>
                        <th scope="col">Nama</th>
                        <th scope="col">Harga</th>
                        <th scope="col">Persediaan</th>
                        <th scope="col">Keterangan</th>
                        <td scope="col">Action</td>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="product,index in products" :key="index">
                        <td>{{product.nama}}</td>
                        <td>{{product.harga}}</td>
                        <td>{{product.persediaan}}</td>
                        <td>
                        <span style="max-width: 100px;" class="text-truncate">
                            {{product.keterangan}}
                        </span>
                        </td>
                        <td>
                            <button class="btn btn-primary" >Edit</button>
                            <button class="btn btn-danger" >Delete</button>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</template>

<script>
    import axios from 'axios';
    export default {
        name: 'Index',
        data() {
            return {
                message: 'Hello Vue!',
                products:[]
            }
        },
        beforeMount(){
            this.getProducts()
        },
        methods: {
            getProducts() {
                axios.get('/api/products')
                .then(response => {
                    this.products = response.data
                })
                .catch(error => {
                    console.log(error)
                })
            }
    }}
</script>

<style lang="scss" scoped>

</style>