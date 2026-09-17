<template>
    <div class="flex items-center justify-center">
        <el-switch style="--el-switch-on-color: #13ce66; --el-switch-off-color: #ec5a5a" @change="submitChanges" v-model="isActive" />
    </div>
</template>

<script setup lang="ts">
// --------------------------------------------------------
// imports
import { User, Property } from '@/types'
import { router } from '@inertiajs/vue3'

// --------------------------------------------------------
// component props
const props = defineProps<{
    property: Property
    user: User
}>()

// --------------------------------------------------------
// form data
const isActive = ref(props.property['hasAccess'])

const submitChanges = () => {
    router.patch(route('users.assign-property', {
        user: props.user,
        property: props.property,
    }))
}
</script>
