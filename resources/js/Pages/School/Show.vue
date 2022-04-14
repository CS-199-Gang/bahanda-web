<template>
    <app-layout title="Schools">
        <template #header>
            <h2 class="h4 font-weight-bold">Schools</h2>
        </template>
        <Card>
            <template #title>
                {{ entity.name }}
            </template>

            <template #content>
                <h4>Admins</h4>
                <ul>
                    <li
                        v-for="admin in schoolAdmins"
                        :key="`admin-${admin.id}`"
                    >
                        {{ admin.name }}
                    </li>
                </ul>
                <h4>Teachers</h4>
                <ul>
                    <li
                        v-for="teacher in teachers"
                        :key="`teacher-${teacher.id}`"
                    >
                        {{ teacher.name }}
                    </li>
                </ul>
            </template>
        </Card>
    </app-layout>
</template>

<script>
import { defineComponent, ref, onMounted, computed } from "vue";
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
    setup(props) {
        const exports = {
            ...props,
        };

        // Users

        const users = ref([]);
        const getUsers = async () => {
            const response = await axios.get(`school/${props.entity.id}/users`);
            users.value = response.data.data;
        };

        const schoolAdmins = computed(() => {
            return users.value.filter((user) => user.user_type === 2);
        });

        const teachers = computed(() => {
            return users.value.filter((user) => user.user_type === 3);
        });

        Object.assign(exports, {
            users,
            schoolAdmins,
            teachers,
        });

        onMounted(getUsers);

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
