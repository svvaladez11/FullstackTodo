<script setup lang="ts">
import {withDefaults, defineProps, computed} from "vue";
import type {IProps} from "./types";
import {RouterLinkFactory} from "./hooks";
import {useRouter} from "vue-router";

// define router
const router = useRouter();

// define props
const props = withDefaults(defineProps<IProps>(), {
  to: { name: 'home' }
});

// define component
const component = computed(() => RouterLinkFactory(props.type));
</script>

<template>
  <component v-if="component"
             :is="component"
             :to="to"
  >
    <slot></slot>
  </component>
</template>

<style scoped>

</style>