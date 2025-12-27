<script setup lang="ts">
import Avatar from '@/shared/ui/volt/Avatar.vue';
import SecondaryButton from '@/shared/ui/volt/SecondaryButton.vue';
import Toolbar from '@/shared/ui/volt/Toolbar.vue';
import {BaseRouterLink} from "@/shared/ui/BaseRouterLink";
</script>

<template>
  <Toolbar pt:root="rounded-full p-4">
    <template #start>
      <div class="flex items-center gap-2">
        <BaseRouterLink :to="{ name: 'home' }" class="">
          <img src="@/widgets/Navbar/assets/img/Logo.svg"
               alt="Логотип"
               class="hover:scale-125 transition-transform delay-10"
          >
        </BaseRouterLink>

        <BaseRouterLink>
          <SecondaryButton label="Задачи"
                           text
                           class="hover:scale-110 transition-transform delay-10"
          />
        </BaseRouterLink>
      </div>
    </template>

    <template #end>
      <div class="flex items-center gap-2">
        <SecondaryButton label="Вход"
                         class="hover:scale-105 transition-transform delay-10"
        />
        <SecondaryButton label="Регистрация"
                         class="hover:scale-105 transition-transform delay-10"
        />
      </div>
    </template>
  </Toolbar>
</template>

<style scoped>
</style>