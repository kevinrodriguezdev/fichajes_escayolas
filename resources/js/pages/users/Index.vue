<script setup lang="ts">
import AppLayout from '@/Layouts/AppLayout.vue';
import { Head, usePage, Link } from '@inertiajs/vue3';
import { Table, TableBody, TableCaption, TableCell, TableHead, TableHeader, TableRow } from '@/components/ui/table';
import { Button } from '@/components/ui/button';
import { Pencil, Trash, CirclePlus } from 'lucide-vue-next';
import { computed } from 'vue';

// Definimos la interfaz para los usuarios
interface User {
    id: number;
    name: string;
    email: string;
}

// Obtenemos los datos de la página con `usePage()`
const page = usePage();
const users = computed(() => page.props.users || []); // Asegura que `users` nunca sea null
</script>

<template>
    <Head title="Users" />
    <AppLayout> 
        <div class="flex h-full flex-1 flex-col gap-4 rounded-xl p-4">
            <div class="flex">
                <Button as-child size="sm" class="bg-indigo-500 text-white hover:bg-indigo-700">
                    <Link href="/users/create">
                        <CirclePlus /> Create
                    </Link>
                </Button>
            </div>
        </div>

        <div class="relative min-h-[100vh] flex-1 rounded-xl border border-sidebar-border/70 dark:border-sidebar-border md:min-h-min">
            <Table v-if="users.length > 0">
                <TableCaption>Users List</TableCaption>
                <TableHeader>
                    <TableRow>
                        <TableHead>Name</TableHead>
                        <TableHead>Email</TableHead>
                        <TableHead>Actions</TableHead>
                    </TableRow>
                </TableHeader>
                <TableBody>
                    <TableRow v-for="user in users" :key="user?.id">
                        <TableCell>{{ user?.name }}</TableCell>
                        <TableCell>{{ user?.email }}</TableCell>
                        <TableCell>
                            <Button size="icon" variant="outline">
                                <Pencil />
                            </Button>
                            <Button size="icon" variant="destructive">
                                <Trash />
                            </Button>
                        </TableCell>
                    </TableRow>
                </TableBody>
            </Table>
            <p v-else class="text-center text-gray-500">No users found.</p>
        </div>
    </AppLayout>
</template>
