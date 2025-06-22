<template>
  <div class="p-7 px-10 flex justify-between items-center">
    <h1 class="flex items-center gap-3 text-3xl font-bold">
      <i class="fa-solid fa-user-tie"></i> Member List :
    </h1>

    <div>
      <button
        @click="showform = !showform"
        class="bg-blue-300 p-2 px-7 rounded-sm font-semibold hover:text-white hover:bg-blue-600 hover:cursor-pointer"
      >
        Add Member
      </button>
    </div>

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

        <div class="form-group mb-3 w-full">
          <label for="fullName">Full Name</label><br />
          <input
            v-model="newMember.fullName"
            type="text"
            id="fullName"
            class="border p-1 px-3 py-2 w-full rounded-lg border-gray-400 mt-2"
            placeholder="Enter full name..."
          />
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
          <label for="adress">Address</label><br />
          <input
            v-model="newMember.adress"
            type="text"
            id="adress"
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
          <th class="px-6 py-3 text-sm font-semibold text-gray-700">Full Name</th>
          <th class="px-6 py-3 text-sm font-semibold text-gray-700">Email</th>
          <th class="px-6 py-3 text-sm font-semibold text-gray-700">Phone Number</th>
          <th class="px-6 py-3 text-sm font-semibold text-gray-700">Address</th>
          <th class="px-6 py-3 text-sm font-semibold text-gray-700">Actions</th>
        </tr>
      </thead>
      <tbody class="bg-white divide-y divide-gray-200">
        <tr v-for="(member, index) in members" :key="member.id" class="hover:bg-gray-100">
          <td class="px-6 py-4 text-sm text-gray-700">{{ index + 1 }}</td>
          <td class="px-6 py-4 text-sm text-gray-700">{{ member.fullName }}</td>
          <td class="px-6 py-4 text-sm text-gray-700">{{ member.email }}</td>
          <td class="px-6 py-4 text-sm text-gray-700">{{ member.phoneNumber }}</td>
          <td class="px-6 py-4 text-sm text-gray-700">{{ member.adress }}</td>
          <td class="px-6 py-4 text-sm text-gray-700 space-x-2">
            <button class="text-blue-600 hover:underline cursor-pointer" @click="showAuthor(member)">Show</button>
            <button class="text-yellow-600 hover:underline cursor-pointer" @click="editAuthor(member)">Edit</button>
            <button class="text-red-600 hover:underline cursor-pointer" @click="deleteAuthor(member.id)">Delete</button>
          </td>
        </tr>
      </tbody>
    </table>
  </div>

  <!-- View/Edit Card -->
  <div v-if="selectedMember" class="fixed inset-0 flex items-center justify-center z-50">
    <div class="bg-white p-8 rounded-lg w-[500px] shadow-xl relative">
      <button @click="closeCard" class="absolute top-3 right-3 text-2xl text-gray-600 hover:text-red-500">
        <i class="fa-regular fa-circle-xmark"></i>
      </button>

      <h2 class="text-2xl font-bold mb-5 text-center">
        {{ isEditing ? 'Edit Member' : 'Member Details' }}
      </h2>

      <div class="space-y-4">
        <template v-if="!isEditing">
          <p><strong>Full Name:</strong> {{ selectedMember.fullName }}</p>
          <p><strong>Email:</strong> {{ selectedMember.email }}</p>
          <p><strong>Phone Number:</strong> {{ selectedMember.phoneNumber }}</p>
          <p><strong>Address:</strong> {{ selectedMember.adress }}</p>
        </template>

        <template v-else>
          <div><label class="font-semibold">Full Name</label><input v-model="selectedMember.fullName" class="w-full border p-2 rounded" /></div>
          <div><label class="font-semibold">Email</label><input v-model="selectedMember.email" class="w-full border p-2 rounded" /></div>
          <div><label class="font-semibold">Phone Number</label><input v-model="selectedMember.phoneNumber" class="w-full border p-2 rounded" /></div>
          <div><label class="font-semibold">Address</label><input v-model="selectedMember.adress" class="w-full border p-2 rounded" /></div>
        </template>
      </div>

      <div class="flex justify-end gap-3 mt-6">
        <button @click="closeCard" class="bg-gray-300 px-4 py-2 rounded hover:bg-gray-400">Close</button>
        <button v-if="isEditing" @click="updateMember" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">Update</button>
      </div>
    </div>
  </div>
</template>

<script setup>
import { ref, onMounted } from "vue";
import axios from "axios";

const showform = ref(false);
const members = ref([]);

const newMember = ref({
  fullName: "",
  email: "",
  phoneNumber: "",
  adress: "",
});

const selectedMember = ref(null);
const isEditing = ref(false);

const fetchMembers = async () => {
  try {
    const response = await axios.get("http://192.168.108.91:8000/api/members/");
    members.value = response.data.data;
  } catch (error) {
    console.error("❌ Failed to fetch members:", error);
  }
};

onMounted(() => {
  fetchMembers();
});

const submitForm = async () => {
  try {
    const response = await axios.post("http://192.168.108.91:8000/api/members/", newMember.value);
    members.value.push(response.data.data);
    newMember.value = { fullName: "", email: "", phoneNumber: "", adress: "" };
    showform.value = false;
  } catch (error) {
    alert("❌ Failed to add member.");
    console.error(error);
  }
};

const showAuthor = (member) => {
  selectedMember.value = { ...member };
  isEditing.value = false;
};

const editAuthor = (member) => {
  selectedMember.value = { ...member };
  isEditing.value = true;
};

const closeCard = () => {
  selectedMember.value = null;
  isEditing.value = false;
};

const updateMember = async () => {
  try {
    await axios.put(`http://192.168.108.91:8000/api/members/edit/${selectedMember.value.id}`, selectedMember.value);
    const index = members.value.findIndex(m => m.id === selectedMember.value.id);
    if (index !== -1) members.value[index] = { ...selectedMember.value };
    closeCard();
  } catch (error) {
    console.error("❌ Failed to update member:", error);
  }
};

const deleteAuthor = async (id) => {
  if (!confirm("Are you sure you want to delete this member?")) return;
  try {
    await axios.delete(`http://192.168.108.91:8000/api/members/delete/${id}`);
    members.value = members.value.filter(m => m.id !== id);
  } catch (error) {
    console.error("❌ Failed to delete member:", error);
  }
};
</script>

<style scoped></style>
