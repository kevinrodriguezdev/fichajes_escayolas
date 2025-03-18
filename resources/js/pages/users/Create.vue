<script setup lang="ts">
import AppLayout from '@/Layouts/AppLayout.vue';
import { Inertia } from '@inertiajs/vue3';
import { ref } from 'vue';
import { Button } from '@/components/ui/button';
import { Input } from '@/components/ui/input';
import { Label } from '@/components/ui/label';

type BreadcrumbItem = { title: string; href: string };
const breadcrumbs: BreadcrumbItem[] = [
  { title: 'Users', href: '/users' },
  { title: 'Create', href: '#' },
];

</script>

<template>
<Head title="Create User" />

<AppLayout :breadcrumbs="breadcrumbs">
<div class="flex flex-1 flex-col gap-4 rouded-xl p-4">
    <h1 class="text-2xl font-bold">Añadir usuario</h1>
    <form v-for="(label,key) in {name: 'Nombre', email: 'Correo electrónico'}" :key="key" @submit.prevent="Inertia.post('/users', form)">
        <Label :for="key" :value="label" />
        <Input v-model="form[key]" :id="key" :type="key === 'email' ? 'email' : 'text'" :required="true" />
        
    </form>
</div>
</AppLayout>
</template>