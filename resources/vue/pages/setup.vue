<template>
    <auth-layout title="Create Admin user">
        <el-alert>
            Use this form to create the initial admin user for the application.
        </el-alert>
        <el-form @submit.prevent="form.post(route('setup.store'))" class="flex w-full flex-col gap-4">
            <el-form-item label="Name" :error="form.errors.name">
                <el-input name="name" placeholder="Full Name" v-model="form.name" />
            </el-form-item>
            <el-form-item label="Username" :error="form.errors.username">
                <el-input name="username" v-model="form.username" />
            </el-form-item>
            <el-form-item label="Email Address" :error="form.errors.name">
                <el-input name="email" type="text" placeholder="Email Address" v-model="form.email" />
            </el-form-item>
            <el-form-item label="Password" :error="form.errors.name">
                <el-input name="password" type="password" v-model="form.password" :show-password="true" />
            </el-form-item>
            <el-form-item label="Confirm Password" :error="form.errors.password_confirmation">
                <el-input name="password_confirmation" type="password" v-model="form.password_confirmation" :show-password="true" />
            </el-form-item>
            <el-button size="default" native-type="submit" class="w-full" :loading="form.processing"> Submit </el-button>
        </el-form>
    </auth-layout>
</template>

<script setup lang="ts">
// --------------------------------------------------------
// imports
import AuthLayout from '@/layouts/auth.vue'

// --------------------------------------------------------
// form data
const form = useForm({
    username: '',
    name: '',
    email: '',
    password: '',
    password_confirmation: '',
})
</script>
