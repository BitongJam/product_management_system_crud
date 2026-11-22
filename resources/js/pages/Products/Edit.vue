<script setup>
import { useForm, Link } from "@inertiajs/vue3";

const props = defineProps({
    product: {
        type: Object,
        required: true,
    },
});

// Initialize form with existing product data
const form = useForm({
    name: props.product.name,
    description: props.product.description,
    price: props.product.price,
    quantity: props.product.quantity,
    type: props.product.type,
});

function submit() {
    form.put(`/products/${props.product.id}`);
}
</script>

<template>
    <div class="min-h-screen bg-gray-100 p-8">
        <div class="mx-auto max-w-2xl rounded-xl bg-white p-8 shadow-sm">
            <div class="mb-6 flex items-center justify-between">
                <h1 class="text-2xl font-bold text-gray-800">Edit Product</h1>

                <Link
                    href="/products"
                    class="text-sm text-gray-500 hover:text-gray-800"
                >
                    Back to Products
                </Link>
            </div>

            <form @submit.prevent="submit" class="space-y-5">
                <div>
                    <label class="mb-1 block text-sm font-medium text-gray-700">
                        Product Name
                    </label>

                    <input
                        v-model="form.name"
                        type="text"
                        class="w-full rounded-lg border border-gray-300 px-3 py-2 focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-200"
                    />

                    <p
                        v-if="form.errors.name"
                        class="mt-1 text-sm text-red-500"
                    >
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

                    <p
                        v-if="form.errors.description"
                        class="mt-1 text-sm text-red-500"
                    >
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
                    />
                </div>

                <div>
                    <label class="mb-1 block text-sm font-medium text-gray-700">
                        Quantity
                    </label>

                    <input
                        v-model.number="form.quantity"
                        type="number"
                        class="w-full rounded-lg border border-gray-300 px-3 py-2 focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-200"
                    />
                </div>

                <div>
                    <label class="mb-1 block text-sm font-medium text-gray-700">
                        Type
                    </label>

                    <select
                        v-model="form.type"
                        class="w-full rounded-lg border border-gray-300 bg-white px-3 py-2"
                    >
                        <option value="stock">Stock</option>
                        <option value="service">Service</option>
                    </select>
                </div>

                <div class="flex justify-end gap-3">
                    <Link
                        href="/products"
                        class="rounded-lg border border-gray-300 px-5 py-2 text-gray-700 hover:bg-gray-50"
                    >
                        Cancel
                    </Link>

                    <button
                        type="submit"
                        :disabled="form.processing"
                        class="rounded-lg bg-blue-600 px-5 py-2 font-medium text-white hover:bg-blue-700 disabled:opacity-50"
                    >
                        {{ form.processing ? "Updating..." : "Update Product" }}
                    </button>
                </div>
            </form>
        </div>
    </div>
</template>
