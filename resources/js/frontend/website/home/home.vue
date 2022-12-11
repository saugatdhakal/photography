<template>
  <!-- ======= CONTAIN Section ======= -->
  <section
    id="hero"
    class="hero d-flex flex-column justify-content-center align-items-center"
    data-aos="fade"
    data-aos-delay="1500"
  >
    <div class="container">
      <div class="row justify-content-center">
        <div class="col-lg-6 text-center">
          <h2>
            I'm <span>Saugat Dhakal</span> a Professional Photographer from
            Nepal
          </h2>
          <p>
            Blanditiis praesentium aliquam illum tempore incidunt debitis
            dolorem magni est deserunt sed qui libero. Qui voluptas amet.
          </p>
          <a href="contact.html" class="btn-get-started">Available for hire</a>
        </div>
      </div>
    </div>
  </section>
  <!-- End CONTAIN Section -->

  <!-- ======= Gallery Section ======= -->
  <section id="gallery" class="gallery">
    <div class="container-fluid">
      <div class="row gy-4 justify-content-center">
        <div
          class="col-xl-3 col-lg-4 col-md-6"
          v-for="images in datas"
          :key="images.id"
        >
          <div class="gallery-item h-100">
            <img
              :src="images.image_path"
              class="img-fluid image-ratio"
              :alt="images.title"
            />
            <div
              class="
                gallery-links
                d-flex
                align-items-center
                justify-content-center
              "
            >
              <a
                :href="images.image_path"
                data-lightbox="home"
                :data-title="images.title"
                class="glightbox preview-link"
                ><i class="bi bi-arrows-angle-expand"></i>
              </a>
              <router-link
                :to="'/photo/photoDetails/' + images.id"
                class="details-link"
              >
                <i class="bi bi-link-45deg"></i>
              </router-link>
            </div>
          </div>
        </div>
        <!-- End Gallery Item -->
      </div>
    </div>
  </section>
  <!-- End Gallery Section -->
  <observer
    :option="option"
    :observerFlag="loadNextImageFlag"
    @observerCall="loadNextPageImages"
  />
</template>

<script setup>
import { onMounted, ref } from "@vue/runtime-core";
import repository from "../../../Backend/apis/repository";
import observer from "../../components/observer.vue";
const { nextPageHomeImages, homeImages } = repository();
// Variables Initialization
const datas = ref([]);
const nextPageUrl = ref(null);
const loadNextImageFlag = ref(false);
const option = {
  root: null,
  rootMargin: "150px",
  threshold: 1,
};

onMounted(async () => {
  loadImages();
});

async function loadNextPageImages() {
  if (!nextPageUrl.value) {
    // if nextPageUrl is null
    loadNextImageFlag.value = false;
    return;
  }
  const res = await nextPageHomeImages(nextPageUrl.value);
  datas.value = [...datas.value, ...res.data];
  nextPageUrl.value = res.next_page_url;
}

async function loadImages() {
  const res = await homeImages();
  if (!res.data) {
    console.log("Error Empty Responses");
    return;
  }
  datas.value = res.data;
  nextPageUrl.value = res.next_page_url;
  if (!nextPageUrl.value) {
    loadNextImageFlag.value = false; // Don't Observe
    return;
  }
  loadNextImageFlag.value = true;
}
</script>

<style >
.gallery {
  margin-top: 40px;
}

.gallery .gallery-item {
  position: relative;
  overflow: hidden;
  border-radius: 10px;
}

.gallery .gallery-item img {
  transition: 0.3s;
}

.gallery .gallery-links {
  position: absolute;
  inset: 0;
  opacity: 0;
  transition: all ease-in-out 0.3s;
  background: rgba(0, 0, 0, 0.6);
  z-index: 3;
}

.gallery .gallery-links .preview-link,
.gallery .gallery-links .details-link {
  font-size: 20px;
  color: rgba(255, 255, 255, 0.5);
  transition: 0.3s;
  line-height: 1.2;
  margin: 30px 8px 0 8px;
}

.gallery .gallery-links .preview-link:hover,
.gallery .gallery-links .details-link:hover {
  color: #fff;
}

.gallery .gallery-links .details-link {
  font-size: 30px;
  line-height: 0;
}

.gallery .gallery-item:hover .gallery-links {
  opacity: 1;
}

.gallery .gallery-item:hover .preview-link,
.gallery .gallery-item:hover .details-link {
  margin-top: 0;
}

.gallery .gallery-item:hover img {
  transform: scale(1.1);
}

.glightbox-clean .gslide-description {
  background: #222425;
}

.glightbox-clean .gslide-title {
  color: rgba(255, 255, 255, 0.8);
  margin: 0;
}
.image-ratio {
  object-fit: cover;
  width: 500px;
  height: 300px;
}
</style>
