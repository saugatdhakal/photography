<template>
  <!-- ======= End Page Header ======= -->
  <div class="page-header d-flex">
    <div class="container gallery-single">
      <div class="row justify-content-center p-0">
        <img :src="imageDetails.image_path" alt="" class="img-fluid image" />
      </div>
      <div class="row justify-content-between gy-4 mt-4">
        <div class="col-lg-8">
          <div class="portfolio-description">
            <h2>{{ imageDetails.title }}</h2>
            <p>{{ imageDetails.description }}</p>
          </div>
        </div>
        <!-- side Project Info -->
        <div class="col-lg-3">
          <div class="portfolio-info card card-body payment-card">
            <h3>Image information</h3>
            <ul>
              <li>
                <strong>Category</strong>
                <span v-if="imageDetails.album">{{
                  imageDetails.album.name
                }}</span>
              </li>

              <li><strong>Capture date</strong> <span>01 March, 2022</span></li>
              <li>
                <strong>Price</strong> <span>${{ imageDetails.price }}</span>
              </li>
              <li>
                <strong>Image URL</strong>
                <a :href="imageDetails.image_path">
                  <div class="btn" style="background-color: rgb(66, 155, 216)">
                    <span style="color: white">Click Here</span>
                    <i
                      class="bi bi-link"
                      style="font-size: 20px; color: darkblue"
                    ></i>
                  </div>
                </a>
              </li>
              <!-- <li>
                <div id="smart-button-container">
                  <div style="text-align: center">
                    <div id="paypal-button-container"></div>
                  </div>
                </div>
              </li> -->
              <li>
                <strong>PAYMENT VIA</strong>
                <!-- Paypal button -->
                <Paypal v-if="imageDetails" :photo_id="imageDetails.id"/>
              </li>
            </ul>
          </div>
        </div>
        <p v-if="imageDetails">{{ imageDetails }}</p>

      </div>
    </div>
  </div>
  <!-- End Page Header -->
</template>

<script setup>
import { onMounted, ref } from "@vue/runtime-core";
import Paypal from "../../components/paypal.vue";

import repository from "../../../Backend/apis/repository";
const props = defineProps(["id"]);
const { getImageDetails } = repository();
const imageDetails = ref({});

onMounted(async () => {
  imageDetails.value = await getImageDetails(props.id);
});
</script>

<style scoped>
.payment-card {
  background-color: rgba(166, 208, 186, 0.435);
}
.image {
  object-fit: contain;
  max-width: 1250px;
  max-height: 700px;
}
</style>
