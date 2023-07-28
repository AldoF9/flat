<template>
  <v-app>
    <v-row>
      <div class="col-2 side">
        <side-bar></side-bar>
      </div>
      <div class="col-10">
        <router-view></router-view>
      </div>
    </v-row>
  </v-app>
</template>

<script>
import SideBar from "./components/SideBar";

export default {
  name: "App",
  components: { SideBar },
};
</script>

<style scoped>
.side {
  background-color: transparent !important;
  background-size: cover;
  border-radius: 30px 100px 100px 30px;
  z-index: 5;
}
</style>
