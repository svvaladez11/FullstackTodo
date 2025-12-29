<script setup lang="ts">
import {Avatar, Button, SecondaryButton, Toolbar} from '@/shared/ui/volt';
import {BaseRouterLink} from "@/shared/ui/BaseRouterLink";
import {useLogout, User, useUserStore} from "@/entities/user";

const store = useUserStore();

const {submit} = useLogout();
</script>

<template>
  <Toolbar pt:root="rounded-full bg-white/30 p-4">
    <template #start>
      <div class="flex items-center gap-2">
        <BaseRouterLink :to="{ name: 'home' }">
          <img src="@/widgets/Navbar/assets/img/Logo.svg"
               alt="Логотип"
               class="hover:scale-125 transition-transform delay-10"
          >
        </BaseRouterLink>

        <BaseRouterLink>
          <SecondaryButton label="Задачи"
                           text
          />
        </BaseRouterLink>
      </div>
    </template>

    <template #end>
      <div v-if="store.state.user"
           class="flex items-center gap-2"
      >
        <div class="flex items-center gap-1 hover:scale-105 transition-transform duration-150 cursor-pointer">
          <Avatar size="large"
                  shape="circle"
                  image="https://primefaces.org/cdn/primevue/images/organization/walter.jpg"
          />
          <span class="text-lg font-bold">{{ (store.state.user as User).login}}</span>
        </div>
        <Button label="Выход"
                @click.prevent="submit"
        />
      </div>
      <div v-else class="flex items-center gap-2">
        <BaseRouterLink :to="{name: 'users.login'}">
          <Button label="Вход"/>
        </BaseRouterLink>
        <BaseRouterLink :to="{name: 'users.registration'}">
          <Button label="Регистрация"/>
        </BaseRouterLink>
      </div>
    </template>
  </Toolbar>
</template>

<style scoped>
</style>