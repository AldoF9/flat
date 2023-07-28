<template>
    <Section class="main-container pb-5">
        <div class="row mt-5 justify-content-center">
            <h1 class="font-weight-bold" style="color: #7019c1">Ventas</h1>
        </div>
        <div class="row mt-5 justify-content-end">
            <div class="col-12 mr-5 pr-5 text-end">
                <form-sale :is-update="false" :items-product="allProduct"
                           :items-client="allClient" :item-state="allState"></form-sale>
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
                            <form-sale :is-update="true" :items-product="allProduct"
                                       :sale-id="item.id" :items-client="allClient"
                                       :item-state="allState" :data-update="item"></form-sale>
                        </template>
                    </v-data-table>
                </div>
            </div>
        </div>
    </Section>
</template>

        <script>
import FormSale from "./FormSale";
export default {
  name: "SaleHome",
    components: {FormSale},
    data() {
        return {
            isLoading: false,
            allProduct: [],
            allClient: [],
            allState: [],
            headers: [
                { text: "Id", value: "id", class: "purple darken-4 white--text" },
                { text: "Folio", value: "folio", class: "purple darken-4 white--text" },
                { text: "Fecha", value: "date", class: "purple darken-4 white--text"},
                { text: "Imuesto", value: "imuesto", class: "purple darken-4 white--text"},
                { text: "Total", value: "total", class: "purple darken-4 white--text"},
                { text: "Estado", value: "state.name", class: "purple darken-4 white--text"},
                { text: "Producto", value: "product.name", class: "purple darken-4 white--text"},
                { text: "Cliente", value: "client.name", class: "purple darken-4 white--text"},
                { text: "Actions", value: "actions", class: "purple darken-4 white--text",},
            ],
            desserts: [],
        };
    },

    created() {
        this.URL_PRODUCT = route('sale.product');
        this.URL_CLIENT = route('sale.client');
        this.URL_STATE = route('sale.state');
        this.URL_INDEX_CONTENT_URL = route("sale.index_content");
        console.log(this.URL_INDEX_CONTENT_URL);
        axios.get(this.URL_INDEX_CONTENT_URL).then((response) => {
            this.desserts = response.data.data;
        });
    },

    mounted() {
        axios.get(this.URL_PRODUCT).then(response => {
            this.allProduct = response.data.data;
        });

        axios.get(this.URL_CLIENT).then(response => {
            this.allClient = response.data.data;
        });

        axios.get(this.URL_STATE).then(response => {
            this.allState = response.data.data;
        });

    },
};
</script>

        <style scoped>
</style>
