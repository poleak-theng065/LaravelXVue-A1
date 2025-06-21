<template>
  <div class="p-7 px-10 flex justify-between items-center">
    <h1 class="flex items-center gap-3 text-3xl font-bold">
      <i class="fa-solid fa-user-tie"></i> Member List :
    </h1>

    <!-- Button to show form -->
    <div>
      <button
        @click="showform = !showform"
        class="bg-blue-300 p-2 px-7 rounded-sm font-semibold hover:text-white hover:bg-blue-600 hover:cursor-pointer"
      >
        Add Member
      </button>
    </div>

    <!-- Create Member Form -->
    <div
      v-if="showform"
      class="shadow-md border rounded-lg z-10 absolute bg-gray-50 top-20 left-100 w-[550px] h-auto"
    >
      <form @submit.prevent="submitForm" class="p-7 w-full">
        <div
          @click="showform = false"
          class="text-2xl flex justify-end hover:text-gray-500 hover:cursor-pointer"
        >
          <i class="fa-regular fa-circle-xmark"></i>
        </div>

        <div class="flex justify-center items-end mb-5">
          <h1 class="font-bold text-2xl">Create Member Form</h1>
        </div>

        <div class="flex gap-3">
          <div class="form-group mb-3 w-full">
            <label for="firstName">First Name</label><br />
            <input
              v-model="newMember.firstName"
              type="text"
              id="firstName"
              class="border p-1 px-3 py-2 w-full rounded-lg border-gray-400 mt-2"
              placeholder="Enter first name..."
            />
          </div>

          <div class="form-group mb-3 w-full">
            <label for="lastName">Last Name</label><br />
            <input
              v-model="newMember.lastName"
              type="text"
              id="lastName"
              class="border p-1 px-3 py-2 w-full rounded-lg border-gray-400 mt-2"
              placeholder="Enter last name..."
            />
          </div>
        </div>

        <div class="form-group mb-3 w-full">
          <label for="email">Email</label><br />
          <input
            v-model="newMember.email"
            type="email"
            id="email"
            class="border p-1 px-3 py-2 w-full rounded-lg border-gray-400 mt-2"
            placeholder="Enter email address..."
          />
        </div>

        <div class="form-group mb-3 w-full">
          <label for="phoneNumber">Phone Number</label><br />
          <input
            v-model="newMember.phoneNumber"
            type="text"
            id="phoneNumber"
            class="border p-1 px-3 py-2 w-full rounded-lg border-gray-400 mt-2"
            placeholder="Enter phone number..."
          />
        </div>

        <div class="form-group mb-3 w-full">
          <label for="address">Address</label><br />
          <input
            v-model="newMember.address"
            type="text"
            id="address"
            class="border p-1 px-3 py-2 w-full rounded-lg border-gray-400 mt-2"
            placeholder="Enter address..."
          />
        </div>

        <div class="flex justify-end items-end">
          <button
            type="submit"
            class="bg-blue-300 p-2 px-7 rounded-sm font-semibold hover:text-white hover:bg-blue-600 hover:cursor-pointer mt-10"
          >
            Submit
          </button>
        </div>
      </form>
    </div>
  </div>

  <!-- Members Table -->
  <div class="overflow-x-auto px-10 mb-10">
    <table class="min-w-full border border-gray-300 divide-y divide-gray-200">
      <thead class="bg-blue-100 text-left">
        <tr>
          <th class="px-6 py-3 text-sm font-semibold text-gray-700">No.</th>
          <th class="px-6 py-3 text-sm font-semibold text-gray-700">First Name</th>
          <th class="px-6 py-3 text-sm font-semibold text-gray-700">Last Name</th>
          <th class="px-6 py-3 text-sm font-semibold text-gray-700">Email</th>
          <th class="px-6 py-3 text-sm font-semibold text-gray-700">Phone Number</th>
          <th class="px-6 py-3 text-sm font-semibold text-gray-700">Address</th>
          <th class="px-6 py-3 text-sm font-semibold text-gray-700">Actions</th>
        </tr>
      </thead>
      <tbody class="bg-white divide-y divide-gray-200">
        <tr
          v-for="(member, index) in members"
          :key="member.id"
          class="hover:bg-gray-100"
        >
          <td class="px-6 py-4 text-sm text-gray-700">{{ index + 1 }}</td>
          <td class="px-6 py-4 text-sm text-gray-700">{{ member.firstName }}</td>
          <td class="px-6 py-4 text-sm text-gray-700">{{ member.lastName }}</td>
          <td class="px-6 py-4 text-sm text-gray-700">{{ member.email }}</td>
          <td class="px-6 py-4 text-sm text-gray-700">{{ member.phoneNumber }}</td>
          <td class="px-6 py-4 text-sm text-gray-700">{{ member.address }}</td>
          <td class="px-6 py-4 text-sm text-gray-700 space-x-2">
            <button
              class="text-blue-600 hover:underline cursor-pointer"
              @click="showAuthor(member)"
            >
              Show
            </button>
            <button
              class="text-yellow-600 hover:underline cursor-pointer"
              @click="editAuthor(member)"
            >
              Edit
            </button>
            <button
              class="text-red-600 hover:underline cursor-pointer"
              @click="deleteAuthor(member.id)"
            >
              Delete
            </button>
          </td>
        </tr>
      </tbody>
    </table>
  </div>

  <!-- Member View/Edit Card Modal -->
  <div
    v-if="selectedMember"
    class="fixed inset-0 flex items-center justify-center z-50"
  >
    <div class="bg-white p-8 rounded-lg w-[500px] shadow-xl relative">
      <button
        @click="closeCard"
        class="absolute top-3 right-3 text-2xl text-gray-600 hover:text-red-500"
      >
        <i class="fa-regular fa-circle-xmark"></i>
      </button>

      <h2 class="text-2xl font-bold mb-5 text-center">
        {{ isEditing ? 'Edit Member' : 'Member Details' }}
      </h2>

      <div class="space-y-4">
        <!-- Show details as plain text -->
        <template v-if="!isEditing">
          <p><strong>First Name:</strong> {{ selectedMember.firstName }}</p>
          <p><strong>Last Name:</strong> {{ selectedMember.lastName }}</p>
          <p><strong>Email:</strong> {{ selectedMember.email }}</p>
          <p><strong>Phone Number:</strong> {{ selectedMember.phoneNumber }}</p>
          <p><strong>Address:</strong> {{ selectedMember.address }}</p>
        </template>

        <!-- Edit details as inputs -->
        <template v-else>
          <div>
            <label class="font-semibold">First Name</label>
            <input
              v-model="selectedMember.firstName"
              class="w-full border p-2 rounded"
            />
          </div>
          <div>
            <label class="font-semibold">Last Name</label>
            <input
              v-model="selectedMember.lastName"
              class="w-full border p-2 rounded"
            />
          </div>
          <div>
            <label class="font-semibold">Email</label>
            <input
              v-model="selectedMember.email"
              class="w-full border p-2 rounded"
            />
          </div>
          <div>
            <label class="font-semibold">Phone Number</label>
            <input
              v-model="selectedMember.phoneNumber"
              class="w-full border p-2 rounded"
            />
          </div>
          <div>
            <label class="font-semibold">Address</label>
            <input
              v-model="selectedMember.address"
              class="w-full border p-2 rounded"
            />
          </div>
        </template>
      </div>

      <div class="flex justify-end gap-3 mt-6">
        <button
          @click="closeCard"
          class="bg-gray-300 px-4 py-2 rounded hover:bg-gray-400"
        >
          Close
        </button>
        <button
          v-if="isEditing"
          @click="updateMember"
          class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600"
        >
          Update
        </button>
      </div>
    </div>
  </div>
</template>

<script setup>
import { ref } from "vue"

const showform = ref(false)

const members = ref([
  {
    id: 1,
    firstName: "Sopheap",
    lastName: "Chum",
    email: "sopheap.chum@gmail.com",
    phoneNumber: "+855 12 345 678",
    address: "123 Preah Monivong Blvd, Phnom Penh, Cambodia",
  },
  {
    id: 2,
    firstName: "Piseth",
    lastName: "Seng",
    email: "piseth.seng@gmail.com",
    phoneNumber: "+855 10 987 654",
    address: "456 Russian Blvd, Phnom Penh, Cambodia",
  },
  {
    id: 3,
    firstName: "Vicheth",
    lastName: "Thon",
    email: "vicheth.thon@gmail.com",
    phoneNumber: "+855 23 456 789",
    address: "789 Street 214, Phnom Penh, Cambodia",
  },
  {
    id: 4,
    firstName: "Sreyleak",
    lastName: "Meng",
    email: "sreyleak.meng@gmail.com",
    phoneNumber: "+855 92 123 456",
    address: "321 Monivong Blvd, Phnom Penh, Cambodia",
  },
]);


const newMember = ref({
  firstName: "",
  lastName: "",
  email: "",
  phoneNumber: "",
  address: "",
})

const selectedMember = ref(null)
const isEditing = ref(false)

function submitForm() {
  if (
    newMember.value.firstName &&
    newMember.value.lastName &&
    newMember.value.email &&
    newMember.value.phoneNumber &&
    newMember.value.address
  ) {
    const memberToAdd = {
      id: Date.now(),
      ...newMember.value,
    }

    members.value.push(memberToAdd)

    // Reset form
    newMember.value = {
      firstName: "",
      lastName: "",
      email: "",
      phoneNumber: "",
      address: "",
    }

    showform.value = false
  } else {
    alert("⚠️ Please fill in all fields.")
  }
}

function showAuthor(member) {
  selectedMember.value = { ...member }
  isEditing.value = false
}

function editAuthor(member) {
  selectedMember.value = { ...member }
  isEditing.value = true
}

function closeCard() {
  selectedMember.value = null
  isEditing.value = false
}

function updateMember() {
  const index = members.value.findIndex(
    (m) => m.id === selectedMember.value.id
  )
  if (index !== -1) {
    members.value[index] = { ...selectedMember.value }
    closeCard()
  }
}

function deleteAuthor(id) {
  members.value = members.value.filter((m) => m.id !== id)
}
</script>

<style scoped></style>
