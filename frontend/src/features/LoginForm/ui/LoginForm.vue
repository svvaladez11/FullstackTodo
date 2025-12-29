<script setup lang="ts">
import {Button} from "@/shared/ui/volt";
import useLoginForm from "@/features/LoginForm/model/useLoginForm";
import type {IEmits} from "../types/ui/login-form";
import {defineEmits} from "vue";

const form = useLoginForm();

const emits = defineEmits<IEmits>();

const handleSubmit = () => {
  emits('on-submit', form.state, form.v$);
}
</script>

<template>
  <div>
    <component :is="form.component">
      <Button
          class="mt-4 w-full"
          label="Войти"
          @click.prevent="handleSubmit"
      />
    </component>
  </div>
</template>


<style scoped>
</style>