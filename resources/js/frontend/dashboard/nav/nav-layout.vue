<template>
  <div id="wrapper" ref="sideBarFlag">
    <!-- Sidebar -->
    <div id="sidebar-wrapper">
      <ul class="sidebar-nav">
        <li class="sidebar-brand">
          <a href="#"> PHOTOGRAPHY </a>
        </li>
        <li v-for="(link,i) in navigationPath" :key="i">
          <router-link :to="{ name: link.name }"
            ><i :class="link.icon"></i> &nbsp;{{link.label}}</router-link
          >
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
      <div
        class="container-fluid"
        style="
          background-color: rgb(246, 247, 251);
          min-height: calc(100vh - 56px);
          display: block;
        "
      >
        <slot></slot>
      </div>
    </div>
    <!-- /#page-content-wrapper -->
  </div>
  <!-- /#wrapper -->
</template>

<script setup>

const navigationPath = [
  {
    'name':'adminHome',
    'label':'Dashboard',
    'icon':'bi bi-columns-gap'
  },
  {
    'name':'imageupload',
    'label':'Upload Image',
    'icon':'bi bi-cloud-plus-fill'
  },
  {
    'name':'adminDetails',
    'label':'Admin Details',
    'icon':'bi bi-person-lines-fill'
  },
  {
    'name':'adminHome',
    'label':'Service',
    'icon':'bi bi-tags-fill'
  },

]
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
.profile i ,#menu-toggle i{
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
  min-height: 100vh;
  border-right: 1px solid gainsboro;
  margin-left: -250px;
  overflow-y: auto;

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

  width: 230px;
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
  color: rgb(163, 163, 174);
}

.sidebar-nav li a:hover,.sidebar-nav li a.router-link-exact-active{
  text-decoration: none;
  color: #fff;
  margin: 0px 2px;
  background: purple;
  border-radius: 5px;
}

.sidebar-nav li a:active,
.sidebar-nav li a:focus {
  text-decoration: none;
}

.sidebar-nav > .sidebar-brand {
  height: 55px;
  font-size: 18px;
  line-height: 54px;
  border-bottom: 1px solid gainsboro;
  margin-bottom: 5px;
}

.sidebar-nav > .sidebar-brand a {
  color: #080303;
}

.sidebar-nav > .sidebar-brand a:hover {
  color: rgb(1, 0, 0);
  background: none;
}
.line-color {
  color: rgb(187, 186, 186);
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
