<template>
    <master-layout>
        <auth-container>
            <auth-header />
            <auth-content>
                <slot />
            </auth-content>
        </auth-container>
    </master-layout>
</template>

<script setup lang="ts">
// --------------------------------------------------------
// imports
import AuthContainer from './partials/auth/container.vue'
import AuthContent from './partials/auth/content.vue'
import AuthHeader from './partials/auth/header.vue'
import MasterLayout from '@/layouts/master.vue'
</script>
