<template>
  <div class="container text-xs-center mt-4">
    <div class="d-flex  flex-column align-items-center">
      <div class="icon-container mb-2">
        <i class="checkmark">✓</i>
      </div>
      <h1>Purchase Successful!</h1>
      <hr style="width:400px">
      <div>
        <div class="row ">
          <strong class="col-md-6" style="width: 180px">Transaction Number</strong>
          <p class="col-md-6">1234567894154556</p>
        </div>
        <div class="d-flex" >
          <strong style="width: 10px">Email</strong>
          <p>Saugatdhakal54564654465@gmail.com</p>
        </div>
        <div class="d-flex">
          <strong style="width: 190px">Photo Name</strong>
          <p>Day in Night</p>
        </div>
        <div class="d-flex">
          <strong style="width: 190px">Payment Date</strong>
          <p>2022/12/2</p>
        </div>
        <hr />
        <div class="d-flex mb-0">
          <strong style="width: 190px">Total Amount</strong>
          <p>$123</p>
        </div>
      </div>
      <p class="lead">
        <strong>Please check your email</strong> for further instructions on how
        to complete your account setup.
      </p>
      <hr />
      <p>Having trouble? <a href="">Contact us</a></p>
      <p class="lead">
        <a
          class="btn btn-primary btn-sm"
          href="https://bootstrapcreative.com/"
          role="button"
          >Continue to homepage</a
        >
      </p>
    </div>
  </div>
</template>

<script setup>
const props = defineProps(["id"]);
console.log(props.id);
</script>

<style scoped>
.icon-container {
  border-radius: 200px;
  height: 200px;
  width: 200px;
  background: #f8faf5;
  margin: 0 auto;
}
.checkmark {
  color: #9abc66;
  font-size: 100px;
  line-height: 200px;
  margin-left: 50px;
}
</style>
