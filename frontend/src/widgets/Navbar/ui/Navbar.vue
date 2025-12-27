<script setup lang="ts">
import Avatar from '@/shared/ui/volt/Avatar.vue';
import SecondaryButton from '@/shared/ui/volt/SecondaryButton.vue';
import Toolbar from '@/shared/ui/volt/Toolbar.vue';
</script>

<template>
  <Toolbar pt:root="rounded-full p-4">
    <template #start>
      <div class="flex items-center gap-2">
        <RouterLink :to="{ name: 'home' }">
          <img src="@/widgets/Navbar/assets/img/Logo.svg"
               alt="Логотип"
          >
        </RouterLink>

        <RouterLink :to="{ name: 'tasks.index' }">
          <SecondaryButton label="Задачи" text />
        </RouterLink>
      </div>
    </template>

    <template #end>
      <div class="flex items-center gap-2">
        <Avatar image="https://primefaces.org/cdn/primevue/images/avatar/amyelsner.png" />
      </div>
    </template>
  </Toolbar>
</template>

<style scoped>
</style>