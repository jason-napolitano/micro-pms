<template>
    <el-form @submit.prevent="submitForm">
        <el-form-item>
            <el-date-picker-panel type="dates" :border="false" v-model="form.scheduled_at" />
        </el-form-item>

        <el-form-item>
            <el-button native-type="submit" size="default" class="w-full">Schedule {{ item.type['name'] }}</el-button>
        </el-form-item>
    </el-form>
</template>

<script setup lang="ts">
// --------------------------------------------------------
// imports
import { router } from '@inertiajs/vue3'
import { MakeReadyItem } from '@/types'

// --------------------------------------------------------
// component props
const props = defineProps<{
    item: MakeReadyItem
}>()

// --------------------------------------------------------
// form data
const form = reactive({
    scheduled_at: null,
})

// --------------------------------------------------------
// events
const emits = defineEmits(['formUpdated'])

// --------------------------------------------------------
// form actions
const submitForm = () => {
    // console.log(form.scheduled_at)
    router.patch(
        route('make-ready.item.update-schedule', props.item),
        {
            scheduled_start_at: form.scheduled_at[0] ?? null,
            scheduled_end_at: form.scheduled_at[1] ?? null,
        },
        {
            onSuccess: () => {
                ElNotification.success({
                    message: 'Schedule Updated Successfully',
                    position: 'bottom-right',
                })
                emits('formUpdated')
            },
        },
    )
}
</script>
