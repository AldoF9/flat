<template>
    <Section class="main-container pb-5">
        <div class="row mt-5 justify-content-center">
            <h1 class="font-weight-bold" style="color: #7019c1">Categorias</h1>
        </div>
        <div class="row mt-5 justify-content-end">
            <div class="col-12 mr-5 pr-5 text-end">
                <form-category :is-update="false"></form-category>
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
                            <form-category :is-update="true" :data-update="item" :category-id="item.id"></form-category>
                        </template>
                    </v-data-table>
                </div>
            </div>
        </div>
    </Section>
</template>

      <script>
import FormCategory from "./FormCategory";
export default {
  name: "CategoryHome",
    components: {FormCategory},
    data() {
    return {
        isLoading: false,
        headers: [
            { text: "Id", value: "id", class: "purple darken-4 white--text" },
            { text: "Nombre", value: "name", class: "purple darken-4 white--text" },
            { text: "Descripcion", value: "description", class: "purple darken-4 white--text"},
            { text: "Actions", value: "actions", class: "purple darken-4 white--text",},

        ],
        desserts: [],
    };
  },
    created() {
        this.URL_INDEX_CONTENT_URL = route("category.index_content");
        console.log(this.URL_INDEX_CONTENT_URL);
        axios.get(this.URL_INDEX_CONTENT_URL).then((response) => {
            this.desserts = response.data.data;
        });
    },
};
</script>

      <style scoped>
</style>
