<template>
  <div class="row justify-content-center" style="margin-top: 5rem">
    <div class="col-md-7 col-lg-4">
      <div class="wrap card card-body text-center card-holder shadow">
        <i class="camera bi bi-camera2" style="font-size: 3.5rem"></i>
        <p class="loginHeader">ADMIN LOGIN</p>
        <form @submit.prevent="submitHandler">
          <div class="mb-4 mt-3">
            <div class="input-group">
              <span class="input-group-text" id="basic-addon1"
                ><i
                  class="bi bi-person-circle"
                  style="font-size: 1.5rem; color: #27a776"
                ></i
              ></span>
              <input
                type="text"
                class="form-control login-input"
                placeholder="Username"
                aria-label="Username"
                v-model="form.email"
                aria-describedby="basic-addon1"
              />
            </div>
            <span
              style="color: red; margin-bottom: 5px; float: left"
              v-for="error in v$.email.$errors"
              :key="error"
            >
              {{ error.$message }}</span
            >
          </div>
          <div class="mb-3">
            <div class="input-group">
              <span class="input-group-text" id="basic-addon1"
                ><i
                  class="bi bi-lock-fill"
                  style="font-size: 1.5rem; color: #27a776"
                ></i
              ></span>
              <input
                type="password"
                class="form-control"
                v-model="form.password"
                placeholder="Password"
                aria-label="Username"
                aria-describedby="basic-addon1"
              />
            </div>
            <span
              style="color: red; margin-bottom: 5px; float: left"
              v-for="error in v$.password.$errors"
              :key="error"
            >
              {{ error.$message }}</span
            >
          </div>
          <div style="display: flex; justify-content: center">
            <button type="submit" class="mt-3 loginBtn" style="min-width: 7rem">
              Login
            </button>
          </div>
        </form>
      </div>
    </div>
  </div>
</template>

<script setup>
import {reactive } from "@vue/runtime-core";
import useVuelidate from "@vuelidate/core";
import { required, maxLength } from "@vuelidate/validators";
import { authState } from "../../../Backend/store/auth";

const auths = authState();
// Reactive fields
const form = reactive({
  email: "admin@gmail.com",
  password: "password",
});

// validation Rule for input fields
const rule = {
  email: { required },
  password: { required, maxLength: maxLength(10) },
};
const v$ = useVuelidate(rule, form);

async function submitHandler() {
  const result = await v$.value.$validate();
  if (!result) {
    return null;
  }
  auths.login(form);
}
</script>

<style scoped>
/*--------------------------------------------------------------
  # Login Form
  --------------------------------------------------------------*/
  .blogIcon {
    height: 2.3rem;
    width: 2rem;
    background-color: purple;
    color: white;
    text-align: center;
    border-radius: 3px;

}

.loginHeader {
    font-family: var(--font-default);
    font-weight: bold;
    font-size: 2vw;
    color: var(--color-default)
}

.loginBtn {
    background-color: var(--color-primary);
    color: var(--color-background);
    font-size: 1.5vw;
    border: none;
    border-radius: 5px;
    padding: 8px;
}

.loginBtn:hover {
    background-color: #32cf93;
}

.camera {
    color: var(--color-primary);
}

/* .card-holder {
    background-color: var(--color-secondary);
} */
</style>
