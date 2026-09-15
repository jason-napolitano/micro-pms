<template>
    <table class="w-full">
        <board-head :types="props.itemTypes" />
        <board-body :units="props.units" v-if="props.units.length" :vendors="props.vendors" :technicians="props.technicians" />
    </table>
    <el-empty v-if="!props.units.length" />
</template>

<script setup lang="ts">
// --------------------------------------------------------
// imports
import { ItemType, Unit, User, Vendor } from '@/types'
import BoardHead from './board/head.vue'
import BoardBody from './board/body.vue'

// --------------------------------------------------------
// component props
const props = defineProps<{
    itemTypes: ItemType[]
    technicians: User[]
    vendors: Vendor[]
    units: Unit[]
}>()
</script>
