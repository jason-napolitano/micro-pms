<template>
    <Link :class="[activeClass(props.pages, 'active-sidebar-item')]" class="sidebar-item" :href="route(props.href)" prefetch>
        <div class="flex flex-col items-center">
            <div v-if="props.icon">
                <props.icon class="h-14" />
            </div>
            <div class="hidden text-center md:block" v-if="props.label">{{ props.label }}</div>
        </div>
    </Link>
</template>

<script setup lang="ts">
// --------------------------------------------------------
// imports
import { FunctionalComponent } from 'vue'

// --------------------------------------------------------
// props
const props = withDefaults(
    defineProps<{
        icon?: FunctionalComponent
        label?: string
        pages?: string
        href?: string
    }>(),
    {
        label: null,
        pages: null,
        icon: null,
        href: '#',
    },
)

// --------------------------------------------------------
// composables
const { activeClass } = useMarkup()

const randomHoverColor = () => {
    const colors = ['bg-red-200', 'bg-blue-200', 'bg-green-300']

    return colors[Math.floor(Math.random() * colors.length)]
}
</script>
