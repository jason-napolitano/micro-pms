<template>
    <app-layout :title="`${status} - ${title}`">
        <div class="flex items-center justify-center">
            <div class="flex flex-col gap-2 text-center">
                <div class="text-8xl font-bold">
                    {{ status }}
                </div>

                <h1 class="mt-4 text-2xl font-semibold">
                    {{ title }}
                </h1>

                <p class="mt-2 text-gray-500">
                    {{ description }}
                </p>

                <Link :href="route('welcome')" class="el-button el-button--default w-full"> Go Home </Link>
            </div>
        </div>
    </app-layout>
</template>

<script setup lang="ts">
// --------------------------------------------------------
// props
const props = defineProps<{
    status: number
}>()

// --------------------------------------------------------
// error titles
const title = computed(() => {
    return (
        {
            403: 'Forbidden',
            404: 'Page Not Found',
            419: 'Page Expired',
            500: 'Internal Error',
            503: 'Service Unavailable',
        }[props.status] ?? 'Something went wrong'
    )
})

// --------------------------------------------------------
// error descriptions
const description = computed(() => {
    return (
        {
            403: "You don't have permission to access this resource.",
            404: "The page you're looking for doesn't exist.",
            419: 'The current page has expired.',
            500: 'There was an internal server error.',
            503: 'The requested service is unavailable',
        }[props.status] ?? 'An unexpected error occurred.'
    )
})
</script>
