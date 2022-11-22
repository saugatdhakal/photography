<template>
  <div class="row">
    <div class="col-md-7 col-lg-5 m-2">
      <form enctype="multipart/form-data" @submit.prevent="submitHandler">
        <div class="albumCreate card card-body shadow">
          <h3 style="text-align: center">Upload Image</h3>
          <div class="mt-1">
            <label for="title"> Title </label>
            <input
              type="text"
              id="title"
              v-model="form.title"
              class="form-control"
            />
          </div>
          <span
            style="color: red; margin-bottom: 5px; float: left"
            v-for="error in v$.title.$errors"
            :key="error"
          >
            {{ error.$message }}</span
          >
          <div class="mt-1">
            <label for="album">Album</label>
            <select id="album" v-model="form.album" class="form-select">
              <option value=" " selected disabled></option>
              <option value="a1">a1</option>
              <option value="a2">a2</option>
            </select>
          </div>
          <span
            style="color: red; margin-bottom: 5px; float: left"
            v-for="error in v$.album.$errors"
            :key="error"
          >
            {{ error.$message }}</span
          >
          <div class="mt-1">
            <label for="formFileMultiple" class="form-label"
              >Upload Image</label
            >
            <input
              class="form-control"
              type="file"
              @change="getImage"
              id="formFileMultiple"
              multiple
            />
          </div>
          <span
            style="color: red; margin-bottom: 5px; float: left"
            v-for="error in v$.image.$errors"
            :key="error"
          >
            {{ error.$message }}</span
          >
          <div class="mt-1">
            <label for="capturedDate">Captured Date</label>
            <input
              type="date"
              v-model="form.capture_date"
              id="capturedDate"
              class="form-control"
            />
          </div>
          <span
            style="color: red; margin-bottom: 5px; float: left"
            v-for="error in v$.capture_date.$errors"
            :key="error"
          >
            {{ error.$message }}</span
          >
          <div class="mt-1">
            <label for="price">Price</label>
            <input
              type="number"
              min="0"
              v-model="form.price"
              id="price"
              class="form-control"
            />
          </div>
          <span
            style="color: red; margin-bottom: 5px; float: left"
            v-for="error in v$.price.$errors"
            :key="error"
          >
            {{ error.$message }}</span
          >

          <div class="mt-1">
            <label for="description">Description</label>
            <textarea
              id="description"
              class="form-control"
              rows="5"
              cols="5"
              v-model="form.description"
            ></textarea>
          </div>
          <span
            style="color: red; margin-bottom: 5px; float: left"
            v-for="error in v$.description.$errors"
            :key="error"
          >
            {{ error.$message }}</span
          >

          <div class="d-flex justify-content-center mt-2">
            <button
              type="submit"
              class="btn imageUploadButton"
              style="width: 100px"
            >
              Enter
            </button>
          </div>
        </div>
      </form>
    </div>
  </div>
</template>

<script setup>
import { reactive, ref } from "@vue/reactivity";
import useVuelidate from "@vuelidate/core";
import { required, maxLength } from "@vuelidate/validators";
import repository from "../../../Backend/apis/repository";

// const image = ref(null);
const form = reactive({
  title: "",
  album: "",
  image: {},
  capture_date: "",
  price: "",
  description: "",
});

const rule = {
  title: { required },
  album: { required },
  image: { required },
  capture_date: { required },
  price: { required },
  description: { required },
};
const v$ = useVuelidate(rule, form);
function getImage(e) {
  form.image = e.target.files[0];
  console.log(form.image);
}
async function submitHandler(e) {
  const result = await v$.value.$validate();
  if (!result) {
    return null;
  }
  let data = new FormData();
  data.append("photo", form.image);
  data.append("title", form.title);
  data.append("album", form.album);
  data.append("capture_date", form.capture_date);
  data.append("price", form.price);
  data.append("description", form.description);
  let res = await repository.uploadImage({ params: data });
  console.log(res);
}

</script>

<style scoped>
.imageUploadButton {
  background-color: var(--color-primary);
  color: var(--color-background);
}
.albumCreate label {
  font-size: 14px;
  font-weight: 500;
}
input::placeholder,
select option {
  font-size: 12px;
  color: var(--color-primary);
}
</style>
