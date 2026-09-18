<template>
    <Head :title="props.title" />
    <slot />
</template>

<script setup lang="ts">
// --------------------------------------------------------
// props
interface AppLayoutProps {
    title?: string | null
}
const props = withDefaults(defineProps<AppLayoutProps>(), {
    title: null,
})
</script>
