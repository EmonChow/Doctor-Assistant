<template>
    <component :is="type"></component>
</template>

<script>
import Simplified from "./Simplified";
import Compact from "./Compact";
import Overlap from "./Overlap";
import Light from "./Light";

export default {
    name: "Header",
    components: {
        simplified: Simplified,
        compact: Compact,
        overlap: Overlap,
        light: Light
    },
    props: {
        type: {
            required: false,
            type: String,
            default: 'overlap',
            validator: (value) => [
                'simplified',
                'compact',
                'overlap',
                'light'
            ].includes(value.toLowerCase())
        }
    }
}
</script>

<style scoped>

</style>
