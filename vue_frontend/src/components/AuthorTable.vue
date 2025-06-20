<template>
  <div class="p-7 px-10 flex justify-between items-center">
    <h1 class="flex items-center gap-3 text-3xl font-bold">
      <i class="fa-solid fa-user-tie"></i> Author List :
    </h1>
     <div>
      <button class="bg-blue-300 p-2 px-7 rounded-sm font-semibold hover:text-white hover:bg-blue-600 hover:cursor-pointer">
        Add Author
      </button> 


    </div>
  </div>

  <div class="overflow-x-auto px-10 mb-10">
    <table class="min-w-full border border-gray-300 divide-y divide-gray-200">
      <thead class="bg-blue-100 text-left">
        <tr>
          <th class="px-6 py-3 text-sm font-semibold text-gray-700">No.</th>
          <th class="px-6 py-3 text-sm font-semibold text-gray-700">Full Name</th>
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
          <td class="px-6 py-4 text-sm text-gray-700">{{ author.country }}</td>
          <td class="px-6 py-4 text-sm text-gray-700">{{ author.books }}</td>
          <td class="px-6 py-4 text-sm text-gray-700 space-x-2">
            <button class="text-blue-600 hover:underline" @click="showAuthor(author)">Show</button>
            <button class="text-yellow-600 hover:underline" @click="editAuthor(author)">Edit</button>
            <button class="text-red-600 hover:underline" @click="deleteAuthor(author.id)">Delete</button>
          </td>
        </tr>
      </tbody>
    </table>
  </div>
</template>

<script setup>
import { ref } from 'vue'

const authors = ref([
  { id: 1, name: 'Theng Poleak', country: 'Cambodia', books: 12 },
  { id: 2, name: 'Chheang Phally', country: 'Thailand', books: 7 },
  { id: 3, name: 'Boy Sokchea', country: 'Vietnam', books: 5 },
  { id: 4, name: 'Chheun Seangmeng', country: 'Laos', books: 9 }
])

function showAuthor(author) {
  alert(`📘 ${author.name} from ${author.country} has ${author.books} books.`)
}

function editAuthor(author) {
  alert(`📝 Edit feature not implemented yet for: ${author.name}`)
}

function deleteAuthor(id) {
  authors.value = authors.value.filter(author => author.id !== id)
}
</script>

<style scoped></style>
