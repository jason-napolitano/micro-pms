<template>
    <el-button :icon="Plus" @click="toggleDialog()" v-if="can('create_user')"> New User </el-button>

    <el-dialog v-model="dialogOpen" title="Create New User" width="600">
        <el-form @submit.prevent="submitForm" class="flex w-full flex-col gap-4">
            <el-row>
                <el-col :span="12">
                    <el-form-item label="Name" :error="form.errors.name">
                        <el-input name="name" placeholder="Full Name" v-model="form.name" />
                    </el-form-item>
                </el-col>
                <el-col :span="12">
                    <el-form-item label="Username" :error="form.errors.username"> <el-input name="username" v-model="form.username" /> </el-form-item>
                </el-col>
            </el-row>

            <el-form-item label="Email Address" :error="form.errors.email">
                <el-input name="email" type="text" placeholder="Email Address" v-model="form.email" />
            </el-form-item>
            <el-row>
                <el-col :span="12">
                    <el-form-item label="Password" :error="form.errors.name">
                        <el-input name="password" type="password" v-model="form.password" :show-password="true" />
                    </el-form-item>
                </el-col>
                <el-col :span="12">
                    <el-form-item label="Confirm Password" :error="form.errors.password_confirmation">
                        <el-input name="password_confirmation" type="password" v-model="form.password_confirmation" :show-password="true" />
                    </el-form-item>
                </el-col>
            </el-row>

            <el-form-item label="Role" :error="form.errors.role">
                <el-select v-model="form.role">
                    <el-option v-for="role in props.roles" :value="role['name']" :label="roleName(role)" />
                </el-select>
            </el-form-item>
            <el-button size="default" native-type="submit" class="w-full" :loading="form.processing"> Submit </el-button>
        </el-form>
    </el-dialog>
</template>

<script setup lang="ts">
// --------------------------------------------------------
// imports
import { Plus } from 'lucide-vue-next'
import { Role } from '@/types'

// --------------------------------------------------------
// props
const props = defineProps<{
    roles: Role[]
}>()

// --------------------------------------------------------
// form data
const form = useForm({
    username: '',
    name: '',
    email: '',
    password: '',
    password_confirmation: '',
    role: null,
})

// --------------------------------------------------------
// form submission
const submitForm = () => {
    form.post(route('users.store'), {
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

// --------------------------------------------------------
// role name formatting
const { toTitleCase, replace } = useString()

const roleName = (role: Role) => computed(() => toTitleCase(replace(role['name'], '_', ' '))).value
</script>
