<template>
  <div id="wrapper" ref="sideBarFlag">
    <!-- Sidebar -->
    <div id="sidebar-wrapper">
      <ul class="sidebar-nav">
        <li class="sidebar-brand">
          <a href="#"> PHOTOGRAPHY </a>
        </li>
        <li>
          <a href="#">Dashboard</a>
        </li>
        <li>
          <a href="#">Shortcuts</a>
        </li>
        <li>
          <a href="#">Overview</a>
        </li>
        <li>
          <a href="#">Events</a>
        </li>
        <li>
          <a href="#">About</a>
        </li>
        <li>
          <a href="#">Services</a>
        </li>
        <li>
          <a href="#">Contact</a>
        </li>
      </ul>
    </div>
    <!-- /#sidebar-wrapper -->

    <!-- Page Content -->
    <div id="page-content-wrapper">
      <nav
        class="
          top-nav
          d-flex
          align-items-center
          w-100
          bg-white
          justify-content-start
        "
      >
        <div
          id="menu-toggle"
          @click="toggleSideBar"
          style="padding-right: 50px"
        >
          <i class="bi bi-list"></i>
        </div>
        <div class="logo-container">
          <p class="top-nav-logo">PHOTOGRAPHY</p>
        </div>

        <div class="profile">
          <i class="bi bi-person-circle"></i>
        </div>
      </nav>
      <div class="container-fluid">
        <slot></slot> 
      </div>
    </div>
    <!-- /#page-content-wrapper -->
  </div>
  <!-- /#wrapper -->
</template>

<script setup>
import { onMounted, ref } from "@vue/runtime-core";

function toggleSideBar() {
  $("#wrapper").toggleClass("toggled");
}
</script>

<style scoped>
* {
  margin: 0;
  padding: 0;
}
/* BODY CONTAINER */
.body-container {
  display: flex;
}
/* TOP NAV  */
.top-nav {
  height: 55px;
  padding: 5px 12px;
  flex-wrap: wrap;
  border-bottom: 1px solid gainsboro;
  position: relative;
}
.menu i,
.profile i {
  font-size: 25px;
}
.top-nav-logo {
  font-weight: 500;
}
.logo-container {
  width: 155px;
}
.profile {
  margin-left: auto;
}

/* Body and side bar */

body {
  overflow-x: hidden;
}

/* Toggle Styles */

#wrapper {
  padding-left: 0;
  -webkit-transition: all 0.5s ease;
  -moz-transition: all 0.5s ease;
  -o-transition: all 0.5s ease;
  transition: all 0.5s ease;
}

#wrapper.toggled {
  padding-left: 230px;
}

#sidebar-wrapper {
  z-index: 1000;
  position: fixed;
  left: 250px;
  width: 0;
  top: 0;
  height: 100%;
  margin-left: -250px;
  overflow-y: auto;
  background: #000;
  -webkit-transition: all 0.5s ease;
  -moz-transition: all 0.5s ease;
  -o-transition: all 0.5s ease;
  transition: all 0.5s ease;
}

#wrapper.toggled #sidebar-wrapper {
  width: 230px;
}

#page-content-wrapper {
  width: 100%;
  position: absolute;
}

#wrapper.toggled #page-content-wrapper {
  position: absolute;
  margin-right: -230px;
}

/* Sidebar Styles */

.sidebar-nav {
  position: absolute;
  height: 100vh;
  width: 250px;
  margin: 0;
  padding: 0;
  list-style: none;
}

.sidebar-nav li {
  text-indent: 20px;
  line-height: 40px;
}

.sidebar-nav li a {
  display: block;
  text-decoration: none;
  color: #999999;
}

.sidebar-nav li a:hover {
  text-decoration: none;
  color: #fff;
  background: rgba(255, 255, 255, 0.2);
}

.sidebar-nav li a:active,
.sidebar-nav li a:focus {
  text-decoration: none;
}

.sidebar-nav > .sidebar-brand {
  height: 65px;
  font-size: 18px;
  line-height: 60px;
}

.sidebar-nav > .sidebar-brand a {
  color: #999999;
}

.sidebar-nav > .sidebar-brand a:hover {
  color: #fff;
  background: none;
}

@media (min-width: 768px) {
  #wrapper {
    padding-left: 230px;
  }

  #wrapper.toggled {
    padding-left: 0;
  }

  #sidebar-wrapper {
    width: 230px;
  }

  #wrapper.toggled #sidebar-wrapper {
    width: 0;
  }

  #page-content-wrapper {
    position: relative;
  }

  #wrapper.toggled #page-content-wrapper {
    position: relative;
    margin-right: 0;
  }
  .logo-container {
    display: none;
  }
}
</style>
