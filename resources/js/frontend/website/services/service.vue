<template>
  <main id="main" data-aos="fade" data-aos-delay="1500">
    <!-- ======= End Page Header ======= -->
    <div class="page-header d-flex align-items-center">
      <div class="container position-relative">
        <div class="row d-flex justify-content-center">
          <div class="col-lg-6 text-center">
            <h2>Services</h2>
            <p>
              Odio et unde deleniti. Deserunt numquam exercitationem. Officiis
              quo odio sint voluptas consequatur ut a odio voluptatem. Sit
              dolorum debitis veritatis natus dolores. Quasi ratione sint. Sit
              quaerat ipsum dolorem.
            </p>

            <a class="cta-btn" href="contact.html">Available for hire</a>
          </div>
        </div>
      </div>
    </div>
    <!-- End Page Header -->

    <!-- ======= Services Section ======= -->
    <section id="services" class="services">
      <div class="container">
        <div class="row gy-4">
          <div class="col-xl-3 col-md-6 d-flex">
            <div class="service-item position-relative">
              <i class="bi bi-activity"></i>
              <h4><a href="" class="stretched-link">Lorem Ipsum</a></h4>
              <p>
                Voluptatum deleniti atque corrupti quos dolores et quas
                molestias excepturi
              </p>
            </div>
          </div>
          <!-- End Service Item -->

          <div class="col-xl-3 col-md-6 d-flex">
            <div class="service-item position-relative">
              <i class="bi bi-bounding-box-circles"></i>
              <h4><a href="" class="stretched-link">Sed ut perspici</a></h4>
              <p>
                Duis aute irure dolor in reprehenderit in voluptate velit esse
                cillum dolore
              </p>
            </div>
          </div>
          <!-- End Service Item -->

          <div class="col-xl-3 col-md-6 d-flex">
            <div class="service-item position-relative">
              <i class="bi bi-calendar4-week"></i>
              <h4><a href="" class="stretched-link">Magni Dolores</a></h4>
              <p>
                Excepteur sint occaecat cupidatat non proident, sunt in culpa
                qui officia
              </p>
            </div>
          </div>
          <!-- End Service Item -->

          <div class="col-xl-3 col-md-6 d-flex">
            <div class="service-item position-relative">
              <i class="bi bi-broadcast"></i>
              <h4><a href="" class="stretched-link">Nemo Enim</a></h4>
              <p>
                At vero eos et accusamus et iusto odio dignissimos ducimus qui
                blanditiis
              </p>
            </div>
          </div>
          <!-- End Service Item -->
        </div>
      </div>
    </section>
    <!-- End Services Section -->

    <!-- ======= Pricing Section ======= -->
    <section id="pricing" class="pricing">
      <div class="container">
        <div class="section-header">
          <h2>Prices</h2>
          <p>Check my adorable pricing</p>
        </div>

        <div class="row gy-4 gx-lg-5">
          <div class="col-lg-6">
            <div class="pricing-item d-flex justify-content-between">
              <h3>Portrait Photography</h3>
              <h4>$160.00</h4>
            </div>
          </div>
          <!-- End Pricing Item -->

          <div class="col-lg-6">
            <div class="pricing-item d-flex justify-content-between">
              <h3>Fashion Photography</h3>
              <h4>$300.00</h4>
            </div>
          </div>
          <!-- End Pricing Item -->

          <div class="col-lg-6">
            <div class="pricing-item d-flex justify-content-between">
              <h3>Sports Photography</h3>
              <h4>$200.00</h4>
            </div>
          </div>
          <!-- End Pricing Item -->

          <div class="col-lg-6">
            <div class="pricing-item d-flex justify-content-between">
              <h3>Still Life Photography</h3>
              <h4>$120.00</h4>
            </div>
          </div>
          <!-- End Pricing Item -->

          <div class="col-lg-6">
            <div class="pricing-item d-flex justify-content-between">
              <h3>Wedding Photography</h3>
              <h4>$500.00</h4>
            </div>
          </div>
          <!-- End Pricing Item -->

          <div class="col-lg-6">
            <div class="pricing-item d-flex justify-content-between">
              <h3>Photojournalism</h3>
              <h4>$200.00</h4>
            </div>
          </div>
          <!-- End Pricing Item -->
        </div>
      </div>
    </section>
    <!-- End Pricing Section -->

  </main>
  <!-- End #main -->
</template>

<script>
export default {};
</script>

<style scoped>
/*--------------------------------------------------------------
  # Services Section
  --------------------------------------------------------------*/
  .services .service-item {
    padding: 50px 30px;
    transition: all ease-in-out 0.4s;
    background: var(--color-secondary-2);
    height: 100%;
    overflow: hidden;
    z-index: 1;
}

.services .service-item:before {
    content: "";
    position: absolute;
    background: #1d1f20;
    top: -200px;
    transition: all 0.3s;
    z-index: -1;
}

.services .service-item i {
    background: var(--color-primary);
    color: #fff;
    font-size: 24px;
    transition: 0.3s;
    display: flex;
    align-items: center;
    justify-content: center;
    width: 56px;
    height: 56px;
    border-radius: 50%;
}

.services .service-item h4 {
    font-weight: 600;
    margin: 15px 0 0 0;
    transition: 0.3s;
    font-size: 20px;
}

.services .service-item h4 a {
    color: #fff;
}

.services .service-item p {
    line-height: 24px;
    font-size: 14px;
    margin: 15px 0 0 0;
}

.services .service-item:hover:before {
    background: var(--color-primary);
    right: 0;
    top: 0;
    width: 100%;
    height: 100%;
    border-radius: 0px;
}

.services .service-item:hover h4 a,
.services .service-item:hover p {
    color: #fff;
}

.services .service-item:hover i {
    background: #fff;
    color: var(--color-primary);
}

/*--------------------------------------------------------------
  # Pricing Section
  --------------------------------------------------------------*/
  .pricing {
    margin-top: 80px;
}

.pricing .pricing-item {
    border-bottom: 1px dashed #0b0d0e;
    width: 100%;
    height: 100%;
    padding: 0 0 15px 0;
}

.pricing .pricing-item h3 {
    margin: 0;
    font-size: 18px;
    font-weight: 500;
    color: var(--color-default);
}

.pricing .pricing-item h4 {
    margin: 0;
    font-size: 16px;
}
</style>
