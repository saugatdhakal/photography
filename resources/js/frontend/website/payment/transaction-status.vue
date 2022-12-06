<template>
  <div class="container mt-4 card card-body shadow">
    <div
      class="row row-cols text-center align-items-center justify-content-center"
      ref="print"
    >
      <div class="icon-container mb-2">
        <i class="checkmark">✓</i>
      </div>
      <h1 class="success-text">Purchase Successful!</h1>
      <hr style="width: 350px" />
      <div class="d-flex flex-column align-items-center"  v-if="customerTransactionData.transaction">
        <div class="d-flex gap-3 flex-wrap">
          <strong>Transaction Number : </strong>
          <p>{{customerTransactionData.transaction.payment_id}}</p>
        </div>
        <div class="d-flex gap-3 flex-wrap">
          <strong>Payment Mode : </strong>
          <p> Online PayPal</p>
        </div>
        <div class="d-flex gap-3 flex-wrap">
          <strong>Email : </strong>
          <p>{{customerTransactionData.transaction.cust_email}}</p>
        </div>
        <div class="d-flex gap-3 flex-wrap">
          <strong>Photo Name : </strong>
          <p>{{customerTransactionData.photo.title}}</p>
        </div>
        <div class="d-flex gap-3 flex-wrap">
          <strong>Payment Date : </strong>
          <p>{{customerTransactionData.transaction.payment_date}}</p>
        </div>
        <hr style="width: 350px; margin: 0" />

        <div class="d-flex gap-3 flex-wrap mt-2">
          <strong>Total Amount : </strong>
          <p>${{customerTransactionData.transaction.amount}}</p>
        </div>
        <hr style="width: 350px; margin: 0" />
      </div>
      <p class="lead">
        <strong>Please check your email</strong> for futher Responses.
      </p>

      <p>
        Having trouble? or futher more details
        <a href="mailto: saugatdhakal5@gmail.com">Send Email</a>
      </p>
    </div>
    <div class="d-flex gap-2 justify-content-center">
      <button @click="printTransaction" class="btn btn-danger">
        PDF <i class="bi bi-file-earmark-arrow-down"></i>
      </button>
      <router-link
        class="btn btn-primary"
        style="max-width: 11em"
        :to="{ name: 'home' }"
        >Continue Home <i class="bi bi-box-arrow-left"></i
      ></router-link>

    </div>
  </div>

</template>

<script setup>
import { ref } from "@vue/reactivity";
import { onMounted } from "@vue/runtime-core";
import repository from "../../../Backend/apis/repository";
import { createPdfFromHtml } from "../../js/pdf.js";

const { searchCustomerTransaction } = repository();
const props = defineProps(["id"]); // CustomerTransaction Id
const print = ref(null); // Getting Html tags By Refs
const customerTransactionData = ref({});

onMounted(async () => {
  setTimeout(() => {
    // printTransaction(); // Print After 1 sec after page loaded automatically
  }, 1000);

  // Getting Data by Id
  customerTransactionData.value = await searchCustomerTransaction(props.id);
});

function printTransaction() {
  createPdfFromHtml(print.value);
  toastr.success("Image Uploaded successfully");
}
</script>

<style scoped>
.icon-container {
  border-radius: 200px;
  height: 200px;
  width: 200px;
  background: #f8faf5;
  margin: 0 auto;
}
.checkmark {
  font-size: 100px;
  line-height: 200px;
  margin-left: 10px;
}
.success-text,
.checkmark {
  color: #9abc66;
}
</style>
