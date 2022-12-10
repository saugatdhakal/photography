<template>
  <div class="row justify-content-center">
    <div class="col-md-7 col-lg-6 m-2">
      <form enctype="multipart/form-data" @submit.prevent="submitHandler">
        <div class="albumCreate card card-body shadow">
          <div v-if="uploadPercent > 0">
            <div class="progress">
              <div
                class="progress-bar progress-bar-striped progress-bar-animated"
                role="progressbar"
                id="uploadingStatus"
                :style="{ width: uploadPercent + '%' }"
                aria-valuenow="10"
                aria-valuemin="0"
                aria-valuemax="100"
              >
                {{
                  uploadPercent < 100
                    ? uploadPercent + "%"
                    : "Compressing Image In Sever"
                }}
              </div>
            </div>
          </div>
          <h3 style="text-align: center">
            UPLOAD IMAGE
            <i class="bi bi-card-image" style="font-size: larger"></i>
          </h3>
          <div class="mt-1">
            <label for="title" class="form-label"> Title </label>
            <div class="input-group mb-3">
              <div class="input-group-prepend">
                <span class="input-group-text"
                  ><i class="bi bi-card-heading"></i
                ></span>
              </div>
              <input
                type="text"
                id="title"
                v-model="form.title"
                class="form-control"
              />
            </div>
          </div>
          <span
            style="color: red; margin-bottom: 5px; float: left"
            v-for="error in v$.title.$errors"
            :key="error"
          >
            {{ error.$message }}</span
          >
          <div class="mt-1">
            <label for="album" class="form-label">Album</label>

            <div class="d-flex gap-2">
              <div class="input-group mb-3">
                <div class="input-group-prepend">
                  <span class="input-group-text"
                    ><i class="bi bi-journal-album"></i
                  ></span>
                </div>
                <select id="album" v-model="form.album" class="form-select">
                  <option value=" " selected disabled></option>
                  <option
                    :value="list.id"
                    v-for="list in albums"
                    :key="list.id"
                  >
                    {{ list.name }}
                  </option>
                </select>
              </div>
              <button
                type="button"
                class="btn btn-primary"
                data-bs-toggle="modal"
                data-bs-target="#myModal"
                title="Add Album"
                style="height: 15%"
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
              accept="image/png, image/gif, image/jpeg"
              @change="getImage"
              id="formFileMultiple"
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
            <label for="capturedDate" class="form-label">Captured Date</label>
            <div class="input-group mb-3">
              <div class="input-group-prepend">
                <span class="input-group-text"
                  ><i class="bi bi-calendar3"></i
                ></span>
              </div>
              <input
                type="date"
                v-model="form.capture_date"
                id="capturedDate"
                class="form-control"
              />
            </div>
          </div>
          <span
            style="color: red; margin-bottom: 5px; float: left"
            v-for="error in v$.capture_date.$errors"
            :key="error"
          >
            {{ error.$message }}</span
          >
          <div class="mt-1">
            <label for="price" class="form-label">Price</label>
            <div class="input-group mb-3">
              <div class="input-group-prepend">
                <span class="input-group-text">$</span>
              </div>
              <input
                type="number"
                class="form-control"
                min="0"
                step="0.01"
                v-model="form.price"
                aria-label="Amount"
              />
            </div>
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
            <button type="submit" class="btn btn-success" style="width: 100px">
              <div v-if="uploadingStatus">
                <div class="spinner-border text-dark" role="status">
                  <span class="visually-hidden">Loading...</span>
                </div>
              </div>
              <i class="bi bi-cloud-upload" v-else></i> Upload
            </button>
          </div>
        </div>
      </form>
    </div>
  </div>
  <!-- Album Modal -->
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
            <button type="submit" id="createbtn" class="btn btn-success">
              Create
            </button>
          </div>
        </div>
      </div>
    </div>
  </form>
</template>

<script setup>
import { reactive, ref } from "@vue/reactivity";
import { onMounted } from "@vue/runtime-core";
import useVuelidate from "@vuelidate/core";
import { required, maxLength } from "@vuelidate/validators";
import repository from "../../../Backend/apis/repository";

const { albumList, uploadImage, createAlbum } = repository();
const uploadingStatus = ref(false);
const uploadPercent = ref(0);
// List of albums fetch from the server
const albums = ref({});
onMounted(async () => {
  albums.value = await albumList();
});

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

// Get Image when get selected
function getImage(e) {
  form.image = e.target.files[0];
}
// Clear Album Form
function clearAlbumModel() {
  // clearing Reactive Variables
  albumForm.album_name = "";
  albumForm.description = "";
  //Reset vuevalidated variables
  album$.value.$reset();
}
// Clear Image Form
function clearImageModel() {
  form.title = "";
  form.album = "";
  form.image = "";
  form.capture_date = "";
  form.price = "";
  form.description = "";
  v$.value.$reset();
}
// Set Number
function setUploadPercent(val) {
  uploadPercent.value = val;
}

// Set Boolen Value
function setUploadStatus(val) {
  uploadingStatus.value = val;
}

function resetEverything() {
  setUploadStatus(false); //Loading Status turn off
  setUploadPercent(0);
  clearImageModel();
}
// Upload Percentage 
let config = {
  onUploadProgress: function (progressEvent) {
    var percentCompleted = Math.round(
      //   (progressEvent.loaded * 100) / progressEvent.total
      (progressEvent.loaded / progressEvent.total) * 100
    );
    setUploadPercent(percentCompleted);
  },
};

async function submitHandler(e) {
  const result = await v$.value.$validate();
  if (!result) {
    return null;
  }
  setUploadStatus(true); //Loading Status turn on
  let data = new FormData();
  data.append("photo", form.image);
  data.append("title", form.title);
  data.append("album_id", form.album);
  data.append("capture_date", form.capture_date);
  data.append("price", form.price);
  data.append("description", form.description);
  let res = await uploadImage({ params: data, config: config });
  if (res) {
    resetEverything();
    toastr.success("Image Uploaded successfully");
  }
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
async function albumFormSubmit() {
  const result = await album$.value.$validate();
  if (!result) {
    return null;
  }
  let res = await createAlbum({ params: albumForm });
  if (res) {
    toastr.success("Album created successfully");
    clearAlbumModel();
    $("#myModal").modal("hide");
  }
}
//End Albums Model Froms
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
