<script setup lang="ts">
import { MoreHorizontal } from 'lucide-vue-next'
import { Button } from '@/components/ui/button'
import { DropdownMenu, DropdownMenuContent, DropdownMenuItem, DropdownMenuLabel, DropdownMenuSeparator, DropdownMenuTrigger } from '@/components/ui/dropdown-menu'

defineProps<{
  companyDisplay: {
    uuid: string
  }
}>()

function view(uuid: string) {
  console.log("view")
}

function edit(uuid: string) {
  console.log("edit")
}

function deleteItem(uuid: string) {
  console.log("delete")
}
</script>

<template>
  <DropdownMenu>
    <DropdownMenuTrigger as-child>
      <Button variant="ghost" class="w-8 h-8 p-0">
        <span class="sr-only">Open menu</span>
        <MoreHorizontal class="w-4 h-4" />
      </Button>
    </DropdownMenuTrigger>
    <DropdownMenuContent align="end">
      <DropdownMenuItem @click="view(companyDisplay.uuid)">
        View
      </DropdownMenuItem>
      <DropdownMenuItem @click="edit(companyDisplay.uuid)">
        Edit
      </DropdownMenuItem>
      <DropdownMenuSeparator />
      <DropdownMenuItem @click="deleteItem(companyDisplay.uuid)">
        Delete
      </DropdownMenuItem>
    </DropdownMenuContent>
  </DropdownMenu>
</template>