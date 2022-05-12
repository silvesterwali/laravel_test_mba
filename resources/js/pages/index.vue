<template>
    <div class="container">
         <div class="pricing-header px-3 py-3 pt-md-5 pb-md-4 mx-auto text-center">
            <h1 class="display-4">Happy Product</h1>
            <p class="lead">Quickly build an effective pricing table for your potential customers with this Bootstrap example. It's built with default Bootstrap components and utilities with little customization.</p>
        </div>
        <div>
        <button type="button" class="btn btn-primary" @click="openModal">
            Add Product
        </button>
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
                            <button class="btn btn-primary"  @click="editItem(product)" >Edit</button>
                            <button class="btn btn-danger" @click="deleteItem(product)" >Delete</button>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
      
        <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true" :class="{ show: show, 'd-block': show }">
            <div class="modal-dialog">
                <form @submit.prevent="validateForm">
                <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">Product</h5>
                    <button type="button" @click="show=false" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="form-group mb-2">
                        <label>Nama</label>
                        <input v-model="dataForm.nama" class="form-control" placeholder="Nama">
                    </div>
                     <div class="form-group mb-2">
                        <label>Harga</label>
                        <input v-model="dataForm.harga" class="form-control" placeholder="Harga">
                    </div>
                     <div class="form-group mb-2">
                        <label>Persediaan</label>
                        <input v-model="dataForm.persediaan" class="form-control" placeholder="Persediaan">
                    </div>
                     <div class="form-group mb-2">
                        <label>Keterangan</label>
                        <input v-model="dataForm.keterangan" class="form-control" placeholder="keterangan">
                    </div>
   
                </div>
                    <div class="modal-footer ">
                        <button type="button" @click="show=false" class="btn btn-secondary float-right" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary float-end">Submit</button>
                    </div>
                    </div>
                </form>
                </div>
            </div>
    </div>
</template>

<script>
    import axios from 'axios';
    import {VueFinalModal} from 'vue-final-modal'
    export default {
        name: 'Index',
        components:{
            VueFinalModal
        },
        data() {
            return {
                message: 'Hello Vue!',
                products:[],
                show:false,
                errors:null,
                dataForm:{
                    nama:null,
                    harga:null,
                    persediaan:null,
                    keterangan:null
                }
            }
        },
        beforeMount(){
            this.getProducts()
        },
        methods: {
            getProducts() {
                this.resetForm()
                axios.get('/api/products')
                .then(response => {
                    this.products = response.data
                })
                .catch(error => {
                    console.log(error)
                })
            },
            openModal(){
                this.resetForm()
                this.show= true
            },
            validateForm(){
                if (this.dataForm?.id) {
                    this.updateProduct()
                } else {
                    this.storeProduct()
                }
            },
            /**
            * create new product
            */
            async storeProduct(){
                this.errors=null
                try {
                    const response = await axios.post('/api/products',this.dataForm)
                    this.show= false
                    alert(response.data.message)
                    this.getProducts()
                } catch (error) {
                    this.errors = error.response.data.errors
                }
            },
            /**
            * update product
            */
            async updateProduct(){
                this.errors=null
                try {
                    const response = await axios.patch('/api/products/'+this.dataForm.id,this.dataForm)
                    alert(response.data.message)
                    this.show= false
                    this.getProducts()
                } catch (error) {
                    this.errors = error.response.data.errors
                }
            },
            editItem(product){
                this.dataForm = product
                this.show= true
            },
            resetForm(){
                this.dataForm = {
                    nama:null,
                    harga:null,
                    persediaan:null,
                    keterangan:null
                }
            },
            deleteItem(product){
                if (confirm('Are you sure you want to delete this item?')) {
                    axios.delete('/api/products/'+product.id)
                    .then(response => {
                        alert(response.data.message)
                        this.getProducts()
                    })
                    .catch(error => {
                        console.log(error)
                    })
                }
            }
        }
    }
</script>

<style lang="scss" scoped>

</style>