<template>
    <dashboard-layout :title="props.property['name']">
        <template #headingRight>
            <div v-text="props.property['address']" />
        </template>
        <el-tabs tabindex="0" type="border-card">
            <el-tab-pane tabindex="0">
                <template #label>
                    <span class="flex items-center">
                        <Calendar class="h-4" />
                        <span>Make-Ready</span>
                    </span>
                </template>

                <div class="flex flex-col gap-4">
                    <div class="flex justify-end">
                        <el-button-group>
                            <create :units="props.propertyUnits" v-if="can('create_make_ready')" />
                            <manage-item-visibility :types="props.visibleItemTypes" v-if="can('filter_make_ready_items')" />
                        </el-button-group>
                    </div>
                    <make-ready-board
                        :itemTypes="props.boardItemTypes"
                        :technicians="props.technicians"
                        :units="props.makeReadyUnits"
                        :vendors="props.vendors"
                    />
                </div>
            </el-tab-pane>

            <el-tab-pane v-if="can('view_make_ready_floor_plans')">
                <template #label>
                    <span class="flex items-center">
                        <LayoutDashboard class="h-4" />
                        <span>Floor Plans</span>
                    </span>
                </template>

                <div class="flex flex-col gap-4">
                    <div class="flex justify-end">
                        <add-floor-plan :property="props.property" />
                    </div>

                    <floor-plan-table :floor_plans="props.floorPlans" />
                </div>
            </el-tab-pane>
            <el-tab-pane v-if="can('view_make_ready_units')">
                <template #label>
                    <span class="flex items-center">
                        <House class="h-4" />
                        <span>Units</span>
                    </span>
                </template>

                <div class="flex flex-col gap-4">
                    <div class="flex justify-end">
                        <add-unit :property="props.property" :floorPlans="props.floorPlans" />
                    </div>
                    <unit-units :units="props.tabUnits" />
                </div>
            </el-tab-pane>
        </el-tabs>
    </dashboard-layout>
</template>

<script setup lang="ts">
// --------------------------------------------------------
// imports
import ManageItemVisibility from '@/components/forms/make-ready-items/manage-item-visibility.vue'
import { FloorPlan, ItemType, PaginatedUnits, Property, Unit, User, Vendor } from '@/types'
import MakeReadyBoard from '@/components/tables/make-ready/board.vue'
import AddFloorPlan from '@/components/forms/floor-plans/create.vue'
import { LayoutDashboard, House, Calendar } from 'lucide-vue-next'
import FloorPlanTable from '@/components/tables/floor-plans.vue'
import Create from '@/components/forms/make-ready/create.vue'
import AddUnit from '@/components/forms/units/create.vue'
import UnitUnits from '@/components/tables/units.vue'

// --------------------------------------------------------
// authentication
const { can } = useAuth()

// --------------------------------------------------------
// component props
const props = defineProps<{
    visibleItemTypes: ItemType[]
    boardItemTypes: ItemType[]
    tabUnits: PaginatedUnits
    floorPlans: FloorPlan[]
    makeReadyUnits: Unit[]
    propertyUnits: Unit[]
    technicians: User[]
    property: Property
    vendors: Vendor[]
}>()
</script>
