<script setup lang="ts">
import AppLayout from '@/Layouts/AppLayout.vue';
import { Head, usePage, Link, router } from '@inertiajs/vue3';
import { Table, TableBody, TableCaption, TableCell, TableHead, TableHeader, TableRow } from '@/components/ui/table';
import { Button } from '@/components/ui/button';
import { Pencil, Trash, CirclePlus } from 'lucide-vue-next';
import { computed } from 'vue';
import { BreadcrumbItem } from '@/types';


interface UserPageProps extends SharedData {
    users: User[];
}

const { props } = usePage<UserPageProps>();
const users = computed(() => props.users);

const breadcrumbs: BreadcrumbItem[] = [{ title: 'Users', href: route('users.index') }];
const deleteUser = async (id: number) => {
    if (confirm('Are you sure you want to delete this user?')) return;

    router.delete(`/users/${id}`, {
        preserveScroll: true,
        onSuccess: () => {
            // Show success notification
            router.visit('/users', { replace: true });
        },
        onError: () => {
            // Show error notification
            console.error('Error deleting user');
        },
    });
};

</script>


<template>

    <Head title="Users" />

    <AppLayout :breadcrumbs="breadcrumbs">
        <div class="flex h-full flex-1 flex-col gap-4 rounded-xl p-4">
            <Button as-child size="sm" class="bg-indigo-500 text-white hover:bg-indigo-700">
                <Link href="/users/create"><CirclePlus/>Añadir</Link>
            </Button>
        </div>

        <div class="relative min-h-[100vh] flex-1 rounded-xl border border-sidebar-border/70 dark:border-sidebar-border md:min-h-min">
            <Table>
                <TableCaption>Users</TableCaption>
                <TableHeader>
                    <TableRow>
                        <TableHead>Id</TableHead>
                        <TableHead>Name</TableHead>
                        <TableHead>Email</TableHead>
                        <TableHead>Actions</TableHead>
                    </TableRow>
                </TableHeader>
                <TableBody>
                    <TableRow v-for="user in users" :key="user.id">
                        <TableCell>{{ user.id }}</TableCell>
                        <TableCell>{{ user.name }}</TableCell>
                        <TableCell>{{ user.email }}</TableCell>
                        <TableCell>
                            <Button as-child size="sm" class="bg-indigo-500 text-white hover:bg-indigo-700">
                                <Link :href="`/users/${user.id}/edit`"><Pencil/></Link>
                            </Button>
                            <Button size="sm" class="bg-red-500 text-white hover:bg-red-700" @click="deleteUser(user.id)" >
                               <Trash/> 
                            </Button>
                        </TableCell>
                    </TableRow>
                </TableBody>
            </Table>
        </div>
    </AppLayout>

</template>
