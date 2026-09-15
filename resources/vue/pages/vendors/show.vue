<template>
    <dashboard-layout :title="props.vendor['name']">
        <h1>{{ props.vendor['name'] }}</h1>
    </dashboard-layout>
</template>

<script setup lang="ts">
// --------------------------------------------------------
// imports
import type { Vendor } from '@/types'

// --------------------------------------------------------
// component props
const props = defineProps<{
    vendor: Vendor
}>()
</script>
