<template>
  <div class="mt-1">
    <label :for="uuid" class="form-label"> {{props.label}} </label>
    <div :class="props.iconClass? 'input-group mb-3':''">
      <div v-if="props.iconClass" class="input-group-prepend">
        <span class="input-group-text"><i :class="props.iconClass"></i></span>
      </div>
      <input
        :type="props.input_type"
        :id="uuid"
        class="form-control form-floating"
        v-bind="$attrs"
        :placeholder="props.label"
        :value="modelValue"
        @input="$emit('update:modelValue', $event.target.value)"
        :aria-describedby="error ? `${uuid}-error` : null"
        :aria-invalid="error ? true : null"
        :disabled="props.isDisable"

      />
    </div>

  </div>
</template>

<script setup>
import UniqueID from "../js/UniqueID";
const uuid = UniqueID().getID();
const props = defineProps({
  label: {
    type: String,
    define: "",
  },
  modelValue: {
    type: [String, Number],
    define: "",
  },
  error: {
    type: String,
    default: "",
  },
  require: {
    type: Boolean,
    default: false,
  },
  isDisable: {
    type: Boolean,
    default: false,
  },
  iconClass:{
    type: String,
    default:null
  },
  input_type:{
    type:String,
    default: "text",
  }
});
</script>

<style>
</style>
