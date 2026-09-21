<template>
    <el-button :icon="Plus" @click="toggleDialog()"> New Unit </el-button>

    <el-dialog v-model="dialogOpen" title="Create New Unit" width="600" @close="allowMultiple = false">
        <div class="flex justify-end">
            <el-form-item label="Allow Multiple Entries?">
                <el-checkbox v-model="allowMultiple" />
            </el-form-item>
        </div>

        <el-form @submit.prevent="submitForm">
            <el-form-item label="Unit Number" :error="form.errors.unit_number">
                <el-input v-model="form.unit_number" ref="unitNumberInput" />
            </el-form-item>

            <el-form-item label="Floor Plan" :error="form.errors.floor_plan_id">
                <el-select v-model="form.floor_plan_id" filterable>
                    <el-option :label="floorPlan['label']" :value="floorPlan['id']" v-for="floorPlan in props.floorPlans" :key="floorPlan['id']" />
                </el-select>
            </el-form-item>

            <el-form-item>
                <el-button native-type="submit" size="default" class="w-full" :loading="form.processing">Submit Data</el-button>
            </el-form-item>
        </el-form>
    </el-dialog>
</template>

<script setup lang="ts">
// --------------------------------------------------------
// imports
import { FloorPlan, Property } from '@/types'
import { Plus } from 'lucide-vue-next'

// --------------------------------------------------------
// props
const props = defineProps<{
    floorPlans: FloorPlan[]
    property: Property
}>()

// --------------------------------------------------------
// form data
const unitNumberInput = ref<HTMLInputElement>()
const allowMultiple = ref<boolean>(false)

const form = useForm({
    property_id: props.property['id'],
    floor_plan_id: null,
    unit_number: null,
})

// --------------------------------------------------------
// form actions
const submitForm = () => {
    form.post(route('units.store'), {
        onSuccess: () => {
            ElNotification.success({
                message: 'Unit created successfully',
                position: 'bottom-right',
            })

            unitNumberInput.value.focus()

            form.reset()

            if (!allowMultiple.value) {
                toggleDialog()
            }
        },
    })
}

// --------------------------------------------------------
// dialog window
const dialogOpen = ref(false)

const toggleDialog = () => (dialogOpen.value = !dialogOpen.value)
</script>
