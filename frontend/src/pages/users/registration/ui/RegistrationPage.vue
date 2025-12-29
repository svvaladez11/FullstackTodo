<script setup lang="ts">
import {RegisterForm} from "@/features/RegisterForm";
import useRegister from "@/pages/users/registration/models/useRegister";

const {submit} = useRegister();
</script>

<template>
  <div class="max-w-md mx-auto mt-12">

    <div class="text-center p-6 bg-white/20 rounded-xl shadow-lg backdrop-blur-md mb-8">
      <h1 class="text-4xl font-bold mb-4">Регистрация</h1>
      <p class="text-lg">Рады видеть вас здесь! Исследуйте наш сайт и наслаждайтесь контентом.</p>
    </div>

    <RegisterForm @on-submit="submit" />
  </div>
</template>

<style scoped>
</style>
