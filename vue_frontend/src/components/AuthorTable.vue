<template>
  <div class="p-7 px-10 flex justify-between items-center">
    <h1 class="flex items-center gap-3 text-3xl font-bold">
      <i class="fa-solid fa-user-tie"></i> Author List :
    </h1>
    <div>
      <button
        @click="showform = !showform"
        class="bg-blue-300 p-2 px-7 rounded-sm font-semibold hover:text-white hover:bg-blue-600 hover:cursor-pointer"
      >
        Add Author
      </button>
    </div>

    <!-- Create Author Form -->
    <div
      v-if="showform"
      class="shadow-md border rounded-lg z-10 absolute bg-gray-50 top-20 left-100 w-99 h-120"
    >
      <form @submit.prevent="submitForm" class="p-7">
        <div
          @click="showform = false"
          class="text-2xl flex justify-end hover:text-gray-500 hover:cursor-pointer"
        >
          <i class="fa-regular fa-circle-xmark"></i>
        </div>
        <div class="flex justify-center items-end mb-5">
          <h1 class="font-bold text-2xl">Create Author Form</h1>
        </div>
        <div class="form-group mb-3">
          <label for="name">Name</label>
          <br />
          <input
            v-model="newAuthor.name"
            class="border p-1 px-3 py-2 w-full rounded-lg border-gray-400 mt-2"
            type="text"
            name="name"
            id="name"
            placeholder="enter your name..."
          />
        </div>
        <div class="form-group mb-3">
          <label for="DOB">DOB</label>
          <br />
          <input
            v-model="newAuthor.DOB"
            class="border p-1 px-3 py-2 w-full rounded-lg border-gray-400 mt-2"
            type="text"
            name="DOB"
            id="DOB"
            placeholder="enter your DOB..."
          />
        </div>
        <div class="form-group mb-3">
          <label for="nationality">Nationality</label>
          <br />
          <input
            v-model="newAuthor.nationality"
            class="border p-1 px-3 py-2 w-full rounded-lg border-gray-400 mt-2"
            type="text"
            name="nationality"
            id="nationality"
            placeholder="enter your nationality..."
          />
        </div>
        <div class="form-group mb-3">
          <label for="NumberOfWrittenBook">Number of Written Books</label>
          <br />
          <input
            v-model.number="newAuthor.NumberOfWrittenBook"
            class="border p-1 px-3 py-2 w-full rounded-lg border-gray-400 mt-2"
            type="number"
            name="NumberOfWrittenBook"
            id="NumberOfWrittenBook"
            placeholder="enter number of written books..."
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

    <!-- Edit Author Form -->
    <div
      v-if="showEditForm"
      class="shadow-md border rounded-lg z-10 absolute bg-gray-50 top-20 left-100 w-99 h-120"
    >
      <form @submit.prevent="submitEditForm" class="p-7">
        <div
          @click="closeEditForm"
          class="text-2xl flex justify-end hover:text-gray-500 hover:cursor-pointer"
        >
          <i class="fa-regular fa-circle-xmark"></i>
        </div>
        <div class="flex justify-center items-end mb-5">
          <h1 class="font-bold text-2xl">Edit Author Form</h1>
        </div>
        <div class="form-group mb-3">
          <label for="edit-name">Name</label>
          <br />
          <input
            v-model="editAuthorData.name"
            class="border p-1 px-3 py-2 w-full rounded-lg border-gray-400 mt-2"
            type="text"
            name="edit-name"
            id="edit-name"
            placeholder="enter your name..."
          />
        </div>
        <div class="form-group mb-3">
          <label for="edit-DOB">DOB</label>
          <br />
          <input
            v-model="editAuthorData.DOB"
            class="border p-1 px-3 py-2 w-full rounded-lg border-gray-400 mt-2"
            type="text"
            name="edit-DOB"
            id="edit-DOB"
            placeholder="enter your DOB..."
          />
        </div>
        <div class="form-group mb-3">
          <label for="edit-nationality">Nationality</label>
          <br />
          <input
            v-model="editAuthorData.nationality"
            class="border p-1 px-3 py-2 w-full rounded-lg border-gray-400 mt-2"
            type="text"
            name="edit-nationality"
            id="edit-nationality"
            placeholder="enter your nationality..."
          />
        </div>
        <div class="form-group mb-3">
          <label for="edit-NumberOfWrittenBook">Number of Written Books</label>
          <br />
          <input
            v-model.number="editAuthorData.NumberOfWrittenBook"
            class="border p-1 px-3 py-2 w-full rounded-lg border-gray-400 mt-2"
            type="number"
            name="edit-NumberOfWrittenBook"
            id="edit-NumberOfWrittenBook"
            placeholder="enter number of written books..."
          />
        </div>
        <div class="flex justify-end items-end">
          <button
            type="submit"
            class="bg-blue-300 p-2 px-7 rounded-sm font-semibold hover:text-white hover:bg-blue-600 hover:cursor-pointer mt-10"
          >
            Update
          </button>
        </div>
      </form>
    </div>
  </div>

  <!-- Authors Table -->
  <div class="overflow-x-auto px-10 mb-10">
    <table class="min-w-full border border-gray-300 divide-y divide-gray-200">
      <thead class="bg-blue-100 text-left">
        <tr>
          <th class="px-6 py-3 text-sm font-semibold text-gray-700">No.</th>
          <th class="px-6 py-3 text-sm font-semibold text-gray-700">Name</th>
          <th class="px-6 py-3 text-sm font-semibold text-gray-700">DOB</th>
          <th class="px-6 py-3 text-sm font-semibold text-gray-700">Nationality</th>
          <th class="px-6 py-3 text-sm font-semibold text-gray-700">Number of Written Books</th>
          <th class="px-6 py-3 text-sm font-semibold text-gray-700">Actions</th>
        </tr>
      </thead>
      <tbody class="bg-white divide-y divide-gray-200">
        <tr
          v-for="(author, index) in authors"
          :key="author.id"
          class="hover:bg-gray-100"
        >
          <td class="px-6 py-4 text-sm text-gray-700">{{ index + 1 }}</td>
          <td class="px-6 py-4 text-sm text-gray-700">{{ author.name }}</td>
          <td class="px-6 py-4 text-sm text-gray-700">{{ author.DOB }}</td>
          <td class="px-6 py-4 text-sm text-gray-700">{{ author.nationality }}</td>
          <td class="px-6 py-4 text-sm text-gray-700">{{ author.NumberOfWrittenBook }}</td>
          <td class="px-6 py-4 text-sm text-gray-700 space-x-2">
            <button
              class="text-blue-600 hover:underline cursor-pointer"
              @click="showAuthor(author)"
            >
              Show
            </button>
            <button
              class="text-yellow-600 hover:underline cursor-pointer"
              @click="editAuthor(author)"
            >
              Edit
            </button>
            <button
              class="text-red-600 hover:underline cursor-pointer"
              @click="deleteAuthor(author.id)"
            >
              Delete
            </button>
          </td>
        </tr>
      </tbody>
    </table>
  </div>

  <!-- Show Author Card -->
  <div
    v-if="selectedAuthor"
    class="bg-white p-6 rounded-lg shadow-lg w-full h-70 max-w-md absolute top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 z-50"
  >
    <div
      class="absolute top-2 right-3 text-xl cursor-pointer hover:text-gray-600"
      @click="closeAuthorCard"
    >
      <i class="fa-regular fa-circle-xmark"></i>
    </div>
    <h2 class="text-2xl font-bold mb-4 text-blue-600">📘 Author Details</h2>
    <p><strong>Name:</strong> {{ selectedAuthor.name }}</p>
    <p><strong>DOB:</strong> {{ selectedAuthor.DOB }}</p>
    <p><strong>Nationality:</strong> {{ selectedAuthor.nationality }}</p>
    <p><strong>Number of Written Books:</strong> {{ selectedAuthor.NumberOfWrittenBook }}</p>
  </div>
</template>

<script setup>
import { ref, onMounted } from 'vue'
import axios from 'axios'

const apiUrl = 'http://192.168.108.91:8000/api/authors/'

const authors = ref([])

// Fetch authors on component mount
onMounted(async () => {
  try {
    const response = await axios.get(apiUrl)
    authors.value = response.data.data
  } catch (error) {
    console.error('Error fetching authors:', error)
    alert('Failed to load authors')
  }
})

// Create form state
const showform = ref(false)
const newAuthor = ref({
  name: '',
  DOB: '',
  nationality: '',
  NumberOfWrittenBook: null
})

const submitForm = async () => {
  if (
    newAuthor.value.name &&
    newAuthor.value.DOB &&
    newAuthor.value.nationality &&
    newAuthor.value.NumberOfWrittenBook
  ) {
    try {
      const response = await axios.post(apiUrl, newAuthor.value)
      authors.value.push(response.data)
      newAuthor.value = { name: '', DOB: '', nationality: '', NumberOfWrittenBook: null }
      showform.value = false
    } catch (error) {
      console.error('Error creating author:', error)
      alert('Failed to create author')
    }
  } else {
    alert('Please fill in all fields')
  }
}

// Edit form state
const showEditForm = ref(false)
const editAuthorData = ref({})

const editAuthor = (author) => {
  editAuthorData.value = { ...author } // Clone author data
  showEditForm.value = true
}

const submitEditForm = async () => {
  if (
    editAuthorData.value.name &&
    editAuthorData.value.DOB &&
    editAuthorData.value.nationality &&
    editAuthorData.value.NumberOfWrittenBook
  ) {
    try {
      const response = await axios.put(`${apiUrl}${editAuthorData.value.id}/`, editAuthorData.value)
      const index = authors.value.findIndex(
        (author) => author.id === editAuthorData.value.id
      )
      if (index !== -1) {
        authors.value[index] = response.data
        closeEditForm()
      }
    } catch (error) {
      console.error('Error updating author:', error)
      alert('Failed to update author')
    }
  } else {
    alert('Please fill in all fields')
  }
}

const closeEditForm = () => {
  showEditForm.value = false
  editAuthorData.value = {}
}

const deleteAuthor = async (id) => {
  try {
    await axios.delete(`${apiUrl}${id}/`)
    authors.value = authors.value.filter((author) => author.id !== id)
  } catch (error) {
    console.error('Error deleting author:', error)
    alert('Failed to delete author')
  }
}

// Show author card
const selectedAuthor = ref(null)
const showAuthor = (author) => {
  selectedAuthor.value = author
}
const closeAuthorCard = () => {
  selectedAuthor.value = null
}
</script>

<style scoped>
/* Ensure input width is consistent */
.w-99 {
  width: 24rem; /* Adjusted to match form width */
}
</style>