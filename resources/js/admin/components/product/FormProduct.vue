<template>
    <v-dialog v-model="dialog" width="1200" style="border-radius: 2px">
        <template v-slot:activator="{ on, attrs }">
            <v-btn
                v-if="!isUpdate"
                width="210"
                height="40"
                class="white--text"
                v-on="on"
                v-bind="attrs"
                color="#7019c1"
            >
                + Agregar Producto
            </v-btn>
            <v-icon
                v-else
                v-on="on"
                v-bind="attrs"
                class="m-0 p-0"
                large
                style="color: #7019c1"
                @click="updateData(dataUpdate)"
            >
                mdi-pencil
            </v-icon>
        </template>
        <v-card :outline="true" rounded="xl" style="padding: 1.5rem">
            <v-card-text>
                <div>
                    <div class="d-flex justify-content-end">
                        <v-icon class="color-txt-gray mt-2" @click="dialog = false" large
                        >mdi-close</v-icon
                        >
                    </div>

                    <div class="d-flex justify-content-center text-center">
                        <div class="vue-header-icon">
                            <v-icon class="color-txt-gray" style="color: #7019c1" large
                            >mdi-account</v-icon
                            >
                        </div>
                        <div>
                            <h3 class="fields-modal">
                                {{ isUpdate ? "Modificar" : "Agregar" }} Producto
                            </h3>
                        </div>
                    </div>
                    <hr class="widthHr" />

                    <v-form ref="form" lazy-validation>
                        <v-row>
                            <v-col cols="6" class="px-2">
                                <div class="fields-modal" style="">Sku:</div>
                                <v-text-field
                                    v-model="sku"
                                    outlined
                                    :rules="rules.skuRules"
                                    dense
                                ></v-text-field>
                            </v-col>
                            <v-col cols="6" class="px-2">
                                <div class="fields-modal" style="">Nombre:</div>
                                <v-text-field
                                    v-model="name"
                                    outlined
                                    :rules="rules.nameRules"
                                    dense
                                ></v-text-field>
                            </v-col>

                        </v-row>
                        <v-row>
                            <v-col cols="6" class="px-2 vue-cols-modal">
                                <div class="fields-modal">Stock:</div>
                                <v-text-field
                                    v-model="stock"
                                    type="number"
                                    :rules="rules.stockRules"
                                    outlined
                                    dense
                                    maxlength="10"
                                    data-rule-maxlength="10"
                                ></v-text-field>
                            </v-col>
                            <v-col cols="6" class="px-2 vue-cols-modal">
                                <div class="fields-modal">Imagen:</div>
                                <v-text-field
                                    v-model="img"
                                    :rules="rules.imgRules"
                                    outlined
                                    dense
                                ></v-text-field>
                            </v-col>
                        </v-row>
                        <v-row>
                            <v-col cols="6" class="px-2 vue-cols-modal">
                                <div class="fields-modal">Calificacion:</div>
                                <v-text-field
                                    v-model="calif"
                                    type="number"
                                    :rules="rules.califRules"
                                    outlined
                                    dense
                                    maxlength="4"
                                    data-rule-maxlength="4"
                                ></v-text-field>
                            </v-col>
                            <v-autocomplete
                                v-model="fk_id_category"
                                :items="itemsCategory"
                                :rules="rules.categoryRules"
                                item-text="name"
                                item-value="id"
                                dense
                                outlined
                            ></v-autocomplete>
                        </v-row>
                        <v-col cols="12" class="px-3 d-flex justify-content-center">
                            <v-btn
                                :loading="loading"
                                color="#272D3B"
                                width="200"
                                height="50"
                                class="white--text"
                                @click="submit"
                                style="
                  border-radius: 10px;
                  background: #7019c1 0% 0% no-repeat padding-box;
                  box-shadow: 0px 0px 6px #0000001a;
                "
                            >
                                {{ isUpdate ? "Guardar" : "+ Agregar Producto" }}
                            </v-btn>
                        </v-col>
                    </v-form>
                </div>
            </v-card-text>
        </v-card>
    </v-dialog>
</template>

<script>
import Swal from "sweetalert2";

export default {
    name: "FormProduct",
    props: {
        isUpdate: {
            type: Boolean,
            required: true
        },
        dataUpdate: {
            type: Object,
            required: false
        },
        itemsCategory:{
            required: true,
        },
        ProductId:{
            type: Number
        },
    },
    data() {
        return {
            dialog: false,
            loading: false,
            modalLoading: false,
            sku: "",
            name: "",
            stock: "",
            img: "",
            calif: "",
            fk_id_category: "",
            rules: {
                skuRules: [(v) => !!v || "SKU is required"],
                nameRules: [(v) => !!v || "Name is required"],
                stockRules: [(v) => !!v || "Stock is required"],
                imgRules: [(v) => !!v || "Imagen is required"],
                califRules: [(v) => !!v || "Calification is required"],
                categoryRules: [(v) => !!v || "Category is required"],
            },
        };
    },

    methods: {
        async submit() {
            let valid = this.$refs.form.validate();
            if (valid) {
                const formData = new FormData();
                formData.append("sku", this.sku);
                formData.append("name", this.name);
                formData.append("stock", this.stock);
                formData.append("img", this.img);
                formData.append("calif", this.calif);
                formData.append("fk_id_category", this.fk_id_category);

                let route_submit = !this.isUpdate
                    ? route("product.upsert", { idProduct: "FAKE_ID" })
                    : route("product.upsert", { idProduct: this.ProductId });
                axios
                    .post(route_submit, formData)
                    .then((response) => {
                        if (response.data.success) {
                            Swal.fire({
                                title: this.isUpdate
                                    ? "Producto modificado"
                                    : "Producto agregado",
                                icon: "success",
                                confirmButtonText: "Agree",
                                confirmButtonColor: "#00D8BF",
                                timer: 8000,
                            });
                            this.loading = false;
                            this.dialog = false;
                            this.$refs.form.reset();
                            window.location.reload();
                        } else {
                            this.loading = false;
                            Swal.fire({
                                title: "Error",
                                text: response.data.message,
                                icon: "error",
                                showConfirmButton: true,
                                confirmButtonText: "Agree",
                                confirmButtonColor: "#00D8BF",
                                timer: 5000,
                            });
                        }
                    })
                    .catch(function (error) {
                        Swal.fire({
                            title: "¡Error!",
                            text: error.response.data,
                            icon: "error",
                            timer: 5000,
                            confirmButtonText: "Agree",
                            confirmButtonColor: "#00D8BF",
                        });
                    });
            }
        },

        updateData(dataUpdate) {
            this.sku = dataUpdate.sku;
            this.name = dataUpdate.name;
            this.stock = dataUpdate.stock;
            this.img = dataUpdate.img;
            this.calif = dataUpdate.calif;
            this.fk_id_category = dataUpdate.fk_id_category;
        },
    },
}
</script>

<style scoped>

</style>
