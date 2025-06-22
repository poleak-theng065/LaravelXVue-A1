<template>
  <div class="p-7 px-10 flex justify-between items-center">
    <h1 class="flex items-center gap-3 text-3xl font-bold">
      <i class="fa-solid fa-user-tie"></i> Author List :
    </h1>

    <!-- btn show form ------------>
    <div>
      <button @click="showform = !showform"
        class="bg-blue-300 p-2 px-7 rounded-sm font-semibold hover:text-white hover:bg-blue-600 hover:cursor-pointer">
        Add Author
      </button>
    </div>

    <!-- Create Author Form -->
    <div v-if="showform" class="shadow-md border rounded-lg z-10 absolute bg-gray-50 top-20 left-100 w-[500px] h-135 ">
      <form @submit.prevent="submitForm" class="p-7">
        <div @click="showform = false" class="text-2xl flex justify-end hover:text-gray-500 hover:cursor-pointer">
          <i class="fa-regular fa-circle-xmark"></i>
        </div>
        <div class="flex justify-center items-end mb-5">
          <h1 class="font-bold text-2xl">Create Author Form</h1>
        </div>
        <div class="form-group mb-3">
          <label for="name">Name</label>
          <br />
          <input v-model="newAuthor.name" class="border p-1 px-3 py-2 w-full rounded-lg border-gray-400 mt-2"
            type="text" name="name" id="name" placeholder="enter your name..." />
        </div>
        <div class="form-group mb-3">
          <label for="DOB">DOB</label>
          <br />
          <input v-model="newAuthor.DOB" class="border p-1 px-3 py-2 w-full rounded-lg border-gray-400 mt-2" type="text"
            name="DOB" id="DOB" placeholder="enter your DOB..." />
        </div>
        <div class="form-group mb-3">
          <label for="nationality">Nationality</label>
          <br />
          <input v-model="newAuthor.nationality" class="border p-1 px-3 py-2 w-full rounded-lg border-gray-400 mt-2"
            type="text" name="nationality" id="nationality" placeholder="enter your nationality..." />
        </div>
        <div class="form-group mb-3">
          <label for="NumberOfWrittenBook">Number of Written Books</label>
          <br />
          <input v-model.number="newAuthor.NumberOfWrittenBook"
            class="border p-1 px-3 py-2 w-full rounded-lg border-gray-400 mt-2" type="number" name="NumberOfWrittenBook"
            id="NumberOfWrittenBook" placeholder="enter number of written books..." />
        </div>
        <div class="flex justify-end items-end">
          <button type="submit"
            class="bg-blue-300 p-2 px-7 rounded-sm font-semibold hover:text-white hover:bg-blue-600 hover:cursor-pointer mt-5">
            Submit
          </button>
        </div>
      </form>
    </div>

    <!-- Edit Author Form -->
    <div v-if="showEditForm"
      class="shadow-md border rounded-lg z-10 absolute bg-gray-50 top-20 left-100 w-[500px] h-140">
      <form @submit.prevent="submitEditForm" class="p-7">
        <div @click="closeEditForm" class="text-2xl flex justify-end hover:text-gray-500 hover:cursor-pointer">
          <i class="fa-regular fa-circle-xmark"></i>
        </div>
        <div class="flex justify-center items-end mb-5">
          <h1 class="font-bold text-2xl">Edit Author Form</h1>
        </div>
        <div class="form-group mb-3">
          <label for="edit-name">Name</label>
          <br />
          <input v-model="editAuthorData.name" class="border p-1 px-3 py-2 w-full rounded-lg border-gray-400 mt-2"
            type="text" name="edit-name" id="edit-name" placeholder="enter your name..." />
        </div>
        <div class="form-group mb-3">
          <label for="edit-DOB">DOB</label>
          <br />
          <input v-model="editAuthorData.DOB" class="border p-1 px-3 py-2 w-full rounded-lg border-gray-400 mt-2"
            type="text" name="edit-DOB" id="edit-DOB" placeholder="enter your DOB..." />
        </div>
        <div class="form-group mb-3">
          <label for="edit-nationality">Nationality</label>
          <br />
          <input v-model="editAuthorData.nationality"
            class="border p-1 px-3 py-2 w-full rounded-lg border-gray-400 mt-2" type="text" name="edit-nationality"
            id="edit-nationality" placeholder="enter your nationality..." />
        </div>
        <div class="form-group mb-3">
          <label for="edit-NumberOfWrittenBook">Number of Written Books</label>
          <br />
          <input v-model.number="editAuthorData.NumberOfWrittenBook"
            class="border p-1 px-3 py-2 w-full rounded-lg border-gray-400 mt-2" type="number"
            name="edit-NumberOfWrittenBook" id="edit-NumberOfWrittenBook"
            placeholder="enter number of written books..." />
        </div>
        <div class="flex justify-end items-end">
          <button type="submit"
            class="bg-blue-300 p-2 px-7 rounded-sm font-semibold hover:text-white hover:bg-blue-600 hover:cursor-pointer mt-10">
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
        <tr v-for="(author, index) in authors" :key="author.id" class="hover:bg-gray-100">
          <td class="px-6 py-4 text-sm text-gray-700">{{ index + 1 }}</td>
          <td class="px-6 py-4 text-sm text-gray-700">{{ author.name }}</td>
          <td class="px-6 py-4 text-sm text-gray-700">{{ author.DOB }}</td>
          <td class="px-6 py-4 text-sm text-gray-700">{{ author.nationality }}</td>
          <td class="px-6 py-4 text-sm text-gray-700">{{ author.NumberOfWrittenBook }}</td>
          <td class="px-6 py-4 text-sm text-gray-700 space-x-2">
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

  <!-- Show Author Card detail-->
  <div v-if="selectedAuthor" class="fixed inset-0 bg-opacity-30 flex items-center justify-center z-50">
    <div class="relative bg-white p-6 rounded-lg shadow-lg max-w-md w-full mx-4">
      <!-- Close button -->
      <button @click="closeAuthorCard" aria-label="Close author details"
        class="absolute top-3 right-3 text-gray-600 hover:text-gray-900 focus:outline-none">
        <i class="fa-regular fa-circle-xmark text-2xl"></i>
      </button>

      <h2 class="text-2xl font-bold mb-4 text-blue-600 flex items-center gap-2">
        <i class="fa-solid fa-book-open"></i> Author Details
      </h2>
      <p class="mb-2"><strong>Name:</strong> {{ selectedAuthor.name }}</p>
      <p class="mb-2"><strong>DOB:</strong> {{ selectedAuthor.DOB }}</p>
      <p class="mb-2"><strong>Nationality:</strong> {{ selectedAuthor.nationality }}</p>
      <p class="mb-2"><strong>Books Written:</strong> {{ selectedAuthor.NumberOfWrittenBook }}</p>
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

const newAuthor = ref({
  name: '',
  DOB: '',
  nationality: '',
  NumberOfWrittenBook: null,
})

const editAuthorData = ref({})


// Get all authors
// ------------------------
const fetchAuthors = async () => {
  try {
    const response = await axios.get('http://192.168.108.62:8000/api/authors/')
    authors.value = response.data.data || response.data
  } catch (error) {
    alert('❌ Failed to fetch authors')
    console.error(error)
  }
}
onMounted(fetchAuthors)

// Get author by id
// ------------------------
const getAuthorById = async (id) => {
  try {
    const res = await axios.get(`http://192.168.108.62:8000/api/authors/${id}`)
    selectedAuthor.value = res.data
  } catch (err) {
    alert('❌ Cannot fetch author by ID')
  }
}


// create authors -- post method
const submitForm = async () => {
  try {
    const res = await axios.post('http://192.168.108.62:8000/api/authors/', newAuthor.value)
    authors.value.push(res.data)
    newAuthor.value = { name: '', DOB: '', nationality: '', NumberOfWrittenBook: null }
    showform.value = false
  } catch (error) {
    console.error('Failed to create author:', error)
    alert('❌ Failed to create author')
  }
}



// Update author
// ------------------------
const editAuthor = (author) => {
  editAuthorData.value = { ...author }
  showEditForm.value = true
}

const submitEditForm = async () => {
  const id = editAuthorData.value.id
  try {
    const res = await axios.put(`http://192.168.108.62:8000/api/authors/edit/${id}`, editAuthorData.value)
    const index = authors.value.findIndex(a => a.id === id)
    if (index !== -1) authors.value[index] = res.data
    closeEditForm()
  } catch (err) {
    alert('❌ Failed to update author')
    console.error(err)
  }
}

// close icon function
const closeEditForm = () => {
  showEditForm.value = false
  editAuthorData.value = {}
}

// delete author
// ------------------------
const deleteAuthor = async (id) => {
  if (!confirm('Are you sure you want to delete this author?')) return
  try {
    await axios.delete(`http://192.168.108.62:8000/api/authors/delete/${id}`)
    authors.value = authors.value.filter((a) => a.id !== id)
  } catch (err) {
    alert('❌ Failed to delete author')
    console.error(err)
  }
}

// SHOW AUTHOR DETAILS
// ------------------------
const showAuthor = (author) => {
  selectedAuthor.value = author
}
const closeAuthorCard = () => {
  selectedAuthor.value = null
}
</script>


<style scoped>
.w-99 {
  width: 24rem;
}
</style>
