<template>
  <div class="row">
    <div class="col-md-7 col-lg-6 m-2">
      <div class="card p-2">
        <form @submit.prevent="submitHandler">
          <div class="text-center fs-3">
            PERSONAL INFORMATION <i class="bi bi-person-vcard"></i>
          </div>

          <base-input
            label="Name"
            v-model="form.name"
            iconClass="bi bi-person"
            title="Full name"
            required
          />
          <div class="row">
            <div class="col-md-6">
              <base-input
                label="Date of Birth"
                title="Day of your Birth"
                input_type="date"
                v-model="form.date"
                iconClass="bi bi-calendar2-event-fill"
                required
              />
            </div>
            <div class="col-md-6">
              <base-input
                label="Professional Work"
                title="Speciality at any photographer work"
                v-model="form.speciality"
                iconClass="bi bi-camera"
                required
              />
            </div>
          </div>

          <div class="row">
            <div class="col-md-6">
              <base-input
                label="Email"
                input_type="email"
                title="Fill your Email Address"
                v-model="form.email"
                iconClass="bi bi-envelope-at"
                required
              />
            </div>
            <div class="col-md-6">
              <base-input
                label="Address"
                title="Fill City Address"
                v-model="form.address"
                iconClass="bi bi-geo-alt"
                required
              />
            </div>
          </div>
          <base-input
            label="Sub Title"
            v-model="form.sub_title"
            iconClass="bi bi-type-h1"
            required
          />
          <base-text-area
            label="Description"
            v-model="form.description"
            required
          />
          <button class="btn btn-primary text-center mt-2 m-auto w-50 d-block">
            Update <i class="bi bi-pencil-square"></i>
          </button>
        </form>
      </div>
    </div>
  </div>
</template>

<script setup>
import { reactive } from "@vue/reactivity";
import BaseInput from "../../components/BaseInput.vue";
import BaseTextArea from "../../components/BaseTextArea.vue";
import { required, maxLength } from "@vuelidate/validators";
import useVuelidate from "@vuelidate/core";
const form = reactive({
  name: "",
  date: "",
  email: "",
  address: "",
  speciality: "",
  description: "",
  sub_title: "",

});
const rule = {
  name: { required, maxLength: maxLength(255) },
  date: { required, maxLength: maxLength(255) },
  email: { required, maxLength: maxLength(255) },
  address: { required, maxLength: maxLength(255) },
  speciality: { required, maxLength: maxLength(255) },
  description: { required },
  sub_title: { required }
};
const v$ = useVuelidate(rule, form);


function submitHandler() {
  console.log("submit");
}
</script>

<style>
</style>
