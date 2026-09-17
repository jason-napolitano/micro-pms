<template>
    <thead class="bg-[#F5F7FA] dark:bg-zinc-950/60">
        <tr>
            <th class="w-32 border border-zinc-200 px-4 py-2 font-light dark:border-zinc-700">Unit Number</th>
            <th class="w-32 border border-zinc-200 px-4 py-2 font-light dark:border-zinc-700" v-for="type in props.types">{{ type['name'] }}</th>
        </tr>
    </thead>
</template>

<script setup lang="ts">
import { ItemType } from '@/types'

const props = defineProps<{
    types: ItemType[]
}>()
</script>
