<template>
    <app-layout title="devices">
        <template #header>
            <h2 class="h4 font-weight-bold">devices</h2>
        </template>
        <div class="row mb-4">
            <div class="col-auto ms-auto">
                <Button @click="dialogVisible = true">Add Device</Button>
            </div>
        </div>
        <DataTable :value="devices" paginator :rows="10">
            <Column field="id" header="ID"> </Column>
        </DataTable>
        <Dialog v-model:visible="dialogVisible" modal>
            <template #header> Add Device </template>
            <form id="add-device-form" @submit.prevent="addDevice">
                <fieldset :disabled="submitting">
                    <span class="p-float-label mt-4">
                        <InputText v-model="deviceData.code" id="code">
                        </InputText>
                        <label for="code">Code</label>
                    </span>
                </fieldset>
                <p>{{ formResponse }}</p>
            </form>
            <template #footer>
                <Button type="submit" form="add-device-form">Save</Button>
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

        const devices = ref([]);
        const getDevices = async () => {
            const response = await axios.get("/device");
            devices.value = response.data.data;
        };

        Object.assign(exports, {
            devices,
            getDevices,
        });

        // Adding devices

        const dialogVisible = ref(false);
        const deviceData = ref({
            name: "",
        });

        const formResponse = ref("response");
        const addDevice = async () => {
            try {
                const response = await axios.post(
                    `/device/claim/${deviceData.value.code}`
                );
                getDevices();

                formResponse.value = "Device added!";
            } catch (e) {
                formResponse.value = "Device could not be added";
            }
        };

        Object.assign(exports, {
            dialogVisible,
            deviceData,
            addDevice,
            formResponse,
        });

        onMounted(getDevices);

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
