<template>
    <app-layout title="Schools">
        <template #header>
            <h2 class="h4 font-weight-bold">Schools</h2>
        </template>
        <DataTable :value="schools" paginator :rows="10">
            <Column field="name" header="Name"></Column>
        </DataTable>
    </app-layout>
</template>

<script>
import { defineComponent, ref, onMounted } from "vue";
import AppLayout from "@/Layouts/AppLayout.vue";
import Welcome from "@/Jetstream/Welcome.vue";
import DataTable from "primevue/datatable";
import Column from "primevue/column";
import axios from "axios";

export default defineComponent({
    setup() {
        const exports = {};

        const schools = ref([]);
        const getSchools = async () => {
            const response = await axios.get("/school");
            schools.value = response.data.data;
        };

        Object.assign(exports, {
            schools,
            getSchools,
        });

        onMounted(getSchools);

        return exports;
    },
    components: {
        AppLayout,
        Welcome,
        DataTable,
        Column,
    },
});
</script>
