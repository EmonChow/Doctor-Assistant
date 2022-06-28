<template>
    <draggable
        class="dragArea"
        tag="ul"
        :list="tasks"
        :group="{ name: 'g1' }"
        item-key="name"
    >
        <template #item="{ element }">
            <li>
                <p>{{ element.name }}</p>
                <NestedDraggable :tasks="element.tasks"/>
            </li>
        </template>
    </draggable>
</template>

<script>
import draggable from 'vuedraggable'

export default {
    name: "NestedDraggable",
    props: {
        tasks: {
            required: true,
            type: Array
        }
    },
    components: {
        draggable
    },
}
</script>

<style scoped>
.dragArea {
    min-height: 50px;
    outline: 1px dashed;
}
</style>
