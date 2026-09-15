<template>
    <el-button :icon="Plus" :disabled="!props.units.length" @click="toggleDialog">New Make-Ready</el-button>

    <el-dialog v-model="dialogOpen" width="500" title="New Make-Ready">
        <div class="flex justify-end">
            <el-form-item label="Allow Multiple Entries?">
                <el-checkbox v-model="allowMultipleEntries" />
            </el-form-item>
        </div>
        <el-form @submit.prevent="submitForm">
            <el-row>
                <el-col :span="24">
                    <el-form-item label="Unit Number" :error="form.errors.unit_id">
                        <el-select filterable v-model="form.unit_id">
                            <el-option v-for="unit in props.units" :key="unit['id']" :value="unit['id']" :label="unit['unit_number']" />
                        </el-select>
                    </el-form-item>
                </el-col>
            </el-row>

            <el-row :gutter="4">
                <el-col :span="12">
                    <el-form-item label="Start Date" :error="form.errors.started_at">
                        <el-date-picker v-model="form.started_at" class="w-full" />
                    </el-form-item>
                </el-col>
                <el-col :span="12">
                    <el-form-item label="Finish Date" :error="form.errors.expected_at">
                        <el-date-picker v-model="form.expected_at" class="w-full" />
                    </el-form-item>
                </el-col>
            </el-row>

            <el-row>
                <el-col :span="24">
                    <el-form-item>
                        <el-button native-type="submit" class="w-full" size="default" :loading="form.processing"> Submit Data </el-button>
                    </el-form-item>
                </el-col>
            </el-row>
        </el-form>
    </el-dialog>
</template>

<script setup lang="ts">
// --------------------------------------------------------
// imports
import { Plus } from 'lucide-vue-next'
import { Unit } from '@/types'

// --------------------------------------------------------
// component props
const props = defineProps<{
    units: Unit[]
}>()

// --------------------------------------------------------
// dialog window
const dialogOpen = ref(false)

const toggleDialog = () => (dialogOpen.value = !dialogOpen.value)

// --------------------------------------------------------
// form data

// allows multiple entries without closing
// the dialog window
const allowMultipleEntries = ref(false)

const form = useForm({
    expected_at: null,
    started_at: null,
    unit_id: null,
})

// --------------------------------------------------------
// form actions
const submitForm = () => {
    form.post(route('make-ready.store'), {
        onSuccess: () => {
            ElNotification.success({
                message: 'Make-ready created successfully',
                position: 'bottom-right',
            })
            form.reset()
            if (!allowMultipleEntries.value) {
                toggleDialog()
            }
        },
    })
}
</script>

<style scoped>
/* --- */
</style>
