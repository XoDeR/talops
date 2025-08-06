<script setup lang="ts">
import { MoreHorizontal } from 'lucide-vue-next'
import { Button } from '@/components/ui/button'
import { DropdownMenu, DropdownMenuContent, DropdownMenuItem, DropdownMenuSeparator, DropdownMenuTrigger } from '@/components/ui/dropdown-menu'
import { router } from '@inertiajs/vue3'

defineProps<{
  companyDisplay: {
    uuid: string
  }
}>()

function view(uuid: string) {
  console.log("view")
  router.visit(`/companies/${uuid}`, {
    method: 'get',
  })
}

function edit(uuid: string) {
  console.log("edit")
  router.visit(`/companies/${uuid}/edit`, {
    method: 'get',
  })
}

function deleteItem(uuid: string) {
  console.log("delete")
  if (confirm("Are you sure you want to delete this company?")) {
    router.delete(`/companies/${uuid}`, {
      preserveScroll: true,
      preserveState: true,
      onSuccess: () => {
        console.log("Company deleted")
      },
    })
  } else {
    console.log("Deletion cancelled")
  }
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