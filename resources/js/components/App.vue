<template>
    <div class="">
        <div class="alert alert-success" role="alert" v-if="successMessage != ''">
            {{ successMessage }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        
        <div class="mainsearch">
            <div class="overlay"></div>
            <div class="container">
                <div class="row">
                    <div class="col-xl-9 mx-auto">
                        <h1 class="mb-5 text-white text-center">Trouver votre produit en vrac le moins cher</h1>
                    </div>
                    <div class="col-md-10 col-lg-8 col-xl-7 mx-auto">
                        <autocomplete :id="'search'" :isAsync="true" :items="productItems" v-on:change="productChanged" v-on:selected="productSelected" :placeholder="'Commencez votre recherche...'" />                  
                    </div>
                </div>
            </div>
        </div>

        <div class="mt-5">
            <div class="container">
                <div class="row">
                    <div class="col-12 mx-auto">
                        <store-list :product="product" />
                    </div>
                </div>
            </div>
        </div>

        <modal :id="'addProduct'" :title="'Ajouter un produit'" v-if="$root.showModal.addProduct">
            <add-product :token="$root.token" slot="content" v-on:success="addProductSuccess" />
        </modal>

        <modal :id="'login'" :title="'Connexion'" v-if="$root.showModal.login">
            <login slot="content" v-on:success="loginSuccess" />
        </modal>

    </div>
</template>


<script>
import Autocomplete from './Autocomplete';
import Api from './../mixins/api.js';
import Modal from './Modal';
import AddProduct from './AddProduct';
import StoreList from './StoreList';
import Login from './auth/Login';

export default {
    data() {
        return {
            successMessage: '',
            productItems: [],
            product: {},
        }
    },
    methods: {
        addProductSuccess(message) {
            this.$root.showModal.addProduct = false;
            this.successMessage = message;
        },
        loginSuccess(data) {
            this.$root.showModal.login = false;
            this.$root.token = data.data.access_token;
            this.$root.isLoggedIn = true;
        },
        productSelected(value) {
            var $this = this;
            this.api('/api/stores/list', {
                product: value
            }).get(function(response) {
                $this.product = response.data;
            }, function(error) {
                console.log(error);
            });
        },
        productChanged(value) {
            var $this = this;
            this.api('/api/products/search', {
                search: value
            }).get(function(response) {
                $this.productItems = response.data;
            }, function(error) {
                console.log(error);
            });
        },
    },
    components: { Autocomplete, Modal, AddProduct, StoreList, Login},
    mixins: [Api]
}
</script>
