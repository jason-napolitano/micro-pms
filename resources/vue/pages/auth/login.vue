<template>
    <auth-layout title="Login">
        <el-form @submit.prevent="form.post(route('login.store'))">
            <el-form-item label="Email Address" :error="form.errors.email">
                <el-input name="email" placeholder="Email Address" v-model="form.email" />
            </el-form-item>
            <el-form-item label="Password" :error="form.errors.password">
                <el-input toggleMask name="password" type="password" v-model="form.password" />
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
    email: '',
    password: '',
    remember: false,
})
</script>
