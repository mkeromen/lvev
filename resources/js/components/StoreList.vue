<template>
    <div v-if="product.stores">
        <h2>Résultats pour le produit : {{ product.name }}</h2>
        <div class="card mt-5" :key="index" v-for="(store, index) in product.stores">
            <div class="card-header font-weight-bold">{{ store.pivot.product_price }}$/{{ product.unit.symbol }}</div>
            <div class="card-body">
                <h5 class="card-title">{{ store.name }}</h5>
                <a href="#" class="btn btn-primary">Mettre à jour le prix</a>
                <a :href="store.url" target="_blank" class="btn btn-primary" v-if="store.url">Découvrir l'épicerie</a>
            </div>
        </div>
    </div>
</template>

<script>
export default {
     props: {
         product: {
            type: Object,
            required: false,
         }
     }
}
</script>