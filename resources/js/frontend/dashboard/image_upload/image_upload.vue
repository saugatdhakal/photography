<template>
  <div class="row justify-content-center">
    <div class="col-md-7 col-lg-6 m-2">
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
            <div class="d-flex gap-1">
              <select id="album" v-model="form.album" class="form-select">
                <option value=" " selected disabled></option>
                <option value="a1">a1</option>
                <option value="a2">a2</option>
              </select>
              <button
                type="button"
                class="btn btn-primary"
                data-bs-toggle="modal"
                data-bs-target="#myModal"
                title="Add Album"
              >
                +
              </button>
            </div>
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
  <!-- Button to Open the Modal -->
  <form @submit.prevent="albumFormSubmit">
    <!-- The Modal -->
    <div class="modal" id="myModal">
      <div class="modal-dialog">
        <div class="modal-content">
          <!-- Modal Header -->
          <div class="modal-header">
            <h4 class="modal-title">Add Category</h4>
            <button
            @click="clearAlbumModel"
              type="button"
              class="btn-close"
              data-bs-dismiss="modal"
            ></button>
          </div>

          <!-- Modal body -->
          <div class="modal-body">
            <div class="mt-1">
              <label for="title"> Title </label>
              <input
                type="text"
                id="title"
                v-model="albumForm.album_name"
                class="form-control"
              />
              <span
                style="color: red; float: left"
                v-for="error in album$.album_name.$errors"
                :key="error"
              >
                {{ error.$message }}</span
              >
            </div>
            <br />
            <div class="mt-1">
              <p for="title">Description</p>
              <textarea
                v-model="albumForm.description"
                class="form-control"
                name=""
                id=""
                cols="20"
                rows="5"
              ></textarea>
            </div>
            <span
              style="color: red; margin-bottom: 5px; float: left"
              v-for="error in album$.description.$errors"
              :key="error"
            >
              {{ error.$message }}</span
            >
          </div>

          <!-- Modal footer -->
          <div class="modal-footer">
            <button
              type="button"
              @click="clearAlbumModel"
              class="btn btn-danger"
              data-bs-dismiss="modal"
            >
              Close
            </button>
            <button type="submit" id="createbtn" class="btn btn-success">Create</button>
          </div>
        </div>
      </div>
    </div>
  </form>
</template>

<script setup>
import { reactive, ref } from "@vue/reactivity";
import useVuelidate from "@vuelidate/core";
import { required, maxLength } from "@vuelidate/validators";
import repository from "../../../Backend/apis/repository";
import router from "../../../Backend/router/router";

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

// Albums Model Froms

const albumForm = reactive({
  album_name: "",
  description: "",
});
const albumRule = {
  album_name: { required },
  description: { required },
};

const album$ = useVuelidate(albumRule, albumForm);

function clearAlbumModel() {
  // clearing Reactive Variables
  albumForm.album_name = "";
  albumForm.description = "";
  //Reset vuevalidated variables
  album$.value.$reset();
}
async function albumFormSubmit() {
  const result = await album$.value.$validate();
  if (!result) {
    return null;
  }
  let res = await repository.createAlbum({ params: albumForm });
  if(res){
    // router.go();
    toastr.success("hi")
    $('#myModal').modal('hide');


  }



}



</script>
<script>
$( "#createbtn" ).on( "click", function( event ) {
  console.log('gekki')
});
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
