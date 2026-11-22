
<script setup>
import { useForm } from '@inertiajs/vue3';

const form = useForm({
    name: '',
    description: '',
    price: '',
    quantity: 0,
    type: 'stock',
});

function submit() {
    form.post('/products');
}
</script>


<template>
    <div class="min-h-screen bg-gray-100 p-8">
        <div class="mx-auto max-w-2xl rounded-xl bg-white p-8 shadow-sm">

            <h1 class="mb-6 text-2xl font-bold text-gray-800">
                Create Product
            </h1>

            <form @submit.prevent="submit" class="space-y-5">

                <div>
                    <label class="mb-1 block text-sm font-medium text-gray-700">
                        Product Name
                    </label>

                    <input
                        v-model="form.name"
                        type="text"
                        class="w-full rounded-lg border border-gray-300 px-3 py-2 focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-200"
                    >

                    <p v-if="form.errors.name" class="mt-1 text-sm text-red-500">
                        {{ form.errors.name }}
                    </p>
                </div>

                <div>
                    <label class="mb-1 block text-sm font-medium text-gray-700">
                        Description
                    </label>

                    <textarea
                        v-model="form.description"
                        rows="3"
                        class="w-full rounded-lg border border-gray-300 px-3 py-2 focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-200"
                    ></textarea>

                    <p v-if="form.errors.description" class="mt-1 text-sm text-red-500">
                        {{ form.errors.description }}
                    </p>
                </div>

                <div>
                    <label class="mb-1 block text-sm font-medium text-gray-700">
                        Price
                    </label>

                    <input
                        v-model="form.price"
                        type="number"
                        step="0.01"
                        class="w-full rounded-lg border border-gray-300 px-3 py-2 focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-200"
                    >
                </div>

                <div>
                    <label class="mb-1 block text-sm font-medium text-gray-700">
                        Quantity
                    </label>

                    <input
                        v-model.number="form.quantity"
                        type="number"
                        class="w-full rounded-lg border border-gray-300 px-3 py-2 focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-200"
                    >
                </div>

                <div>
                    <label class="mb-1 block text-sm font-medium text-gray-700">
                        Type
                    </label>

                    <select
                        v-model="form.type"
                        class="w-full rounded-lg border border-gray-300 bg-white px-3 py-2 focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-200"
                    >
                        <option value="stock">Stock</option>
                        <option value="service">Service</option>
                    </select>
                </div>

                <div class="flex justify-end">
                    <button
                        type="submit"
                        :disabled="form.processing"
                        class="rounded-lg bg-blue-600 px-5 py-2 font-medium text-white hover:bg-blue-700 disabled:cursor-not-allowed disabled:opacity-50"
                    >
                        {{ form.processing ? 'Saving...' : 'Save Product' }}
                    </button>
                </div>

            </form>
        </div>
    </div>
</template>

