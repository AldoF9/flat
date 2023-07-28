<template>
    <Section class="main-container pb-5">
        <div class="row mt-5 justify-content-center">
            <h1 class="font-weight-bold" style="color: #7019c1">Ingresos</h1>
        </div>
        <div class="row mt-5 justify-content-end">
            <div class="col-12 mr-5 pr-5 text-end">
                <form-income :is-update="false" :items-product="allProduct"
                           :items-provider="allProvider" :item-user="allUser"></form-income>
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

                    </v-data-table>
                </div>
            </div>
        </div>
    </Section>
</template>

        <script>
import FormIncome from "./FormIncome";
export default {
  name: "IncomeHome",
    components: {FormIncome},
    data() {
        return {
            isLoading: false,
            allProduct: [],
            allProvider: [],
            allUser: [],
            headers: [
                { text: "Id", value: "id", class: "purple darken-4 white--text" },
                { text: "Folio", value: "folio", class: "purple darken-4 white--text" },
                { text: "Fecha", value: "date", class: "purple darken-4 white--text"},
                { text: "total", value: "total", class: "purple darken-4 white--text"},
                { text: "Monetario", value: "monetario", class: "purple darken-4 white--text"},
                { text: "Cantidad", value: "cantidad", class: "purple darken-4 white--text"},
                { text: "Total_unitario", value: "total_unitario", class: "purple darken-4 white--text"},
                { text: "Producto", value: "product.name", class: "purple darken-4 white--text"},
                { text: "Proveedor", value: "provider.name", class: "purple darken-4 white--text"},
                { text: "Usuario", value: "user.name", class: "purple darken-4 white--text"},
            ],
            desserts: [],
        };
    },

    created() {
        this.URL_PRODUCT = route('income.product');
        this.URL_PROVIDER = route('income.provider');
        this.URL_USER = route('income.user');
        this.URL_INDEX_CONTENT_URL = route("income.index_content");
        console.log(this.URL_INDEX_CONTENT_URL);
        axios.get(this.URL_INDEX_CONTENT_URL).then((response) => {
            this.desserts = response.data.data;
        });
    },

    mounted() {
        axios.get(this.URL_PRODUCT).then(response => {
            this.allProduct = response.data.data;
        });

        axios.get(this.URL_PROVIDER).then(response => {
            this.allProvider = response.data.data;
        });

        axios.get(this.URL_USER).then(response => {
            this.allUser = response.data.data;
        });

    },
};
</script>

        <style scoped>
</style>
