<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import { Head } from "@inertiajs/vue3";
import { ref, computed } from "vue";

// Delivery Mode: 'bulk' | 'single'
const deliveryMode = ref("bulk");

// Template
const selectedTemplate = ref("Template ex 1");
const templates = ref(["Template ex 1", "Template ex 2", "Template ex 3"]);

// Single mode fields
const recipientName = ref("Andi");
const phoneNumber = ref("3456-7060");
const phonePrefix = ref("+62 321");
const parameters = ref([
    { id: 1, value: "" },
    { id: 2, value: "" },
]);

// Bulk mode
const csvFile = ref(null);
const isDragging = ref(false);

// Preview & Confirmation
const totalRecipients = computed(() => {
    if (deliveryMode.value === "single") {
        return recipientName.value && phoneNumber.value ? 1 : 0;
    }
    return 0;
});

const status = computed(() => {
    if (deliveryMode.value === "single") {
        return recipientName.value && phoneNumber.value ? "Ready" : "Not sent";
    }
    return csvFile.value ? "Ready" : "Not sent";
});

function handleDrop(e) {
    isDragging.value = false;
    const file = e.dataTransfer.files[0];
    if (file && file.name.endsWith(".csv")) {
        csvFile.value = file;
    }
}

function handleFileInput(e) {
    const file = e.target.files[0];
    if (file) csvFile.value = file;
}

function addParameter() {
    parameters.value.push({ id: Date.now(), value: "" });
}

function removeParameter(id) {
    parameters.value = parameters.value.filter((p) => p.id !== id);
}
</script>

<template>
    <Head title="Blast" />
    <AuthenticatedLayout>
        <template #header>
            <div class="px-8 py-6 bg-gray-50 min-h-screen">
                <!-- Page Title -->
                <div class="mb-5">
                    <h1 class="text-2xl font-bold text-gray-900">
                        Blast Message
                    </h1>
                    <p class="text-sm text-gray-400 mt-0.5">
                        Send Messages to multiple recipients easily and in a
                        controlled way.
                    </p>
                </div>

                <!-- ===== STEP 1: DELIVERY MODE ===== -->
                <div class="flex items-start gap-6 mb-4">
                    <div class="w-44 flex-shrink-0 pt-2">
                        <p class="text-xs font-semibold text-gray-700">
                            1. Delivery Mode
                        </p>
                        <p class="text-xs text-gray-400 mt-0.5 leading-relaxed">
                            Choose how you want to set up your recipient list
                        </p>
                    </div>

                    <div class="flex gap-3 flex-1">
                        <!-- Bulk -->
                        <button
                            @click="deliveryMode = 'bulk'"
                            :class="[
                                'flex items-center gap-3 px-4 py-3 rounded-xl border-2 transition-all flex-1 text-left',
                                deliveryMode === 'bulk'
                                    ? 'border-purple-500 bg-white shadow-sm'
                                    : 'border-gray-200 bg-white hover:border-gray-300',
                            ]"
                        >
                            <div
                                :class="[
                                    'w-4 h-4 rounded-full border-2 flex items-center justify-center flex-shrink-0',
                                    deliveryMode === 'bulk'
                                        ? 'border-purple-500'
                                        : 'border-gray-300',
                                ]"
                            >
                                <div
                                    v-if="deliveryMode === 'bulk'"
                                    class="w-2 h-2 rounded-full bg-purple-500"
                                ></div>
                            </div>
                            <div
                                :class="[
                                    'w-8 h-8 rounded-lg flex items-center justify-center flex-shrink-0',
                                    deliveryMode === 'bulk'
                                        ? 'bg-purple-100'
                                        : 'bg-gray-100',
                                ]"
                            >
                                <svg
                                    class="w-4 h-4"
                                    :class="
                                        deliveryMode === 'bulk'
                                            ? 'text-purple-600'
                                            : 'text-gray-500'
                                    "
                                    fill="none"
                                    viewBox="0 0 24 24"
                                    stroke="currentColor"
                                >
                                    <path
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        stroke-width="2"
                                        d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"
                                    />
                                </svg>
                            </div>
                            <div>
                                <p class="text-sm font-semibold text-gray-800">
                                    Bulk
                                </p>
                                <p class="text-xs text-gray-400">
                                    Send to multiple recipients via a CSV file
                                </p>
                            </div>
                        </button>

                        <!-- Single -->
                        <button
                            @click="deliveryMode = 'single'"
                            :class="[
                                'flex items-center gap-3 px-4 py-3 rounded-xl border-2 transition-all flex-1 text-left',
                                deliveryMode === 'single'
                                    ? 'border-purple-500 bg-white shadow-sm'
                                    : 'border-gray-200 bg-white hover:border-gray-300',
                            ]"
                        >
                            <div
                                :class="[
                                    'w-4 h-4 rounded-full border-2 flex items-center justify-center flex-shrink-0',
                                    deliveryMode === 'single'
                                        ? 'border-purple-500'
                                        : 'border-gray-300',
                                ]"
                            >
                                <div
                                    v-if="deliveryMode === 'single'"
                                    class="w-2 h-2 rounded-full bg-purple-500"
                                ></div>
                            </div>
                            <div
                                :class="[
                                    'w-8 h-8 rounded-lg flex items-center justify-center flex-shrink-0',
                                    deliveryMode === 'single'
                                        ? 'bg-purple-100'
                                        : 'bg-gray-100',
                                ]"
                            >
                                <svg
                                    class="w-4 h-4"
                                    :class="
                                        deliveryMode === 'single'
                                            ? 'text-purple-600'
                                            : 'text-gray-500'
                                    "
                                    fill="none"
                                    viewBox="0 0 24 24"
                                    stroke="currentColor"
                                >
                                    <path
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        stroke-width="2"
                                        d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"
                                    />
                                </svg>
                            </div>
                            <div>
                                <p class="text-sm font-semibold text-gray-800">
                                    Single
                                </p>
                                <p class="text-xs text-gray-400">
                                    Send to one or multiple recipients
                                </p>
                            </div>
                        </button>
                    </div>
                </div>

                <!-- ===== STEPS 2, 3, 4 ===== -->
                <div class="grid grid-cols-12 gap-4">
                    <!-- Step 2: Message Template -->
                    <div
                        class="col-span-3 bg-white rounded-2xl border border-gray-200 p-5"
                    >
                        <p class="text-xs font-semibold text-gray-700 mb-0.5">
                            2. Message Template
                        </p>
                        <p class="text-xs text-gray-400 mb-4">
                            Define the message to be sent
                        </p>

                        <label
                            class="block text-xs font-medium text-gray-600 mb-1.5"
                            >Template</label
                        >
                        <div class="relative">
                            <select
                                v-model="selectedTemplate"
                                class="w-full border border-gray-200 rounded-lg px-3 py-2 text-sm text-gray-700 focus:outline-none focus:ring-2 focus:ring-purple-400 bg-white appearance-none pr-8"
                            >
                                <option
                                    v-for="t in templates"
                                    :key="t"
                                    :value="t"
                                >
                                    {{ t }}
                                </option>
                            </select>
                            <svg
                                class="w-4 h-4 text-gray-400 absolute right-2 top-2.5 pointer-events-none"
                                fill="none"
                                viewBox="0 0 24 24"
                                stroke="currentColor"
                            >
                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    stroke-width="2"
                                    d="M19 9l-7 7-7-7"
                                />
                            </svg>
                        </div>

                        <div
                            class="mt-3 flex items-start gap-2 p-3 bg-blue-50 rounded-lg"
                        >
                            <svg
                                class="w-4 h-4 text-blue-400 flex-shrink-0 mt-0.5"
                                fill="currentColor"
                                viewBox="0 0 20 20"
                            >
                                <path
                                    fill-rule="evenodd"
                                    d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z"
                                    clip-rule="evenodd"
                                />
                            </svg>
                            <p class="text-xs text-blue-600" v-pre>
                                Use variables for dynamic data from CSV, for
                                example: {{ name }}, {{ phone }}
                            </p>
                        </div>
                    </div>

                    <!-- Step 3: Recipients / Input Parameters -->
                    <div
                        class="col-span-4 bg-white rounded-2xl border border-gray-200 p-5"
                    >
                        <!-- BULK -->
                        <template v-if="deliveryMode === 'bulk'">
                            <p
                                class="text-xs font-semibold text-gray-700 mb-0.5"
                            >
                                3. Recipients
                            </p>
                            <p class="text-xs text-gray-400 mb-4">
                                Upload a CSV file containing the list of
                                recipients
                            </p>

                            <div
                                @dragover.prevent="isDragging = true"
                                @dragleave="isDragging = false"
                                @drop.prevent="handleDrop"
                                :class="[
                                    'border-2 border-dashed rounded-xl py-10 flex flex-col items-center justify-center text-center transition-all',
                                    isDragging
                                        ? 'border-purple-400 bg-purple-50'
                                        : 'border-gray-200 hover:border-gray-300 bg-gray-50',
                                ]"
                            >
                                <template v-if="!csvFile">
                                    <svg
                                        class="w-10 h-10 text-gray-300 mb-2"
                                        fill="none"
                                        viewBox="0 0 24 24"
                                        stroke="currentColor"
                                    >
                                        <path
                                            stroke-linecap="round"
                                            stroke-linejoin="round"
                                            stroke-width="1.5"
                                            d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12"
                                        />
                                    </svg>
                                    <p
                                        class="text-sm font-medium text-gray-600 mb-1"
                                    >
                                        Upload file CSV
                                    </p>
                                    <p class="text-xs text-gray-400 mb-3">
                                        Drag & drop your file here or
                                    </p>
                                    <label
                                        class="cursor-pointer inline-block bg-white border border-gray-300 rounded-lg px-4 py-1.5 text-xs font-medium text-gray-600 hover:bg-gray-100 transition"
                                    >
                                        Browse File
                                        <input
                                            type="file"
                                            accept=".csv"
                                            class="hidden"
                                            @change="handleFileInput"
                                        />
                                    </label>
                                </template>
                                <template v-else>
                                    <svg
                                        class="w-5 h-5 text-green-500 mb-1"
                                        fill="none"
                                        viewBox="0 0 24 24"
                                        stroke="currentColor"
                                    >
                                        <path
                                            stroke-linecap="round"
                                            stroke-linejoin="round"
                                            stroke-width="2"
                                            d="M5 13l4 4L19 7"
                                        />
                                    </svg>
                                    <span
                                        class="text-sm text-gray-700 font-medium"
                                        >{{ csvFile.name }}</span
                                    >
                                    <button
                                        @click="csvFile = null"
                                        class="text-red-400 hover:text-red-600 text-xs mt-1"
                                    >
                                        Hapus
                                    </button>
                                </template>
                            </div>
                        </template>

                        <!-- SINGLE -->
                        <template v-else>
                            <p
                                class="text-xs font-semibold text-gray-700 mb-0.5"
                            >
                                3. Input Parameters
                            </p>
                            <p class="text-xs text-gray-400 mb-4">
                                Enter recipient data manually
                            </p>

                            <!-- Name -->
                            <div class="mb-3">
                                <label
                                    class="flex items-center gap-1.5 text-xs font-medium text-gray-600 mb-1.5"
                                >
                                    <svg
                                        class="w-3.5 h-3.5 text-gray-400"
                                        fill="none"
                                        viewBox="0 0 24 24"
                                        stroke="currentColor"
                                    >
                                        <path
                                            stroke-linecap="round"
                                            stroke-linejoin="round"
                                            stroke-width="2"
                                            d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"
                                        />
                                    </svg>
                                    Name
                                </label>
                                <input
                                    v-model="recipientName"
                                    type="text"
                                    placeholder="Enter name..."
                                    class="w-full border border-gray-200 rounded-lg px-3 py-2 text-sm text-gray-700 focus:outline-none focus:ring-2 focus:ring-purple-400"
                                />
                            </div>

                            <!-- Phone -->
                            <div class="mb-4">
                                <label
                                    class="flex items-center gap-1.5 text-xs font-medium text-gray-600 mb-1.5"
                                >
                                    <svg
                                        class="w-3.5 h-3.5 text-gray-400"
                                        fill="none"
                                        viewBox="0 0 24 24"
                                        stroke="currentColor"
                                    >
                                        <path
                                            stroke-linecap="round"
                                            stroke-linejoin="round"
                                            stroke-width="2"
                                            d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"
                                        />
                                    </svg>
                                    Phone number
                                </label>
                                <div class="flex gap-2">
                                    <div class="relative">
                                        <select
                                            v-model="phonePrefix"
                                            class="border border-gray-200 rounded-lg px-2 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-purple-400 bg-white appearance-none pr-6"
                                        >
                                            <option>+62</option>
                                            <option>+62 321</option>
                                            <option>+1</option>
                                            <option>+44</option>
                                        </select>
                                        <svg
                                            class="w-3 h-3 text-gray-400 absolute right-1 top-3 pointer-events-none"
                                            fill="none"
                                            viewBox="0 0 24 24"
                                            stroke="currentColor"
                                        >
                                            <path
                                                stroke-linecap="round"
                                                stroke-linejoin="round"
                                                stroke-width="2"
                                                d="M19 9l-7 7-7-7"
                                            />
                                        </svg>
                                    </div>
                                    <input
                                        v-model="phoneNumber"
                                        type="tel"
                                        placeholder="8xx-xxxx-xxxx"
                                        class="flex-1 border border-gray-200 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-purple-400"
                                    />
                                </div>
                            </div>

                            <!-- Parameters -->
                            <div>
                                <p
                                    class="text-xs font-medium text-gray-700 mb-2"
                                >
                                    Parameters
                                </p>
                                <div class="space-y-2">
                                    <div
                                        v-for="(param, index) in parameters"
                                        :key="param.id"
                                        class="relative"
                                    >
                                        <select
                                            v-model="param.value"
                                            class="w-full border border-gray-200 rounded-lg px-3 py-2 text-sm text-gray-400 focus:outline-none focus:ring-2 focus:ring-purple-400 bg-white appearance-none pr-8"
                                        >
                                            <option value="" disabled>
                                                parameter {{ index + 1 }}
                                            </option>
                                            <option>Option A</option>
                                            <option>Option B</option>
                                        </select>
                                        <svg
                                            class="w-4 h-4 text-gray-400 absolute right-2 top-2.5 pointer-events-none"
                                            fill="none"
                                            viewBox="0 0 24 24"
                                            stroke="currentColor"
                                        >
                                            <path
                                                stroke-linecap="round"
                                                stroke-linejoin="round"
                                                stroke-width="2"
                                                d="M19 9l-7 7-7-7"
                                            />
                                        </svg>
                                    </div>
                                </div>
                                <button
                                    @click="addParameter"
                                    class="flex items-center gap-1 text-xs text-purple-600 font-medium hover:text-purple-800 mt-3 transition"
                                >
                                    <svg
                                        class="w-3.5 h-3.5"
                                        fill="none"
                                        viewBox="0 0 24 24"
                                        stroke="currentColor"
                                    >
                                        <path
                                            stroke-linecap="round"
                                            stroke-linejoin="round"
                                            stroke-width="2"
                                            d="M12 4v16m8-8H4"
                                        />
                                    </svg>
                                    Add parameter
                                </button>
                            </div>
                        </template>
                    </div>

                    <!-- Step 4: Preview & Confirmation -->
                    <div class="col-span-5 flex flex-col gap-4">
                        <!-- Confirmation Panel -->
                        <div
                            class="bg-white rounded-2xl border border-gray-200 p-5"
                        >
                            <p
                                class="text-xs font-semibold text-gray-700 mb-0.5"
                            >
                                4. Preview & Confirmation
                            </p>
                            <p class="text-xs text-gray-400 mb-4">
                                Review before sending
                            </p>

                            <div class="divide-y divide-gray-100">
                                <!-- Total Recipients -->
                                <div
                                    class="flex items-center justify-between py-2.5"
                                >
                                    <div
                                        class="flex items-center gap-2 text-xs text-gray-500"
                                    >
                                        <svg
                                            class="w-4 h-4 text-gray-400"
                                            fill="none"
                                            viewBox="0 0 24 24"
                                            stroke="currentColor"
                                        >
                                            <path
                                                stroke-linecap="round"
                                                stroke-linejoin="round"
                                                stroke-width="2"
                                                d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z"
                                            />
                                        </svg>
                                        Total recipients
                                    </div>
                                    <span
                                        class="text-xs font-semibold text-gray-800"
                                        >{{ totalRecipients }}</span
                                    >
                                </div>

                                <!-- Template -->
                                <div
                                    class="flex items-center justify-between py-2.5"
                                >
                                    <div
                                        class="flex items-center gap-2 text-xs text-gray-500"
                                    >
                                        <svg
                                            class="w-4 h-4 text-gray-400"
                                            fill="none"
                                            viewBox="0 0 24 24"
                                            stroke="currentColor"
                                        >
                                            <path
                                                stroke-linecap="round"
                                                stroke-linejoin="round"
                                                stroke-width="2"
                                                d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"
                                            />
                                        </svg>
                                        Template
                                    </div>
                                    <span
                                        class="text-xs font-semibold text-gray-800"
                                        >{{ selectedTemplate || "-" }}</span
                                    >
                                </div>

                                <!-- Name (Single only) -->
                                <div
                                    v-if="deliveryMode === 'single'"
                                    class="flex items-center justify-between py-2.5"
                                >
                                    <div
                                        class="flex items-center gap-2 text-xs text-gray-500"
                                    >
                                        <svg
                                            class="w-4 h-4 text-gray-400"
                                            fill="none"
                                            viewBox="0 0 24 24"
                                            stroke="currentColor"
                                        >
                                            <path
                                                stroke-linecap="round"
                                                stroke-linejoin="round"
                                                stroke-width="2"
                                                d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"
                                            />
                                        </svg>
                                        Name
                                    </div>
                                    <span
                                        class="text-xs font-semibold text-gray-800"
                                        >{{ recipientName || "-" }}</span
                                    >
                                </div>

                                <!-- Phone (Single only) -->
                                <div
                                    v-if="deliveryMode === 'single'"
                                    class="flex items-center justify-between py-2.5"
                                >
                                    <div
                                        class="flex items-center gap-2 text-xs text-gray-500"
                                    >
                                        <svg
                                            class="w-4 h-4 text-gray-400"
                                            fill="none"
                                            viewBox="0 0 24 24"
                                            stroke="currentColor"
                                        >
                                            <path
                                                stroke-linecap="round"
                                                stroke-linejoin="round"
                                                stroke-width="2"
                                                d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"
                                            />
                                        </svg>
                                        Phone number
                                    </div>
                                    <span
                                        class="text-xs font-semibold text-gray-800"
                                    >
                                        {{
                                            phoneNumber
                                                ? phonePrefix +
                                                  " " +
                                                  phoneNumber
                                                : "-"
                                        }}
                                    </span>
                                </div>

                                <!-- Estimated SMS (Bulk only) -->
                                <div
                                    v-if="deliveryMode === 'bulk'"
                                    class="flex items-center justify-between py-2.5"
                                >
                                    <div
                                        class="flex items-center gap-2 text-xs text-gray-500"
                                    >
                                        <svg
                                            class="w-4 h-4 text-gray-400"
                                            fill="none"
                                            viewBox="0 0 24 24"
                                            stroke="currentColor"
                                        >
                                            <path
                                                stroke-linecap="round"
                                                stroke-linejoin="round"
                                                stroke-width="2"
                                                d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z"
                                            />
                                        </svg>
                                        Estimated SMS
                                    </div>
                                    <span
                                        class="text-xs font-semibold text-gray-800"
                                        >0</span
                                    >
                                </div>

                                <!-- Status -->
                                <div
                                    class="flex items-center justify-between py-2.5"
                                >
                                    <div
                                        class="flex items-center gap-2 text-xs text-gray-500"
                                    >
                                        <svg
                                            class="w-4 h-4 text-gray-400"
                                            fill="none"
                                            viewBox="0 0 24 24"
                                            stroke="currentColor"
                                        >
                                            <path
                                                stroke-linecap="round"
                                                stroke-linejoin="round"
                                                stroke-width="2"
                                                d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"
                                            />
                                        </svg>
                                        Status
                                    </div>
                                    <span
                                        :class="[
                                            'text-xs font-semibold',
                                            status === 'Ready'
                                                ? 'text-green-500'
                                                : 'text-red-500',
                                        ]"
                                    >
                                        {{ status }}
                                    </span>
                                </div>
                            </div>
                        </div>

                        <!-- Message Preview -->
                        <div
                            class="bg-white rounded-2xl border border-gray-200 p-5"
                        >
                            <p class="text-xs font-semibold text-gray-700 mb-3">
                                Message Preview
                            </p>
                            <div class="bg-gray-50 rounded-xl p-3">
                                <div
                                    class="bg-white rounded-xl p-3 shadow-sm inline-block max-w-xs text-xs text-gray-700 leading-relaxed"
                                >
                                    <p>
                                        Hi
                                        {{
                                            deliveryMode === "single" &&
                                            recipientName
                                                ? recipientName
                                                : "John Doe"
                                        }},
                                    </p>
                                    <p class="mt-1">
                                        ini adalah pesan dari sistem blast.
                                        Terimakasih
                                    </p>
                                    <a
                                        href="#"
                                        class="text-blue-500 underline mt-1 block"
                                        >https://mystore.com/offer</a
                                    >
                                    <p
                                        class="text-right text-gray-400 text-xs mt-2"
                                    >
                                        10:30 ✓✓
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Send Blast Button -->
                <div class="flex justify-end mt-5">
                    <button
                        class="bg-black text-white px-7 py-3 rounded-xl font-semibold text-sm flex items-center gap-2 hover:bg-gray-800 transition-all shadow-md"
                    >
                        <svg
                            class="w-4 h-4"
                            fill="currentColor"
                            viewBox="0 0 24 24"
                        >
                            <path d="M2.01 21L23 12 2.01 3 2 10l15 2-15 2z" />
                        </svg>
                        Send Blast
                    </button>
                </div>
            </div>
        </template>
    </AuthenticatedLayout>
</template>
