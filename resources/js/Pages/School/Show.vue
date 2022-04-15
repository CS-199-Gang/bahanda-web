<template>
    <app-layout title="Users">
        <template #header>
            <h2 class="h4 font-weight-bold">Schools</h2>
        </template>
        <div class="row">
            <div class="col-auto ms-auto">
                <Button @click="dialogVisible = true"> Add User</Button>
            </div>
        </div>
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
        <Dialog v-model:visible="dialogVisible" modal>
            <template #header> Add User </template>
            <form id="add-user-form" @submit.prevent="addUser">
                <fieldset :disabled="submitting">
                    <!-- Name -->
                    <div class="row">
                        <div class="col">
                            <span class="p-float-label mt-4">
                                <InputText v-model="userData.name" id="name">
                                </InputText>
                                <label for="name">Name</label>
                            </span>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <span class="p-float-label mt-4">
                                <InputText
                                    v-model="userData.username"
                                    id="username"
                                >
                                </InputText>
                                <label for="username">Username</label>
                            </span>
                        </div>
                    </div>
                    <!-- Email -->
                    <div class="row">
                        <div class="col">
                            <span class="p-float-label mt-4">
                                <InputText
                                    v-model="userData.email"
                                    type="email"
                                    id="email"
                                >
                                </InputText>
                                <label for="email">Email</label>
                            </span>
                        </div>
                    </div>
                    <!-- Type -->
                    <div class="row">
                        <div class="col">
                            <span class="p-float-label mt-4">
                                <Dropdown
                                    v-model="userData.user_type"
                                    :options="userTypes"
                                    option-label="name"
                                    option-value="value"
                                    id="user-type"
                                    class="w-100"
                                >
                                </Dropdown>
                                <label for="user-type">Type</label>
                            </span>
                        </div>
                    </div>
                    <p>{{ formResponse }}</p>
                </fieldset>
            </form>
            <template #footer>
                <Button type="submit" form="add-user-form">Save</Button>
                <Button @click="dialogVisible = false">Cancel</Button>
            </template>
        </Dialog>
    </app-layout>
</template>

<script>
import { defineComponent, ref, onMounted, computed } from "vue";
import AppLayout from "@/Layouts/AppLayout.vue";
import Welcome from "@/Jetstream/Welcome.vue";
import Card from "primevue/card";
import DataTable from "primevue/datatable";
import Column from "primevue/column";
import Dialog from "primevue/dialog";
import InputText from "primevue/inputtext";
import Dropdown from "primevue/dropdown";
import Button from "primevue/button";
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

        const dialogVisible = ref(false);
        const submitting = ref(false);

        const schoolAdmins = computed(() => {
            return users.value.filter((user) => user.user_type === 2);
        });

        const teachers = computed(() => {
            return users.value.filter((user) => user.user_type === 3);
        });

        const userData = ref({
            name: "",
            user_type: "",
        });
        const formResponse = ref("");

        const addUser = async () => {
            submitting.value = true;
            const response = await axios.post(
                `/school/${props.entity.id}/add-user`,
                userData.value
            );
            submitting.value = false;
            formResponse.value = `User added with password ${response.data.data.password}`;
            getUsers();
        };

        const userTypes = ref([
            { name: "School Admin", value: 2 },
            { name: "Teacher", value: 3 },
        ]);

        Object.assign(exports, {
            users,
            schoolAdmins,
            teachers,
            userTypes,
            dialogVisible,
            userData,
            addUser,
            submitting,
            formResponse,
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
        Dialog,
        InputText,
        Dropdown,
        Button,
    },
});
</script>
