<script setup lang="ts">
import Navbar from "@/widgets/Navbar/ui/Navbar.vue";
</script>

<template>
  <div class="w-full min-h-dvh flex flex-col bg-gradient-to-br from-blue-400 to-purple-600 text-white">
    <header class="w-full">
      <Navbar class="m-4"/>
    </header>

    <main class="flex-1 flex items-center justify-center">
      <slot></slot>
    </main>

    <footer></footer>
  </div>
</template>

<style scoped>
</style>
