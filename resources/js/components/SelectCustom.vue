<script setup lang="ts">
import { computed } from 'vue'
import { Select, SelectTrigger, SelectValue, SelectContent, SelectItem } from '@/components/ui/select'

interface Option {
  uuid: string
  name: string
}

const props = defineProps<{
  options: Option[]
  modelValue: string
}>()

const emit = defineEmits<{
  (e: 'update:modelValue', value: string): void
}>()

const selected = computed({
  get: () => props.modelValue,
  set: (value: string) => emit('update:modelValue', value),
})
</script>

<template>
  <Select v-model="selected">
    <SelectTrigger class="w-full">
      <SelectValue placeholder="Select an option" />
    </SelectTrigger>

    <SelectContent class="max-h-60 overflow-y-auto">
      <template v-for="option in options" :key="option.uuid">
        <SelectItem :value="option.uuid">
          {{ option.name }}
        </SelectItem>
      </template>
    </SelectContent>
  </Select>
</template>
