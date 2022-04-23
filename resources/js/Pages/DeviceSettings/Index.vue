<template>
    <app-layout title="Settings">
        <template #header>
            <h2 class="h4 font-weight-bold">Device Settings</h2>
        </template>
        <div class="row">
            <div class="col">
                <Card>
                    <template #title>
                        <h3>Settings</h3>
                    </template>
                    <template #content>
                        <strong>Scenario 1 Time</strong>
                        <div class="d-flex">
                            <InputNumber
                                v-model="scenarioOneMinutes"
                                show-buttons
                                :min="0"
                            >
                            </InputNumber>
                            <InputNumber
                                v-model="scenarioOneSeconds"
                                show-buttons
                                :min="0"
                            >
                            </InputNumber>
                        </div>
                        <strong>Scenario 2 Time</strong>
                        <div class="d-flex">
                            <InputNumber
                                v-model="scenarioTwoMinutes"
                                show-buttons
                                :min="0"
                            >
                            </InputNumber>
                            <InputNumber
                                v-model="scenarioTwoSeconds"
                                show-buttons
                                :min="0"
                            >
                            </InputNumber>
                        </div>
                    </template>
                </Card>
            </div>
            <div class="col">
                <Card>
                    <template #title>
                        <h3>Apply to devices:</h3>
                    </template>
                    <template #content>
                        <MultiSelect
                            v-model="selectedDevices"
                            :options="devices"
                            option-label="id"
                            display="chip"
                            :max-selected-labels="2"
                            placeholder="Select Devices"
                        />
                        <div>
                            <Button @click="applySettings"> Apply </Button>
                        </div>
                    </template>
                </Card>
            </div>
        </div>
    </app-layout>
</template>

<script>
import { defineComponent, ref, computed, onMounted } from "vue";
import AppLayout from "@/Layouts/AppLayout.vue";
import Card from "primevue/card";
import MultiSelect from "primevue/multiselect";
import InputText from "primevue/inputtext";
import InputNumber from "primevue/inputnumber";
import Button from "primevue/button";

export default defineComponent({
    setup() {
        const exports = {};

        // Device Data

        const devices = ref([]);
        const getDevices = async () => {
            const response = await axios.get("/device");
            devices.value = response.data.data;
        };
        const selectedDevices = ref([]);
        const selectedDeviceIds = computed(() => {
            return selectedDevices.value.map((device) => device.id);
        });

        onMounted(getDevices);

        Object.assign(exports, {
            devices,
            getDevices,
            selectedDevices,
            selectedDeviceIds,
        });

        // Settings
        const scenarioOneMinutes = ref(10);
        const scenarioOneSeconds = ref(0);

        const scenarioOneTime = computed(() => {
            return scenarioOneMinutes.value * 60 + scenarioOneSeconds.value;
        });

        const scenarioTwoMinutes = ref(10);
        const scenarioTwoSeconds = ref(0);

        const scenarioTwoTime = computed(() => {
            return scenarioTwoMinutes.value * 60 + scenarioTwoSeconds.value;
        });

        const applySettings = async () => {
            const response = await axios.post("/settings/apply", {
                scenario_one_time: scenarioOneTime.value,
                scenario_two_time: scenarioTwoTime.value,
                selected_devices: selectedDeviceIds.value,
            });
        };

        Object.assign(exports, {
            scenarioOneMinutes,
            scenarioOneSeconds,
            scenarioTwoMinutes,
            scenarioTwoSeconds,
            applySettings,
        });

        return exports;
    },
    components: {
        AppLayout,
        Card,
        MultiSelect,
        InputText,
        InputNumber,
        Button,
    },
});
</script>
