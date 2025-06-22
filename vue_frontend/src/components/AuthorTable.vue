<template>
  <div class="p-7 px-10 flex justify-between items-center">
    <h1 class="flex items-center gap-3 text-3xl font-bold">
      <i class="fa-solid fa-user-tie"></i> Author List :
    </h1>
    <button
      @click="showForm = true"
      class="bg-blue-300 p-2 px-7 rounded-sm font-semibold hover:text-white hover:bg-blue-600 hover:cursor-pointer"
    >
      Add Author
    </button>
  </div>

  <!-- Create Author Form -->
  <div v-if="showForm" class="absolute top-24 left-1/2 -translate-x-1/2 bg-gray-50 w-[500px] shadow-md border rounded-lg z-10">
    <form @submit.prevent="submitForm" class="p-7">
      <div class="flex justify-end text-2xl cursor-pointer hover:text-gray-500" @click="showForm = false">
        <i class="fa-regular fa-circle-xmark"></i>
      </div>
      <h1 class="text-center font-bold text-2xl mb-5">Create Author</h1>

      <div class="mb-3">
        <label>Name</label>
        <input v-model="newAuthor.name" type="text" class="form-input" placeholder="Enter name..." />
      </div>
      <div class="mb-3">
        <label>DOB</label>
        <input v-model="newAuthor.DOB" type="text" class="form-input" placeholder="Enter DOB..." />
      </div>
      <div class="mb-3">
        <label>Nationality</label>
        <input v-model="newAuthor.nationality" type="text" class="form-input" placeholder="Enter nationality..." />
      </div>
      <div class="mb-3">
        <label>Number of Written Books</label>
        <input v-model.number="newAuthor.NumberOfWrittenBook" type="number" class="form-input" placeholder="Enter number..." />
      </div>

      <div class="flex justify-end mt-6">
        <button type="submit" class="bg-blue-500 text-white px-5 py-2 rounded hover:bg-blue-700">Submit</button>
      </div>
    </form>
  </div>

  <!-- Edit Form -->
  <div v-if="showEditForm" class="absolute top-24 left-1/2 -translate-x-1/2 bg-gray-50 w-[500px] shadow-md border rounded-lg z-10">
    <form @submit.prevent="submitEditForm" class="p-7">
      <div class="flex justify-end text-2xl cursor-pointer hover:text-gray-500" @click="closeEditForm">
        <i class="fa-regular fa-circle-xmark"></i>
      </div>
      <h1 class="text-center font-bold text-2xl mb-5">Edit Author</h1>

      <div class="mb-3">
        <label>Name</label>
        <input v-model="editAuthorData.name" type="text" class="form-input" />
      </div>
      <div class="mb-3">
        <label>DOB</label>
        <input v-model="editAuthorData.DOB" type="text" class="form-input" />
      </div>
      <div class="mb-3">
        <label>Nationality</label>
        <input v-model="editAuthorData.nationality" type="text" class="form-input" />
      </div>
      <div class="mb-3">
        <label>Number of Written Books</label>
        <input v-model.number="editAuthorData.NumberOfWrittenBook" type="number" class="form-input" />
      </div>

      <div class="flex justify-end mt-6">
        <button type="submit" class="bg-yellow-500 text-white px-5 py-2 rounded hover:bg-yellow-700">Update</button>
      </div>
    </form>
  </div>

 <!-- Authors Table -->
<div class="overflow-x-auto px-10 mb-10">
  <table class="min-w-full border border-gray-300 divide-y divide-gray-200">
    <thead class="bg-blue-100 text-left text-gray-700 text-sm font-semibold">
      <tr>
        <th class="px-6 py-3 w-12">No.</th>
        <th class="px-6 py-3 w-40">Name</th>
        <th class="px-6 py-3 w-40">DOB</th>
        <th class="px-6 py-3 w-36">Nationality</th>
        <th class="px-6 py-3 w-36">Books</th>
        <th class="px-6 py-3 w-40 text-center">Actions</th>
      </tr>
    </thead>
    <tbody class="bg-white divide-y divide-gray-200 text-sm">
      <tr
        v-for="(author, index) in authors"
        :key="author.id"
        class="hover:bg-gray-50"
      >
        <td class="px-6 py-4">{{ index + 1 }}</td>
        <td class="px-6 py-4">{{ author.name }}</td>
        <td class="px-6 py-4">{{ author.DOB }}</td>
        <td class="px-6 py-4">{{ author.nationality }}</td>
        <td class="px-6 py-4">{{ author.NumberOfWrittenBook }}</td>
        <td class="px-6 py-4 space-x-3 text-center">
          <button class="text-blue-600 hover:underline" @click="showAuthor(author)">Show</button>
          <button class="text-yellow-600 hover:underline" @click="editAuthor(author)">Edit</button>
          <button class="text-red-600 hover:underline" @click="deleteAuthor(author.id)">Delete</button>
        </td>
      </tr>
    </tbody>
  </table>
</div>


  <!-- Author Details Modal -->
  <div
    v-if="selectedAuthor"
    class="bg-white p-6 rounded-lg shadow-lg w-full max-w-md fixed top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 z-50"
  >
    <div class="absolute top-2 right-3 text-xl cursor-pointer hover:text-gray-600" @click="selectedAuthor = null">
      <i class="fa-regular fa-circle-xmark"></i>
    </div>
    <h2 class="text-2xl font-bold mb-4 text-blue-600">📘 Author Details</h2>
    <p><strong>Name:</strong> {{ selectedAuthor.name }}</p>
    <p><strong>DOB:</strong> {{ selectedAuthor.DOB }}</p>
    <p><strong>Nationality:</strong> {{ selectedAuthor.nationality }}</p>
    <p><strong>Books:</strong> {{ selectedAuthor.NumberOfWrittenBook }}</p>
  </div>
</template>

<script setup>
import { ref, onMounted } from 'vue'
import axios from 'axios'

const authors = ref([])
const showForm = ref(false)
const showEditForm = ref(false)
const selectedAuthor = ref(null)

const newAuthor = ref({
  name: '',
  DOB: '',
  nationality: '',
  NumberOfWrittenBook: null,
})

const editAuthorData = ref({})

// ------------------------
// GET ALL AUTHORS
// ------------------------
const fetchAuthors = async () => {
  try {
    const response = await axios.get('http://192.168.108.91:8000/api/authors/')
    authors.value = response.data.data || response.data
  } catch (error) {
    alert('❌ Failed to fetch authors')
    console.error(error)
  }
}
onMounted(fetchAuthors)

// ------------------------
// GET AUTHOR BY ID (optional: for future use)
// ------------------------
const getAuthorById = async (id) => {
  try {
    const res = await axios.get(`http://192.168.108.91:8000/api/authors/${id}`)
    selectedAuthor.value = res.data
  } catch (err) {
    alert('❌ Cannot fetch author by ID')
  }
}

// ------------------------
// CREATE AUTHOR
// ------------------------
const submitForm = async () => {
  try {
    const res = await axios.post('http://192.168.108.91:8000/api/authors/', newAuthor.value)
    authors.value.push(res.data)
    newAuthor.value = { name: '', DOB: '', nationality: '', NumberOfWrittenBook: null }
    showForm.value = false
  } catch (err) {
    alert('❌ Failed to create author')
    console.error(err)
  }
}

// ------------------------
// UPDATE AUTHOR
// ------------------------
const editAuthor = (author) => {
  editAuthorData.value = { ...author }
  showEditForm.value = true
}

const submitEditForm = async () => {
  const id = editAuthorData.value.id
  try {
    const res = await axios.put(`http://192.168.108.91:8000/api/authors/edit/${id}`, editAuthorData.value)
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

// ------------------------
// DELETE AUTHOR
// ------------------------
const deleteAuthor = async (id) => {
  if (!confirm('Are you sure you want to delete this author?')) return
  try {
    await axios.delete(`http://192.168.108.91:8000/api/authors/delete/${id}`)
    authors.value = authors.value.filter((a) => a.id !== id)
  } catch (err) {
    alert('❌ Failed to delete author')
    console.error(err)
  }
}

// ------------------------
// SHOW AUTHOR DETAILS
// ------------------------
const showAuthor = (author) => {
  selectedAuthor.value = author
}
</script>


<style scoped>
.form-input {
  width: 100%;
  padding: 8px 12px;
  border-radius: 8px;
  border: 1px solid #ccc;
  margin-top: 6px;
}
</style>
