<template>
    <div id="app">
        <button @click="count++">
            Count is: {{ count }}
        </button>
        <div class="row justify-content-center">
            <ul>
                <li v-for="test in tests" :key="test.id">{{ test.title }}</li>
            </ul>
        </div>
    </div>
</template>

<script setup>
import { ref } from 'vue'

const count = ref(0)
</script>

<script>
export default {
    props: ["tests"]
}
</script>
