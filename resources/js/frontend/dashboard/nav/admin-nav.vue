<template>
  <div class="container-fluid" style="width: 100%; margin: 0; padding: 0">
    <div class="d-flex">
      <div
        class="sideBar d-flex flex-column wrap"
        id="sideBar"
        style="top: 5px"
        :class="smallNav ? '' : 'sideBar-hidden'"
      >
        <i
          class="clickListSmallSide bi bi-list d-flex mt-2"
          id="clickListSmallSide"
          @click="smallNavClick"
          style="
          font-size: 1.5rem;
            cursor: pointer;
            margin-bottom: 15px;
            color: black;
            justify-content: center;
          "
        ></i>
        <ul style="list-style: none; padding: 0">
          <li class="liText">
            <a href="">
              <i class="bi bi-house-door"></i>
              <p>Home</p>
            </a>
          </li>
          <li class="liText">
            <a href="">
              <i class="bi bi-info-circle"></i>
              <p>About</p>
            </a>
          </li>
          <li class="liText">
            <a href="">
              <i class="bi bi-image"></i>
              <p>Gallary</p>
            </a>
          </li>
          <li class="liText">
            <a href="">
              <i class="bi bi-camera"></i>
              <p>Service</p>
            </a>
          </li>
          <li class="liText">
            <a href="">
              <i class="bi bi-person-lines-fill"></i>
              <p>Contact</p>
            </a>
          </li>
        </ul>
      </div>
      <div
        class="fullSideNav d-flex flex-column wrap"
        :class="largeNav ? '' : 'fullSideNav-hidden'"
        id="fullsidenav"
        style="top: 5px"
      >
        <i
          class="clickListFullSide bi bi-list d-flex"
          @click="largeNavClick"
          style="font-size: 1.5rem; margin-bottom: 15px; color: black"
        ></i>
        <ul style="list-style: none; padding: 0">
          <li>
            <a href="">
              <i class="bi bi-house-door"></i>
              <span> Home </span>
            </a>
          </li>

          <li>
            <a href="" style="display: inline">
              <i class="bi bi-info-circle"></i>
              <span> About </span>
            </a>
          </li>
          <li>
            <a href="">
              <i class="bi bi-image"></i>
              <span> Gallary </span>
            </a>
          </li>
          <li>
            <a href="">
              <i class="bi bi-camera"></i>
              <span> Service </span>
            </a>
          </li>
          <li>
            <a href="">
              <i class="bi bi-person-lines-fill"></i>
              <span> Contact </span>
            </a>
          </li>
        </ul>
      </div>
      <div class="bodyContent" style="width:100%">
        <div class="container-fluid">
          <slot></slot>
        </div>
      </div>
    </div>
  </div>
</template>

<script setup>
import { ref } from "@vue/reactivity";
// For Toggling the sideNave var
const smallNav = ref(true);
const largeNav = ref(false);

function smallNavClick() {
  smallNav.value = false;
  largeNav.value = true;
}
function largeNavClick() {
  smallNav.value = true;
  largeNav.value = false;
}
</script>

<style scoped>
/* NAV */
.sideBar {
  width: 5%;
  height: 100vh;
  background-color: white;
  border-right: solid 1px black;
}

.sideBar ul li i,
.liText p {
  color: var(--color-default);
}

.fullSideNav {
  width: 15%;
  height: 100vh;
  background-color: var(--color-background);
  padding: 10px;

  border-right: solid 1px black;
}
.fullSideNav ul li {
  padding: 0;
  margin-bottom: 20px;
}
.sideBar ul li a,
.fullSideNav ul li a {
  text-decoration: none;
  font-size: larger;
}

.fullSideNav ul li a {
  color: var(--color-default);
}

.fullSideNav-hidden,
.sideBar-hidden {
  display: none !important;
}

.sideBar ul li {
  text-align: center;
  color: var(--color-background);
  margin-bottom: 20px;
  padding: 0;
}

@media only screen and (max-width: 1200px) {
  /*Tablets [601px -> 1200px]*/
  .sideBar {
    width: 8%;
  }
  .fullSideNav {
    width: 15%;
  }
}
@media only screen and (max-width: 600px) {
  /*Big smartphones [426px -> 600px]*/
  .sideBar {
    width: 18%;
  }
  .fullSideNav {
    width: 25%;
  }
}
@media only screen and (max-width: 425px) {
  /*Small smartphones [325px -> 425px]*/
  .sideBar {
    width: 20%;
  }
  .fullSideNav {
    width: 40%;
  }
}
</style>
