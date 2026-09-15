<template>
    <Head :title="props.title" />
    <slot />

    <div v-show="false" class="container mx-auto flex justify-center pt-2">
        <DarkMode />
    </div>
</template>

<script setup lang="ts">
// --------------------------------------------------------
// props
import DarkMode from '@/components/buttons/dark-mode.vue'

interface AppLayoutProps {
    title?: string | null
}
const props = withDefaults(defineProps<AppLayoutProps>(), {
    title: null,
})
</script>
