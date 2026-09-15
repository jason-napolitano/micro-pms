<template>
    <span>
        <span v-text="props.value" /> <sup>FT <sup>2</sup></sup>
    </span>
</template>

<script setup lang="ts">
// --------------------------------------------------------
// component props
const props = defineProps<{
    value: number
}>()
</script>
