<template>
    <a :href="`mailto:${props.email}`" class="flex items-center text-blue-300 underline">
        <MailPlus class="h-3.5" />
        <span>{{ props.text }}</span>
    </a>
</template>

<script setup lang="ts">
// --------------------------------------------------------
// imports
import { MailPlus } from 'lucide-vue-next'

// --------------------------------------------------------
// props
const props = defineProps<{
    email: string
    text: string
}>()
</script>
