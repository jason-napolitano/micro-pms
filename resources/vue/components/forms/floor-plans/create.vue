<template>
    <el-button :icon="Plus" @click="toggleDialog()"> New Floor Plan </el-button>

    <el-dialog v-model="dialogOpen" title="Create New Floor Plan" width="600">
        <div class="flex justify-end">
            <el-form-item label="Allow Multiple Entries?">
                <el-checkbox v-model="allowMultiple" />
            </el-form-item>
        </div>

        <el-form @submit.prevent="submitForm">
            <el-row :gutter="4">
                <el-col :span="12">
                    <el-form-item label="Label" :error="form.errors.label">
                        <el-input v-model="form.label" ref="labelInput" />
                    </el-form-item>
                </el-col>
                <el-col :span="12">
                    <el-form-item label="Square Feet" :error="form.errors.square_feet">
                        <el-input type="number" v-model="form.square_feet" />
                    </el-form-item>
                </el-col>
            </el-row>

            <el-row :gutter="4">
                <el-col :span="12">
                    <el-form-item label="Bedrooms" :error="form.errors.bedrooms">
                        <el-input type="number" v-model="form.bedrooms" />
                    </el-form-item>
                </el-col>
                <el-col :span="12">
                    <el-form-item label="Bathrooms" :error="form.errors.bathrooms">
                        <el-input v-model="form.bathrooms" />
                    </el-form-item>
                </el-col>
            </el-row>

            <el-form-item>
                <el-button native-type="submit" size="default" class="w-full" :loading="form.processing">Submit Data</el-button>
            </el-form-item>
        </el-form>
    </el-dialog>
</template>

<script setup lang="ts">
// --------------------------------------------------------
// imports
import { Plus } from 'lucide-vue-next'
import { Property } from '@/types'

// --------------------------------------------------------
// props
const props = defineProps<{
    property: Property
}>()

// --------------------------------------------------------
// form data
const labelInput = ref<HTMLInputElement>()

// allows multiple entries without closing
// the dialog window
const allowMultiple = ref(false)

const form = useForm({
    property_id: props.property['id'],
    square_feet: null,
    bathrooms: null,
    bedrooms: null,
    label: null,
})

// --------------------------------------------------------
// form actions
const submitForm = () => {
    form.post(route('floor-plans.store'), {
        onSuccess: () => {
            labelInput.value?.focus()
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

<style scoped>
/* --- */
</style>
