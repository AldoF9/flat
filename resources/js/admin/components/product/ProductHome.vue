<template>
    <Section class="main-container pb-5">
        <div class="row mt-5 justify-content-center">
            <h1 class="font-weight-bold" style="color: #7019c1">Productos</h1>
        </div>
        <div class="row mt-5 justify-content-end">
            <div class="col-12 mr-5 pr-5 text-end">
                <form-product :is-update="false" :items-category="allCategory"></form-product>
            </div>
        </div>
        <div>
            <div class="row ml-3">
                <div class="col-12">
                    <v-data-table
                        :headers="headers"
                        :items="desserts"
                        class="elevation-1"
                    >
                        <template v-slot:item.actions="{item}">
                            <form-product :is-update="true" :data-update="item"
                                          :product-id="item.id" :items-category="allCategory"></form-product>
                        </template>
                    </v-data-table>
                </div>
            </div>
        </div>
    </Section>
</template>

        <script>
import FormProduct from "./FormProduct";
export default {
  name: "ProductHome",
    components: {FormProduct},
    data() {
        return {
            isLoading: false,
            allCategory: [],
            headers: [
                { text: "Id", value: "id", class: "purple darken-4 white--text" },
                { text: "Sku", value: "sku", class: "purple darken-4 white--text" },
                { text: "Nombre", value: "name", class: "purple darken-4 white--text"},
                { text: "Stock", value: "stock", class: "purple darken-4 white--text"},
                { text: "Calificacion", value: "calif", class: "purple darken-4 white--text"},
                { text: "Categoria", value: "category.name", class: "purple darken-4 white--text"},
                { text: "Actions", value: "actions", class: "purple darken-4 white--text",},
            ],
            desserts: [],
        };
    },

    created() {
        this.URL_CATEGORY = route('product.category');
        this.URL_INDEX_CONTENT_URL = route("product.index_content");
        console.log(this.URL_INDEX_CONTENT_URL);
        axios.get(this.URL_INDEX_CONTENT_URL).then((response) => {
            this.desserts = response.data.data;
        });
    },

    mounted() {
        axios.get(this.URL_CATEGORY).then(response => {
            this.allCategory = response.data.data;
        });

        console.log(this.allCategory);

    },
};
</script>

        <style scoped>
</style>
