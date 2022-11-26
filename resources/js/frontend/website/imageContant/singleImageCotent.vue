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
            <h2>This is an example of portfolio detail</h2>
            <p>
              Autem ipsum nam porro corporis rerum. Quis eos dolorem eos itaque
              inventore commodi labore quia quia. Exercitationem repudiandae
              officiis neque suscipit non officia eaque itaque enim. Voluptatem
              officia accusantium nesciunt est omnis tempora consectetur
              dignissimos. Sequi nulla at esse enim cum deserunt eius.
            </p>
            <p>
              Amet consequatur qui dolore veniam voluptatem voluptatem sit. Non
              aspernatur atque natus ut cum nam et. Praesentium error dolores
              rerum minus sequi quia veritatis eum. Eos et doloribus doloremque
              nesciunt molestiae laboriosam.
            </p>

            <p>
              Impedit ipsum quae et aliquid doloribus et voluptatem quasi.
              Perspiciatis occaecati earum et magnam animi. Quibusdam non qui ea
              vitae suscipit vitae sunt. Repudiandae incidunt cumque minus
              deserunt assumenda tempore. Delectus voluptas necessitatibus est.
            </p>
            <p>
              Sunt voluptatum sapiente facilis quo odio aut ipsum repellat
              debitis. Molestiae et autem libero. Explicabo et quod
              necessitatibus similique quis dolor eum. Numquam eaque praesentium
              rem et qui nesciunt.
            </p>
          </div>
        </div>
        <!-- side Project Info -->
        <div class="col-lg-3">
          <div class="portfolio-info">
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
                <a :href="imageDetails.image_path">{{
                  imageDetails.image_path
                }}</a>
              </li>
              <li>
                <div id="smart-button-container">
                  <div style="text-align: center">
                    <div id="paypal-button-container"></div>
                  </div>
                </div>
              </li>
              <!-- <li>
                <a href="#" target="_blank" class="btn-visit align-self-start">
                  PURCHASE
                  <svg
                    xmlns="http://www.w3.org/2000/svg"
                    width="16"
                    height="16"
                    fill="currentColor"
                    class="bi bi-paypal"
                    viewBox="0 0 16 16"
                  >
                    <path
                      d="M14.06 3.713c.12-1.071-.093-1.832-.702-2.526C12.628.356 11.312 0 9.626 0H4.734a.7.7 0 0 0-.691.59L2.005 13.509a.42.42 0 0 0 .415.486h2.756l-.202 1.28a.628.628 0 0 0 .62.726H8.14c.429 0 .793-.31.862-.731l.025-.13.48-3.043.03-.164.001-.007a.351.351 0 0 1 .348-.297h.38c1.266 0 2.425-.256 3.345-.91.379-.27.712-.603.993-1.005a4.942 4.942 0 0 0 .88-2.195c.242-1.246.13-2.356-.57-3.154a2.687 2.687 0 0 0-.76-.59l-.094-.061ZM6.543 8.82a.695.695 0 0 1 .321-.079H8.3c2.82 0 5.027-1.144 5.672-4.456l.003-.016c.217.124.4.27.548.438.546.623.679 1.535.45 2.71-.272 1.397-.866 2.307-1.663 2.874-.802.57-1.842.815-3.043.815h-.38a.873.873 0 0 0-.863.734l-.03.164-.48 3.043-.024.13-.001.004a.352.352 0 0 1-.348.296H5.595a.106.106 0 0 1-.105-.123l.208-1.32.845-5.214Z"
                    />
                  </svg>
                </a>
              </li> -->
            </ul>
          </div>
        </div>
        {{ imageDetails }}
      </div>
    </div>
  </div>
  <!-- End Page Header -->
</template>

<script setup>
import { onMounted, ref } from "@vue/runtime-core";
import repository from "../../../Backend/apis/repository";
const props = defineProps(["id"]);
const { getImageDetails } = repository();
const imageDetails = ref({});

onMounted(async () => {
  imageDetails.value = await getImageDetails(props.id);
  //INITILIZING THE PAYPAL BUTTON
  initPayPalButton();
});
function initPayPalButton() {
  paypal
    .Buttons({
      style: {
        shape: "rect",
        color: "gold",
        layout: "vertical",
        label: "paypal",
      },

      createOrder: function (data, actions) {
        return actions.order.create({
          purchase_units: [
            {
              items: [
                {
                  name: imageDetails.value.title,
                  album: imageDetails.value.album.name,
                  quantity: 1,
                  unit_amount: {
                    currency_code: "USD",
                    value: 1,
                  },
                },
              ],
              amount: {
                currency_code: "USD",
                value: 1,
                breakdown: {
                  item_total: {
                    currency_code: "USD",
                    value: "1",
                  },
                },
              },
            },
          ],
        });
      },

      onApprove: function (data, actions) {
        return actions.order.capture().then(function (orderData) {
          // Full available details
          console.log(
            "Capture result",
            orderData,
            JSON.stringify(orderData, null, 2)
          );

          // Show a success message within this page, e.g.
          const element = document.getElementById("paypal-button-container");
          element.innerHTML = "";
          element.innerHTML = "<h3>Thank you for your payment!</h3>";

          // Or go to another URL:  actions.redirect('thank_you.html');
        });
      },

      onError: function (err) {
        console.log(err);
      },
    })
    .render("#paypal-button-container");
}
</script>

<style scoped>
.image {
  object-fit: contain;

  max-width: 1250px;
  max-height: 700px;
}
</style>
