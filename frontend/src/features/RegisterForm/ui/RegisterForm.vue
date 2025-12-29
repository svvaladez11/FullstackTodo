<script setup lang="ts">
import {Button} from "@/shared/ui/volt";
import useRegisterForm from "@/features/RegisterForm/model/useRegisterForm";
import type {IEmits} from "../types/ui/register-form";
import {defineEmits} from "vue";

const form = useRegisterForm();

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
          label="Зарегистрироваться"
          @click.prevent="handleSubmit"
      />
    </component>
  </div>
</template>


<style scoped>
</style>