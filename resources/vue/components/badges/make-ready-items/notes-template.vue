<template>
    <el-button
        class="cursor-pointer text-sm border border-zinc-200 bg-zinc-100 px-1 py-0.5 dark:border-zinc-600 dark:bg-zinc-700"
        @click="form.notes = props.text"
        v-text="props.text"
    />
</template>

<script setup lang="ts">
import type { InertiaForm } from '@inertiajs/vue3'

// --------------------------------------------------------
// component props
const props = defineProps<{
    form: InertiaForm<any>
    text: string
}>()
</script>
