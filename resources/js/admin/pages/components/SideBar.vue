<template>
  <v-navigation-drawer
    v-model="drawer"
    :mini-variant.sync="mini"
    permanent
    width="auto"
    class="nav-side-background-color"
  >
    <v-list>
      <div class="text-center">
        <img
          class="img-fluid my-5 w-50"
          src="/images/E-commerce.jpg"
          style="width: 220px; margin-right: 15px"
        />
      </div>
      <v-list-item
        link
        class="my-5"
        :key="index"
        :to="item.path"
        v-for="(item, index) in items"
        style="padding-left: 0px"
        onclick="window.scrollTo(0,0)"
      >
        <v-list-item-icon class="img1">
          <div>
            <v-img class="d-block" :src="item.icon" alt="img" />
          </div>
        </v-list-item-icon>
        <v-list-item-icon class="img2 d-none">
          <div class="icon">
            <v-img :src="item.icon2" alt="img" />
          </div>
        </v-list-item-icon>

        <v-list-item-content>
          <v-list-item-title class="item-nav-text-color">
            {{ item.name }}
          </v-list-item-title>
        </v-list-item-content>
      </v-list-item>
    </v-list>
  </v-navigation-drawer>
</template>

<script>
export default {
  name: "SideBar",
  data: () => ({
    mini: false,
    drawer: true,

    items: [
      {
        name: "Clientes",
        path: { name: "client" },
      },
      {
        name: "Usuarios",
        path: { name: "user" },
      },
      {
        name: "Categorias",
        path: { name: "category" },
      },
      {
        name: "Ingresos",
        path: { name: "income" },
      },
      {
        name: "Productos",
        path: { name: "product" },
      },
      {
        name: "Proveedores",
        path: { name: "provider" },
      },
      {
        name: "Ventas",
        path: { name: "sale" },
      },
    ],
  }),
};
</script>

<style scoped>
.container-nav-side {
  margin: -65px -46px 0px 0px;
}

.nav-side-background-color {
  background: transparent linear-gradient(195deg, #7019c1 0%, #163ead 100%) 0%
    0% no-repeat padding-box;
  background-size: cover;
  border-radius: 30px 100px 100px 30px;
  z-index: 1;
  align-items: initial;
}

.item-nav-text-color {
  color: #ffffff;
}

.v-list .v-list-item--active,
.v-list .v-list-item--active .v-icon {
  background-color: white;
  color: white !important;
  border-radius: 10% 0% 0% 10%;
  filter: light(50%);
  padding-left: 32px;
  border-bottom-left-radius: 25px;
  border-top-left-radius: 25px;
}

.v-list .v-list-item--active .v-list-item__title {
  color: #7019c1 !important;
}

.v-list .v-list-item--active .v-list-item__icon.img1 {
  display: none !important;
}
.v-list .v-list-item--active .v-list-item__icon.img2 {
  display: block !important;
  margin-right: 32px;
  width: 0px;
}
</style>
