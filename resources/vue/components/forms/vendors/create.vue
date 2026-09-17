<template>
    <el-button :icon="Plus" @click="toggleDialog()" v-if="can('create_vendor')"> New Vendor </el-button>

    <el-dialog v-model="dialogOpen" title="Create New Vendor" width="600">
        <el-form @submit.prevent="submitForm" class="flex w-full flex-col gap-4">
            <el-row>
                <el-col :span="8">
                    <el-form-item label="Name" :error="form.errors.name">
                        <el-input name="name" placeholder="Full Name" v-model="form.name" />
                    </el-form-item>
                </el-col>
                <el-col :span="8">
                    <el-form-item label="Email" :error="form.errors.email">
                        <el-input name="email" placeholder="Vendor Email" v-model="form.email" />
                    </el-form-item>
                </el-col>
                <el-col :span="8">
                    <el-form-item label="Phone" :error="form.errors.phone">
                        <el-input name="phone" placeholder="Phone Number" v-model="form.phone" v-maska="'(###)-###-####'" />
                    </el-form-item>
                </el-col>
            </el-row>

            <el-row>
                <el-col :span="8">
                    <el-form-item label="Primary Contact" :error="form.errors.contact_name">
                        <el-input name="contact_name" placeholder="Contact Name" v-model="form.contact_name" />
                    </el-form-item>
                </el-col>
                <el-col :span="8">
                    <el-form-item label="Contact Email" :error="form.errors.contact_email">
                        <el-input name="contact_email" v-model="form.contact_email" />
                    </el-form-item>
                </el-col>
                <el-col :span="8">
                    <el-form-item label="Contact Phone" :error="form.errors.contact_phone">
                        <el-input name="contact_phone" v-model="form.contact_phone" v-maska="'(###)-###-####'" />
                    </el-form-item>
                </el-col>
            </el-row>

            <el-button size="default" native-type="submit" class="w-full" :loading="form.processing"> Submit </el-button>
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
const form = useForm({
    contact_name: '',
    contact_phone: '',
    contact_email: '',
    phone: '',
    email: '',
    name: '',
})

// --------------------------------------------------------
// form submission
const submitForm = () => {
    form.post(route('vendors.store'), {
        onSuccess: () => {
            form.reset()
            toggleDialog()
        },
    })
}

// --------------------------------------------------------
// auth check
const { can } = useAuth()

// --------------------------------------------------------
// dialog window
const dialogOpen = ref(false)

const toggleDialog = () => (dialogOpen.value = !dialogOpen.value)
</script>
