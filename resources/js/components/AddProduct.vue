<template v-slot:content>
	<div>
        <p>Vous avez vu un produit en épicerie à un bon prix et vous voulez le partager avec la communauté.</p>
        
        <div class="alert alert-warning" role="alert" v-if="errors.length">
            <ul class="list-group">
                <li v-for="(error, i) in errors" :key="i">{{ error }}</li>
            </ul>
        </div>

    	<form @submit="submitForm">
            <div class="form-group">
                <autocomplete :label="'Nom du produit'" :id="'product'" :isAsync="true" :items="productItems" v-on:change="productChanged" v-on:selected="productSelected" />
            </div>
            <div class="form-group">
                <autocomplete :label="'Nom de l\'épicerie'" :id="'store'" :isAsync="true" :items="storeItems" v-on:change="storeChanged" v-on:selected="storeSelected" />
            </div>
            <div class="form-group">
                <label for="price">Prix</label>
                <input class="form-control" id="price" v-model="price" type="number" step="0.01" min="0" name="product_price" placeholder="Ex : 4.50" />
            </div>
            <button type="submit" class="btn btn-primary">Ajouter</button>
        </form>
	</div>
</template>

<script>
import Autocomplete from './Autocomplete';
import Api from './../mixins/api.js';
import Messages from './../mixins/messages.js';

export default {
    props: {
        token: {
            type: String,
            required: true,
            default: ''
        }
    },
    data() {
        return {
            errors: [],
            product: 0,
            store: 0,
            price: 0,
            productItems: [],
            storeItems: []
        }
    },
    methods: {
        submitForm(e) {
            e.preventDefault();

            this.checkForm();
            if(!this.errors.length) {
                console.log(this.product + " / " + this.store + " / " + this.price);
                var $this = this;
                this.api('/api/products/add', {
                    product: this.product,
                    store: this.store,
                    price: this.price
                })
                .setAuth(this.token)
                .post(function(response) {
                    $this.success('Merci ! Votre produit a bien été ajouté.');
                }, function(error) {
                    if(error.response) {
                        let errors = error.response.data.errors;
                        $this.errors.push(Object.keys(errors).map(function(key) { return errors[key]; }));
                    }
                });
            }
        },
        checkForm() {
            this.errors = [];
            if(this.product <= 0 || this.product == '') this.errors.push("Le nom du produit est requis.");
            if(this.store <= 0 || this.store == '') this.errors.push("le nom de l'épicerie est requis.");
            if(this.price <= 0) this.errors.push("Le prix est invalide.");
        },
        productSelected(value) {
            this.product = value;
        },
        storeSelected(value) {
            this.store = value;
        },
        storeChanged(value) {
            var $this = this;
            this.store = value;
            this.api('/api/stores/search', {
                search: value
            }).get(function(response) {
                //console.log('store searched');
                $this.storeItems = response.data;
            }, function(error) {
                console.log(error);
            });
        },
        productChanged(value) {
            var $this = this;
            this.product = value;
            this.api('/api/products/search', {
                search: value
            }).get(function(response) {
                //console.log(response.data);
                $this.productItems = response.data;
            }, function(error) {
                console.log(error);
            });
        },
    },
    components: { Autocomplete },
    mixins: [Api, Messages]
}
</script>
