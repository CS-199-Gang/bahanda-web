<template>
    <app-layout title="Dashboard">
        <template #header>
            <h2 class="h4 font-weight-bold">Scores</h2>
        </template>

        <DataTable :value="scores">
            <Column header="Student">
                <template #body="slotProps">
                    {{ slotProps.data.name }} ({{
                        slotProps.data.student_number
                    }})
                </template>
            </Column>
            <Column field="tasks.battery" header="Batteries (2)"> </Column>
            <Column field="tasks.docs" header="Documents (1)"> </Column>
            <Column field="tasks.water" header="Water (5)"> </Column>
            <Column field="tasks.food" header="Food (9)"> </Column>
            <Column field="tasks.matchsticks" header="Matchsticks (1)">
            </Column>
            <Column field="tasks.flashlight" header="Flashlight (1)"> </Column>
            <Column field="tasks.medicne" header="Medicine (1)"></Column>
            <Column field="tasks.first_aid_kit" header="First Aid Kit (1)">
            </Column>

            <Column field="tasks.door" header="Doors (3)"></Column>
            <Column field="tasks.plug" header="Plugs (3)"></Column>
            <Column field="tasks.power" header="Power (1)"></Column>
            <Column field="tasks.window" header="Windows (3)"></Column>
        </DataTable>
    </app-layout>
</template>

<script>
import { defineComponent, onMounted, ref } from "vue";
import AppLayout from "@/Layouts/AppLayout.vue";
import axios from "axios";
import DataTable from "primevue/datatable";
import Column from "primevue/column";

export default defineComponent({
    setup() {
        const exports = {};

        const scores = ref([]);
        const getScores = async () => {
            const response = await axios.get("/score");
            scores.value = response.data.data;
        };

        Object.assign(exports, {
            scores,
        });

        onMounted(getScores);

        return exports;
    },
    components: {
        AppLayout,
        DataTable,
        Column,
    },
});
</script>
