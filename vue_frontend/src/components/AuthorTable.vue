<template>
  <div class="p-4 sm:p-6 md:p-7 md:px-10 flex flex-col sm:flex-row justify-between items-center gap-4">
    <h1 class="flex items-center gap-3 text-xl sm:text-2xl md:text-3xl font-bold mb-4 sm:mb-0">
      <i class="fa-solid fa-user-tie"></i> Author List
    </h1>

    <!-- btn show form -->
    <div>
      <button @click="showform = !showform"
        class="bg-blue-300 p-2 px-4 sm:px-6 md:px-7 rounded-sm font-semibold hover:text-white hover:bg-blue-600 hover:cursor-pointer">
        Add Author
      </button>
    </div>

    <!-- Create Author Form -->
    <div v-if="showform" class="shadow-md border rounded-lg z-10 fixed bg-gray-50 top-4 left-4 right-4 sm:top-10 sm:left-10 sm:right-10 md:top-20 md:left-1/4 md:w-[500px] mx-auto">
      <form @submit.prevent="submitForm" class="p-4 sm:p-5 md:p-7">
        <div @click="showform = false" class="text-lg sm:text-xl md:text-2xl flex justify-end hover:text-gray-500 hover:cursor-pointer">
          <i class="fa-regular fa-circle-xmark"></i>
        </div>
        <div class="flex justify-center items-end mb-4 sm:mb-5">
          <h1 class="font-bold text-lg sm:text-xl md:text-2xl">Create Author Form</h1>
        </div>
        <div class="form-group mb-3">
          <label for="name">Name</label>
          <input v-model="newAuthor.name" class="border p-1 px-3 py-2 w-full rounded-lg border-gray-400 mt-2"
            type="text" name="name" id="name" placeholder="Enter your name..." />
        </div>
        <div class="form-group mb-3">
          <label for="DOB">DOB</label>
          <input v-model="newAuthor.DOB" class="border p-1 px-3 py-2 w-full rounded-lg border-gray-400 mt-2"
            type="text" name="DOB" id="DOB" placeholder="Enter your DOB..." />
        </div>
        <div class="form-group mb-3">
          <label for="nationality">Nationality</label>
          <input v-model="newAuthor.nationality" class="border p-1 px-3 py-2 w-full rounded-lg border-gray-400 mt-2"
            type="text" name="nationality" id="nationality" placeholder="Enter your nationality..." />
        </div>
        <div class="form-group mb-3">
          <label for="NumberOfWrittenBook">Number of Written Books</label>
          <input v-model.number="newAuthor.NumberOfWrittenBook"
            class="border p-1 px-3 py-2 w-full rounded-lg border-gray-400 mt-2" type="number" name="NumberOfWrittenBook"
            id="NumberOfWrittenBook" placeholder="Enter number of written books..." />
        </div>
        <div class="flex justify-end items-end">
          <button type="submit"
            class="bg-blue-300 p-2 px-4 sm:px-6 md:px-7 rounded-sm font-semibold hover:text-white hover:bg-blue-600 hover:cursor-pointer mt-4 sm:mt-5">
            Submit
          </button>
        </div>
      </form>
    </div>

    <!-- Edit Author Form -->
    <div v-if="showEditForm" class="shadow-md border rounded-lg z-10 fixed bg-gray-50 top-4 left-4 right-4 sm:top-10 sm:left-10 sm:right-10 md:top-20 md:left-1/4 md:w-[500px] mx-auto">
      <form @submit.prevent="submitEditForm" class="p-4 sm:p-5 md:p-7">
        <div @click="closeEditForm" class="text-lg sm:text-xl md:text-2xl flex justify-end hover:text-gray-500 hover:cursor-pointer">
          <i class="fa-regular fa-circle-xmark"></i>
        </div>
        <div class="flex justify-center items-end mb-4 sm:mb-5">
          <h1 class="font-bold text-lg sm:text-xl md:text-2xl">Edit Author Form</h1>
        </div>
        <div class="form-group mb-3">
          <label for="edit-name">Name</label>
          <input v-model="editAuthorData.name" class="border p-1 px-3 py-2 w-full rounded-lg border-gray-400 mt-2"
            type="text" name="edit-name" id="edit-name" placeholder="Enter your name..." />
        </div>
        <div class="form-group mb-3">
          <label for="edit-DOB">DOB</label>
          <input v-model="editAuthorData.DOB" class="border p-1 px-3 py-2 w-full rounded-lg border-gray-400 mt-2"
            type="text" name="edit-DOB" id="edit-DOB" placeholder="Enter your DOB..." />
        </div>
        <div class="form-group mb-3">
          <label for="edit-nationality">Nationality</label>
          <input v-model="editAuthorData.nationality" class="border p-1 px-3 py-2 w-full rounded-lg border-gray-400 mt-2"
            type="text" name="edit-nationality" id="edit-nationality" placeholder="Enter your nationality..." />
        </div>
        <div class="form-group mb-3">
          <label for="edit-NumberOfWrittenBook">Number of Written Books</label>
          <input v-model.number="editAuthorData.NumberOfWrittenBook"
            class="border p-1 px-3 py-2 w-full rounded-lg border-gray-400 mt-2" type="number"
            name="edit-NumberOfWrittenBook" id="edit-NumberOfWrittenBook"
            placeholder="Enter number of written books..." />
        </div>
        <div class="flex justify-end items-end">
          <button type="submit"
            class="bg-blue-300 p-2 px-4 sm:px-6 md:px-7 rounded-sm font-semibold hover:text-white hover:bg-blue-600 hover:cursor-pointer mt-4 sm:mt-5 md:mt-10">
            Update
          </button>
        </div>
      </form>
    </div>
  </div>

  <!-- Authors List -->
  <div class="px-4 sm:px-6 md:px-10 mb-10">
    <!-- Mobile Card Layout -->
    <div class="sm:hidden flex flex-col gap-4">
      <div v-for="(author, index) in authors" :key="author.id"
        class="border border-gray-300 rounded-lg shadow-md p-4 bg-white hover:bg-gray-100">
        <div class="flex justify-between items-center">
          <div>
            <p class="text-xs font-semibold text-gray-700">No: {{ index + 1 }}</p>
            <p class="text-sm font-bold text-gray-800">{{ author.name }}</p>
            <p class="text-xs text-gray-700">Nationality: {{ author.nationality }}</p>
            <p class="text-xs text-gray-700">Books: {{ author.NumberOfWrittenBook }}</p>
          </div>
          <div class="relative">
            <button @click="toggleActions(index)"
              class="text-gray-600 hover:text-gray-900 cursor-pointer">
              <i class="fa-solid fa-ellipsis-vertical text-sm"></i>
            </button>
            <div v-if="activeMenu === index"
              class="absolute right-0 mt-2 w-32 bg-white border border-gray-300 rounded-lg shadow-lg z-10">
              <button class="block w-full text-left px-4 py-2 text-xs text-blue-600 hover:bg-gray-100"
                @click="showAuthor(author)">
                <i class="fa-solid fa-eye mr-2"></i> View
              </button>
              <button class="block w-full text-left px-4 py-2 text-xs text-yellow-600 hover:bg-gray-100"
                @click="editAuthor(author)">
                <i class="fa-solid fa-pen-to-square mr-2"></i> Edit
              </button>
              <button class="block w-full text-left px-4 py-2 text-xs text-red-600 hover:bg-gray-100"
                @click="deleteAuthor(author.id)">
                <i class="fa-solid fa-trash mr-2"></i> Delete
              </button>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- Table Layout for Tablet and Larger -->
    <div class="hidden sm:block overflow-x-auto">
      <table class="min-w-full border border-gray-300 divide-y divide-gray-200">
        <thead class="bg-blue-100 text-left">
          <tr>
            <th class="px-2 sm:px-3 md:px-6 py-2 text-xs sm:text-sm font-semibold text-gray-700">No.</th>
            <th class="px-2 sm:px-3 md:px-6 py-2 text-xs sm:text-sm font-semibold text-gray-700">Name</th>
            <th class="px-2 sm:px-3 md:px-6 py-2 text-xs sm:text-sm font-semibold text-gray-700">DOB</th>
            <th class="px-2 sm:px-3 md:px-6 py-2 text-xs sm:text-sm font-semibold text-gray-700">Nationality</th>
            <th class="px-2 sm:px-3 md:px-6 py-2 text-xs sm:text-sm font-semibold text-gray-700">Books</th>
            <th class="px-2 sm:px-3 md:px-6 py-2 text-xs sm:text-sm font-semibold text-gray-700">Actions</th>
          </tr>
        </thead>
        <tbody class="bg-white divide-y divide-gray-200">
          <tr v-for="(author, index) in authors" :key="author.id" class="hover:bg-gray-100">
            <td class="px-2 sm:px-3 md:px-6 py-2 text-xs sm:text-sm text-gray-700">{{ index + 1 }}</td>
            <td class="px-2 sm:px-3 md:px-6 py-2 text-xs sm:text-sm text-gray-700">{{ author.name }}</td>
            <td class="px-2 sm:px-3 md:px-6 py-2 text-xs sm:text-sm text-gray-700">{{ author.DOB }}</td>
            <td class="px-2 sm:px-3 md:px-6 py-2 text-xs sm:text-sm text-gray-700">{{ author.nationality }}</td>
            <td class="px-2 sm:px-3 md:px-6 py-2 text-xs sm:text-sm text-gray-700">{{ author.NumberOfWrittenBook }}</td>
            <td class="px-2 sm:px-3 md:px-6 py-2 text-xs sm:text-sm text-gray-700 space-x-2">
              <button class="text-blue-600 hover:underline cursor-pointer" @click="showAuthor(author)">
                <i class="fa-solid fa-eye"></i>
              </button>
              <button class="text-yellow-600 hover:underline cursor-pointer" @click="editAuthor(author)">
                <i class="fa-solid fa-pen-to-square"></i>
              </button>
              <button class="text-red-600 hover:underline cursor-pointer" @click="deleteAuthor(author.id)">
                <i class="fa-solid fa-trash"></i>
              </button>
            </td>
          </tr>
        </tbody>
      </table>
    </div>
  </div>

  <!-- Show Author Card detail -->
  <div v-if="selectedAuthor" class="fixed inset-0 bg-opacity-30 flex items-center justify-center z-50">
    <div class="relative bg-white p-4 sm:p-5 md:p-6 rounded-lg shadow-lg max-w-sm sm:max-w-md w-full mx-4">
      <button @click="closeAuthorCard" aria-label="Close author details"
        class="absolute top-3 right-3 text-gray-600 hover:text-gray-900 focus:outline-none">
        <i class="fa-regular fa-circle-xmark text-lg sm:text-xl md:text-2xl"></i>
      </button>
      <h2 class="text-lg sm:text-xl md:text-2xl font-bold mb-4 text-blue-600 flex items-center gap-2">
        <i class="fa-solid fa-book-open"></i> Author Details
      </h2>
      <p class="mb-2 text-xs sm:text-sm md:text-base"><strong>Name:</strong> {{ selectedAuthor.name }}</p>
      <p class="mb-2 text-xs sm:text-sm md:text-base"><strong>DOB:</strong> {{ selectedAuthor.DOB }}</p>
      <p class="mb-2 text-xs sm:text-sm md:text-base"><strong>Nationality:</strong> {{ selectedAuthor.nationality }}</p>
      <p class="mb-2 text-xs sm:text-sm md:text-base"><strong>Books Written:</strong> {{ selectedAuthor.NumberOfWrittenBook }}</p>
    </div>
  </div>
</template>

<script setup>
import { ref, onMounted } from 'vue'
import axios from 'axios'

const authors = ref([])
const showform = ref(false)
const showEditForm = ref(false)
const selectedAuthor = ref(null)
const activeMenu = ref(null)

const API_BASE = 'http://192.168.108.62:8000/api/authors'

const newAuthor = ref({
  name: '',
  DOB: '',
  nationality: '',
  NumberOfWrittenBook: null,
})

const editAuthorData = ref({})

const fetchAuthors = async () => {
  try {
    const response = await axios.get(`${API_BASE}/`)
    authors.value = response.data.data || response.data
  } catch (error) {
    alert('❌ Failed to fetch authors')
    console.error(error)
  }
}
onMounted(fetchAuthors)

const getAuthorById = async (id) => {
  try {
    const res = await axios.get(`${API_BASE}/${id}`)
    selectedAuthor.value = res.data
  } catch (err) {
    alert('❌ Cannot fetch author by ID')
    console.error(err)
  }
}

const submitForm = async () => {
  try {
    const res = await axios.post(`${API_BASE}/`, newAuthor.value)
    authors.value.push(res.data)
    newAuthor.value = { name: '', DOB: '', nationality: '', NumberOfWrittenBook: null }
    showform.value = false
  } catch (error) {
    console.error('Failed to create author:', error)
    alert('❌ Failed to create author')
  }
}

const editAuthor = (author) => {
  editAuthorData.value = { ...author }
  showEditForm.value = true
  activeMenu.value = null
}

const submitEditForm = async () => {
  const id = editAuthorData.value.id
  try {
    const res = await axios.put(`${API_BASE}/${id}`, editAuthorData.value)
    const index = authors.value.findIndex(a => a.id === id)
    if (index !== -1) authors.value[index] = res.data
    closeEditForm()
  } catch (err) {
    alert('❌ Failed to update author')
    console.error(err)
  }
}

const closeEditForm = () => {
  showEditForm.value = false
  editAuthorData.value = {}
}

const deleteAuthor = async (id) => {
  if (!confirm('Are you sure you want to delete this author?')) return
  try {
    await axios.delete(`${API_BASE}/${id}`)
    authors.value = authors.value.filter((a) => a.id !== id)
    activeMenu.value = null
  } catch (err) {
    alert('❌ Failed to delete author')
    console.error(err)
  }
}

const showAuthor = (author) => {
  selectedAuthor.value = author
  activeMenu.value = null
}

const closeAuthorCard = () => {
  selectedAuthor.value = null
}

const toggleActions = (index) => {
  activeMenu.value = activeMenu.value === index ? null : index
}
</script>

<style scoped>
/* Ensure the table is scrollable on tablet and larger */
table {
  width: 100%;
  min-width: 500px; /* Ensures horizontal scrolling on tablet */
}

/* Adjust form and text sizes for mobile and tablet */
@media (max-width: 640px) {
  .fixed {
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    padding: 0.5rem;
    overflow-y: auto;
  }

  input, button {
    font-size: 0.875rem;
    padding: 0.5rem;
  }

  .text-lg {
    font-size: 1rem;
  }

  .text-xl {
    font-size: 1.125rem;
  }
}

@media (min-width: 640px) and (max-width: 1024px) {
  .fixed {
    top: 1rem;
    left: 1rem;
    right: 1rem;
    padding: 1rem;
    overflow-y: auto;
  }

  input, button {
    font-size: 0.95rem;
    padding: 0.75rem;
  }

  .text-lg {
    font-size: 1.1rem;
  }

  .text-xl {
    font-size: 1.25rem;
  }
}

/* Ensure buttons are touch-friendly */
button {
  min-width: 44px;
  min-height: 44px;
}

/* Dropdown menu positioning */
.absolute.right-0 {
  right: 0.5rem;
}

/* Remove unnecessary width class */
.w-99 {
  width: auto;
}
</style>