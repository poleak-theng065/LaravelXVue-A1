<template>
  <div class="p-7 px-10 flex justify-between items-center">
    <h1 class="flex items-center gap-3 text-3xl font-bold">
      <i class="fa-solid fa-user-tie"></i> Author List :
    </h1>
     <div>
        <button @click="showform = !showform" class="bg-blue-300 p-2 px-7 rounded-sm font-semibold hover:text-white hover:bg-blue-600 hover:cursor-pointer">
        Add Author
      </button> 
    </div>

    <!-- start form input to create author -->
    <div v-if="showform" class="shadow-md border rounded-lg z-10 absolute bg-gray-50 top-20 left-100 h-120">
     
      <form @submit.prevent="submitForm" action="#" class="p-7">
        <!-- toggle hide form---------------------- -->
        <div @click="showform = false" class="text-2xl flex justify-end hover:text-gray-500 hover:cursor-pointer">
          <i class="fa-regular fa-circle-xmark"></i>
        </div>
        <!-- end of toggle ------------ -->
        <div class="flex justify-center items-end mb-5"><h1 class="font-bold text-2xl">Create Author Form</h1></div>
        <div class="form-group mb-3 ">
          <label for="name">FullName</label> <br>
          <input class="border p-1 px-3 py-2 w-100 rounded-lg border-gray-400 mt-2" type="text" name="name" id="name" placeholder="enter your name...">
        </div>
         <div class="form-group mb-3">
          <label for="country">Country</label> <br>
          <input class="border p-1 px-3 py-2 w-100 rounded-lg border-gray-400 mt-2" type="text" name="country" id="country" placeholder="enter your country...">
        </div>
         <div class="form-group mb-3">
          <label for="quantity">Quantity</label> <br>
          <input class="border p-1 px-3 py-2 w-100 rounded-lg border-gray-400 mt-2" type="text" name="quantity" id="quantity" placeholder="enter your quantity...">
        </div>
         <div class="flex justify-end items-end">
          <button class="bg-blue-300 p-2 px-7 rounded-sm font-semibold hover:text-white hover:bg-blue-600 hover:cursor-pointer mt-10" >Submit</button>
         </div>
      </form>
    </div>

    <!-- end of form create -->
  </div>

  <div class="overflow-x-auto px-10 mb-10">
    <table class="min-w-full border border-gray-300 divide-y divide-gray-200">
      <thead class="bg-blue-100 text-left">
        <tr>
          <th class="px-6 py-3 text-sm font-semibold text-gray-700">No.</th>
          <th class="px-6 py-3 text-sm font-semibold text-gray-700">Full Name</th>
          <th class="px-6 py-3 text-sm font-semibold text-gray-700">DOB</th>
          <th class="px-6 py-3 text-sm font-semibold text-gray-700">Country</th>
          <th class="px-6 py-3 text-sm font-semibold text-gray-700">Quantity</th>
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
          <td class="px-6 py-4 text-sm text-gray-700">{{ author.dob }}</td>
          <td class="px-6 py-4 text-sm text-gray-700">{{ author.country }}</td>
          <td class="px-6 py-4 text-sm text-gray-700">{{ author.books }}</td>
          <td class="px-6 py-4 text-sm text-gray-700 space-x-2">
            <button class="text-blue-600 hover:underline cursor-pointer" @click="showAuthor(author)">Show</button>
            <button class="text-yellow-600 hover:underline" @click="editAuthor(author)">Edit</button>
            <button class="text-red-600 hover:underline" @click="deleteAuthor(author.id)">Delete</button>
          </td>
        </tr>
      </tbody>
    </table>
  </div>


  <!-- show card of author -->
  <div v-if="selectedAuthor"  class="bg-white p-6 rounded-lg shadow-lg w-full h-70 max-w-md absolute top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 z-50">
    <!-- Close Button -->
    <div class="absolute top-2 right-3 text-xl cursor-pointer hover:text-gray-600" @click="closeAuthorCard">
      <i class="fa-regular fa-circle-xmark"></i>
    </div>

    <!-- Author Info -->
    <h2 class="text-2xl font-bold mb-4 text-blue-600">📘 Author Details</h2>
    <p><strong>Full Name:</strong> {{ selectedAuthor.name }}</p>
    <p><strong>Country:</strong> {{ selectedAuthor.country }}</p>
    <p><strong>Books:</strong> {{ selectedAuthor.books }}</p>
  </div>

</template>

<script setup>
import { ref } from 'vue'

const authors = ref([
  { id: 1, name: 'Theng Poleak',dob:'10-19-2025', country: 'Cambodia', books: 12 },
  { id: 2, name: 'Chheang Phally',dob:'10-19-2025', country: 'Thailand', books: 7 },
  { id: 3, name: 'Boy Sokchea',dob:'10-19-2025',  country: 'Vietnam', books: 5 },
  { id: 4, name: 'Chheun Seangmeng',dob:'10-19-2025', country: 'Laos', books: 9 }
])


function editAuthor(author) {
  alert(`📝 Edit feature not implemented yet for: ${author.name}`)
}

function deleteAuthor(id) {
  authors.value = authors.value.filter(author => author.id !== id)
}

// show form create author function--------------
const showform = ref(false)

// show card of author in detail ---------------
const selectedAuthor = ref('')
const showAuthor = (author) => {
  selectedAuthor.value = author
}
const closeAuthorCard = () => {
  selectedAuthor.value = ''
}


</script>

<style scoped></style>
