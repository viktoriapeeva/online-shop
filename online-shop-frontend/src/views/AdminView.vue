<template>
    <div>
        <!-- Add table to add/remove/delete categories, users, products -->
        <h1 class="text-2xl font-bold mb-4">Admin Dashboard</h1>
        <div class="overflow-x-auto">
            <table class="min-w-full bg-white border border-gray-200">
                <thead>
                    <tr>
                        <th class="px-4 py-2 border-b">ID</th>
                        <th class="px-4 py-2 border-b">Name</th>
                        <th class="px-4 py-2 border-b">Email</th>
                        <th class="px-4 py-2 border-b">Role</th>
                        <th class="px-4 py-2 border-b">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <!-- Loop through users and display them in the table -->
                    <tr v-for="user in users" :key="user.id">
                        <td class="px-4 py-2 border-b">{{ user.id }}</td>
                        <td class="px-4 py-2 border-b">{{ user.name }}</td>
                        <td class="px-4 py-2 border-b">{{ user.email }}</td>
                        <td class="px-4 py-2 border-b">{{ user.role }}</td>
                        <td class="px-4 py-2 border-b">
                            <!-- Add buttons to edit/delete user -->
                            <!-- <button @click="editUser(user)" class="text-blue-500 hover:underline">Edit</button>
                            <button @click="deleteUser(user.id)" class="text-red-500 hover:underline ml-2">Delete</button> -->
                        </td>
                    </tr>
                </tbody>
            </table>
    </div>
</template>
<script setup>
import { ref } from 'vue'
const users = ref([])
</script>