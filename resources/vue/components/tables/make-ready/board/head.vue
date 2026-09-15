<template>
    <thead>
        <tr>
            <th>Unit Number</th>
            <th v-for="type in props.types">{{ type['name'] }}</th>
        </tr>
    </thead>
</template>

<script setup lang="ts">
import { ItemType } from '@/types'

const props = defineProps<{
    types: ItemType[]
}>()
</script>

<style scoped>
@reference "tailwindcss";
th {
    @apply w-32 border border-zinc-200 px-4 py-2 font-light dark:border-zinc-700;
}

thead {
    @apply bg-[#F5F7FA] dark:bg-zinc-950/60;
}
</style>
