<script setup lang="ts">
import { defineProps } from "vue";
import type {IProps} from "./types";

// define props
defineProps<IProps>();
</script>

<template>
  <RouterLink :to="{ name: to }">
    <slot></slot>
  </RouterLink>
</template>

<style scoped>

</style>