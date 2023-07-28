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
                + Agregar Usuario
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
                                {{ isUpdate ? "Modificar" : "Agregar" }} Usuario
                            </h3>
                        </div>
                    </div>
                    <hr class="widthHr" />

                    <v-form ref="form" lazy-validation>
                        <v-row>
                            <v-col cols="6" class="px-2">
                                <div class="fields-modal" style="">Nombre:</div>
                                <v-text-field
                                    v-model="name"
                                    outlined
                                    :rules="rules.nameRules"
                                    dense
                                ></v-text-field>
                            </v-col>
                            <v-col cols="6" class="px-2 vue-cols-modal">
                                <div class="fields-modal">Telefono:</div>
                                <v-text-field
                                    v-model="phone"
                                    type="number"
                                    :rules="rules.phoneRules"
                                    outlined
                                    dense
                                    maxlength="10"
                                    data-rule-maxlength="10"
                                ></v-text-field>
                            </v-col>
                        </v-row>
                        <v-row>
                            <v-col cols="6" class="px-2 vue-cols-modal">
                                <div class="fields-modal">Email:</div>
                                <v-text-field
                                    v-model="email"
                                    :rules="rules.emailRules"
                                    outlined
                                    dense
                                ></v-text-field>
                            </v-col>
                            <v-col cols="6" class="px-2 vue-cols-modal">
                                <div class="fields-modal">Contraseña:</div>
                                <v-text-field
                                    v-model="password"
                                    outlined
                                    :rules="rules.passwordRules"
                                    dense
                                ></v-text-field>
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
                                {{ isUpdate ? "Guardar" : "+ Agregar Usuario" }}
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
    name: "FormUser",
    props: {
        isUpdate: {
            type: Boolean,
            required: true,
        },
        dataUpdate: {
            type: Object,
            required: false,
        },
        userId: {
            type: Number,
        },
    },
    data() {
        return {
            dialog: false,
            loading: false,
            modalLoading: false,
            name: "",
            phone: "",
            email: "",
            password: "",
            rules: {
                nameRules: [(v) => !!v || "Name is required"],
                phoneRules: [(v) => !!v || "Phone is required"],
                emailRules: [(v) => !!v || "Email is required"],
                passwordRules: [(v) => !!v || "Address is required"],
            },
        };
    },

    methods: {
        async submit() {
            let valid = this.$refs.form.validate();
            if (valid) {
                const formData = new FormData();
                formData.append("name", this.name);
                formData.append("phone", this.phone);
                formData.append("email", this.email);
                formData.append("password", this.password);

                let route_submit = !this.isUpdate
                    ? route("user.upsert", { idUser: "FAKE_ID" })
                    : route("user.upsert", { idUser: this.userId });
                axios
                    .post(route_submit, formData)
                    .then((response) => {
                        if (response.data.success) {
                            Swal.fire({
                                title: this.isUpdate
                                    ? "Usuario modificado"
                                    : "Usuario agregado",
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
            this.name = dataUpdate.name;
            this.phone = dataUpdate.phone;
            this.email = dataUpdate.email;
            this.password = dataUpdate.password;
        },
    },
}
</script>

<style scoped>

</style>
