<template>
    <el-form @submit.prevent="submitForm">
        <el-form-item>
            <el-select v-model="form.status">
                <el-option v-for="status in statuses" :key="status['value']" :value="status['value']" :label="status['label']" />
            </el-select>
        </el-form-item>

        <el-form-item>
            <el-button native-type="submit" size="default" class="w-full">Submit Data</el-button>
        </el-form-item>
    </el-form>
</template>

<script setup lang="ts">
// --------------------------------------------------------
// imports
import { MakeReady } from '@/types'

// --------------------------------------------------------
// component props
const props = defineProps<{
    makeReady: MakeReady
}>()

// --------------------------------------------------------
// events
const emit = defineEmits(['formUpdated'])

// --------------------------------------------------------
// form data
const form = useForm({
    status: null,
})

const statuses = [
    { label: 'Completed', value: 'completed' },
    { label: 'Cancelled', value: 'cancelled' },
    { label: 'On-Hold', value: 'on_hold' },
]

// --------------------------------------------------------
// form actions
const submitForm = () => {
    // alert(status.value)

    form.patch(route('make-ready.update-status', props.makeReady), {
        onSuccess: () => {
            ElNotification.success({
                message: 'Status Updated Successfully',
                position: 'bottom-right',
            })
            emit('formUpdated')
        },
    })
}
</script>
