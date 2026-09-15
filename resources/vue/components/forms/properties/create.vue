<template>
    <el-button :icon="Plus" @click="toggleDialog()">New Property</el-button>

    <el-dialog v-model="dialogOpen" title="Create New Property" width="600">
        <div class="flex justify-end">
            <el-form-item label="Allow Multiple Entries?">
                <el-checkbox v-model="allowMultiple" />
            </el-form-item>
        </div>

        <el-form @submit.prevent="submitForm">
            <el-row>
                <el-col :span="12">
                    <el-form-item label="Name" :error="form.errors.name">
                        <el-input v-model="form.name" ref="nameInput" />
                    </el-form-item>
                </el-col>
                <el-col :span="12">
                    <el-form-item label="Code" :error="form.errors.code">
                        <el-input v-model="form.code" />
                    </el-form-item>
                </el-col>
            </el-row>

            <el-row>
                <el-col :span="16">
                    <el-form-item label="Address" :error="form.errors.address">
                        <el-input v-model="form.address" />
                    </el-form-item>
                </el-col>

                <el-col :span="8">
                    <el-form-item label="Phone Number" :error="form.errors.phone">
                        <el-input v-model="form.phone" v-maska="'(###)-###-####'" />
                    </el-form-item>
                </el-col>
            </el-row>
            <el-form-item label="Image" :error="form.errors.image">
                <input type="file" accept="image/*" @change="handleImage($event)" class="el-input" />
            </el-form-item>

            <el-form-item>
                <el-button native-type="submit" size="default" class="w-full">Submit Data</el-button>
            </el-form-item>
        </el-form>
    </el-dialog>
</template>

<script setup lang="ts">
// --------------------------------------------------------
// imports
import { Plus } from 'lucide-vue-next'
import { vMaska } from 'maska/vue'

// --------------------------------------------------------
// form data
const allowMultiple = ref(false)

const form = useForm({
    address: null,
    image: null,
    phone: null,
    name: null,
    code: null,
})

// --------------------------------------------------------
// form actions
const nameInput = ref<HTMLInputElement>()

const submitForm = () => {
    form.post(route('properties.store'), {
        forceFormData: true,
        onSuccess: () => {
            nameInput.value?.focus()
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

const handleImage = (event) => {
    form.image = event.target.files[0]
}
</script>

<style scoped>
/* --- */
</style>
