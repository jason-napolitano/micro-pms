<template>
    <el-button :icon="SlidersHorizontal" @click="toggleDialog">Filter Items</el-button>

    <el-dialog v-model="dialogOpen" width="350" title="Filter Items">
        <div class="flex flex-col gap-1" :class="{ 'gap-2': activeDropzone === 0 }">
            <div
                class="h-1 transition-all"
                :class="{
                    'h-10': activeDropzone === 0,
                }"
                @dragenter.prevent="dragEnter(0)"
                @drop.prevent="drop(0)"
                @dragover.prevent
            >
                <div v-if="activeDropzone === 0" class="h-full border border-dashed border-blue-300 bg-blue-50 dark:bg-blue-950/25 dark:border-blue-700;" />
            </div>
            <template v-for="(item, index) in items" :key="item.id">
                <div
                    class="flex items-center justify-start border border-stone-200 bg-stone-50 dark:border-zinc-800 dark:bg-zinc-900"
                    :class="{ 'opacity-50': draggedItem?.id === item.id }"
                >
                    <div class="flex w-full items-center justify-between py-1 pr-2">
                        <div @dragstart="dragStart(item)" @dragend="dragEnd" draggable="true" class="flex items-center justify-start">
                            <GripVertical class="h-3 cursor-grab" />
                            <span> {{ item['name'] }}</span>
                        </div>
                        <el-checkbox @click="toggleVisibility(item)" :checked="!item['deleted_at']" />
                    </div>
                </div>

                <!-- item dropzone -->
                <div
                    :class="{ 'h-10': activeDropzone === index + 1 }"
                    @dragenter.prevent="dragEnter(index + 1)"
                    @drop.prevent="drop(index + 1)"
                    class="h-1 transition-all"
                    @dragover.prevent
                >
                    <div v-if="activeDropzone === index + 1" class="h-full border border-dashed border-blue-300 bg-blue-50 dark:bg-blue-950/25 dark:border-blue-700;" />
                </div>
            </template>
        </div>
    </el-dialog>
</template>

<script setup lang="ts">
// --------------------------------------------------------
// imports
import { SlidersHorizontal, GripVertical } from 'lucide-vue-next'
import { router } from '@inertiajs/vue3'
import { ItemType } from '@/types'

// --------------------------------------------------------
// component props
const props = defineProps<{
    types: ItemType[]
}>()

// --------------------------------------------------------
// dialog window
const dialogOpen = ref(false)
const toggleDialog = () => (dialogOpen.value = !dialogOpen.value)

// --------------------------------------------------------
// toggle visibility
const type = ref<ItemType | null>(null)

const toggleVisibility = (value: ItemType) => {
    type.value = value
    router.patch(
        route('make-ready.items.type.visibility'),
        {
            type: type.value,
        },
        {
            onSuccess: () => {
                type.value = null
            },
        },
    )
}

// --------------------------------------------------------
// reorder functionality
const items = ref([...props.types])

const activeDropzone = ref<number | null>(null)
const draggedItem = ref<ItemType | null>(null)

// options reset
const resetDragOptions = () => {
    draggedItem.value = null
    activeDropzone.value = null
}

// drag start
function dragStart(item: ItemType) {
    draggedItem.value = item
}

// drag end
function dragEnd() {
    resetDragOptions()
}

// drag enter
function dragEnter(index: number) {
    if (!draggedItem.value) return
    activeDropzone.value = index
}

// drop action
function drop(index: number) {
    if (!draggedItem.value) return

    const draggedId = draggedItem.value.id

    // previous index
    const oldIndex = items.value.findIndex((item) => item.id === draggedId)
    if (oldIndex === -1) return

    // remove the dragged item
    const [movedItem] = items.value.splice(oldIndex, 1)

    // if we removed something before the target position,
    // the target index shifts back by one.
    let newIndex = index

    if (oldIndex < index) {
        newIndex--
    }

    // put the item into its new position
    items.value.splice(newIndex, 0, movedItem)

    // reassign integer order
    items.value.forEach((item, index) => {
        item.order = index + 1
    })

    resetDragOptions()
    saveOrder()
}

// save order
function saveOrder() {
    router.patch(
        route('make-ready.items.types.reorder'),
        {
            items: items.value.map((item) => item.id),
        },
        {
            preserveScroll: true,
            preserveState: true,
        },
    )
}
</script>
