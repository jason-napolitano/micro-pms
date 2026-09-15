<template>
    <div class="text-primary flex cursor-pointer items-center underline" @click="toggleFilters(props.filter, props.data, props.href)">
        <Funnel class="h-3.5" v-if="props.icon" />
        <span v-text="props.text" />
    </div>
</template>

<script setup lang="ts">
// --------------------------------------------------------
// imports
import { Funnel } from 'lucide-vue-next'

// --------------------------------------------------------
// component props
interface ComponentProps {
    text?: string
    filter: string
    data: string | number
    href?: string
    icon?: boolean
}

const props = withDefaults(defineProps<ComponentProps>(), {
    text: null,
    href: null,
    icon: true,
})

// --------------------------------------------------------
// composables
const { toggleFilters } = useRoute()
</script>
