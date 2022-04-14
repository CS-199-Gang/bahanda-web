<template>
    <app-layout title="Schools">
        <template #header>
            <h2 class="h4 font-weight-bold">Schools</h2>
        </template>
        <div class="row mb-4">
            <div class="col-auto ms-auto">
                <Button @click="dialogVisible = true">Add School</Button>
            </div>
        </div>
        <DataTable :value="schools" paginator :rows="10">
            <Column field="name" header="Name">
                <template #body="slotProps">
                    <Link
                        :href="route('schools.show', slotProps.data.id)"
                        :active="route().current('schools.show')"
                        >{{ slotProps.data.name }}</Link
                    >
                </template>
            </Column>
        </DataTable>
        <Dialog v-model:visible="dialogVisible" modal>
            <template #header> Add School </template>
            <form id="add-school-form" @submit.prevent="addSchool">
                <fieldset :disabled="submitting">
                    <span class="p-float-label mt-4">
                        <InputText v-model="schoolData.name" id="name">
                        </InputText>
                        <label for="name">Name</label>
                    </span>
                </fieldset>
            </form>
            <template #footer>
                <Button type="submit" form="add-school-form">Save</Button>
                <Button @click="dialogVisible = false">Cancel</Button>
            </template>
        </Dialog>
    </app-layout>
</template>

<script>
import { defineComponent, ref, onMounted } from "vue";
import AppLayout from "@/Layouts/AppLayout.vue";
import Welcome from "@/Jetstream/Welcome.vue";
import DataTable from "primevue/datatable";
import Column from "primevue/column";
import Button from "primevue/button";
import Dialog from "primevue/dialog";
import InputText from "primevue/inputtext";
import axios from "axios";
import { Link } from "@inertiajs/inertia-vue3";

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

        // Adding schools

        const dialogVisible = ref(false);
        const schoolData = ref({
            name: "",
        });

        const addSchool = async () => {
            const response = await axios.post("/school", schoolData.value);
            getSchools();
        };

        Object.assign(exports, {
            dialogVisible,
            schoolData,
            addSchool,
        });

        onMounted(getSchools);

        return exports;
    },
    components: {
        AppLayout,
        Welcome,
        DataTable,
        Column,
        Link,
        Button,
        Dialog,
        InputText,
    },
});
</script>
