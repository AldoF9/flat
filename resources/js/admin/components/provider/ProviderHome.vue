<template>
    <Section class="main-container pb-5">
        <div class="row mt-5 justify-content-center">
            <h1 class="font-weight-bold" style="color: #7019c1">Proveedores</h1>
        </div>
        <div class="row mt-5 justify-content-end">
            <div class="col-12 mr-5 pr-5 text-end">
                <form-provider :is-update="false"></form-provider>
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
                            <form-provider :is-update="true" :data-update="item" :provider-id="item.id"></form-provider>
                        </template>
                    </v-data-table>
                </div>
            </div>
        </div>
    </Section>
</template>

        <script>
import FormProvider from "./FormProvider";
export default {
  name: "ProviderHome",
    components: {FormProvider},
    data() {
        return {
            isLoading: false,
            headers: [
                { text: "Id", value: "id", class: "purple darken-4 white--text" },
                { text: "Nombre", value: "name", class: "purple darken-4 white--text" },
                { text: "Telefono", value: "phone", class: "purple darken-4 white--text",},
                { text: "Actions", value: "actions", class: "purple darken-4 white--text",},
            ],
            desserts: [],
        };
    },

    created() {
        this.URL_INDEX_CONTENT_URL = route("provider.index_content");
        console.log(this.URL_INDEX_CONTENT_URL);
        axios.get(this.URL_INDEX_CONTENT_URL).then((response) => {
            this.desserts = response.data.data;
        });
    },
};
</script>

        <style scoped>
</style>
