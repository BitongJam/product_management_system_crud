<script setup>
import { ref } from "vue";
import { Link, router } from "@inertiajs/vue3";
const props = defineProps({
    products: {
        type: Array,
        default: () => [],
    },
    filters: {
        type: Object,
        default: () => ({}),
    },
});

const search = ref(props.filters.search || "");

function searchProducts() {
    router.get(
        "/products",
        { search: search.value },
        { preserveState: true, replace: true },
    );
}

function formatPrice(price) {
    return new Intl.NumberFormat("en-PH", {
        style: "currency",
        currency: "PHP",
    }).format(price);
}

function deleteProduct(id) {
    if (confirm("Are you sure you want to delete this product?")) {
        router.delete(`/products/${id}`);
    }
}
</script>

<template>
    <div class="min-h-screen bg-gray-100 p-8">
        <div class="mx-auto max-w-7xl">
            <!-- Header -->
            <div class="mb-6 flex items-center justify-between">
                <div>
                    <h1 class="text-2xl font-bold text-gray-800">Products</h1>
                    <p class="mt-1 text-sm text-gray-500">
                        Manage your products and inventory.
                    </p>
                </div>

                <Link
                    href="/products/create"
                    class="rounded-lg bg-blue-600 px-5 py-2 font-medium text-white hover:bg-blue-700"
                >
                    + Create Product
                </Link>
            </div>

            <form @submit.prevent="searchProducts" class="mb-5 flex gap-2">
                <input
                    v-model="search"
                    type="text"
                    placeholder="Search products..."
                    class="w-full max-w-md rounded-lg border border-gray-300 bg-white px-4 py-2 focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-200"
                />

                <button
                    type="submit"
                    class="rounded-lg bg-gray-800 px-5 py-2 text-white hover:bg-gray-700"
                >
                    Search
                </button>

                <Link
                    v-if="search"
                    href="/products"
                    class="rounded-lg border border-gray-300 px-5 py-2 text-gray-700 hover:bg-gray-50"
                >
                    Clear
                </Link>
            </form>

            <!-- Product Table -->
            <div class="overflow-hidden rounded-xl bg-white shadow-sm">
                <div class="overflow-x-auto">
                    <table class="w-full text-left text-sm">
                        <thead class="bg-gray-50 text-gray-600">
                            <tr>
                                <th class="px-6 py-4 font-semibold">ID</th>
                                <th class="px-6 py-4 font-semibold">
                                    Product Name
                                </th>
                                <th class="px-6 py-4 font-semibold">
                                    Description
                                </th>
                                <th class="px-6 py-4 text-right font-semibold">
                                    Price
                                </th>
                                <th class="px-6 py-4 text-right font-semibold">
                                    Quantity
                                </th>
                                <th class="px-6 py-4 text-center font-semibold">
                                    Type
                                </th>
                                <th class="px-6 py-4 text-center font-semibold">
                                    Actions
                                </th>
                            </tr>
                        </thead>

                        <tbody class="divide-y divide-gray-100">
                            <tr
                                v-for="product in products.data"
                                :key="product.id"
                                class="hover:bg-gray-50"
                            >
                                <td class="px-6 py-4 text-gray-500">
                                    {{ product.id }}
                                </td>

                                <td class="px-6 py-4 font-medium text-gray-800">
                                    {{ product.name }}
                                </td>

                                <td class="px-6 py-4 text-gray-500">
                                    {{ product.description }}
                                </td>

                                <td class="px-6 py-4 text-right text-gray-800">
                                    {{ formatPrice(product.price) }}
                                </td>

                                <td class="px-6 py-4 text-right text-gray-800">
                                    {{ product.quantity }}
                                </td>

                                <td class="px-6 py-4 text-center">
                                    <span
                                        class="rounded-full px-3 py-1 text-xs font-medium"
                                        :class="
                                            product.type === 'stock'
                                                ? 'bg-blue-100 text-blue-700'
                                                : 'bg-purple-100 text-purple-700'
                                        "
                                    >
                                        {{ product.type }}
                                    </span>
                                </td>
                                <td class="px-6 py-4 text-center">
                                    <Link
                                        :href="`/products/${product.id}/edit`"
                                        class="font-medium text-blue-600 hover:text-blue-800"
                                    >
                                        Edit
                                    </Link>
                                    <button
                                        type="button"
                                        @click="deleteProduct(product.id)"
                                        class="font-medium text-red-600 hover:text-red-800"
                                    >
                                        Delete
                                    </button>
                                </td>
                            </tr>

                            <!-- Empty State -->
                            <tr v-if="products.length === 0">
                                <td colspan="6" class="px-6 py-12 text-center">
                                    <p class="text-gray-500">
                                        No products found.
                                    </p>

                                    <Link
                                        href="/products/create"
                                        class="mt-3 inline-block text-blue-600 hover:underline"
                                    >
                                        Create your first product
                                    </Link>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    <div class="mt-6 flex items-center justify-between">
                        <p class="text-sm text-gray-600">
                            Showing {{ products.from }} to {{ products.to }} of
                            {{ products.total }} products
                        </p>

                        <div class="flex gap-2">
                            <button
                                v-for="link in products.links"
                                :key="link.label"
                                :disabled="!link.url"
                                @click="
                                    router.get(
                                        link.url,
                                        {},
                                        {
                                            preserveState: true,
                                            preserveScroll: true,
                                        },
                                    )
                                "
                                v-html="link.label"
                                class="rounded border px-3 py-2 text-sm disabled:opacity-40"
                                :class="{
                                    'bg-blue-600 text-white': link.active,
                                }"
                            />
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
