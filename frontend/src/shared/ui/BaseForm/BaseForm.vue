<script setup lang="ts">
import { defineProps } from "vue";
import type { IProps } from "./types";
import {type InputTypes, type TextAreaTypes} from "@/shared/types/utils/use-form-builder";
import {InputText, Textarea, InputMask, InputNumber, InputOtp,} from '@/shared/ui/volt';

defineProps<IProps>();

const getComponent = (type: InputTypes | TextAreaTypes) => {
  switch(type) {
    case 'textarea': return Textarea;
    case 'mask': return InputMask;
    case 'number': return InputNumber;
    case 'otp': return InputOtp;
    case 'text':
    case 'password':
    default: return InputText;
  }
};

const getProps = (field) => ({
  id: field.name,
  name: field.name,
  placeholder: field.placeholder,
  ...(field.type === 'mask' ? { mask: field.mask } : {}),
  ...(field.type === 'otp' ? { length: field.length || 4 } : {}),
  ...(field.type === 'password' ? { type: field.type } : {}),
});
</script>

<template>
  <form v-if="fields.length" class="w-full">
    <div
        v-for="field in fields"
        :key="field.name"
        class="flex flex-col w-full mb-4 relative"
    >
      <component
          :is="getComponent(field.type)"
          v-if="v$.value[field.name]"
          v-model="v$.value[field.name].$model"
          v-bind="getProps(field)"
      />

      <!-- Validation Errors -->
      <div class="mt-4" v-if="v$.value[field.name]?.$errors.length > 0">
        <div
            v-for="(error, id) in v$.value[field.name].$errors"
            :key="error.$uid"
            class="flex items-center ml-2.5"
        >
          <span class="text-red-500 select-none" v-if="id === 0">✘</span>
          <div
              v-if="id === 0"
              class="flex items-center bg-white/30 shadow-[0px_0px_8px_rgba(0,_0,_0,_0.6)] rounded xl:h-12 px-3 py-1 ml-1.5"
          >
            <p class="text-red-700 text-sm">{{ error.$message }}</p>
          </div>
        </div>
      </div>

    </div>

    <slot />
  </form>
</template>

<style scoped></style>
