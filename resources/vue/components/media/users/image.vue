<template>
    <div class="relative inline-block">
        <button class="relative h-80 min-w-full overflow-hidden" :disabled="uploading" type="button">
            <!-- Avatar -->
            <img v-if="avatarUrl" :src="avatarUrl" alt="User avatar" class="h-full min-w-full object-cover" />

            <!-- No avatar -->
            <span v-else class="flex h-full min-w-full items-center justify-center bg-gray-200 text-gray-500">
                <span>No Avatar</span>
            </span>

            <!-- Upload overlay -->
            <span v-if="uploading" class="absolute inset-0 flex items-center justify-center bg-black/50">
                <svg class="h-6 w-6 animate-spin text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4" />

                    <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8v4a4 4 0 00-4 4H4z" />
                </svg>
            </span>
        </button>

        <div v-if="props.canUpload">
            <!-- Hidden file input -->
            <input ref="fileInput" type="file" accept="image/jpeg,image/png,image/webp" class="hidden" @change="upload" />

            <div class="el-button el-button--default mb-2 flex w-full items-center justify-center text-sm" @click="selectFile">
                <Image class="h-3.5" />
                <span>Update Image</span>
            </div>
        </div>
    </div>
</template>

<script setup lang="ts">
// --------------------------------------------------------
// imports
import { router } from '@inertiajs/vue3'
import { Image } from 'lucide-vue-next'

// --------------------------------------------------------
// props
interface Props {
    src?: string | null,
    canUpload: boolean,
}

const props = withDefaults(defineProps<Props>(), {
    canUpload: true,
})

// --------------------------------------------------------
// events
const emit = defineEmits<{
    uploaded: [url: string]
}>()

// --------------------------------------------------------
// uploader
const fileInput = ref<HTMLInputElement | null>(null)
const previewUrl = ref<string | null>(null)
const uploading = ref<boolean>(false)

// Used to force the browser to reload the image
const cacheKey = ref(Date.now())

const avatarUrl = computed(() => {
    // While uploading, show the local preview immediately
    if (previewUrl.value) {
        return previewUrl.value
    }

    if (!props.src) {
        return '/storage/avatars/empty.jpg'
    }

    // Cache busting
    return `${props.src}?v=${cacheKey.value}`
})

function selectFile() {
    if (uploading.value) {
        return
    }

    fileInput.value?.click()
}

function upload(event: Event) {
    const input = event.target as HTMLInputElement
    const file = input.files?.[0]

    if (!file) {
        return
    }

    // Immediately display the image the user selected
    previewUrl.value = URL.createObjectURL(file)

    uploading.value = true

    const formData = new FormData()
    formData.append('image', file)

    router.post(route('users.image'), formData, {
        forceFormData: true,
        preserveScroll: true,

        onSuccess: () => {
            // The server has successfully saved the image
            cacheKey.value = Date.now()

            // Remove the temporary local preview
            if (previewUrl.value) {
                URL.revokeObjectURL(previewUrl.value)
                previewUrl.value = null
            }

            // Notify the parent if it needs to update other state
            emit('uploaded', props.src ?? '')
        },

        onError: (errors) => {
            console.error('Avatar upload failed:', errors)

            // Upload failed, so remove the temporary preview
            if (previewUrl.value) {
                URL.revokeObjectURL(previewUrl.value)
                previewUrl.value = null
            }
        },

        onFinish: () => {
            uploading.value = false

            // Reset the input so selecting the same file again
            // will trigger @change
            input.value = ''
        },
    })
}

// --------------------------------------------------------
// lifecycle hooks
onBeforeUnmount(() => {
    if (previewUrl.value) {
        URL.revokeObjectURL(previewUrl.value)
    }
})
</script>
