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
                + Agregar Venta
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
                                {{ isUpdate ? "Modificar" : "Agregar" }} Venta
                            </h3>
                        </div>
                    </div>
                    <hr class="widthHr" />

                    <v-form ref="form" lazy-validation>
                        <v-row>
                            <v-col cols="6" class="px-2">
                                <div class="fields-modal" style="">Folio:</div>
                                <v-text-field
                                    v-model="folio"
                                    outlined
                                    :rules="rules.folioRules"
                                    dense
                                ></v-text-field>
                            </v-col>
                            <v-col cols="6" class="px-2">
                                <div class="fields-modal" style="">Fecha:</div>
                                <v-dialog
                                    ref="dialog1"
                                    v-model="menu1"
                                    :return-value.sync="date"
                                    persistent
                                    width="290px"
                                >
                                    <template v-slot:activator="{ on, attrs }">
                                        <v-text-field
                                            :value="date"
                                            label="Date"
                                            readonly
                                            :rules="rules.dateRules"
                                            v-bind="attrs"
                                            v-on="on"
                                            dense
                                            outlined
                                        ></v-text-field>
                                    </template>
                                    <v-date-picker
                                        v-model="date"
                                        scrollable
                                        locale="en-mx"
                                        color="green lighten-1"
                                        :format="'yyyy-MM-dd'"
                                    >
                                        <v-spacer></v-spacer>
                                        <v-btn
                                            text
                                            color="primary"
                                            @click="menu1 = false"
                                        >
                                            Cancel
                                        </v-btn>
                                        <v-btn
                                            text
                                            color="primary"
                                            @click="$refs.dialog1.save(date)"
                                        >
                                            OK
                                        </v-btn>
                                    </v-date-picker>
                                </v-dialog>
                            </v-col>

                        </v-row>
                        <v-row>
                            <v-col cols="6" class="px-2 vue-cols-modal">
                                <div class="fields-modal">Impuesto:</div>
                                <v-text-field
                                    v-model="imuesto"
                                    type="number"
                                    :rules="rules.impuestoRules"
                                    outlined
                                    dense
                                    maxlength="3"
                                    data-rule-maxlength="3"
                                ></v-text-field>
                            </v-col>
                            <v-col cols="6" class="px-2 vue-cols-modal">
                                <div class="fields-modal">Total:</div>
                                <v-text-field
                                    v-model="total"
                                    type="number"
                                    :rules="rules.totalRules"
                                    outlined
                                    dense
                                    maxlength="10"
                                    data-rule-maxlength="10"
                                ></v-text-field>
                            </v-col>
                        </v-row>
                        <v-row>
                            <v-col cols="6" class="px-2 vue-cols-modal">
                                <div class="fields-modal">Estado:</div>
                                <v-autocomplete
                                    v-model="fk_id_state"
                                    :items="itemState"
                                    :rules="rules.stateRules"
                                    item-text="name"
                                    item-value="id"
                                    dense
                                    outlined
                                ></v-autocomplete>
                            </v-col>
                            <v-col cols="6" class="px-2 vue-cols-modal">
                                <div class="fields-modal">Producto:</div>
                                <v-autocomplete
                                    v-model="fk_id_product"
                                    :items="itemsProduct"
                                    :rules="rules.productRules"
                                    item-text="name"
                                    item-value="id"
                                    dense
                                    outlined
                                ></v-autocomplete>
                            </v-col>
                        </v-row>
                        <v-row>
                            <v-col cols="6" class="px-2 vue-cols-modal">
                                <div class="fields-modal">Cliente:</div>
                                <v-autocomplete
                                    v-model="fk_id_client"
                                    :items="itemsClient"
                                    :rules="rules.clientRules"
                                    item-text="name"
                                    item-value="id"
                                    dense
                                    outlined
                                ></v-autocomplete>
                            </v-col>
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
    name: "FormSale",
    props: {
        isUpdate: {
            type: Boolean,
            required: true
        },
        dataUpdate: {
            type: Object,
            required: false
        },
        itemsProduct:{
            required: true,
        },
        itemsClient:{
            required: true,
        },
        itemState:{
            required: true,
        },
        SaleId:{
            type: Number
        },
    },
    data() {
        return {
            dialog: false,
            loading: false,
            modalLoading: false,
            folio: "",
            date: "",
            imuesto: "",
            total: "",
            fk_id_state: "",
            fk_id_product: "",
            fk_id_client: "",
            menu1: null,
            rules: {
                folioRules: [(v) => !!v || "SKU is required"],
                dateRules: [(v) => !!v || "Name is required"],
                impuestoRules: [(v) => !!v || "Stock is required"],
                totalRules: [(v) => !!v || "Imagen is required"],
                stateRules: [(v) => !!v || "Calification is required"],
                productRules: [(v) => !!v || "Category is required"],
                clientRules: [(v) => !!v || "Category is required"],
            },
        };
    },

    methods: {
        async submit() {
            let valid = this.$refs.form.validate();
            if (valid) {
                const formData = new FormData();
                formData.append("folio", this.folio);
                formData.append("date", this.date);
                formData.append("imuesto", this.imuesto);
                formData.append("total", this.total);
                formData.append("fk_id_state", this.fk_id_state);
                formData.append("fk_id_product", this.fk_id_product);
                formData.append("fk_id_client", this.fk_id_client);

                let route_submit = !this.isUpdate
                    ? route("sale.upsert", { idSale: "FAKE_ID" })
                    : route("sale.upsert", { idSale: this.SaleId });
                axios
                    .post(route_submit, formData)
                    .then((response) => {
                        if (response.data.success) {
                            Swal.fire({
                                title: this.isUpdate
                                    ? "Venta modificada"
                                    : "Venta agregada",
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
            this.folio = dataUpdate.folio;
            this.date = dataUpdate.date;
            this.imuesto = dataUpdate.imuesto;
            this.total = dataUpdate.total;
            this.fk_id_state = dataUpdate.fk_id_state;
            this.fk_id_product = dataUpdate.fk_id_product;
            this.fk_id_client = dataUpdate.fk_id_client;
        },
    },
}
</script>

<style scoped>

</style>
