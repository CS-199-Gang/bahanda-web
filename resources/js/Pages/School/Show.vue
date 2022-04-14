<template>
    <app-layout title="Schools">
        <template #header>
            <h2 class="h4 font-weight-bold">Schools</h2>
        </template>
        <Card>
            <template #title>
                {{ entity.name }}
            </template>
        </Card>
    </app-layout>
</template>

<script>
import { defineComponent, ref, onMounted } from "vue";
import AppLayout from "@/Layouts/AppLayout.vue";
import Welcome from "@/Jetstream/Welcome.vue";
import Card from "primevue/card";
import DataTable from "primevue/datatable";
import Column from "primevue/column";
import axios from "axios";

export default defineComponent({
    props: {
        entity: Object,
    },
    setup({ props }) {
        const exports = {
            ...props,
        };

        return exports;
    },
    components: {
        AppLayout,
        Welcome,
        DataTable,
        Column,
        Card,
    },
});
</script>
