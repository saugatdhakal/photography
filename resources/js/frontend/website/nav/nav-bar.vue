<template>
  <KeepAlive>
    <div class="container-fluid">
      <header id="header" class="header d-flex align-items-center fixed-top">
        <div
          class="
            header-nav
            container-fluid
            d-flex
            align-items-center
            justify-content-between
          "
          style=""
        >
          <a
            href="index.html"
            class="logo d-flex align-items-center me-auto me-lg-0"
          >
            <!-- Uncomment the line below if you also wish to use an image logo -->
            <!-- <img src="assets/img/logo.png" alt=""> -->
            <i class="bi bi-camera"></i>
            <h1>ASTRO</h1>
          </a>

          <nav id="navbar" class="navbar">
            <ul>
              <li>
                <router-link :to="{ name: 'home' }">Home</router-link>
              </li>
              <li><router-link :to="{ name: 'about' }">About</router-link></li>
              <li class="dropdown">
                <a href="#"
                  ><span>Gallery</span>
                  <i class="bi bi-chevron-down dropdown-indicator"></i
                ></a>
                <ul>
                  <li><a href="gallery.html">Nature</a></li>
                  <li><a href="gallery.html">People</a></li>
                  <li><a href="gallery.html">Architecture</a></li>
                  <li><a href="gallery.html">Animals</a></li>
                  <li><a href="gallery.html">Sports</a></li>
                  <li><a href="gallery.html">Travel</a></li>
                  <li class="dropdown">
                    <a href="#"
                      ><span>Sub Menu</span>
                      <i class="bi bi-chevron-down dropdown-indicator"></i
                    ></a>
                    <ul>
                      <li><a href="#">Sub Menu 1</a></li>
                      <li><a href="#">Sub Menu 2</a></li>
                      <li><a href="#">Sub Menu 3</a></li>
                    </ul>
                  </li>
                </ul>
              </li>
              <li>
                <router-link :to="{ name: 'service' }">Service</router-link>
              </li>
              <li>
                <router-link :to="{ name: 'contact' }">Contact</router-link>
              </li>
            </ul>
          </nav>
          <!-- .navbar -->

          <div class="header-social-links">
            <a href="#" class="twitter"><i class="bi bi-twitter"></i></a>
            <a href="#" class="facebook"><i class="bi bi-facebook"></i></a>
            <a href="#" class="instagram"><i class="bi bi-instagram"></i></a>
            <a href="#" class="linkedin"><i class="bi bi-linkedin"></i></a>
          </div>
          <i class="mobile-nav-toggle mobile-nav-show bi bi-list"></i>
          <i
            class="mobile-nav-toggle mobile-nav-hide d-none bi bi-x text-white"
          ></i>
        </div>
      </header>
    </div>
  </KeepAlive>
  <main>
    <slot></slot>
  </main>
</template>
<script setup>
</script>

<style scoped>
/*--------------------------------------------------------------
  # Desktop Navigation
  --------------------------------------------------------------*/
@media (min-width: 1280px) {
  .navbar {
    padding: 0;
  }

  .navbar ul {
    margin: 0;
    padding: 0;
    display: flex;
    list-style: none;
    align-items: center;
  }

  .navbar li {
    position: relative;
  }

  .navbar a,
  .navbar a:focus {
    display: flex;
    align-items: center;
    justify-content: space-between;
    padding: 10px 0 10px 30px;
    font-family: var(--font-primary);
    text-transform: uppercase;
    letter-spacing: 2px;
    font-size: 13px;
    font-weight: 400;

    white-space: nowrap;
    transition: 0.3s;
    color: var(--color-default);
  }

  .dropdown ul li:hover {
    color: red;
  }

  .navbar a i,
  .navbar a:focus i {
    font-size: 12px;
    line-height: 0;
    margin-left: 5px;
  }

  .navbar a:hover,
  .navbar .active,
  .navbar .active:focus,
  .navbar li:hover > a {
    color: var(--color-primary);
  }

  .navbar .dropdown ul {
    display: block;
    position: absolute;
    left: 14px;
    top: calc(100% + 30px);
    margin: 0;
    padding: 10px 0;
    z-index: 99;
    opacity: 0;
    visibility: hidden;
    background: var(--color-secondary);
    transition: 0.3s;
    border-radius: 4px;
  }

  .navbar .dropdown ul li {
    min-width: 200px;
  }

  .navbar .dropdown ul a {
    padding: 10px 20px;
    font-size: 15px;
    text-transform: none;
    font-weight: 400;
  }

  .navbar .dropdown ul a i {
    font-size: 12px;
  }

  .navbar .dropdown ul a:hover,
  .navbar .dropdown ul .active:hover,
  .navbar .dropdown ul li:hover > a {
    color: #fff;
  }

  .navbar .dropdown:hover > ul {
    opacity: 1;
    top: 100%;
    visibility: visible;
  }

  .navbar .dropdown .dropdown ul {
    top: 0;
    left: calc(100% - 30px);
    visibility: hidden;
  }

  .navbar .dropdown .dropdown:hover > ul {
    opacity: 1;
    top: 0;
    left: 100%;
    visibility: visible;
  }
}

@media (min-width: 1280px) and (max-width: 1366px) {
  .navbar .dropdown .dropdown ul {
    left: -90%;
  }

  .navbar .dropdown .dropdown:hover > ul {
    left: -100%;
  }
}

@media (min-width: 1280px) {
  .mobile-nav-show,
  .mobile-nav-hide {
    display: none;
  }
}

/*--------------------------------------------------------------
  # Mobile Navigation
  --------------------------------------------------------------*/
@media (max-width: 1279px) {
  .navbar {
    position: fixed;
    top: 0;
    right: -100%;
    width: 100%;
    max-width: 400px;
    bottom: 0;
    transition: 0.3s;
    z-index: 9997;
  }

  .navbar ul {
    position: absolute;
    inset: 0;
    padding: 50px 0 10px 0;
    margin: 0;
    background: rgba(0, 0, 0, 0.9);
    overflow-y: auto;
    transition: 0.3s;
    z-index: 9998;
  }

  .navbar a,
  .navbar a:focus {
    display: flex;
    align-items: center;
    justify-content: space-between;
    padding: 10px 20px;
    font-family: var(--font-primary);
    font-size: 13px;
    text-transform: uppercase;
    font-weight: 400;
    color: var(--color-background);

    letter-spacing: 1px;
    white-space: nowrap;
    transition: 0.3s;
  }

  .navbar a i,
  .navbar a:focus i {
    font-size: 12px;
    line-height: 0;
    margin-left: 5px;
  }

  .navbar a:hover,
  .navbar .active,
  .navbar .active:focus,
  .navbar li:hover > a {
    color: var(--color-background);
  }

  .navbar .dropdown ul,
  .navbar .dropdown .dropdown ul {
    position: static;
    display: none;
    padding: 10px 0;
    margin: 10px 20px;
    transition: all 0.5s ease-in-out;
    border: 1px solid black;
  }

  .navbar .dropdown > .dropdown-active,
  .navbar .dropdown .dropdown > .dropdown-active {
    display: block;
  }

  .mobile-nav-show {
    color: var(--color-default);
    font-size: 28px;
    cursor: pointer;
    line-height: 0;
    transition: 0.5s;
    z-index: 9999;
    margin: 0 10px 0 10px;
  }

  .mobile-nav-hide {
    color: var(--color-default);
    font-size: 32px;
    cursor: pointer;
    line-height: 0;
    transition: 0.5s;
    position: fixed;
    right: 20px;
    top: 20px;
    z-index: 9999;
  }

  .mobile-nav-active {
    overflow: hidden;
  }

  .mobile-nav-active .navbar {
    right: 0;
  }

  .mobile-nav-active .navbar:before {
    content: "";
    position: fixed;
    inset: 0;
    background: rgba(22, 23, 24, 0.8);
    z-index: 9996;
  }
}

.dropdown ul li a {
  color: var(--color-background);
}
a.router-link-active {
  color: #27a776;
}
</style>
