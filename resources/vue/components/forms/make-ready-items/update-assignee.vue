<template>
    <el-form @submit.prevent="submitForm">
        <el-tabs @tab-change="form.reset()">
            <el-tab-pane label="In-house">
                <el-form-item label="Select Technician">
                    <el-select v-model="form.assigned_to" :disabled="form.vendor_id" clearable>
                        <el-option
                            v-for="technician in props.technicians"
                            :key="technician['id']"
                            :label="technician['name']"
                            :value="technician['id']"
                        />
                    </el-select>
                </el-form-item>
            </el-tab-pane>
            <el-tab-pane label="Vendor">
                <el-form-item label="Select Vendor">
                    <el-select v-model="form.vendor_id" :disabled="form.assigned_to" clearable>
                        <el-option v-for="vendor in props.vendors" :key="vendor['id']" :label="vendor['name']" :value="vendor['id']" />
                    </el-select>
                </el-form-item>
            </el-tab-pane>
        </el-tabs>

        <el-form-item>
            <el-button native-type="submit" size="default" class="w-full">Assign {{ props.item.type['name'] }}</el-button>
        </el-form-item>
    </el-form>
</template>

<script setup lang="ts">
// --------------------------------------------------------
// imports
import { MakeReadyItem, User, Vendor } from '@/types'

// --------------------------------------------------------
// component props
const props = defineProps<{
    technicians: User[]
    item: MakeReadyItem
    vendors: Vendor[]
}>()

// --------------------------------------------------------
// events
const emit = defineEmits(['formUpdated'])

// --------------------------------------------------------
// form data
const form = useForm({
    assigned_to: null,
    vendor_id: null,
})

// --------------------------------------------------------
// form actions
const submitForm = () => {
    form.patch(route('make-ready.item.update-assignee', props.item), {
        onSuccess: () => {
            ElNotification.success({
                message: 'Assigned Successfully',
                position: 'bottom-right',
            })
            form.reset()
            emit('formUpdated')
        },
    })
}
</script>
